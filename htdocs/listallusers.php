		<!-- Source: http://www.belgeler.org/hpm/html-php-mysql-giris_prg-phpmysql.html
			 Variant: Talha Karadeniz
			 Source 2: http://www.sqlkodlari.com/01-sql-kullanimi.asp
		-->
		<?php
			
			$db = mysqli_connect("localhost", "root", "dbpassword", "lab382");
  			//or die ("Veritabanına bağlanırken bir hata oluştu.");
			//mysql_select_db("code_arena")
  			//or die("Veritanında bir hata oluştu.");	
			$query_all = $db->query("select username, email, favourite_ide from users");
			//$n_users = $query_all->num_rows;  
			echo "<table border = 1> ";//style='border:1px'>";
			echo "	<tr>"; //<th>";
			echo "		<td> username </td>"; 
			echo "      <td> email </td>";
			echo "		<td> favourite_ide </td>"; 
			echo "	</tr>";//</th>";
				    
			//$rows = $query_all->fetch();		 
			while($row = $query_all->fetch_assoc()) {
				
				//$username = mysql_result($query_all, $count, "username");
				//$email = mysql_result($query_all, $count, "email");
				//$ide = mysql_result($query_all, $count, "favourite_ide");
				$username = $row["username"];
				$email = $row["email"];
				$ide = $row["favourite_ide"];
				echo "<tr>";  
				echo "	<td> $username </td>"; 
				echo "  <td> $email </td>"; 
				echo "  <td> $ide </td>"; //<br>";
				echo "</tr>";
				$count++; 	
			}	
			echo "</table>";	
			//echo $result;	   
			//echo "Hey.";	
			//$field_names = array("user", "pass", "favourite_pl", "ide");
			//$n_fields = 4;
			//$count = 0;
			//for($i = 0; $i < $n_fields; $i++) {
			//	$field_name = $field_names[$i];
			//	if(_POST[$field_name] !== null) {
			//		$count++;		
			//	}	
			//}
			//if ($count == $n_fields) {
			//	//echo "Posted sth.";		
			//	@mysql_connect("localhost", "root", "1357")
  			//or die ("Veritaban�na ba�lan�rken bir hata olu�tu!");
			//	@mysql_select_db("code_arena")
  			//or die("Veritan�nda bir hata olu�tu!");	
			//}		
			//$n_users = 3;
			//$count = 0;
			//while($count < $n_users) {
			//	$query = mysql_query("select * from users");
			//	$username = mysql_result($query, $count, "username");
			//	echo "$username <br>";
			//	$count++; 	
			//} 		
	
		?>
	
