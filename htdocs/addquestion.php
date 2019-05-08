<?php
session_start();

if (isset($_SESSION["username"]) != true) {
    header("Location: login.php");
}

?>

<html>

    <head>
        <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/4.3/examples/sign-in/signin.css" rel="stylesheet">
    </head>

	<body class="text-center">
    
		<form method = "post" class="form-signin">
        <a href="listallusers.php">Go Back to Users List</a>
        <br><br>
        <h1 class="h3 mb-3 font-weight-normal">Add Question</h1>

            <div class="form-group">
			<label>Question Title:<br>
			<input required name = "question_title" placeholder="Question Title..." class="form-control" ></input> <br>
			</label>
            </div>
            <div class="form-group">
			<label>Question Text:<br>
			<textarea required name = "question_text" cols = "40" rows = "6" placeholder="Question..." class="form-control" ></textarea> <br>
			</label>
            </div>
            <div class="form-group">
			<label>Answer:<br>
			<input required name = "answer" placeholder="Answer..." class="form-control" ></input> <br>
			</label>
			<br>
            </div>
            <div class="form-group">
			
			<input type="submit" value="Submit Question" class="btn btn-lg btn-primary btn-block" />
            </div>
    	</form>
   
	</body>
</html>

<?php
require "db_connect.php";

if (array_key_exists("username", $_SESSION)) {
    if (array_key_exists("question_title", $_POST) && array_key_exists("question_text", $_POST) && array_key_exists("answer", $_POST)) {
        $username = $_SESSION["username"];
        echo $username;
        $reviewer_id = $_SESSION["user_id"];
        echo $reviewer_id;

        $query_all = $db->query("select username, is_reviewer from users where username =\"" . $username . "\"");

        $row = $query_all->fetch_assoc();

        if ($row["is_reviewer"] == 1) {
            $question_title = "\"" . $_POST["question_title"] . "\"";
            $question_text = "\"" . $_POST["question_text"] . "\"";
            $answer = "\"" . $_POST["answer"] . "\"";

			$query_str = "insert into questions (question_title, question_text, question_answer, reviewer_id)  VALUES($question_title, $question_text, $answer, $reviewer_id)";
			
			$query_result = $db->query($query_str); 
			
            if ($query_result == true) {
                echo "Question added.";
            } else {
                echo "Problem with db, question wasn't added.";
            }
        } else {
            header("Location: listallusers.php");
        }
    }
}
?>
