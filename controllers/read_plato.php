<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión DB
include_once '../config/DB.php';
// Objet Plato
include_once '../objects/plato.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$plato = new Plato($db);

// Query Plato - read()
$stmt = $plato->read();
$num = $stmt->rowCount();

// Encuentra algún registro de Plato?
if($num>0){

    // Plato array
    $platos_arr=array();
    $platos_arr["platos"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $plato_item=array(
            "id_plato" => $id_plato,
            "nombre_plato" => $nombre_plato
        );

        array_push($platos_arr["platos"], $plato_item);
    }

    echo json_encode($platos_arr);
}

else{
    echo json_encode(
        array("message" => "No hay platos en la DB.")
    );
}
?>
