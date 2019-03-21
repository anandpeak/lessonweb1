
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
		$servername = "localhost:3306";
		$username = "root";
		$password = "Eff123456";
		$db = "SISI2";

		try{
			$pdo = new PDO('mysql:host=localhost; dbname = SISI2; port=3306', $username, $password);
			$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			echo "amjilttai";
		
			}catch(PDOException $e){
				echo "aldaatai:" . $e->getMessage();
			}

			if(isset($_POST['login_name'])&&
			isset($_POST['login_password'])
		 ){
			 $user = $_POST['login_name'];
			 $pass = $_POST['login_password'];
			 //suragchiin medeeleliig student table ees avah 
			 $query = $pdo->prepare("SELECT * FROM SISI2.student WHERE userName = '$user' AND passWord1 = '$pass'");
			 $query->execute();
			 $row = $query->fetch();
			

			 $a = $row->id;
			 echo "a=".$a;
			 echo "<table>";
				echo <<<EOT
			<tr>
				<td>ID:			$row->id</td>
				<td>Firstname: $row->firstName</td>
				<td>LastName: $row->lastName</td>
				<td>Gender: $row->gender</td>
				<td>Major_id: $row->major</td>
			</tr>
EOT;
			echo "</table>";
			echo"<br><br><br><br>";

			//hicheeliin medeelliig lesson tablees avah
			$sql = $pdo->prepare("SELECT * FROM SISI2.lesson");
			$sql ->execute();
			echo "<form action='index.php' method='post'>";
			 echo "<table>";
			 while($row = $sql->fetch()){
				echo <<<EOT
				<tr>
					<td> lesson: $row->lesson_name</td>
					<td> Songoh: <input type = 'checkbox' name = "check[]" value = $row->id> </td>
				</tr>
EOT;

			 }
			 echo "</table>";
			 echo"<input type='submit' value = 'save'>";
			 echo"</form>";
		}



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