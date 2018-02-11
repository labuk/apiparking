<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexión DB
include_once '../config/DB.php';
// Objet Plato
include_once '../objects/plato.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$plato = new Plato($db);

// Leer Post data
$data = json_decode(file_get_contents("php://input"));

// Delete el objeto Plato
var_dump($data);
$plato->id_plato = $data->id_plato;
if($plato->delete()){
        echo '{ "message": "Plato eliminado." }';
}
// error
else{
        echo '{ "message": "No se ha podido eliminar plato." }';
}
?>
