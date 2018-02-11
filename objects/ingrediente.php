<?php
class Ingrediente{

    // Conexión base de datos
    private $conn;
    private $table_name = "ingrediente";

    // Variables
    public $id_ingrediente;
    public $nombre_ingrediente;

    // Constructor con $db - conexión a la base de datos
    public function __construct($db){
        $this->conn = $db;
    }

    // Read Ingrediente
    function read(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Read One Ingrediente = $id_ingrediente
    function readOne($id_ingrediente){
        // select query = id_ingrediente
        $query =  "SELECT ingrediente.id_ingrediente, ingrediente.nombre_ingrediente, alergeno.nombre_alergeno
                  FROM ingrediente
                  LEFT JOIN ingrediente_alergeno ON ingrediente_alergeno.id_ingrediente = ingrediente.id_ingrediente
                  LEFT JOIN alergeno ON alergeno.id_alergeno = ingrediente_alergeno.id_alergeno
                  WHERE ingrediente.id_ingrediente = " . $id_ingrediente;

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Create ingrediente
    function create( $alergenos = null ){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre_ingrediente=:nombre_ingrediente";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nombre_ingrediente=htmlspecialchars(strip_tags($this->nombre_ingrediente));

        // bind values
        $stmt->bindParam(":nombre_ingrediente", $this->nombre_ingrediente);

        // execute query
        if($stmt->execute()) {
          if(isset($alergenos)){
            $this->id_ingrediente = $this->conn->lastInsertId();
            if($this->add_alergeno($alergenos, $this->id_ingrediente)){
              return true;
            };
            // error
            return false;
          }else{
            return true;
          }
        }

        // error
        return false;

    }



    // Add alergeno to ingrediente
    function add_alergeno( $alergenos, $id_ingrediente ){

      $sql = array();
      foreach ( $alergenos as $key => $value) {
        // (`id_ingrediente`, `id_alergeno`)
        array_push ($sql, "(" . $id_ingrediente . "," . $value . ")" );
      }

      $strg = implode(",", $sql);

      //var_dump($this);

        // query to insert record
        $query = " INSERT INTO ingrediente_alergeno ( id_ingrediente, id_alergeno ) VALUES "
                . $strg;

        // prepare query
        $stmt = $this->conn->prepare($query);
        var_dump($stmt);

        // execute query
        if($stmt->execute()) {
            return true;
            echo 'Hecho';
        }

        // error
        return false;

    }


}
?>
