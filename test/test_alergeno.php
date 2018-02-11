<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';

echo '*****<br>';
echo '***** Alergeno - test read()';
$response = curl_get('localhost/elparking/controllers/read_alergeno.php');
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["alergenos"]);
echo 'Lectura correcta - Numero de alergenos: ', $num;


echo '<br>';
echo '*****<br>';
echo '***** Alergeno - test create()';
$data = array("nombre_alergeno" => "Proteina trigo");
var_dump($data);
$response = curl_post('localhost/elparking/controllers/create_alergeno.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_alergeno.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["alergenos"]);
// GET Elemento insertado
$insert_alergenos = end($stmt["alergenos"]);
if($num == $num_post-1){
  echo '<br>';
  echo 'El alergeno se ha creado.';
  echo 'Valores: ' , var_dump($insert_alergenos);
} else {
  echo 'Fallo funcion  create()';
}


echo '<br>';
echo '*****<br>';
echo '***** Alergeno - test readOne($id_alergeno)';
$response = curl_get('localhost/elparking/controllers/readOne_alergeno.php?id_alergeno=1');
var_dump($response);
$stmt = json_decode($response, true);
$num_p = count($stmt["platos"]);
$num_a = count($stmt["alergeno"]);
echo 'Lectura correcta - Numero de platos: ', $num_p , ' - alergenos: ', $num_a;

echo '<br>';
echo '*****<br>';
echo '***** Alergeno - test delete()';
$data = array("id_alergeno" => $insert_alergenos['id_alergeno']);
$data_dump = json_encode($data);
var_dump($data_dump);
$response = curl_post('localhost/elparking/controllers/delete_alergeno.php', $data);
//var_dump($response);
$response = curl_get('localhost/elparking/controllers/read_alergeno.php');
$stmt = json_decode($response, true);
$num_post = count($stmt["alergenos"]);
if($num == $num_post){
  echo '<br>';
  echo 'El alergeno se ha borrado.';
} else {
  echo 'Fallo funcion delete()';
}

?>
