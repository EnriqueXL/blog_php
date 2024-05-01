<!-- controller/ArticuloController.php -->
<?php
class ArticuloController {

    public static function index() {
        require_once "./config/Basemysql.php";
        require_once "./models/Articulo.php";
        $articulos = new Articulo();
        $resultado = $articulos->leer();

        require_once("./views/paginaPrincipal.php");     
    }
}
?>

