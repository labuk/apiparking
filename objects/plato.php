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

    // Create plato
    function create(){

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
            return true;
        }

        // error
        return false;

    }

}

?>
