<?php
class Controller_Student{
    public function dashboard(){
        echo View_Render::render("includes/header",[], "Dashboard");
        echo View_Render::render("student/dashboard", []);
        echo View_Render::render("includes/footer");
    }
    public function classesToday($subpage = "index", $args){
        echo View_Render::render("includes/header",[], "Classes Today");
        echo View_Render::render('includes/navbar/includes/sidebarNav_header');
        $studentClassSessions = new Model_business_studentClassSessions();
        switch ($subpage){
            case "index":
                $todayClassesData = $studentClassSessions->getTodayClasses();
                echo View_Render::render("student/attendance/classes_today", []);
                break;
            case "class_session":
                if (isset($args)){
                    $liveClassData = $studentClassSessions->getLiveClassData();
                    echo View_Render::render("student/attendance/class_session", $liveClassData);
                }
            default:
                echo View_Render::render("404",[],"Page not found");
            
        }
        echo View_Render::render('includes/navbar/includes/sidebarNav_footer');
        echo View_Render::render("includes/footer");
    }
    public function timeline(){
        echo View_Render::render("includes/header",[], "Timeline");
        echo View_Render::render('includes/navbar/includes/sidebarNav_header');
        echo View_Render::render("student/attendance/timeline", []);
        echo View_Render::render('includes/navbar/includes/sidebarNav_footer');
        echo View_Render::render("includes/footer");
    }
    public function leaveform(){
        echo View_Render::render("student/profile_settings", [], "Profile Settings");
    }
}
?>