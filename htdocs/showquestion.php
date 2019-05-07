<html>
<body>

<?php
    // TODO not done

    session_start();
    
    $hide = false;

	if(isset($_SESSION["user_id"]) != true) {
		header("Location: login.php"); 		
    }
    
    require "db_connect.php";
	
	if(!isset($_GET["id"])) {
        $hide = true;

        // List all questions if no id is sent.

        $query_all = $db->query("select question_id, question_title from questions");

        echo "<h1> List of Questions </h1>";

        echo "<ol>";
        while($row = $query_all->fetch_assoc()) {
            $id = $row["question_id"];
            $name = $row["question_title"];
            echo "<li>";
            echo "<a href=\"showquestion.php?id=$id\">$name</a>";
        }
        echo "</ol>";
    }
    else {

        echo "<a href='showquestion.php'>Return to All Questions List</a><br>";

        $query_all = $db->query("select question_title, question_text, question_answer from questions where question_id =\"" . $_GET["id"] . "\"");
    
        $row = $query_all->fetch_assoc();

        echo "<h3>" . $row["question_title"] . "</h3>";
        echo $row["question_text"] . "<br> <br>";
    }
?>

<form method="post">

    <textarea required name = "answer" cols = "40" rows = "6" placeholder="Your Answer..." <?php echo $hide ? "hidden" : ""?>></textarea>
    <br>
    <input type="submit" value="Submit" <?php echo $hide ? "hidden" : ""?> />

</form>


</body>
</html>