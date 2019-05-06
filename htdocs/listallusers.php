<?php

	session_start();
	
	require "db_connect.php";
	
	$query_all = $db->query("select id, username, email, favourite_ide, favourite_pl, is_reviewer from users");
 
	echo "<table border = 1> ";//style='border:1px'>";
	echo "	<tr>";
	echo "		<th> Username </th>"; 
	echo "      <th> eMail </th>";
	echo "		<th> Favorite IDE </th>";
	echo "		<th> Favorite PL </th>";
	echo "		<th> Reviewer </th>";
	echo "	</tr>";
		    
	while($row = $query_all->fetch_assoc()) {

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
		echo "  <td><input type='checkbox' name='$id' value='$reviewer' ";

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
