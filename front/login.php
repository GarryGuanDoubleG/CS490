<?php

if(!isset($_POST['username']) || !isset($_POST['password'])) {
	return;
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~ybp7/CS490/middle.php");
curl_setopt($ch, CURLOPT_POST, 1);

//data
curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "username=".$_POST['username']."&password=".$_POST['password']);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

// further processing ....
if($server_output == "yn")
	echo "Logged into local DB";
elseif($server_output == "ny")
	echo "Logged into NJIT";
else
	echo "Username/password incorrect";

?>
