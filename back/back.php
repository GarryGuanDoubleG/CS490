<?php
	require 'db.php';
	require 'login.php';
	require 'questions.php';
	require 'test.php';

	$db = new DB;

	echo var_dump($_POST);

	switch($_POST["request"])
	{
		case "login":
			echo login($db, $_POST["username"], $_POST["password"]);
			break;
		case "add":
			echo InsertQuestion($db,$_POST);
			break;
		case "getbank":
			echo GetAllQuestions($db);
			break;
		case "maketest":
			echo CreateTest($db, 0, $_POST["ids"]);
			break;
		case "gettest":
			echo getTest($db, 0);
			break;
		case "releasescore":
			echo ReleaseScore($db, 0);
			break;
		case "starttest":
			echo StartTest($db, 0);
			break;
		case "endtest":
			echo EndTest($db, 0);
			break;
		case "givescore":
			echo InsertScore($db, 2, 0, $_POST["questid"], $_POST["score"], $_POST["comment"], $_POST["answer"]);
			break;
		case "getresult":
			echo GetScore($db, 2, 0);
			break;
	}

	$db->close();
?>