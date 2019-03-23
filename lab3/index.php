
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

		try{
			$pdo = new PDO('mysql:host=localhost; dbname = SISI2; port=3306', $username, $password);
			$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);		
			}catch(PDOException $e){
				echo "aldaatai:" . $e->getMessage();
			}

			if(isset($_POST['login_name'])&&
			isset($_POST['login_password'])
		 ){
			 $user = filter_var($_POST['login_name'], FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_HIGH);
			 //var_dump($user);
			 $pass = filter_var($_POST['login_password'],FILTER_SANITIZE_STRING);
			 //suragchiin medeeleliig student table ees avah 
			 $query = $pdo->prepare("SELECT * FROM SISI2.student WHERE userName = '$user' AND passWord1 = '$pass'");
			 $query->execute();
			 $row = $query->fetch();
			echo "<h3>Оюутны мэдээлэл</h3>";		
			 echo "<table>";
				echo <<<EOT
			<tr>
				<td>ID:			$row->id</td>
				<td>Firstname: $row->firstName</td>
				<td>LastName: $row->lastName</td>
				<td>Gender: $row->gender</td>
				<td>Major_id: $row->major_id</td>
			</tr>
EOT;
			echo "</table>";
			echo"<br><br>";
			echo "<h3>Хичээлийн мэдээлэл</h3>";
			//hicheeliin medeelliig lesson tablees avah
			$sql = $pdo->prepare("SELECT * FROM SISI2.lesson");
			$sql ->execute();
			echo "<form action='index.php' method='post'>";
			 echo "<table>";
			 while($row1 = $sql->fetch()){
			echo "<tr>";
			echo	"<td> lesson: $row1->lesson_name</td>";
			$qur = $row1->id;
			$ss = $pdo->prepare("SELECT * FROM SISI2.stu_les s, SISI2.lesson l WHERE s.lesson_id = '$qur' AND l.id = '$row1->id' AND s.student_id = '$row->id'");
			$ss->execute();
			while($row2 = $ss->fetch()){
				//echo "<br>";
				//echo $row2->student_id;
				$les1[] = $row2->lesson_id;
				//echo $row2->id;
			//	var_dump($les1);	
			} 
			if(in_array($row1->id , $les1)){
				echo	"<td style= 'background-color:green;' > Songoh: <input type = 'checkbox' name = 'check1[]' value = $row1->id checked> </td>";
			}else{
				echo	"<td > Songoh: <input type = 'checkbox' name = 'check[]' value = $row1->id> </td>";
				echo 	"<input type = 'hidden' name = 'stu_id' value = $row->id>";
			}
			echo 	"</tr>";
			 }
			 echo "</table>";
			 echo"<input type='submit' value = 'save'>";
			 echo"</form>";
			
		}
		if(isset($_POST['check']) &&
			isset($_POST['stu_id'])){
				print_r($_POST['check']);

			$check = $_POST['check'];
			$stu_id = $_POST['stu_id'];
			foreach ($check as $checked){
				//var_dump($stu_id);
				$query = $pdo->prepare("INSERT INTO SISI2.stu_les VALUES(NULL,$stu_id,'$checked')");
				$query->execute();
			}
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