<?php

	function login($db, $username, $password)
	{
	 	$query = "SELECT * from Users1 WHERE username = '$username' AND password = '$password';";

		$result = $db->exec_query($query);
		$row = $result->fetch_array();

		if($row['role'] == "teacher")
			return "t";
		else if($row['role'] == "student")
			return 's';
		else
			return "no";
	}

?>