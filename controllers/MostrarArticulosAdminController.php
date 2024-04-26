<!-- controller/MostrarArticulosAdminController.php -->
<?php
//  var_dump("hola");

class MostrarArticulosAdminController {

    public static function mostrarArticulosPosteados() {
        require_once "./config/Basemysql.php";
        require_once "./models/Articulo.php";
        $articulo =  new Articulo();
        $resultado = $articulo->leer();
        
        require_once("./views/viewsAdmin/articulos.php");
    }
}
?>

