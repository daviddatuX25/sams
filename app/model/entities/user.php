<?php
class Model_Entities_User{
    private $db;

    public function __construct(){
        $this->db = new Model_Db();
    }
    
}
?>