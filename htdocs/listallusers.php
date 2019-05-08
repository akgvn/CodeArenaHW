<html>

<head>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body {
    width: 30%;
    padding: 50px;
    align-items: center;
    padding-top: 50px;
    padding-bottom: 50px;
    background-color: #f5f5f5;
}
</style>

<body>

<form method="post">

<?php

session_start();

require "db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$un = $_SESSION["username"];

echo "<strong> Welcome, $un! </strong> <br>";

echo "<a href=\"leaderboard.php\">Leaderboard</a> <br>";

$query_all = $db->query("select id, username, email, favourite_ide, favourite_pl, is_reviewer from users");

echo "<table class=\"table table-striped\"> ";
echo "	<tr>";
echo "		<th> Username </th>";
echo "      <th> eMail </th>";
echo "		<th> Favorite IDE </th>";
echo "		<th> Favorite PL </th>";
echo "		<th> Reviewer </th>";
echo "	</tr>";

while ($row = $query_all->fetch_assoc()) {

    $id = $row["id"];
    $username = $row["username"];
    $email = $row["email"];
    $ide = $row["favourite_ide"];
    $pl = $row["favourite_pl"];
    $reviewer = $row["is_reviewer"];
    echo "<tr>";
    echo "	<td> $username </td>";
    echo "  <td> $email </td>";
    echo "  <td> $ide </td>";
    echo "  <td> $pl </td>";
    echo "  <td><input type='checkbox' name='reviewerchecklist[]' value='$id' ";

    if ($reviewer) { // If user is reviewer, check the box.
        echo "checked ";
    }

    if (!$_SESSION["reviewer"]) { // If session user is not a reviewer, disable the box.
        echo "disabled";
    }

    echo " />";
    echo "</tr>";
    $count++;
}
echo "</table>";
?>
<input type="hidden" name="sent" value="1" />
<input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit" <?php echo $_SESSION["reviewer"] ? " " : "disabled"; ?> />
</form>

<br>

<div class="card">
  <div class="card-body">
    <a href="showquestion.php">List of Questions</a>
    <br>
    <?php

    if ($_SESSION["reviewer"]) {
        echo "<a href=\"addquestion.php\">Add Question</a>";
    }

    ?>
  </div>
</div>






<form method="get">
	<input type="hidden" name="signout" value="1" />
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign out" />
</form>


<?php

if (($_POST["sent"])) { // Form is submitted

    $query_all = $db->query("select id from users");

    while ($row = $query_all->fetch_assoc()) {
        $cid = $row['id'];

        echo "cid: ";
        print_r($cid);
        echo "<br> thing: ";
        print_r($_POST["reviewerchecklist"]);

        if (in_array($cid, $_POST["reviewerchecklist"])) {
            $qu = $db->query("update users set is_reviewer='1' where id='$cid'");
        } else {
            $qu = $db->query("update users set is_reviewer='0' where id='$cid'");

            if ($_SESSION["user_id"] == $cid) {
                $_SESSION["reviewer"] = '0';
            }
        }
    }

    header("Refresh:0");
}

require "signout.php";
?>

</body>
</html>