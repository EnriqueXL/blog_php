<?php
require_once "./config/Basemysql.php";
require_once "./models/Usuario.php";
require_once "./config/config.php";

class UsuariosController
{
    public static function registrarUsuario()
    {
        $usuario = new Usuario();

        if (isset($_POST['registrarse'])) {

            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirmarPassword = $_POST["confirmar_password"];


            if (empty($nombre) || $nombre == '' || empty($email) || $email == '' || empty($password) || $password == '' || empty($confirmarPassword) || $confirmarPassword == '') {
                $error = "Error, algunos campos están vacíos";
            } else {

                if ($password != $confirmarPassword) {
                    $error = "Error, la contraseña y la confirmación no coinciden";
                } else {

                    if ($usuario->validar_email($email)) {
                        
                        if ($usuario->registrar($nombre, $email, $password)) {
                            $mensaje = "Te has registrado correctamente, click en el botón acceder para ingresar";
                            $_SESSION['autenticado'] = true;
                            $_SESSION['usuario'] = $email;
                        } else {
                            $error = "Error, no se pudo registrar el usuario";
                        }
                    } else {

                        $error = "Error, este email ya se encuentra registrado";
                    }
                }
            }
        }

        include_once "./views/registro.php";
    }

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
