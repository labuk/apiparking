<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión DB
include_once '../config/DB.php';
// Objet alergeno
include_once '../objects/alergeno.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$alergeno = new Alergeno($db);

// Leer GET query
$id_alergeno = $_GET["id_alergeno"];

// Query Alergeno - read()
$stmt = $alergeno->readOne($id_alergeno);
$num = $stmt->rowCount();

// Encuentra algún registro?
if($num>0){

    // Alergeno array
    $alergenos_arr=array();
    $alergenos_arr["alergeno"]=array();
    $alergenos_arr["platos"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $alergeno_item=array(
            "id_alergeno" => $id_alergeno,
            "nombre_alergeno" => $nombre_alergeno
        );
        array_push($alergenos_arr["alergeno"], $alergeno_item);

        if(isset($nombre_plato)){
          $plato_item=array(
              $nombre_plato
          );
          array_push($alergenos_arr["platos"], $plato_item);
        }

    }

    // Eliminamos duplicados
    $alergenos_arr["alergeno"] = array_unique($alergenos_arr["alergeno"], SORT_REGULAR);
    $alergenos_arr["platos"] = array_unique($alergenos_arr["platos"], SORT_REGULAR);
    // Reseteamos key
    $alergenos_arr = array_map('array_values', $alergenos_arr);

    echo json_encode($alergenos_arr);
}

else{
    echo json_encode(
        array("message" => "Ese alergeno no existe en la DB.")
    );
}

?>
