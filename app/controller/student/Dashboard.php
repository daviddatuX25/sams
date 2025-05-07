<?php
    class Controller_Student_Dashboard extends Controller_Student_Main {
        public function index(){
            $this->render('student/dashboard', [],$pageTitle = "Dashboard");
        }
    }
?>