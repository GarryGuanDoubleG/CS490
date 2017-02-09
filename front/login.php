<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~as2866/cs490/test.php");
curl_setopt($ch, CURLOPT_POST, 1);

//data
curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "username=".$_POST['username']."&password=".$_POST['password']);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
echo "Output: ". $server_output;
