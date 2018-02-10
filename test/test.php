<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';

// curl 'localhost/elparking/controllers/read_plato.php'
// curl 'localhost/elparking/controllers/create_plato.php' -X POST -d '{"nombre_plato": "Arroz"}' -H 'Content-Type: application/json'

echo 'Plato - test read()';
$response = curl_get('localhost/elparking/controllers/read_plato.php');
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["platos"]);
echo 'Lectura correcta - Numero de platos: ', $num;


echo '<br>';
echo 'Plato - test create()';
$data = array("nombre_plato" => "Arroz");
$data_dump = json_encode($data);
var_dump($data_dump);
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


echo 'Ingrediente - test read()';
$response = curl_get('localhost/elparking/controllers/read_ingrediente.php');
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["ingredientes"]);
echo 'Lectura correcta - Numero de ingredientes: ', $num;


echo '<br>';
echo 'Ingrediente - test create()';
$data = array("nombre_ingrediente" => "Arroz");
var_dump($data);
$response = curl_post('localhost/elparking/controllers/create_ingrediente.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_ingrediente.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["ingredientes"]);
if($num == $num_post-1){
  echo '<br>';
  echo 'El ingrediente se ha creado.';
  echo 'Valores: ' , var_dump($stmt["ingredientes"][$num_post-1]);
} else {
  echo 'Fallo funcion  create()';
}


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
echo 'Plato con ingredientes - test create($ingredientes)';
$data = array("nombre_plato" => "Arroz con yogurt",
  "ingredientes" => array(
       "1" => "1",
       "2" => "3"
       )
);
$data_dump = json_encode($data);
var_dump($data_dump);
$response = curl_post('localhost/elparking/controllers/create_plato.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_plato.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["platos"]);
echo 'Plato creado: ',$num_post;
var_dump($stmt["platos"]);

echo '<br>';
echo 'Plato - test readOne()';
$response = curl_get('localhost/elparking/controllers/readOne_plato.php?id_plato='.$num_post);
var_dump($response);
$stmt = json_decode($response, true);
$num_p = count($stmt["plato"]);
$num_i = count($stmt["ingredientes"]);
$num_a = count($stmt["alergenos"]);
echo 'Lectura correcta - Numero de platos: ', $num_p , ' - ingredientes: ', $num_i, ' - alergenos: ', $num_a;

?>
