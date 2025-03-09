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

    public function login() {

        if (isset($_POST["userKey"]) && isset($_POST["password"])) {
            $userKey = $_POST["userKey"];
            $password = $_POST["password"];

            $user = new Model_User();
            $user->setUsername($userKey);
            $user->setPassword($password);

            $userKeyVerified = $user->verifyUserKey();
            $passwordVerified = $user->verifyPassword();

            if ($userKeyVerified && $passwordVerified) {
                $_SESSION["userKey"] = $userKey;
                header("Location: " . BASE_URL);
                return;
            }
        }

        echo View_Render::render("home/login", [
            "usernameVerified" => NULL,
            "passwordVerified" => NULL
        ], "Login Page");
    }

    public function register() {
        echo View_Render::render("home/register", [], "Register Page");
    }
}
?>