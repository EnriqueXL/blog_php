<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Router.php
include_once 'ArticuloController.php';
include_once 'DetalleArticuloController.php';
include_once './config/config.php';

class Router {

    private $routes = [];

    public function get($path, $callback) {
        $this->routes[$path] = $callback;
        
    }

    public function resolve() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = str_replace(BASE_PATH, '', $path); // Asegúrate de reemplazar '/github/blog' con la ruta base de tu aplicación
    
        $callback = $this->routes[$path] ?? false;
    
        if ($callback === false) {
            require_once("./views/404.php"); 
            return;
        }
    
        echo call_user_func($callback);
    }
}

$router = new Router();

$router->get('/inicio', 'ArticuloController::index');

$router->get('/', 'ArticuloController::index');

//Acceder a los detalles de cada articulo
$router->get('/detalle.php', 'DetalleArticuloController::index');

// $router->get('/index.php', function() {
    
//     $articuloController = new ArticuloController();
//     return $articuloController->index();
// });

// $router->get('/about', function() {
//     echo "About Page";
//     // return "About Page";
// });

// $router->get('/contact', function() {
//     return "Contact Page";
// });

$router->resolve();
?>