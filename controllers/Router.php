<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['autenticado'])) {
    $_SESSION['autenticado'] = false;
}else{
    $usuario = $_SESSION['usuario'];
}
// else{
//     if (session_destroy()) {
//         echo "Sesión destruida correctamente";
//     } else {
//         echo "Error al destruir la sesión";
//     }
// }

//Configuración del path
include_once './config/config.php';
//Controladores importados
include_once 'loginController.php';
include_once 'ArticuloController.php';
include_once 'DetalleArticuloController.php';
// include_once 'agregarComentarioController.php';
include_once 'MostrarArticulosAdminController.php';
include_once 'EditarArticuloController.php';
include_once 'CrearArticuloController.php';
include_once 'ComentariosController.php';
include_once 'UsuariosController.php';

// Router.php
class Router {

    private $routes = [];

    public function get($path, $callback) {
        $this->routes[$path] = $callback;
        
    }

    public function resolve() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = str_replace(BASE_PATH, '', $path); // Elimina el path base de la URL
    
        $callback = $this->routes[$path] ?? false;
    
        if ($callback === false) {
            require_once("./views/404.php"); 
            return;
        }

        // Lista de rutas que no requieren autenticación
        $publicRoutes = ['/acceder.php', '/registro.php'];

        // Valida el Path con la ruta es decir /github/blog/ + /acceder.php o /registro.php
        //Verificar si el usuario está autenticado
        if (!in_array($path, $publicRoutes) && $_SESSION['autenticado'] == false) {
            header("Location: ".REGISTRO."");
        exit;
    }
        echo call_user_func($callback);
    }
}

$router = new Router();

// Guia para crear rutas
//IMPORTAR EL CONTROLADOR QUE SE VA A USAR
// $router->get('/pagina que se ingresara a la url', 'nombre_de_la_clase::nombre_de_la_funcion');

//login de usuarios
$router->get('/acceder.php', 'loginController::accederUsuario');

//Registro de usuarios
$router->get('/registro.php', 'UsuariosController::registrarUsuario');

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

//Ruta para el admin, mostrar usuarios
$router->get('/admin/usuarios.php', 'UsuariosController::mostrarUsuarios');

//Ruta para el admin, editar usuarios
$router->get('/admin/editar_usuario.php', 'UsuariosController::editarUsuarios');

//Ruta para cerrar sesion
$router->get('/salir.php', 'loginController::destruirSesion');

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