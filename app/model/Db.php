<?php
class Model_Db {
    private $db;
    private $stmt;
    private $table;

    public function __construct($table = null){
        $dsn = "mysql: host=" . DB_HOST . ";dbname=" . DB_NAME;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        $this->table = $table;
        try{
            $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e){
            throw new RuntimeException("Database failed to connect: " . $e->getMessage());
        }
    }

    // Executes a raw query on the database
    public function query($sqlCode) {
        try {
            $this->stmt = $this->db->prepare($sqlCode);
            return $this->stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Returns the ID of the last inserted row
    public function getLastId() {
        try {
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return null;
        }
    }

    // Bind helper function
    public function bind($stmt, $parameter, $value, $type = "") {
        if (is_array($value) || is_object($value)) {
            throw new InvalidArgumentException("Cannot bind array or object to SQL parameter");
        }
        if (empty($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $stmt->bindParam($parameter, $value, $type);
    }

    // Read helper function
        // Example:
        // Columns -> ['col1','col2',...]
        // Joins -> [ ["type" => "", "table" => "", "condition" => "" ], [],... ]
        // Where -> ["column" => "", "operator" => "", "value" => "" ]
    private function buildQuery($table, $columns = [], $where = [], $joins = [], $limit = null) {
        $table = $table ?? $this->table;
        try {
            // Build SELECT clause
            $select = empty($columns) || $columns === "*" ? '*' : implode(', ', $columns);
    
            // Build FROM clause
            $from = $table;
    
            // Build JOIN clauses
            $joinStmt = '';
            foreach ($joins as $join) {
                if (!isset($join['type'], $join['table'], $join['condition'])) {
                    throw new PDOException('Invalid join parameters');
                }
                $joinStmt .= " {$join['type']} JOIN {$join['table']} ON {$join['condition']}";
            }
    
            // Build WHERE clause
            $whereConditions = [];
            $bindValues = [];
            foreach ($where as $condition) {
                if (!isset($condition['column'], $condition['operator'], $condition['value'])) {
                    throw new PDOException('Invalid where condition');
                }
                $whereConditions[] = "{$condition['column']} {$condition['operator']} ?";
                $bindValues[] = $condition['value'];
            }
            $whereStmt = empty($whereConditions) ? '' : ' WHERE ' . implode(' AND ', $whereConditions);
    
            // Build SQL query
            $sql = "SELECT $select FROM $from $joinStmt $whereStmt";
            if ($limit !== null) {
                $sql .= " LIMIT $limit";
            }
    
            // Prepare statement
            $stmt = $this->db->prepare($sql);
    
            // Bind where values
            foreach ($bindValues as $index => $value) {
                $this->bind($stmt, $index + 1, $value);
            }
    
            return ['stmt' => $stmt, 'sql' => $sql];
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // Read helper: Returns one result or false
    public function readOne($table, $columns = [],  $where = [], $joins = []) {
        $table = $table ?? $this->table;
        try {
            if (empty($where)) {
                return false; // No where condition provided
            }
    
            $result = $this->buildQuery($table, $columns, $where, $joins);
            if (!$result) {
                return false;
            }
    
            $stmt = $result['stmt'];
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row !== false ? $row : false;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    // Read helper: Returns multiple results or empty array
    public function readAll($table, $columns = [], $where = [], $joins = [], $limit) {
        $table = $table ?? $this->table;
        try {
            $result = $this->buildQuery($table, $columns,$where, $joins, $limit );
            if (!$result) {
                return [];
            }
    
            $stmt = $result['stmt'];
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // Create function (returns last inserted ID on success)
    public function create($table, $data) {
        $table = $table ?? $this->table;
        $columns = array_keys($data);
        $values = array_values($data);
        try {
            $sql = "INSERT INTO " . $table . " (" . implode(",", $columns) . ") VALUES (" . implode(",", array_fill(0, count($columns), "?")) . ")";
            $stmt = $this->db->prepare($sql);
            foreach ($values as $index => $value) {
                $this->bind($stmt, $index + 1, $value);
            }
            $success = $stmt->execute();
            return $success ? $this->getLastId() : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($table, $data, $where) {
        $table = $table ?? $this->table;
        try {
            if (empty($data) || empty($where)) {
                return false; // No data or where condition provided
            }
    
            // Prepare SET clause
            $setParts = [];
            foreach (array_keys($data) as $column) {
                $setParts[] = "$column = ?";
            }
            $setStmt = implode(", ", $setParts);
    
            // Prepare WHERE clause
            $whereParts = [];
            foreach (array_keys($where) as $column) {
                $whereParts[] = "$column = ?";
            }
            $whereStmt = implode(" AND ", $whereParts);
    
            // Build SQL query
            $sql = "UPDATE " . $table . " SET " . $setStmt . " WHERE " . $whereStmt;
            $stmt = $this->db->prepare($sql);
    
            // Bind data values
            $dataValues = array_values($data);
            foreach ($dataValues as $index => $value) {
                $this->bind($stmt, $index + 1, $value);
            }
    
            // Bind where values
            $whereValues = array_values($where);
            $offset = count($dataValues);
            foreach ($whereValues as $index => $value) {
                $this->bind($stmt, $offset + $index + 1, $value);
            }
    
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function delete($table, $where) {
        $table = $table ?? $this->table;
        try {
            if (empty($where)) {
                return false; // No where condition provided
            }
    
            // Prepare WHERE clause
            $whereParts = [];
            foreach (array_keys($where) as $column) {
                $whereParts[] = "$column = ?";
            }
            $whereStmt = implode(" AND ", $whereParts);
    
            // Build SQL query
            $sql = "DELETE FROM " . $table . " WHERE " . $whereStmt;
            $stmt = $this->db->prepare($sql);
    
            // Bind where values
            $whereValues = array_values($where);
            foreach ($whereValues as $index => $value) {
                $this->bind($stmt, $index + 1, $value);
            }
    
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>