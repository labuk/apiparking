<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión DB
include_once '../config/DB.php';
// Objet Ingrediente
include_once '../objects/ingrediente.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$ingrediente = new Ingrediente($db);

// Leer GET query
$id_ingrediente = $_GET["id_ingrediente"];

// Query Ingrediente - read()
$stmt = $ingrediente->readOne($id_ingrediente);
$num = $stmt->rowCount();

// Encuentra algún registro?
if($num>0){

    // ingrediente array
    $ingredientes_arr=array();
    $ingredientes_arr["ingrediente"]=array();
    $ingredientes_arr["alergenos"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $ingrediente_item=array(
            "id_ingrediente" => $id_ingrediente,
            "nombre_ingrediente" => $nombre_ingrediente
        );
        array_push($ingredientes_arr["ingrediente"], $ingrediente_item);

        if(isset($nombre_alergeno)){
          $alergeno_item=array(
              $nombre_alergeno
          );
          array_push($ingredientes_arr["alergenos"], $alergeno_item);
        }

    }

    // Eliminamos duplicados
    $ingredientes_arr["ingrediente"] = array_unique($ingredientes_arr["ingrediente"], SORT_REGULAR);
    // Reseteamos key
    $ingredientes_arr = array_map('array_values', $ingredientes_arr);

    echo json_encode($ingredientes_arr);
}

else{
    echo json_encode(
        array("message" => "Ese ingrediente no existe en la DB.")
    );
}

?>
