<?php

	function InsertQuestion($db, $question)
	{
		$table = "TestBank";
		$method_name = $question["methodName"];
		$parameter = $question["parameter"];
		$description = $question["descr"];
		$test_input = $question["testIn"];
		$test_output = $question["testOut"];
		$type = "code";//used for filtering but currently not being utilized

		$query = "INSERT INTO $table " . 
								"(type, method_name, parameters, description, test_input, test_output) " .
				 				"VALUES ('$type', '$method_name', '$parameter', '$description', '$test_input', '$test_output');";
		if(!$db->exec_query($query))
		{
			echo "Error";
		}
		else
		{
			echo "Success";
		}
	}

	function GetAllQuestions($db)
	{
		$query = "SELECT * from TestBank";
		$result = $db->exec_query($query);

		$questions = array();

		$i = 0;
		if($result)
		{
			while($row = $result->fetch_array())
			{
				$questions[$i++] = $row;
			}

			$data = json_encode($questions);

			return $data;
		}
		else
		{
			return "Error";
		}


	}

?>