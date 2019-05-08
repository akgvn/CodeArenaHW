<html>

<head>
<link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<a href="listallusers.php">Back to All Users</a>

<?php

session_start();

require "db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
}

$query_all = $db->query("select id, username, email, favourite_ide, favourite_pl, solved_count from users order by solved_count desc");

echo "<table class=\"table table-striped\"> ";
echo "	<tr>";
echo "		<th> Username </th>";
echo "      <th> eMail </th>";
echo "		<th> Favorite IDE </th>";
echo "		<th> Favorite PL </th>";
echo "		<th> Solved Questions </th>";
echo "	</tr>";

while ($row = $query_all->fetch_assoc()) {

    $id = $row["id"];
    $username = $row["username"];
    $email = $row["email"];
    $ide = $row["favourite_ide"];
    $pl = $row["favourite_pl"];
    $solved = $row["solved_count"];
    echo "<tr>";
    echo "	<td> $username </td>";
    echo "  <td> $email </td>";
    echo "  <td> $ide </td>";
    echo "  <td> $pl </td>";
    echo "  <td> $solved </td>";
    echo "</tr>";
    $count++;
}
echo "</table>";
?>

<br>

</body>
</html>