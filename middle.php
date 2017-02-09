<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "username=".$_POST['username']."&password=".$_POST['password']);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

curl_close ($ch);



echo "Output: ". $server_output;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.njit.edu/cp/login.php");
curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,
	    “userid=".$_POST[‘username’].”&cplogin=".$_POST[‘password’]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

curl_close ($ch);



echo "Output: ". $server_output;

?>
