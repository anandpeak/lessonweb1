
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
	</style>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	
	
	<?php 


/*
		$servername = "localhost:3306";
		$username = "root";
		$password = "Eff123456";
		$db = "SISI2";
        $conn = mysqli_connect($servername, $username, $password, $db);	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
	   

		if(isset($_POST['login_name'])&&
		   isset($_POST['login_password'])
		){
			$user = $_POST['login_name'];
			$pass = $_POST['login_password'];
			$query = "SELECT * FROM student WHERE userName = '$user' AND passWord1 = '$pass'";
			var_dump($query);
			if(!mysqli_query($conn, $query)){
				echo "<br> amjiltgui";
			}else{
				$result = mysqli_query($conn,$query);
				var_dump($result);
			}
			$rows = mysqli_num_rows($result);
			for($j = 0; $j < $rows; $j++){
				$row = mysqli_fetch_row($result);
				echo "<table>";
				echo <<< EOT
				
				<tr>
					<td>ID:			$row[0]</td>
					<td>Firstname: $row[1]</td>
					<td>LastName: $row[2]</td>
					<td>Gender: $row[5]</td>
					<td>Major_id: $row[6]</td>
				</tr>
EOT;
				echo "</table>";
			}
		}
        */
	?>

</body>
</html>