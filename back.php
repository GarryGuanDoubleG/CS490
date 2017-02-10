
<?php
	require 'db.php';

	$db = new DB;
	$username = "";
	$pw = "";
	
	if(array_key_exists('username', $_POST)
	{
		$username = $_POST['username'];
	}
	if(array_key_exists('password', $_POST)
	{
		$pw 	  = $_POST['password'];
	}
	
	if($username == "" || $pw == "")
	{
		echo "Username or pw not given";
	}

	// $username = "test";
	// $pw = "test";

	$result = $db->exec_query($username, $pw);

	if($result->num_rows > 0)
	{
		echo "Success";
	}
	else
	{
		echo "Could not find match";
	}
?>