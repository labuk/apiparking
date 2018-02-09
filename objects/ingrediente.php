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

    // Create ingrediente
    function create(){

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
            return true;
        }

        // error
        return false;

    }

}
?>
