<?php
class Controller_Home {
    public function index() {
        echo View_Render::render('includes/header');
        echo View_Render::render('includes/navbar/homeNav', ["activeLink" => "index"]);
        echo View_Render::render("home/index", [], "Welcome page");
        echo View_Render::render('includes/footer');
    }

    public function project() {
        echo View_Render::render('includes/header');
        echo View_Render::render('includes/navbar/homeNav', ["activeLink" => "project"]);
        echo View_Render::render("home/project", [], "The Project");
        echo View_Render::render('includes/footer');
    }

    public function creators() {
        echo View_Render::render('includes/header');
        echo View_Render::render('includes/navbar/homeNav', ["activeLink" => "creators"]);
        echo View_Render::render("home/creators", [], "The Creators");
        echo View_Render::render('includes/footer');
    }
}
?>