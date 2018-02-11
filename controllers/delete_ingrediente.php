<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conexión DB
include_once '../config/DB.php';
// Objet Ingrediente
include_once '../objects/ingrediente.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$ingrediente = new Ingrediente($db);

// Leer Post data
$data = json_decode(file_get_contents("php://input"));

// Delete el objeto Ingrediente
var_dump($data);
$ingrediente->id_ingrediente = $data->id_ingrediente;
if($ingrediente->delete()){
        echo '{ "message": "Ingrediente eliminado." }';
}
// error
else{
        echo '{ "message": "No se ha podido eliminar ingrediente." }';
}
?>
