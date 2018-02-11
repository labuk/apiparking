<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';

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


echo '<br>';
echo 'Ingrediente con alergenos- test create($alergenos)';
$data = array("nombre_ingrediente" => "Arroz",
  "alergenos" => array(
       "1" => "4"
       )
);
$data_dump = json_encode($data);
var_dump($data_dump);
$response = curl_post('localhost/elparking/controllers/create_ingrediente.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_ingrediente.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["ingredientes"]);
echo 'Ingrediente creado: ',$num_post;
var_dump($stmt["ingredientes"]);

echo '<br>';
echo 'Ingrediente - test readOne($id_ingrediente)';
$response = curl_get('localhost/elparking/controllers/readOne_ingrediente.php?id_ingrediente='.$num_post);
var_dump($response);
$stmt = json_decode($response, true);
$num_i = count($stmt["ingrediente"]);
$num_a = count($stmt["alergenos"]);
echo 'Lectura correcta - Numero de ingredientes: ', $num_i, ' - alergenos: ', $num_a;

?>
