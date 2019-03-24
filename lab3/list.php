
<!DOCTYPE html>
<html>
<head>
	<style>
	 	table{
	 		border:1px solid black;
	 		width: 100%;
	 	}
	 	tr, td{
	 		border:1px solid black;
	 	}
		form { 
			display: inline; 
		}
		body{
			background-color:#E0FFFF;
		}
	</style>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	
			
	<?php 
		$servername = "localhost:3306";
		$username = "root";
		$password = "Eff123456";
		$db = "SISI2";
        $conn = mysqli_connect($servername, $username, $password, $db);	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
        echo <<<EOT
			<a href="insert.php"><button>Insert</button></a> 
			
EOT;
if(isset($_GET['delete']) && isset($_GET['id'])){
	$isbn = $_GET['id'];
	var_dump($isbn);
	$query = "DELETE FROM student WHERE id='$isbn'";
	//ustgah querry ajilluullaad shalgaj baina
	if(!mysqli_query($conn, $query)){
		echo "DELETE failed: $query <br>".mysql_error()."<br><br>";
	}
}

	   $query = "SELECT * FROM student";
	   $result = mysqli_query($conn, $query);
	   if(!$result) die ("DATAbase Access failed ". mysql_error());
	   $rows = mysqli_num_rows($result);
	   echo "<table>";
	   for($j = 0; $j < $rows; $j++){
		   $row = mysqli_fetch_row($result);
			echo <<<EOT
				<tr>
					<td>ID:			$row[0]</td>
					<td>Firstname: $row[1]</td>
					<td>LastName: $row[2]</td>
					<td>Gender: $row[5]</td>
					<td>Major_id: $row[6]</td>
					<td>
						<form action = "update.php" method="get">
							<input type = "hidden" name = "update" value = "yes"> 
							<input type = "hidden" name = "id" value="$row[0]">
						<a href="update.php"><input type = "submit" value = "Update Record"></a>
						</form>
						<form action = "list.php" method = "get">
							<input type = "hidden" name = "delete" value = "yes">
							<input type = "hidden" name = "id" value = "$row[0]">
							<input type = "submit" value = "Delete Record">
						</form>
					</td>
				</tr>
EOT;
	   }
	   echo "</table>";

	   
	?>

</body>
</html>