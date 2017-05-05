<?php

	function InsertQuestion($db, $question)
	{
		$table = "TestBank";

		$method_name = $question["methodName"];
		$returnType = $question["returnType"];
		$type = $question["type"];
		$difficulty = $question["difficulty"];
		$parameter = $question["parameter"];
		$description = $question["descr"];
		$testcases = $question["cases"];
		$type = "code";//used for filtering but currently not being utilized

		$query = "INSERT INTO $table " . 
								"(type, method_name, returnType, difficulty, parameters, description, testcases) " .
				 				"VALUES ('$type', '$method_name', '$returnType', '$difficulty', '$parameter', '$description', '$testcases');";
		if(!$db->exec_query($query))
		{
			echo "Error";
		}
		else
		{
			echo "Success";
		}
	}

	function GetFilterQuery($filter, $filterText)
	{
		$filterQuery = "";
		if($filter == "None")
			return $filterQuery;

		if($filter == "Keyword")
		{
			$filterQuery = " WHERE description LIKE '%" . $filterText . "%'";
		}

		else if($filter == "Difficulty")
		{
			$filterQuery = " WHERE difficulty = '$filterText'";
		}
		else if($filter == "Type")
		{
			$filterQuery = " WHERE type = '$filterText'";
		}

		return $filterQuery;
	}

	function GetSortQuery($sortStr, $asc)
	{
		$sort = "";

		if($sortStr != "None")
		{
			if($asc == true)
			{
				$sort = " ORDER BY $sortStr ASC";
			}
			else
			{
				$sort = " ORDER BY $sortStr DESC";
			}
		}
		
		return $sort;
	}

	function GetAllQuestions($db)
	{
		$query = "SELECT * from TestBank";
		$filter = GetFilterQuery($_POST["filter"], $_POST["filterText"]);
		$sort = GetSortQuery($_POST["sort"], $_POST["ascending"]);

		$query = $query . $filter . $sort;
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