<?php
	
	function InsertScore($db, $student_id, $test_id, $question_id, $score, $comment, $student_answer)
	{
		echo "Insert score\n";
		$clear_score = "DELETE FROM StudentScores WHERE test_id = $test_number " . 
				 "AND question_id = $question_id " .
				 "AND student_id = $student_id";

		echo "query is " . $clear_score;

		$db->exec_query($clear_score);

		$insert_query = "INSERT INTO StudentScores (student_id, test_id, question_id, score, comment, student_answer)" .
						"VALUES ($student_id, $test_id, $question_id, $score, $comment, $student_answer)";

		echo "Insert query: " . $insert_query . "\n";

		$db->exec_query($insert_query); 


		return "success";
	}

	function GetScore($db, $student_id, $test_id)
	{
		$test_query = "SELECT * FROM Test WHERE test_id = $test_id";
		$result = $db->exec_query($test_query);
		$row = $result->fetch_array();

		// if($row['released'] == 0)
		// {
		// 	return "Not released";
		// }
		// else
		// {
			$query = "SELECT * FROM StudentScores WHERE student_id = $student_id AND test_id = $test_id";
			$result = $db->exec_query($query);

			$scores = array();
			$i = 0;
			while($row = $result->fetch_array())
			{
				$scores[$i] = $row;
				$id = $row['question_id'];

				$question_query = "SELECT description FROM TestBank WHERE question_id = $id";
				$result = $db->exec_query($question_query);
				$description = $result->fetch_array();

				$scores[$i]['description'] = $description;

				$i++;
			}

			return json_encode($scores);
		// }

	}
?>