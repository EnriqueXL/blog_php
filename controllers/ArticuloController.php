<!-- controller/ArticuloController.php -->
<?php
class ArticuloController {

    public static function index() {
        require_once "./config/Basemysql.php";
        require_once "./models/Articulo.php";
        $articulos = new Articulo();
        $resultado = $articulos->leer();

        // var_dump($resultado);

        if ($resultado) {
            require_once("./views/paginaPrincipal.php");
            // return $resultado;
        } else {
            echo json_encode(array('mensaje' => 'No hay artículos publicados'));
        }
    }
}
?>

