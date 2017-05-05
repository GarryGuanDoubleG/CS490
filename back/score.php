<?php
	
	function InsertScore($db, $student_id, $test_id)
	{
		echo "insert score";
		$score = $_POST["score"];
		$question_id = $_POST["question_id"];
		$block = $_POST["jsonobj"];

		var_dump($_POST);

		$clear_score = "DELETE FROM StudentScores WHERE test_id = $test_id " . 
				 "AND question_id = $question_id " .
				 "AND student_id = $student_id";


		$result = $db->exec_query($clear_score);

		//$_POST["questid"], $_POST["score"], $_POST["comment"], $_POST["answer"];
		
		$insert_query = "INSERT INTO StudentScores (student_id, test_id, question_id, score, block)" .
						" VALUES ($student_id, $test_id, $question_id, $score, '$block')";


		$result = $db->exec_query($insert_query); 

	}

	function GetScore($db, $student_id, $test_id)
	{
		$select_query = "SELECT * FROM studentScorePage";
		$result = $db->exec_query($select_query);

		$html = $result->fetch_array()["studentpage"];
		return $html;

		// $student_score_qry = "SELECT * FROM StudentScores WHERE student_id = $student_id AND test_id = $test_id";
		// $student_scores = $db->exec_query($student_score_qry);

		// $scores = array();
		// $i = 0;

		// foreach($student_scores as $row)
		// {
		// 	$scores[$i] = $row;
		// 	if($row["released"] == 1)
		// 	{
		// 		return "{}";
		// 	}

		// 	$question_id = $scores[$i]["question_id"];

		// 	$description = $db->exec_query("SELECT description FROM TestBank WHERE question_id = $question_id");
		// 	$description = $description->fetch_array();

		// 	$scores[$i]['description'] = $description[0];

		// 	$i++;
		// }

		// return json_encode($scores);
	}

	function GetProfScore($db, $student_id, $test_id)
	{
		$student_id = 2;
		$test_id = 0;

		$getResults = "SELECT * FROM studentScorePage";
		$result = $db->exec_query($getResults);
		$row = $result->fetch_array();

		if($row)
		{
			return $row["studentpage"];
		}

		$student_score_qry = "SELECT * FROM StudentScores WHERE student_id = $student_id AND test_id = $test_id";
		$student_scores = $db->exec_query($student_score_qry);

		$scores = array();
		$i = 0;
		
		foreach($student_scores as $row)
		{
			$scores[$i] = $row;
			$question_id = $scores[$i]["question_id"];

			$description = $db->exec_query("SELECT description FROM TestBank WHERE question_id = $question_id");
			$description = $description->fetch_array();

			$scores[$i]['description'] = $description[0];

			$i++;
		}

		return json_encode($scores);
	}

	function UpdateScore($db, $student_id, $test_id)
	{	


		$delete_query = "TRUNCATE studentScorePage";
		$db->exec_query($delete_query);
		$body = $_POST["body"];


		$update_query = "INSERT INTO studentScorePage (id, studentpage)" .
						" VALUES (0, '$body')";


		$result = $db->exec_query($update_query); 
	}
?>