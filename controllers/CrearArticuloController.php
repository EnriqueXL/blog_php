<?php

    class CrearArticuloController {
       
        public static function crearArticulo() {
            require_once "./config/Basemysql.php";
            require_once "./models/Articulo.php";
            require_once "./views/viewsAdmin/crear_articulo.php";
            require_once "./config/config.php";

            $articulo = new Articulo();

            if (isset($_POST['crearArticulo'])) {

                //Obtener los valores
                $titulo = $_POST["titulo"];
                $texto = $_POST["texto"];
        
                if ($_FILES["imagen"]["error"] > 0) {
        
                    $error = "Error, ningún archivo seleccionado";
                } else {
        
                    if (empty($titulo) || $titulo == '' || empty($texto) || $texto == '') {
        
                        $error = "Error, algunos campos están vacíos";
                    } else {
        
                        $image = $_FILES['imagen']['name'];
                        $imageArr = explode('.', $image);
                        $rand = rand(1000, 99999);
                        $newImageName = $imageArr[0] . $rand . '.' . $imageArr[1];
                        $rutaDirectorio = "img/articulos/";
                        $rutaFinal = $rutaDirectorio . $newImageName;
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal);
        
                        if ($articulo->crear($titulo, $newImageName, $texto)) {
                            $mensaje = "Artículo creado correctamente";
                          
                            // require_once "./views/viewsAdmin/crear_articulo.php";
                            require_once "./views/viewsAdmin/crear_articulo.php";
                            // header("Location: " . BASE_PATH . "");
                            exit;
                            // header("Location:articulos.php?mensaje=" . urlencode($mensaje));
                        }else{
                            $error = "Error al guardar en la base de datos";
                        }
                    }
                }
            }
           
        }
    }
    
   

?>