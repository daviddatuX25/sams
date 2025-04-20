<?php
class Model_User{
    private $tableName = 'users';
    private $userSessionData = ["user_id", "first_name", "role", "profile_picture"];
    private function userKeyCondition($userKey){
        return ["column" => "user_key", "operator" => "=", "value" => $userKey];
    } 

    public function __construct($db = null){
        if (isset($db)){
            $this->db = $db;
        } else {
            $this->db = new Model_Db('users');
        }
    }

    public function userExists($userKey){
        $result = $this->db->readOne(
            $this->tableName, 
            $columns = ['user_id'], 
            $where = [$this->userKeyCondition($userKey)]
        );
        return $result['user_id'] ?? null;
    }

    public function authenticateUserByPassword($userKey, $password){
        $result = $this->db->readOne(
            $this->tableName, 
            $columns = ["password_hash"],
            $where = [$this->userKeyCondition($userKey)]
        );
       if (password_verify($password, $result['password_hash'])){
            $user = $this->db->readOne(
                $this->tableName, 
                $columns = $this->userSessionData, 
                $where = [$this->userKeyCondition($userKey)]
            );
       }
       return $user ?? false;
    }

    public function createUser($userDataGroup){
        unset($userDataGroup['password_confirm']);
        $userID = $this->db->create($table = $this->$tableName, $data = $userDataGroup);
        $user = $this->db->readOne($where = ['user_id' => $userID]);
        return $user ?? false;
    }
}
?>