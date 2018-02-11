<?php

function curl_get($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
};

function curl_post($url, $data) {
    $ch = curl_init($url);
    $data_string = json_encode($data);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
};

function curl_delete($url, $data) {
    $ch = curl_init($url);
    $data_string = json_encode($data);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
    );
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
};

?>
