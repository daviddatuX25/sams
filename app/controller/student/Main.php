<?php
    class controller_student_Main extends Controller_Protected{
        public function __construct(){
            parent::__construct($newlyLoggedIn = false, $controllerGroup = $this->reflectController($this));
        }
        public function index(){
            header('location: ' . BASE_URL . '/student/dashboard');
            exit;
        }
    }
?>