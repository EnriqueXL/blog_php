<?php

class Usuario
{

    private $conn;
    private $table = 'usuarios';

    //Propiedades
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $fecha_creacion;


    //Constructor de nuestra clase
    public function __construct()
    {
       
        $baseDatos = new sqlConfig();
        $this->conn = $baseDatos->connect();
    }


    public function leer()
    {

        $query = 'SELECT u.id AS usuario_id, u.nombre AS usuario_nombre, u.email AS usuario_email, u.fecha_creacion AS usuario_fecha_creacion, r.nombre AS rol  FROM ' . $this->table . ' u INNER JOIN roles r ON r.id = u.rol_id';

        //Preparar sentencia
        $stmt = $this->conn->prepare($query);

        //Ejecutar query
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public function leer_individual($id)
    {

        $query = 'SELECT u.id AS usuario_id, u.nombre AS usuario_nombre, u.email AS usuario_email, u.fecha_creacion AS usuario_fecha_creacion, r.nombre AS rol  FROM ' . $this->table . ' u INNER JOIN roles r ON r.id = u.rol_id WHERE u.id = ?';

        $stmt = $this->conn->prepare($query);


        //Vincular parámetro
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $usuario = $stmt->fetchAll(PDO::FETCH_OBJ);
         
        return $usuario;
    }

    public function actualizar($idUsuario, $rol, $nombreUsuario, $emailUsuario)
    {

        $query = 'UPDATE ' . $this->table . ' SET nombre = :nombre, email = :email, rol_id = :rol_id WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        //Vincular parámetro
        $stmt->bindParam(":nombre", $nombreUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":email", $emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":rol_id", $rol, PDO::PARAM_INT);
        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        printf("error $s\n", $stmt->error);
    }


    public function borrar($idUsuario)
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(":id", $idUsuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }

        printf("error $s\n", $stmt->error);
    }



    public function registrar($nombre, $email, $password)
    {


        $query = 'INSERT INTO ' . $this->table . ' (nombre, email, password, rol_id)VALUES(:nombre, :email, :password, 2)';


        $passwordEncriptado = md5($password);

        $stmt = $this->conn->prepare($query);

        //Vincular parámetro
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordEncriptado, PDO::PARAM_STR);


        //Ejecutar query
        if ($stmt->execute()) {
            return true;
        }

        //Si hay error 
        printf("error $s\n", $stmt->error);
    }


    public function validar_email($email)
    {

        $query = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $resultado = $stmt->execute();

        $registroEmail = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($registroEmail) {
            return false;
        } else {
            return true;
        }
    }



    public function acceder($email, $password)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email AND password = :password';

        //Encriptar el password MD5
        $passwordEncriptado = md5($password);

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $passwordEncriptado, PDO::PARAM_STR);

        $resultado = $stmt->execute();

        $existeUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existeUsuario) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerRol($email){

        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        $resultado = $stmt->execute();

        $existeUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existeUsuario) {
            return $existeUsuario['rol_id'];
        }else{
            return false;
        }
   
    }
}
