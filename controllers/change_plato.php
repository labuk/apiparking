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

// Rellenar el objeto Plato - la entrada es { id_plato, add{id_ingrediente}, delete{id_plato_ingrediente} }
var_dump($data);
$plato->id_plato = $data->id_plato;

if(isset($data->add) || isset($data->delete)) {
  // Query Plato - add_ingrediente($ingredientes)
  if($plato->change_ingrediente($data->add, $data->delete)){
          echo '{ "message": "Ingredientes modificados." }';
  }
  // error
  else{
          echo '{ "message": "No se han podido modificar los ingredientes." }';
  }
}


?>
