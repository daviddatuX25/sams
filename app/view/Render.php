<?php 
    class View_Render {
        public static function render($templateFileName, $data = array(), $pageTitle = NULL){
            $templateFileName = str_replace('.', '/', $templateFileName);
            $pageTitle = $pageTitle;
            extract($data);
            ob_start();
            if(isset($pageTitle)) include("templates/includes/header.php") ;
            include("templates/" . $templateFileName . ".php");
            if(isset($pageTitle)) include("templates/includes/footer.php") ;
            return ob_get_clean();
        }
    }
?>