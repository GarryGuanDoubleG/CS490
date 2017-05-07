<?php
	
	function CreateTest($db, $test_number, $ids, $points)
	{

		$query = "TRUNCATE Test";
		$db->exec_query($query);
		$query = "TRUNCATE StudentScores";
		$db->exec_query($query);

		$questions = explode(',', $ids);
		$question_points = explode(',', $points);

		$feedback = $_POST["feedback"];

		for($i = 0; $i < count($questions); $i++)
		{
			$value = trim($questions[$i], " ");
			$point = trim($question_points[$i], " ");
			$feedback = $question["feedback"];
			$insert_query = "INSERT INTO Test (test_id, points, question_id, started, finished, released) " .
					 		"VALUES ('$test_number', $point, $value, 0, 0, 0)";


			$db->exec_query($insert_query);

			echo $insert_query;
		}

	}

	function questionFilter($db, $test_id)
	{
		$sortby = "";
		$filter = "";

		if(isset($_POST['category']))
		{
			$sortby = $_POST['category'];
		}
		if(isset($_POST['filter']))
		{
			$filter = $_POST['filter'];
		}

	}


	function getTest($db, $test_id)
	{
		$query = "SELECT * FROM Test WHERE test_id = $test_id";
		
		$result = $db->exec_query($query);

		$i = 0;
		
		$questions = array();

		while($row = $result->fetch_array())
		{
			if($row['started'] == 0)
				return "not started";
			
			$question_id = $row['question_id'];

			$questions_query = "SELECT * FROM TestBank WHERE question_id = $question_id";

			$question_result = $db->exec_query($questions_query);
			$questions[$i] = $question_result->fetch_array();			
			$questions[$i]['points'] = $row["points"];
			$i++;
			
		}

		return json_encode($questions);
	}


	function ReleaseScore($db, $test_number)
	{
		$query = "UPDATE Test SET released = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);
	}

	function StartTest($db, $test_number)
	{
		$query = "UPDATE Test SET started = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);
	}

	function EndTest($db, $test_number)
	{
		$query = "UPDATE Test SET finished = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);
	}


?>