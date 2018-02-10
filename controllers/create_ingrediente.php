<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexión DB
include_once '../config/DB.php';
// Objeto ingrediente
include_once '../objects/ingrediente.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$ingrediente = new Ingrediente($db);

// Leer Post data
$data = json_decode(file_get_contents("php://input"));

// Rellenar el objeto ingrediente
//var_dump($data);
$ingrediente->nombre_ingrediente = $data->nombre_ingrediente;

// Query ingrediente - create()
if($ingrediente->create()){
        echo '{ "message": "ingrediente creado." }';
}
// error
else{
        echo '{ "message": "No se ha podido crear ingrediente." }';
}
?>
