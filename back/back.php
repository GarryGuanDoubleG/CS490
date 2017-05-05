<?php
	require 'db.php';
	require 'login.php';
	require 'questions.php';
	require 'test.php';
	require 'score.php';

	$db = new DB;


	switch($_POST["request"])
	{
		case "login":
			echo login($db, $_POST["username"], $_POST["password"]);
			break;
		case "add":
			InsertQuestion($db,$_POST);
			break;
		case "getbank":
			echo GetAllQuestions($db);
			break;
		case "maketest":
			CreateTest($db, 0, $_POST["ids"], $_POST["points"]);
			break;
		case "gettest":
			echo getTest($db, 0);
			break;
		case "releasescore":
			echo ReleaseScore($db, 0);
			break;
		case "updatescores":
			UpdateScores($db);
			break;
		case "starttest":
			StartTest($db, 0);
			break;
		case "endtest":
			EndTest($db, 0);
			break;
		case "givescore":
			InsertScore($db, 2, 0);
			break;
		case "getstudentresults":
			echo GetScore($db, 2, 0);
			break;
		case "getprofresults":
			echo GetProfScore($db, 2, 0);
			break;
		case "submitchanges":
			UpdateScore($db, 2, 0);
			break;
		default:
			break;
	}

	$db->close();
?>