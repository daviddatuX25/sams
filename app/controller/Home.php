<?php
class Controller_Home {
    public function index() {
        echo View_Render::render("home/index", [], "Welcome page");
    }

    public function project() {
        echo View_Render::render("home/project", [], "The Project");
    }

    public function creators() {
        echo View_Render::render("home/creators", [], "The Creators");
    }
}
?>