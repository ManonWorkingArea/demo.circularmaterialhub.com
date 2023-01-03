<?php

$apiKey 		= "8rMz65o3D0E";
$secretKey 	= "MIGfMA0GCSqGSIb3DQEBAQUAA4GNAD";
//------------------------- API -----------------------------------------------

//------------------------- API -------------------------------------------
$url = "https://admin.ecobz.training/api/home/last";

$header = array();
$header[] = 'Content-length: 0';
$header[] = 'Content-type: application/json';
$header[] = "api-key: {$apiKey}";
$header[] = "secret-key: {$secretKey}";
//------------------------- Return -------------------------------------------
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$response_json = curl_exec($ch);
curl_close($ch);
//------------------------- Return -------------------------------------------
$output = json_decode($response_json, true);
//-------------------------------------------------------------------------------
//------------------------- Return -------------------------------------------
print_r($output);

?>