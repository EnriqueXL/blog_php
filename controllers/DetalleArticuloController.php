<!-- controller/ArticuloController.php -->
<?php
class DetalleArticuloController {

    public static function mostrarDetalle() {
        require_once "./config/Basemysql.php";
        
        require_once "./models/Articulo.php";
        require_once "./models/Usuario.php";
        require_once "./models/Comentario.php";
        

        if (isset($_GET["id"])) {
            $idArticulo = $_GET["id"];
        }
        
        //Instancimos el objeto
        $articulo = new Articulo();
        $resultado = $articulo->leer_individual($idArticulo);
        
        //Instanciar los comentario para este artículo
        $comentarios = new Comentario();
        $resultado2 = $comentarios->leerPorId($idArticulo);
        
        // Instancio el usuario de la clase Usuarios para ocupar el metodo de leer indiviual y recuperar el email de cada usuario
        $usuario = new Usuario($idArticulo);
        $resultado3 = $usuario->leer_individual($idArticulo);

    
         // Crear comentario
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            //Obtener los valores
            $idArticulo = $_POST['articulo'];
            $email = $_POST['usuario'];
            $comentario = $_POST['comentario'];
        
            if (empty($email) || $email == '' || empty($comentario) || $comentario == '') {
                $error = "Error, algunos campos están vacíos";
            } else {
                //Instanciamos el comentario
                $comentarioObj = new Comentario();

                if ($comentarioObj->crear($email, $comentario, $idArticulo)) {
                    $mensaje = "Comentario creado correctamente";
                    header("Location: " . BASE_PATH . " ");   
                    // header("Location: " . BASE_PATH . "/detalle.php");   
                    // require_once("./views/detalle.php");   
                    exit;

                } else {
                    $error = "Error, no se pudo crear el comentario";
                }
            }
        }

        require_once("./views/detalle.php");
    }
}
?>

