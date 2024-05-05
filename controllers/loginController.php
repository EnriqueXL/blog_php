<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
class loginController
{
    public static function accederUsuario()
    {
        require_once "./config/Basemysql.php";
        require_once "./models/Usuario.php";


        $usuario = new Usuario();

        if (isset($_POST['acceder'])) {

            $email = $_POST["email"];
            $password = $_POST["password"];

            if (empty($email) || $email == '' || empty($password) || $password == '') {
                $error = "Error, algunos campos están vacíos";
          
            } else {
                if ($usuario->acceder($email, $password)) {

                    $_SESSION['autenticado'] = true;
                    $_SESSION['usuario'] = $email;

                    var_dump($_SESSION['usuario']);
                    exit;

                    header("Location:" . INICIO . "");
                    
                    
                } else {
                    $error = "Error, no pudo ingresar";
               
                }
            }
        }
        // if (isset($_POST['registrarse'])) {
        //     var_dump('registrarse');
        //     exit;
        //     header("Location:" . REGISTRO . "");
        // }


        include_once "./views/acceder.php";
    }
}
