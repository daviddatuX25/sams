<?php
require_once '../config/config.php';
require_once '../routes/main.php';

// Router
$requestUri = trim(str_replace(explode("/", trim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/'))[0], "", strtolower(trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'))), "/");
$routes = array_filter($routes); // Remove empty routes
foreach ($routes as $route => $handler) {
    // Convert :param to regex (\w+)
    $pattern =  preg_replace('/:\w+/', '(\w+)', str_replace('/', '\/', trim($route, '/')));
    if (preg_match("/^$pattern$/", $requestUri, $matches)) {
        array_shift($matches); // Remove full match

        if (strpos($handler, "@") !== false) {
            list($controller, $method) = explode("@", $handler);
        } else {
            $controller = $handler;
            $method = "index"; // Default method
        }

        if (class_exists($controller) && method_exists($controller, $method)) {
            echo call_user_func_array([new $controller, $method], $matches);
            return;
        } else {
            echo View_Render::render("404error", ["routeStr" => $requestUri, "message" => "Controller or method not found"], "404 Not Found");
            return;
        }
    }
}
echo View_Render::render("404error", ["routeStr" => $requestUri], "404 Not Found");
?>
 