<?php

	session_start();

	if(isset($_SESSION["username"]) != true) {
		header("Location: login.php"); 		
	}
	
	print_r($_SESSION);

	echo "Hey.";
?>

<html>
	<body>

		<form method = "post">
			<label> Question Title: </label> <br>
			<input name = "question_title"> </input> <br> 	
			
			<label> Question Text: </label> <br>
			<textarea name = "question_text" cols = "40" rows = "6" > </textarea> <br> 	
			<label> Answer: </label> <br> 
			<input name = "answer"  > </input> <br>
					
			<input type="submit" value="Submit" />
		</form>
	</body>		
</html>

<?php
	require "db_connect.php";
	
	echo $_SESSION["username"]; // FIXME this place

	echo "Hey.";

	if (array_key_exists("username", $_SESSION)) {
		$field_names = array("question_title", "question_text", "answer");
		$n_fields = 3;
		$count = 0;
		for($i = 0; $i < $n_fields; $i++) {
			$field_name = $field_names[$i];
			if(array_key_exists($field_name, $_POST) ) {
				$count++;		
			}	
		}
		if ($count == $n_fields) {
			$username = $_SESSION["username"];	
			echo $username;	
			$reviewer_id = $_SESSION["user_id"]; 
			echo $reviewer_id;	
			//$query_str	
			
			$query_all = $db->query("select username, is_reviewer from users where username =\"" . $username . "\""); //$username from users where  ");
			//echo $query_all;
			$row = $query_all->fetch_assoc();
			if($row["is_reviewer"] == 1){
				$question_title = "\"" . $_POST["question_title"] . "\"";
				$question_text = "\"" . $_POST["question_text"] . "\"";
				$answer = "\"" . $_POST["answer"] . "\"" ;
				//$quetion_answer = $_POST["answer"];
				$query_str = "insert into questions (question_title, question_text, question_answer, reviewer_id)  VALUES($question_title, $question_text, $answer, $reviewer_id)";
				echo $query_str;//Str
				$query_result = $db->query($query_str);//$db->query("insert into questions (question_title, question_text, question_answer, reviewer_id)  VALUES($question_title, $question_text, $an");   //Q
				if ($query_result == true) {
					echo "Question added.";
				} 	
				else {
					echo "Sth is wrong.";
				}
			}
			else {
				header("Location: http://localhost/prez");
			}	
					
		}
		//else {
		//	header("Location: http://localhost");
		//}	

	}
?>	
