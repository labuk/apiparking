<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';


echo 'Alergeno - test read()';
$response = curl_get('localhost/elparking/controllers/read_alergeno.php');
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["alergenos"]);
echo 'Lectura correcta - Numero de alergenos: ', $num;


echo '<br>';
echo 'Alergeno - test create()';
$data = array("nombre_alergeno" => "Proteina Arroz");
var_dump($data);
$response = curl_post('localhost/elparking/controllers/create_alergeno.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_alergeno.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["alergenos"]);
if($num == $num_post-1){
  echo '<br>';
  echo 'El alergeno se ha creado.';
  echo 'Valores: ' , var_dump($stmt["alergenos"][$num_post-1]);
} else {
  echo 'Fallo funcion  create()';
}


echo '<br>';
echo 'Alergeno - test readOne($id_alergeno)';
$response = curl_get('localhost/elparking/controllers/readOne_alergeno.php?id_alergeno=1');
var_dump($response);
$stmt = json_decode($response, true);
$num_p = count($stmt["platos"]);
$num_a = count($stmt["alergeno"]);
echo 'Lectura correcta - Numero de platos: ', $num_p , ' - alergenos: ', $num_a;

?>
