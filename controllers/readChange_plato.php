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

// Leer GET query
$id_plato = $_GET["id_plato"];
$plato->id_plato = $id_plato;

// Query Plato - read()
$stmt = $plato->readChange($id_plato);
$num = $stmt->rowCount();

// Encuentra algún registro?
if($num>0){

    // Plato array
    $platos_arr=array();
    $platos_arr["plato"]=array();
    $platos_arr["ingredientes_add"]=array();
    $platos_arr["ingredientes_delete"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $plato_item=array(
            "id_plato" => $id_plato,
            "nombre_plato" => $nombre_plato
        );
        array_push($platos_arr["plato"], $plato_item);

        $ingrediente_item=array(
          "nombre_ingrediente" => $nombre_ingrediente,
          "fecha" => $updateAt
        );

        if($delete_flag){
          array_push($platos_arr["ingredientes_delete"], $ingrediente_item);
        }else{
          array_push($platos_arr["ingredientes_add"], $ingrediente_item);
        }

    }

    // Eliminamos duplicados
    $platos_arr["plato"] = array_unique($platos_arr["plato"], SORT_REGULAR);
    // Reseteamos key
    $platos_arr = array_map('array_values', $platos_arr);

    echo json_encode($platos_arr);
}

else{
    echo json_encode(
        array("message" => "Ese plato no existe en la DB.")
    );
}

?>
