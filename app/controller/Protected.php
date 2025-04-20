<?php 
class Controller_Protected extends Controller_Main {

    public function __construct($isAuthPage = false, $controllerGroup) {
        if($this->isLoggedIn()) {
            if(isset($_POST['logout']) && $this->isAjaxRequest()){
                header('Content-Type: application/json');
                $location = $this->logoutUser($returnURL = true);
                echo json_encode(['location' => $location]);
                exit;
            }
            $this->redirectToPortal($newlyLoggedIn = false, $controllerGroup);
        } else {
            if (!$isAuthPage){
                $this->redirectToLogin();
            }
        }
    }

    // Level 3
    protected function redirectToPortal($newlyLoggedIn = false, $controllerGroup){
        $exceptionControllerGroup = ['']; // For future allowed controllers for all types of roles/users roles.
        $userRole = $this->currentUser()['role'];
        if (($controllerGroup !== $userRole && !(in_array($controllerGroup, $exceptionControllerGroup))) || $newlyLoggedIn) {

            switch($userRole){
                case 'student':
                    $userController = new controller_student_Main; 
                    break;
                case 'teacher': 
                    $userController = new controller_teacher_Main;
                    break;
                case 'admin':
                    $userController = new controller_admin_Main;
                    break;
                default:
                    $userController = new controller_Home;  
                    break;
            }
            $userController->index();
        }
    }

    protected function redirectToLogin() {
        header("Location: " . BASE_URL . "/login");
        exit;
    }

    // Level 2
    

    protected function isLoggedIn() {
        $this->sessionStart();
        return isset($_SESSION['user']);
    }

    protected function logoutUser($returnURL){
        $this->sessionStart();
        unset($_SESSION['user']);
        if($returnURL){
            return BASE_URL . "/login";
        } else {
            $this->redirectToLogin();
        }
       
    }

    protected function setCurrentUser($user){
        $this->sessionStart();
        $_SESSION['user'] = $user;
    }

    // Level 1
    protected function sessionStart(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    protected function currentUser() {
        return $_SESSION['user'] ?? null;
    }

}

?>