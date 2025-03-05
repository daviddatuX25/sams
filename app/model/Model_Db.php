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

    protected function create($table, $columns, $values){

        $preStmt = "INSERT INTO " . $table . "(" . implode("," , $columns) . ")" . " VALUES";

        $valuesStmt = "(" . implode(',' , 
            array_map(function($row){
                return '(' . implode(',' , $row) . ')';
            },$values
        )) . ")";
       

        $stmt = $this->db->prepare($preStmt . $valuesStmt);
        return $stmt->execute();
    }


    protected function read($sql){
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }
}

?>