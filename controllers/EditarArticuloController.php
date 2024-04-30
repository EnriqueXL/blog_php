<!-- controller/EditarArticuloController.php -->
<?php

class EditarArticuloController
{

    public static function actualizarArticulo()
    {
        require_once "./config/Basemysql.php";
        require_once "./models/Articulo.php";



        //Validar si se envío el id
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        //Instancimos el objeto
        $articulos = new Articulo();
        $resultado = $articulos->leer_individual($id);

        if (isset($_POST['editarArticulo']) && !empty($id)) {

            $idArticulo = $_POST["id"];
            $titulo = $_POST["titulo"];
            $texto = $_POST["texto"];

            if ($_FILES["imagen"]["error"] > 0) {
                //No se sube imagen pero deja actualizar demás campos

                if (empty($titulo) || $titulo == '' || empty($texto) || $texto == '') {
                    $error = "Error, algunos campos están vacíos";
                } else {

                    //Instanciamos el articulo
                    $articulo = new Articulo();

                    $newImageName = "";

                    if ($articulo->actualizar($idArticulo, $titulo, $texto, $newImageName)) {
                        $mensaje = "Artículo actualizado correctamente";
                        // var_dump($mensaje);
                        $articulo =  new Articulo();
                        $resultado = $articulo->leer();
                    
                        header("Location: " . RUTA_ADMIN . "articulos.php");            
                        // /github/blog/admin/articulos.php
                        
                        exit;
                    } else {
                        $error = "Error, no se pudo actualizar";
                    }
                }
            } else {


                if (empty($titulo) || $titulo == '' || empty($texto) || $texto == '') {
                    $error = "Error, algunos campos están vacíos";
                } else {

                    $image = $_FILES['imagen']['name'];
                    $imageArr = explode('.', $image);
                    $rand = rand(1000, 99999);
                    $newImageName = $imageArr[0] . $rand . '.' . $imageArr[1];
                    $rutaFinal = "../img/articulos/" . $newImageName;
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal);

                    $articulo = new Articulo($db);

                    if ($articulo->actualizar($idArticulo, $titulo, $texto, $newImageName)) {
                        $mensaje = "Artículo acutalizado correctamente";
                        header("Location: " . RUTA_ADMIN . "articulos.php");   
                        // include_once './views/viewsAdmin/articulos.php';
                        exit;
                       
                    } else {
                        $error = "Error, no se pudo actualizar";
                    }
                }
            }
        }



        if (isset($_POST['borrarArticulo'])) {

            $idArticulo = $_POST['id'];

            $articulo = new Articulo($db);


            if ($articulo->borrar($idArticulo)) {
                $mensaje = "Artículo borrado correctamente";
                // header("Location:articulos.php?mensaje=" . urlencode($mensaje));
                include_once './views/viewsAdmin/articulos.php';
                exit;
            } else {
                $error = "Error, no se pudo borrar";
            }
        }
        
        require_once("./views/viewsAdmin/editar_articulo.php");
    }
}
?>