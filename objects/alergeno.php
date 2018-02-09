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

}
?>
