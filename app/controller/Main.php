<?php
class controller_Main extends controller_Utilities{
    // View Renderer
    protected static function render($templateFilePathName, $data = [], $pageTitle = NULL, $display = true) {
        if ($data != NULL) {
            extract($data);
        }
        ob_start();
        include("../app/view/templates/" . $templateFilePathName . ".php");
        if ($display){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }

    // Error Handlings
    public static function handle404($routePath, $extended_message = NULL) { // 404 error handler
        http_response_code(404);
        Controller_Main::render('includes/header',[],'Page not Found');
        Controller_Main::render("404error", ["routePath" => $routePath, "extended_message" => $extended_message]);
        Controller_Main::render('includes/footer');
    }
}
