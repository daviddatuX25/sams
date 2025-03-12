<?php
class Controller_Student{
    public function dashboard(){
        echo View_Render::render("includes/header",[], "Dashboard");
        echo View_Render::render("student/dashboard", []);
        echo View_Render::render("includes/footer");
    }
    public function liveClass($subpage = "index", $classSessionID = null){
        echo View_Render::render("includes/header",[], "Classes Today");
        echo View_Render::render('includes/navbar/includes/sidebarNav_header');
        echo View_Render::render('includes/navbar/studentNav', ['activeLink' => 'liveClass']);

        $studentClassSessions = new Model_Business_studentClassSessions();

        switch ($subpage){
            case "index":
                $todayClassesData = $studentClassSessions->getTodayClasses();
                    echo View_Render::render("student/attendance/liveClass", ["todayClassesData" => $todayClassesData]);
                break;
            case "class_session":
                if (isset($classSessionID)){
                    $liveClassData = $studentClassSessions->getLiveClassData($classSessionID);
                    echo View_Render::render("student/attendance/class_session", $liveClassData);
                }
                break;
            default:
                echo View_Render::render("404",[],"Page not found");
            
        }
        echo View_Render::render('includes/navbar/includes/sidebarNav_footer');
        echo View_Render::render("includes/footer");
    }
    public function timeline(){
        echo View_Render::render("includes/header",[], "Timeline");
        echo View_Render::render('includes/navbar/includes/sidebarNav_header');
        echo View_Render::render('includes/navbar/studentNav', ['activeLink' => 'timeline']);
        echo View_Render::render("student/attendance/timeline", []);
        echo View_Render::render('includes/navbar/includes/sidebarNav_footer');
        echo View_Render::render("includes/footer");
    }
    public function leaveform(){
        echo View_Render::render("includes/header",[], "Profile Settings");
        echo View_Render::render('includes/navbar/includes/sidebarNav_header');
        echo View_Render::render('includes/navbar/studentNav', ['activeLink' => 'profileSettings']);
        echo View_Render::render("student/attendance/timeline", []);
        echo View_Render::render('includes/navbar/includes/sidebarNav_footer');
        echo View_Render::render("includes/footer");
    }
}
?>