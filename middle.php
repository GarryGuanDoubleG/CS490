<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "username=".$_POST['username']."&password=".$_POST['password']);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

curl_close ($ch);
if (strpos($server_output, 'Success') !== false) {
    echo 'y';
} else { echo 'n';}
//echo $server_output;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://cp4.njit.edu/cp/home/login");
curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "user=".$_POST['username']."&pass=".$_POST['password']."&uuid="."0xACA021");
//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.text');
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
$server_output = curl_exec ($ch);
curl_close ($ch);
if (strpos($server_output, 'Failed') !== false) {
    echo 'n';
} else { echo 'y';}
//echo $server_output
//echo var_dump($server_output);







?>
