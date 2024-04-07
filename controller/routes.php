<!-- controller/routes.php -->
<?php
    require_once "models/Articulo.php";

    $articulos = new Articulo();
    $resultado = $articulos->leer();

    if ($resultado) {
      
        require_once("views/paginaPrincipal.php");
       
    } else {
        echo json_encode(array('mensaje' => 'No hay artículos publicados'));
    }

?>