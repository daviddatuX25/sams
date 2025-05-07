<?php
class Controller_Home extends Controller_Main{
    public function index() {
        $this->render("home/index", [], "Welcome page");
    }

    public function project() {
        $this->render('includes/header');
        $this->render("home/project", [], "Projects Page");

    }

    public function creators() {
        $this->render("home/creators", [], "The Creators");
    }
}
?>