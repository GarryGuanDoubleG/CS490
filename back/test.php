<?php
	
	function CreateTest($db, $test_number, $ids)
	{
		$query = "DELETE FROM Test where test_id = $test_number";
		$db->exec_query($query);

		$questions = explode(',', $ids);

		for($i = 0; $i < count($questions); $i++)
		{
			$value = $questions[$i];
			$insert_query = "INSERT INTO Test (test_id, question_id, started, finished, released) " .
					 		"VALUES ($test_number, $value, 0, 0, 0)";

			$db->exec_query($insert_query);
		}

		$result = "success";
		return $result;
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
			$questions[$i++] = $question_result->fetch_array();
		}

		return json_encode($questions);
	}

	function ReleaseScore($db, $test_number)
	{
		$query = "UPDATE Test SET released = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);

		return "success";
	}

	function StartTest($db, $test_number)
	{
		$query = "UPDATE Test SET started = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);

		return "success";
	}

	function EndTest($db, $test_number)
	{
		$query = "UPDATE Test SET finished = 1 WHERE test_id = $test_number";
		$result = $db->exec_query($query);

		return "success";
	}


?>