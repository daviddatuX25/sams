<?php
    class Controller_Student_Classes extends Controller_Student_Main{
        public function index(){
            $this->render('student/classes', [] ,$pageTitle = "Classes");
        }
    }

?>