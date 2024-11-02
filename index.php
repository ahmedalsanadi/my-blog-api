<?php

require_once 'Router.php';
require_once 'controller/BlogController.php';
require_once 'controller/UserController.php';

$router = new Router();

$requestMethod = $_SERVER['REQUEST_METHOD']; 
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = $router->resolve($requestMethod, $requestPath);

if ($route) {

    [$controller, $action, $params] = $route;
    $controller->$action(...$params);

} else {
    ResponseHelper::respondWithError(404, 'Not Found');
}