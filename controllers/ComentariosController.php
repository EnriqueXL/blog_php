<!-- controller/ArticuloController.php -->
<?php

require_once "./config/Basemysql.php";
require_once "./models/Comentario.php";
class ComentariosController
{

    public static function mostrarComentarios()
    {
       
        //Instancimos el objeto
        $comentarios = new Comentario();
        $listaComentarios = $comentarios->leer();

        // if ($_SESSION['autenticado'] == false) {
        //     header("Location: ".REGISTRO."");
        // }

        require_once("./views/viewsAdmin/comentarios.php");
        exit;
        // header("Location: " . BASE_PATH . "/views/viewsAdmin/comentarios.php");
    }

    public static function editarComentario()
    {
        require_once "./config/Basemysql.php";
        require_once "./models/Comentario.php";

        //Validar si se envío el id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        //Instancimos el objeto
        $comentario = new Comentario();
        $resultado = $comentario->leer_individual($id);

        if (isset($_POST["editarComentario"])) {
         
            $idComentario = $_POST["id"];
            $estado = $_POST["cambiarEstado"];

            $comentario = new Comentario();
            

            //Actualizar comentario
            if ($comentario->actualizar($idComentario, $estado)) {
                $mensaje = "Comentario actualizado correctamente";
                // LISTA_COMENTARIOS
                header("Location:". LISTA_COMENTARIOS . "");
                exit;
            } else {
                $error = "Error, no se pudo actualizar";
                exit;
            }
        }

        if (isset($_POST["borrarComentario"])) {

            $idComentario = $_POST["id"];

            $comentario = new Comentario();

            //Crear usuario
            if ($comentario->borrar($idComentario)) {
                $mensaje = "Comentario borrado correctamente";
                // header("Location:comentarios.php?mensaje=" . urlencode($mensaje));
                // LISTA_COMENTARIOS
                header("Location:". LISTA_COMENTARIOS . "");
                exit;
            } else {
                $error = "Error, no se pudo borrar";
                exit;
            }
        }
        
        require_once("./views/viewsAdmin/editar_comentario.php");
        // header("Location: " . EDITAR_COMENTARIOS . "");   
        // header("Location: " . RUTA_ADMIN . "editar_comentario.php"); 
 
        
    }
}
?>