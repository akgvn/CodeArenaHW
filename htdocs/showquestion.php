<html>
<body>

<?php
// TODO not done

session_start();

$hide = false;

if (isset($_SESSION["user_id"]) != true) {
    header("Location: login.php");
}

require "db_connect.php";

if (!isset($_GET["id"])) {
    $hide = true;

    // List all questions if no id is sent.

    $query_all = $db->query("select question_id, question_title from questions");

    echo "<a href=\"listallusers.php\">Back to Listing</a>";

    echo "<h2> List of Questions </h2>";

    echo "<ol>";
    while ($row = $query_all->fetch_assoc()) {
        $id = $row["question_id"];
        $name = $row["question_title"];
        echo "<li>";
        echo "<a href=\"showquestion.php?id=$id\">$name</a>";
    }
    echo "</ol>";
} else {

    $solvedbefore = $db->query("select solved_id from solved_by where question_id='" . $_GET["id"] . "' && user_id='" . $_SESSION["user_id"] . "'");
    $solvedbefore = $solvedbefore->num_rows;

    if($solvedbefore != 0) {
        $solvedbefore = true;
    } else {
        $solvedbefore = false;
    }

    echo "<a href='showquestion.php'>Return to All Questions List</a><br>";

    if($solvedbefore) {
        echo "<br> <strong> You solved this question before! </strong> <br>";
    }

    $query_all = $db->query("select question_title, question_text, question_answer from questions where question_id =\"" . $_GET["id"] . "\"");

    $row = $query_all->fetch_assoc();

    echo "<h3>" . $row["question_title"] . "</h3>";
    echo $row["question_text"] . "<br> <br>";

}
?>

<form method="post">

    <textarea required name = "answer" cols = "40" rows = "6" <?php echo $solvedbefore ? "disabled " : " placeholder='Your Answer...' "; echo $hide ? "hidden >" : ">"; echo $solvedbefore ? $row["question_answer"]  : "" ?></textarea>
    <br>
    <input type="submit" value="Submit" <?php echo $hide || $solvedbefore ? "hidden" : "" ?> />
    
</form>

<?php

if (isset($_POST["answer"])) {
    if($_POST["answer"] == $row["question_answer"]) {
        $db->query("insert into solved_by set question_id='" . $_GET["id"] . "', user_id='" . $_SESSION["user_id"] . "'");
        $solved = $db->query("select solved_count from users where id='" . $_SESSION["user_id"] . "'");
        $solved = $solved->fetch_assoc();
        $solved = $solved["solved_count"];
        $solved += 1;
        $db->query("update users set solved_count='" . $solved . "' where id='" . $_SESSION["user_id"] . "'");
   }
}

?>


</body>
</html>