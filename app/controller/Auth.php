<?php
class Controller_Auth{
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

        echo View_Render::render("auth/login", [
            "usernameVerified" => NULL,
            "passwordVerified" => NULL
        ], "Login Page");
    }

    public function register() {
        echo View_Render::render("auth/register", [], "Register Page");
    }
}
?>