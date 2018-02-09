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

// Query Ingrediente - read()
$stmt = $ingrediente->read();
$num = $stmt->rowCount();

// Encuentra algún registro de Ingrediente?
if($num>0){

    // Ingrediente array
    $ingredientes_arr=array();
    $ingredientes_arr["ingredientes"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $ingrediente_item=array(
            "id_ingrediente" => $id_ingrediente,
            "nombre_ingrediente" => $nombre_ingrediente
        );

        array_push($ingredientes_arr["ingredientes"], $ingrediente_item);
    }

    echo json_encode($ingredientes_arr);
}

else{
    echo json_encode(
        array("message" => "No hay ingredientes en la DB.")
    );
}
?>
