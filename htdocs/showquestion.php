<?php
    // TODO not done

	session_start();

	if(isset($_SESSION["username"]) != true) {
		header("Location: login.php"); 		
	}
	
	if(!isset($_GET["id"])) {
        echo "Error, no question id!";
        // TODO more here
    }
    else {
        require "db_connect.php";

        $query_all = $db->query("select question_title, question_text, question_answer from questions where question_id =\"" . $_GET["id"] . "\"");
    
        $row = $query_all->fetch_assoc();

        print_r($row); // TODO add question answering etc.

        echo ["question_title"];
        echo ["question_text"];
    }
?>

<form method="post">

    <textarea required name = "answer" cols = "40" rows = "6" placeholder="Your Answer..."></textarea>
    <br>
    <input type="submit" value="Submit" />

</form>