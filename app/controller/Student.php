<?php
class Controller_Student{
    public function dashboard(){
        echo View_Render::render("student/dashboard", [], "Dashboard");
    }
    public function live(){
        echo View_Render::render("student/attendance/live", [], "Live Classes");
    }
    public function recorded(){
        echo View_Render::render("student/attendance/records", [], "Recorded Classes");
    }
    public function profileSettings(){
        echo View_Render::render("student/profile_settings", [], "Profile Settings");
    }
}
?>