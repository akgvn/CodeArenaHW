<?php
	//session_save_path("C:\\AppServ\\php5");
	//session_start();

	// Session ile tutmamız lazım ancak AppServer desteklemediği için cookie ile yapmış. 

	// session_name("hede");
	// session_start

	$field_names = array("user", "pass");
	$n_fields = 2;
	$count = 0;

	for($i = 0; $i < $n_fields; $i++) {
		$field_name = $field_names[$i];
		if(array_key_exists($field_name, $_POST) ) { //_POST[$field_name])) 			{
			$count++;		
		}	
	}
	if ($count == $n_fields) {
		echo "Posted sth.";		
		$db = mysqli_connect("localhost", "root", "12345678", "code_arena_1");
  				//or die ("Veritabanına bağlanırken bir hata oluştu!");
		//mysql_select_db("code_arena")
  				//or die("Veritanında bir hata oluştu!");	
		$username = $_POST["user"];
		$password = $_POST["pass"];
		$query_str = "select * from users where username = \"" . $username . "\" and password = \"" . $password . "\"";//. "\" LIMIT 1";
		print $query_str;
		$result = $db->query($query_str);//mysql_query($query_str);
		$n_rows = $result->num_rows;//();//mysql_num_rows($query);
		echo $n_rows;
		if ($n_rows == 1) {
			echo "Login successful.";
			//Source: https://stackoverflow.com/questions/19260793/php-cookies-not-working 	
			//$filename = time()+3600; 
			$exp = time() + 3600;
			$row = $result->fetch_assoc(); 	 
			setcookie("username", $username, $exp, '/');
			setcookie("user_id", $row["id"], $exp, '/');
			header( 'Location: addquestion.php' ) ;
		}
		else {
			echo "Password or username mismatch.";
		}
	}		
	
?>
	

<html>
	<body>
		<form method = "post">
			<label> Username: </label> <input name = "user"> </input> <br> 	
			<label> Password: </label> <input name = "pass" type = "password"> </input> <!-- <  --> 	
			<br>	
			<input type="submit" value="Submit" />
		</form>	
	</body>	
</html>

