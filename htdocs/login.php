<?php
	session_start();

	if (isset($_SESSION["username"])) {
		echo $_SESSION["username"];
	}

	if (array_key_exists("user", $_POST) && array_key_exists("pass", $_POST)) {
		print_r($_POST); // Print everthing that's posted.
		echo "<br>";

		require "db_connect.php";

		$username = $_POST["user"];
		$password = $_POST["pass"];

		$query_str = "select * from users where username = \"" . $username . "\" and password = \"" . $password . "\"";//. "\" LIMIT 1";
		
		print $query_str;
		echo "<br>";
		
		$result = $db->query($query_str); // Querying db for the user.
		
		print_r($result);
		echo "<br>";

		$n_rows = $result->num_rows; // Number of rows with that username & password, should be 1.
		
		echo $n_rows;
		echo "<br>";

		if ($n_rows == 1) {
			echo "Login successful.";

			$row = $result->fetch_assoc(); // Fetch the entire row.

			$_SESSION["user_id"] = $row["id"]; // Gets the id column of the row.
			$_SESSION["username"] = $username;

			header('Location: listallusers.php') ;
		}
		else {
			echo "Password or username mismatch.";
		}
	}		
	
?>
	

<html>
	<body>
		<form method = "post">
			<label> Username: </label> <input required name = "user"> </input> <br> 	
			<label> Password: </label> <input required name = "pass" type = "password"> </input>
			<br>	
			<input type="submit" value="Submit" />
		</form>	
	</body>	
</html>

