<!-- controller/ArticuloController.php -->
<?php
class ComentariosController {

    public static function mostrarComentarios() {
        require_once "./config/Basemysql.php";
        require_once "./models/Comentario.php";

        //Instancimos el objeto
        $comentarios = new Comentario();
        $resultado = $comentarios->leer();

        require_once("./views/viewsAdmin/comentarios.php");
        // header("Location: " . BASE_PATH . "/views/viewsAdmin/comentarios.php");
    }
}
?>

