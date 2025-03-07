<?php 
    class View_Render {
        public static function render($templateFileName, $data = array(), $pageTitle = NULL){
            $pageTitle = $pageTitle;
            extract($data);
            ob_start();
            include("templates/" . $templateFileName . ".php");
            return ob_get_clean();
        }
    }
?>