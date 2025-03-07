<?php
class Controller_Home {
    public function index() {
        echo View_Render::render("home/index", [], "Welcome page");
    }
}
?>