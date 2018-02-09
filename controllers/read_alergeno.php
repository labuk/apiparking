<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión DB
include_once '../config/DB.php';
// Objet Alergeno
include_once '../objects/alergeno.php';

// Inizializar DB and Object
$database = new Database();
$db = $database->getConnection();
$alergeno = new alergeno($db);

// Query Alergeno - read()
$stmt = $alergeno->read();
$num = $stmt->rowCount();

// Encuentra algún registro de Alergeno?
if($num>0){

    // Alergeno array
    $alergenos_arr=array();
    $alergenos_arr["alergenos"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $alergeno_item=array(
            "id_alergeno" => $id_alergeno,
            "nombre_alergeno" => $nombre_alergeno
        );

        array_push($alergenos_arr["alergenos"], $alergeno_item);
    }

    echo json_encode($alergenos_arr);
}

else{
    echo json_encode(
        array("message" => "No hay alergenos en la DB.")
    );
}
?>
