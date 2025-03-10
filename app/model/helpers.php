<?php
    class Model_helpers{
        public static function sanitize(){
            foreach ($_POST as $key => $value) {
                $_POST[$key] = htmlspecialchars($value);
            }
            foreach ($_GET as $key => $value) {
                $_GET[$key] = htmlspecialchars($value);
            }
        }
    }
?>