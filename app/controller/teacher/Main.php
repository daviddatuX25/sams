<?php

class controller_teacher_Main extends Controller_Protected{
    public function __construct(){
        parent::__construct($newlyLoggedIn = false, $controllerGroup = $this->reflectController($this));
    }
    public function index(){
        echo "Teacher!";
    }
}

?>