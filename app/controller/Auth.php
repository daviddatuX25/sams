<?php
class Controller_Auth{
    public function login() {
        echo View_Render::render('includes/header');
        echo View_Render::render('includes/navbar/homeNav', ["activeLink" => "login"]);
        echo View_Render::render("home/login", [], "Login Page");
        echo View_Render::render('includes/footer');
    }

    public function register() {
        echo View_Render::render('includes/header');
        echo View_Render::render('includes/navbar/homeNav', ["activeLink" => "register"]);
        echo View_Render::render("home/register", [], "Register Page");
        echo View_Render::render('includes/footer');

    }
}
?>