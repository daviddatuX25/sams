<?php
class Controller_Home {
    public function index() {
            echo View_Render::render("home.index", [], "Home page");
    }

    public function guides() {
            echo View_Render::render("home.guides", [], "Guides page");
    }

    public function about() {
        echo View_Render::render("home.about", [], "About page");
        }
}
?>