<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Controladores importados
include_once 'ArticuloController.php';
include_once 'DetalleArticuloController.php';
// include_once 'agregarComentarioController.php';
include_once 'MostrarArticulosAdminController.php';
include_once 'EditarArticuloController.php';
include_once 'CrearArticuloController.php';
include_once 'ComentariosController.php';

include_once './config/config.php';



// Router.php
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

// Guia para crear rutas
//IMPORTAR EL CONTROLADOR QUE SE VA A USAR
// $router->get('/pagina que se ingresara a la url', 'nombre_de_la_clase::nombre_de_la_funcion');

//Redirijir a la página principal
$router->get('/inicio', 'ArticuloController::index');

//Redirijir a la página principal
$router->get('/index.php', 'ArticuloController::index');

//Redirijir a la página principal
$router->get('/', 'ArticuloController::index');

//Acceder a los detalles de cada articulo
$router->get('/detalle.php', 'DetalleArticuloController::mostrarDetalle');

//Crear Comentarios para los articulos posteados
// $router->get('/agregarComentario.php', 'agregarComentarioController::crearComentario');

//Ruta para el admin, crear articulos (Admin).
$router->get('/admin/crear_articulo.php', 'CrearArticuloController::crearArticulo');

//Ruta para el admin, visor de los articulos
$router->get('/admin/articulos.php', 'MostrarArticulosAdminController::mostrarArticulosPosteados');

//Ruta para el admin, editar articulos publicados
$router->get('/admin/editar_articulo.php', 'EditarArticuloController::actualizarArticulo');

//Ruta para el admin, mostrar comentarios
$router->get('/admin/comentarios.php', 'ComentariosController::mostrarComentarios');

//Ruta para el admin, editar comentarios
$router->get('/admin/editar_comentario.php', 'ComentariosController::editarComentario');


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