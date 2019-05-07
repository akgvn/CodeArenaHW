<?php
session_start();

if (isset($_SESSION["username"]) != true) {
    header("Location: login.php");
}

print_r($_SESSION);

echo "Hey.";
?>

<html>
	<body>
		<form method = "post">
			<label>Question Title:<br>
			<input required name = "question_title" placeholder="Question Title..."></input> <br>
			</label>

			<label>Question Text:<br>
			<textarea required name = "question_text" cols = "40" rows = "6" placeholder="Question..."></textarea> <br>
			</label>

			<label>Answer:<br>
			<input required name = "answer" placeholder="Answer..."></input> <br>
			</label>
			<br>
			<input type="submit" value="Submit" />
		</form>
	</body>
</html>

<?php
require "db_connect.php";

echo $_SESSION["username"];

echo "Hey.";

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
