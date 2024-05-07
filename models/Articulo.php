<!-- models/Articulo.php -->
<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
class Articulo
{

    private $conn;
    private $table = 'articulos';

    //Propiedades
    public $id;
    public $titulo;
    public $imagen;
    public $texto;
    public $fecha_creacion;

    

    //Constructor de nuestra clase
    public function __construct()
    {
        $baseDatos = new sqlConfig();
        $this->conn = $baseDatos->connect();

     
    }

    //Obtener los artículos
    public function leer()
    {

        $query = 'SELECT id, titulo, imagen, texto, fecha_creacion FROM ' . $this->table;

        // Preparamos la sentencia (Mejora la seguridad y el rendimiento de la consulta).
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        
        // Devolvemos un array de objetos
        $articulos = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $articulos;

    }

    //Obtener los artículos
    public function leer_individual($id)
    {

        $query = 'SELECT id, titulo, imagen, texto, fecha_creacion FROM ' . $this->table . ' WHERE id = ? LIMIT 1';

        $stmt = $this->conn->prepare($query);

        //Vincular parámetro, ayuda a prevenir ataques de inyección SQL, ya que los valores de los parámetros no se concatenan directamente en la cadena de SQL. Asegurando seguridad y eficiencia. 
        $stmt->bindParam(1, $id);
    
        $stmt->execute();
        $articulo = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $articulo;
    }

    //Crear un artículo
    public function crear($titulo, $newImageName, $texto)
    {

        $query = 'INSERT INTO ' . $this->table . ' (titulo , imagen , texto)VALUES(:titulo , :imagen , :texto)';

        //Preparar sentencia
        $stmt = $this->conn->prepare($query);

        //Vincular parámetro
        $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
        $stmt->bindParam(":imagen", $newImageName, PDO::PARAM_STR);
        $stmt->bindParam(":texto", $texto, PDO::PARAM_STR);


        //Ejecutar query
        if ($stmt->execute()) {
            return true;
        }

        //Si hay error 
        printf("error", $stmt->error);
    }



    public function actualizar($id, $titulo, $texto, $newImageName)
    {


        if ($newImageName == "") {

            $query = 'UPDATE ' . $this->table . ' SET titulo = :titulo, texto = :texto WHERE id = :id';

            //Preparar sentencia
            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
            $stmt->bindParam(":texto", $texto, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            //Ejecutar query
            if ($stmt->execute()) {
                return true;
            }else{
                $mensaje = "Error al actualizar el titulo y el texto";
            }
        } else {

            $query = 'UPDATE ' . $this->table . ' SET titulo = :titulo, texto = :texto, imagen = :imagen WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            //Vincular parámetro
            $stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);
            $stmt->bindParam(":texto", $texto, PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $newImageName, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            //Ejecutar query
            if ($stmt->execute()) {
                return true;
            }else{
                $mensaje = "Error al actualizar el titulo, el texto y la imagen";
                return false;
            }
        }


        //Si hay error 
        printf("error", $stmt->error, "Mensaje: ", $mensaje);
    }


    public function borrar($idArticulo)
    {


        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $idArticulo, PDO::PARAM_INT);

        //Ejecutar query
        if ($stmt->execute()) {
            return true;
        }

        //Si hay error 
        printf("error ", $stmt->error);
    }
}

