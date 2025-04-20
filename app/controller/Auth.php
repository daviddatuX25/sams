<?php
class Controller_Auth extends Controller_Protected{

    public function __construct() {
        parent::__construct($isAuthPage = true, $controllerGroup = 'auth');
    }

    public function createUserSession($userID){

    }

    public function login() {
        $pageTitle = "Login Page";
        [$passErr, $userErr] = null;
        if (isset($_POST['submit'])) {
           [$userKey, $password] = $this->sanitizeInput([$_POST['user_key'], $_POST['password']]);
            $userDB = new Model_User();
            if($userDB->userExists($userKey)){
                $user = $userDB->authenticateUserByPassword($userKey, $password);
                if ($user) {
                    $this->setCurrentUser($user);
                    $this->redirectToPortal($newlyLoggedIn = true, $controllerGroup = null);
                } else {$passErr = true;}
            } else { $userErr = true; }
            $userErrMsg = $userErr ? "User key can not be found." : null;
            $passErrMsg = $passErr ? "Password don't match" : null;
            $this->render("home/login", ["passErrMsg" => $passErrMsg, "lastUserKey" => $userKey, "userErrMsg" => $userErrMsg], $pageTitle);
        } else {
            $this->render("home/login", [], $pageTitle);
        }
    }

    public function register() {
        $userDB = new Model_User(null);

        if ($this->isAjaxRequest()){
            header('Content-Type: application/json');
            $response = [];
            $userKey = $this->sanitizeInput($_POST['user_key']);
            $response['userKeyErr'] = $userDB->userExists($userKey) ? "Username or School ID already exists." : null;
            $cleanData = $this->sanitizeInput([
                'password' => $_POST['password'],
                'repeat_password' => $_POST['repeat_password']
            ]);
            $response['passErr'] = $this->passwordValidation($cleanData);
            $response['success'] = true;
            echo json_encode($response);
            exit;
        }

        if (isset($_POST['submit'])){
            list($validatedData, $errors) = $this->registerValidation($_POST, $userDB);
            if(!$errors){
                $user = $userDB->createUser($validatedData);
                $this->setCurrentUser($user);
                $this->redirectToPortal();
            } else {
                $this->render("home/register", ["errors" => $errors ?? null], "Register Error");
            }
        } else {
            $this->render("home/register", [], "Register Page");
        }
    }

    private function registerValidation($postData, $userDB){
        unset($postData['submit']);
        $cleanData = $this->sanitizeInput($postData);
        $emptyData = $this->checkEmptyInput($userDataGroup = $cleanData, $nullableFields = ['profile_picture','birthday', 'bio']);
        $err = []; // passErr[], userErr[], emptyData[]
        if (!$emptyData) {
            // Username Validation
            if(!$userDB->userExists($cleanData['user_key'])){
                $passwordError = $this->passwordValidation($cleanData);
                if(empty($passwordError)){// Prepare data for DB Create
                    $password = $cleanData['password'];
                    unset($cleanData['password']);
                    unset($cleanData['repeat_password']);
                    $cleanData['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
                    return [$cleanData, false];
                } else {
                    $err['passErr'] = $passwordError;
                }
            } else {
                $err['userKeyErr'] = "Username or School ID already exists.";
            }
        } else {
            $err['emptyData'] = $emptyData;
        }

        return [$cleanData ?? $postData ,$err];
    }

    private function passwordValidation($cleanData){
        // Password Validation
        $password = $cleanData['password'];
        $passwordError = [];
        if ($password !== $cleanData['repeat_password']) {// Matching pass
            $passwordError['match'] = "Passwords don't match";
        }
        if (strlen($password) < 8) { // Length of pass
            $passwordError['len'] = "Password must be at least 8 characters long";
        }
        if (!(preg_match('/(?=.*\d)/', $password))) { // Contains number
            $passwordError['digit'] = "Password must contain at least one digit";
        }
        
        if (!(preg_match('/(?=.*[A-Z])/', $password))) { // Contains uppercase letter
            $passwordError['uppercase'] = "Password must contain at least one uppercase letter";
        }
        return $passwordError;
    }
}
?>