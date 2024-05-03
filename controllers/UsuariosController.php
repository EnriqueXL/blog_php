<?php
require_once "./config/Basemysql.php";
require_once "./models/Usuario.php";
require_once "./config/config.php";

class UsuariosController
{
    public static function mostrarUsuarios()
    {
        $baseDatos = new sqlConfig();
        $db = $baseDatos->connect();

        //Instancimos el objeto
        $usuarios = new Usuario();
        $resultado = $usuarios->leer();

        include_once "./views/viewsAdmin/usuarios.php";
        exit;
    }

    public static function editarUsuarios()
    {

        $baseDatos = new sqlConfig();
        $db = $baseDatos->connect();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        $usuario = new Usuario($db);
        $usuarios = $usuario->leer_individual($id);

        if (isset($_POST["editarUsuario"])) {

            // Datos de usuario
            $nombreUsuario = $_POST['nombre'];
            $emailUsuario = $_POST['email'];

            $idUsuario = $_POST["id"];
            // Enviamos por sumbit el value del select para actualizar el rol
            $rol = $_POST["rol"];

            if (empty($idUsuario) || $idUsuario == '' || empty($rol) || $rol == '' || $nombreUsuario == '' || $emailUsuario == '') {
                $error = "Error, algunos campos están vacíos";
            } else {

                if ($usuario->actualizar($idUsuario, $rol, $nombreUsuario, $emailUsuario)) {
                    $mensaje = "Usuario actualizado correctamente";
                    header("Location:usuarios.php?mensaje=" . urlencode($mensaje));
                    exit();
                } else {
                    $error = "Error, no se pudo actualizar";
                }
            }
        }


        if (isset($_POST["borrarUsuario"])) {

            $idUsuario = $_POST["id"];

            $usuario = new Usuario($db);

            //Crear usuario
            if ($usuario->borrar($idUsuario)) {
                $mensaje = "Usuario borrado correctamente";
                header("Location:usuarios.php?mensaje=" . urlencode($mensaje));
                exit();
            } else {
                $error = "Error, no se pudo actualizar";
            }
        }

        include_once "./views/viewsAdmin/editar_usuario.php";
    
    }
}
