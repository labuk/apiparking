<?php
class Alergeno{

    // Conexión base de datos
    private $conn;
    private $table_name = "alergeno";

    // Variables
    public $id;
    public $name;

    // Constructor con $db - conexión a la base de datos
    public function __construct($db){
        $this->conn = $db;
    }

    // Read Alergeno
    function read(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Read One Alergeno = $id_alergeno
    function readOne($id_alergeno){
        // select query = id_alergeno
        $query =  "SELECT alergeno.id_alergeno, alergeno.nombre_alergeno, plato.nombre_plato
                  FROM alergeno
                  INNER JOIN ingrediente_alergeno ON ingrediente_alergeno.id_alergeno = alergeno.id_alergeno
                  INNER JOIN plato_ingrediente ON plato_ingrediente.id_ingrediente = ingrediente_alergeno.id_ingrediente
                  INNER JOIN plato ON plato.id_plato = plato_ingrediente.id_plato
                  WHERE alergeno.id_alergeno = " . $id_alergeno;

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Create alergeno
    function create(){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre_alergeno=:nombre_alergeno";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nombre_alergeno=htmlspecialchars(strip_tags($this->nombre_alergeno));

        // bind values
        $stmt->bindParam(":nombre_alergeno", $this->nombre_alergeno);

        // execute query
        if($stmt->execute()) {
            return true;
        }

        // error
        return false;

    }

    // Delete Alergeno
    function delete(){

      // query to delete record
      $query = " DELETE FROM alergeno WHERE id_alergeno = "
                . $this->id_alergeno ;

      // prepare query
      $stmt = $this->conn->prepare($query);
      var_dump($stmt);

      // execute query
      if($stmt->execute()) {
          return true;
      }

      // error
      return false;

    }

}
?>
