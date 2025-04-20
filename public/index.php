<?php
require_once '../config/config.php';
require_once '../routes/main.php';

// Path extractor
function getCleanPath() {
    // Get the full request path
    $fullPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Remove the project folder name '/sams'
    $parts = explode('/', trim($fullPath, '/'));
    array_shift($parts); // Remove 'sams'
    
    // Join remaining parts and convert to lowercase
    return strtolower(implode('/', $parts));
}
$path = getCleanPath();

// Route handler
$routes = array_filter($routes); // Remove empty routes
foreach ($routes as $route => $handler) {
    // Convert :param to regex (\w+)
    $pattern =  preg_replace('/:\w+/', '(\w+)', str_replace('/', '\/', trim($route, '/')));
    if (preg_match("/^$pattern$/", $path, $matchedParams)) {
        array_shift($matchedParams); // Remove full match
        if (strpos($handler, "@") !== false) {
            list($controller, $method) = explode("@", $handler);
        } else {
            $controller = $handler;
            $method = "index"; // Default method
        }

        if (class_exists($controller) && method_exists($controller, $method)) {
            echo call_user_func_array([new $controller, $method], $matchedParams);
            return;
        } else {
            http_response_code(404);
            Controller_Main::handle404($routePath = $path);
            return;
        }
    }
}
Controller_Main::handle404($routePath = $path);


?>
 