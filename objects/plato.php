<?php
class Plato{

    // Conexión base de datos
    private $conn;
    private $table_name = "plato";

    // Variables
    public $id_plato;
    public $nombre_plato;

    // Constructor con $db - conexión a la base de datos
    public function __construct($db){
        $this->conn = $db;
    }

    // Read Plato
    function read(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Read One Plato = $id_plato
    function readOne($id_plato){
        // select query = id_plato
        $query =  "SELECT plato.id_plato, plato.nombre_plato, ingrediente.nombre_ingrediente, plato_ingrediente.id_plato_ingrediente ,alergeno.nombre_alergeno
                  FROM plato
                  INNER JOIN plato_ingrediente ON plato_ingrediente.id_plato = plato.id_plato
                  INNER JOIN ingrediente ON ingrediente.id_ingrediente = plato_ingrediente.id_ingrediente
                  LEFT JOIN ingrediente_alergeno ON ingrediente_alergeno.id_ingrediente = ingrediente.id_ingrediente
                  LEFT JOIN alergeno ON alergeno.id_alergeno = ingrediente_alergeno.id_alergeno
                  WHERE plato.id_plato = " . $id_plato;

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // Create plato
    function create( $ingredientes = null ){

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nombre_plato=:nombre_plato";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nombre_plato=htmlspecialchars(strip_tags($this->nombre_plato));

        // bind values
        $stmt->bindParam(":nombre_plato", $this->nombre_plato);

        // execute query
        if($stmt->execute()) {
          // Hay ingredientes?
          //var_dump($stmt);
          if(isset($ingredientes)){
            $this->id_plato = $this->conn->lastInsertId();
            if($this->add_ingrediente($ingredientes, $this->id_plato)){
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

    // Add ingrediente to plato
    function add_ingrediente( $ingredientes, $id_plato ){

      $sql = array();
      foreach ( $ingredientes as $key => $value) {
        // (`id_plato`, `id_ingrediente`)
        array_push ($sql, "(" . $id_plato . "," . $value . ")" );
      }

      $strg = implode(",", $sql);

      //var_dump($this);

        // query to insert record
        $query = " INSERT INTO plato_ingrediente ( id_plato, id_ingrediente ) VALUES "
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

    // Add ingrediente to plato
    function change_ingrediente( $ingredientes_add, $ingredientes_delete ){
      $flag_add = 1;
      $flag_delete = 1;

      if(isset($ingredientes_delete)){
        $flag_delete = 0;

        var_dump( $ingredientes_delete );

        $sql = array();
        foreach ( $ingredientes_delete as $key => $value) {
          // (`id_ingrediente`)
          array_push ($sql,  $value );
        }

        $strg = implode(" , ", $sql);
        var_dump($strg);

        // query to insert record
        $query = " DELETE FROM plato_ingrediente WHERE id_plato_ingrediente IN ( "
                . $strg . ")";

        // prepare query
        $stmt = $this->conn->prepare($query);
        var_dump($stmt);

        // execute query
        if($stmt->execute()) {
          $flag_delete=1;
        }

      }

      if(isset($ingredientes_add)){
        $flag_add = 0;

        if($this->add_ingrediente($ingredientes_add, $this->id_plato )) {
          $flag_add=1;
        }
      }

      if ($flag_add==1 || $flag_delete==1){
        return true;
      }

      // error
      return false;

    }

}

?>
