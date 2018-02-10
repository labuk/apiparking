<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexión DB
include_once '../config/DB.php';
// Objeto Alergeno
include_once '../objects/alergeno.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$alergeno = new Alergeno($db);

// Leer Post data
$data = json_decode(file_get_contents("php://input"));

// Rellenar el objeto Alergeno
//var_dump($data);
$alergeno->nombre_alergeno = $data->nombre_alergeno;

// Query Alergeno - create()
if($alergeno->create()){
        echo '{ "message": "Alergeno creado." }';
}
// error
else{
        echo '{ "message": "No se ha podido crear alergeno." }';
}
?>
