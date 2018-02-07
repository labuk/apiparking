<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexión DB
include_once '../config/DB.php';
// Objeto Plato
include_once '../objects/plato.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$plato = new Plato($db);

// Leer Post data
$data = json_decode(file_get_contents("php://input"));

// Rellenar el objeto Plato
var_dump($data);
$plato->nombre_plato = $data->nombre_plato;

// Query Plato - create()
if($plato->create()){
        echo '{ "message": "Plato creado." }';
}
// error
else{
        echo '{ "message": "No se ha podido crear plato." }';
}
?>
