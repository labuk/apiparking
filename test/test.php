<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';

// curl 'localhost/elparking/controllers/read_plato.php'
// curl 'localhost/elparking/controllers/create_plato.php' -X POST -d '{"nombre_plato": "Arroz"}' -H 'Content-Type: application/json'

echo 'Plato - test read()';
$response = curl_get('localhost/elparking/controllers/read_plato.php');
//$response = curl_exec ($handler);
//curl_close($handler);
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["platos"]);
echo 'Lectura correcta - Numero de platos: ', $num;


echo '<br>';
echo 'Plato - test create()';
$data = array("nombre_plato" => "Arroz");
var_dump($data);
$response = curl_post('localhost/elparking/controllers/create_plato.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_plato.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["platos"]);
if($num == $num_post-1){
  echo '<br>';
  echo 'El plato se ha creado.';
  echo 'Valores: ' , var_dump($stmt["platos"][$num_post-1]);
} else {
  echo 'Fallo funcion  create()';
}


?>
