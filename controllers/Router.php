<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Router.php
include_once 'ArticuloController.php';

class Router {

    private $routes = [];

    public function get($path, $callback) {
        $this->routes[$path] = $callback;
        
    }

    public function resolve() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = str_replace('/github/blog', '', $path); // Asegúrate de reemplazar '/github/blog' con la ruta base de tu aplicación
    
        $callback = $this->routes[$path] ?? false;
    
        if ($callback === false) {
            echo "Página no encontrada";
            return;
        }
    
        echo call_user_func($callback);
    }
}

$router = new Router();

// $router->get('/', 'ArticuloController::index');

$router->get('/', function() {
    
    $articuloController = new ArticuloController();
    return $articuloController->index();
});

// $router->get('/about', function() {
//     echo "About Page";
//     // return "About Page";
// });

// $router->get('/contact', function() {
//     return "Contact Page";
// });

$router->resolve();
?>