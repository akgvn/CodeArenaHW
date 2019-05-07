<html>
<body>

<form method="post">

<?php

session_start();

require "db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$query_all = $db->query("select id, username, email, favourite_ide, favourite_pl, is_reviewer from users order by solved_count");

echo "<table border = 1> "; //style='border:1px'>";
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
<input type="submit" value="Submit" <?php echo $_SESSION["reviewer"] ? " " : "disabled"; ?> />
</form>

<br>

<a href="showquestion.php">List of Questions</a>

<br>

<?php

if ($_SESSION["reviewer"]) {
    echo "<a href=\"addquestion.php\">Add Question</a>";
}

?>

<form method="get">
	<input type="hidden" name=""signout" value="1" />
	<input type="submit" value="Sign out" />
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