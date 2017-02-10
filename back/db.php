
<?php
	
	class DB
	{
		private $db;
		private $table;
		private $username;
		private $pw;
		private $hostname;

		public $conn;

		function __construct()	
		{
			$this->db = "gg99";
			$this->username = "gg99";
			$this->pw = "spheric25";
			$this->table = "CS490";

			$this->conn = new mysqli('sql2.njit.edu', $this->username, $this->pw, $this->db);
			if($this->conn->connect_error)
			{
				echo "Failed to connect to db";
			}
		}

		function exec_query($username, $password)
		{			
			$query = "SELECT * FROM " . $this->table . " WHERE username = '$username' AND password = '$password'";
			echo "query: $query<br>";
			$result = $this->conn->query($query);

			return $result;
		}
	}


?>