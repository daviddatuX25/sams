<?php
class Model_Db {
    private $db;

    public function __construct(){
        
        $dsn = "mysql: host=" . DB_HOST . ";dbname=" . DB_NAME;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        
        try{
            $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e){
            throw new RuntimeException("Database failed to connect: " . $e->getMessage());
        }
    }

    // Executes a raw query on the database
    protected function query($sqlCode) {
        try {
            $this->statement = $this->db->prepare($sqlCode);
            return $this->statement->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Reads multiple rows from the database
    protected function read($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            foreach ($params as $index => $value) {
                $this->bind($stmt, $index + 1, $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    // Fetches a single result as an object (uses the last prepared statement)
    protected function readOne() {
        try {
            if (!$this->statement) {
                throw new Exception("No statement prepared. Call query() or another method first.");
            }
            $this->statement->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            return false;
        }
    }

    // Returns the ID of the last inserted row
    public function getLastId() {
        try {
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Bind helper function
    protected function bind($stmt, $parameter, $value, $type = "") {
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

    // Create function (returns last inserted ID on success)
    protected function create($table, $columns, $values) {
        if (count($columns) != count($values)) {
            return false;
        }
        try {
            $sql = "INSERT INTO " . $table . " (" . implode(",", $columns) . ") VALUES (" . implode(",", array_fill(0, count($columns), "?")) . ")";
            $stmt = $this->db->prepare($sql);
            foreach ($values as $index => $value) {
                $this->bind($stmt, $index + 1, $values[$index]);
            }
            $success = $stmt->execute();
            return $success ? $this->getLastId() : false;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Update function
    protected function update($table, $data, $where, $whereValue) {
        try {
            $setParts = [];
            foreach (array_keys($data) as $column) {
                $setParts[] = "$column = ?";
            }
            $setStmt = implode(", ", $setParts);
            $sql = "UPDATE " . $table . " SET " . $setStmt . " WHERE " . $where;
            $stmt = $this->db->prepare($sql);
            $dataValues = array_values($data);
            foreach ($dataValues as $index => $value) {
                $this->bind($stmt, $index + 1, $dataValues[$index]);
            }
            $this->bind($stmt, count($dataValues) + 1, $whereValue);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Delete function
    protected function delete($table, $where, $whereValue) {
        try {
            $sql = "DELETE FROM " . $table . " WHERE " . $where;
            $stmt = $this->db->prepare($sql);
            $this->bind($stmt, 1, $whereValue);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

?>