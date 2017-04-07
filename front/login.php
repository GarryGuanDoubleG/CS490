<?php

if(!isset($_POST['username']) || !isset($_POST['password'])) {
	return;
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~ybp7/CS490/middle.php");
curl_setopt($ch, CURLOPT_POST, 1);

//data
curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "request=login&username=".$_POST['username']."&password=".$_POST['password']);

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
echo "Server output: ".$server_output."<br>";

// further processing ....
<<<<<<< Updated upstream
if($server_output == "t")
	header( 'Location: https://web.njit.edu/~as2866/cs490/professor.html' ) ;
elseif($server_output == "s")
=======
if(strpos($server_output, 't') !== false)
	header( 'Location: https://web.njit.edu/~as2866/cs490/professor.html' ) ;
elseif(strpos($server_output, 's') !== false)
>>>>>>> Stashed changes
	header( 'Location: https://web.njit.edu/~as2866/cs490/student.html' ) ;
else
	echo "Username/password incorrect";

?>
