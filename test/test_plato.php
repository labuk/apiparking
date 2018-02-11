<?php

// LLamadas GET/POST curl
include_once 'test_utilities.php';

echo 'Plato - test read()';
$response = curl_get('localhost/elparking/controllers/read_plato.php');
var_dump($response);
$stmt = json_decode($response, true);
$num = count($stmt["platos"]);
echo 'Lectura correcta - Numero de platos: ', $num;


echo '<br>';
echo 'Plato - test create()';
$data = array("nombre_plato" => "Arroz con leche");
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

echo '<br>';
echo 'Plato con ingredientes - test create($ingredientes)';
$data = array("nombre_plato" => "Arroz con leche y nueces",
  "ingredientes" => array(
       "1" => "2",
       "2" => "3",
       "3" => "4"
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
echo 'Plato - test readOne($id_plato)';
$response = curl_get('localhost/elparking/controllers/readOne_plato.php?id_plato='.$num_post);
var_dump($response);
$stmt = json_decode($response, true);
$num_p = count($stmt["plato"]);
$num_i = count($stmt["ingredientes"]);
$num_a = count($stmt["alergenos"]);
echo 'Lectura correcta - Numero de platos: ', $num_p , ' - ingredientes: ', $num_i, ' - alergenos: ', $num_a;


echo '<br>';
echo 'Plato - test change($id_plato,$ingredientes_add,$ingredientes_delete)';
$response = curl_get('localhost/elparking/controllers/readOne_plato.php?id_plato='.$num_post);
var_dump($response);
$stmt = json_decode($response, true);
$delete_ing = $stmt["ingredientes"][1]['id_plato_ingrediente'];
var_dump($delete_ing);
$data = array("id_plato" => $num_post,
  "add" => array(
       "1" => "1"
     ),
  "delete" => array(
      "1" => $delete_ing
    ),
);
$data_dump = json_encode($data);
var_dump($data_dump);
$response = curl_post('localhost/elparking/controllers/change_plato.php', $data);
var_dump($response);
$stmt = json_decode($response, true);
$response = curl_get('localhost/elparking/controllers/readOne_plato.php?id_plato='.$num_post);
var_dump($response);


?>
