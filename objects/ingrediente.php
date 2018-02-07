<?php
class Ingrediente{

    // Conexión base de datos
    private $conn;
    private $table_name = "ingrediente";

    // Variables
    public $id;
    public $name;

    // Constructor con $db - conexión a la base de datos
    public function __construct($db){
        $this->conn = $db;
    }
}
?>
