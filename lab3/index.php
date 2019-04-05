<?php
	ob_start();
?>
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
	//header("location:login.php?st=err");
		$servername = "localhost:3306";
		$username = "root";
		$password = "Eff123456";
		$db = "SISI2";
		try{
			$pdo = new PDO('mysql:host=localhost; dbname = SISI2; port=3306', $username, $password);
			//setAttribute -> database deer data nuudiig udirddah. 
			$pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);		
			}catch(PDOException $e){

			}
			if(isset($_POST['login_name'])&&
			isset($_POST['login_password'])
		 ){ 
			 /*
			 	$query = 'PREPARE statement FROM 'SELECT * FROM SISI2.student WHERE userName = ? AND passWord1 = ?'';
				$query = 'SET @user = $_POST['login_name'],' .
							'@pass = $_POST['login_password']'
				mysqli_query($conn, $query); 
				$query = 'EXECUTE statement USING @user, @pass';
				mysqli_query($conn,$query);
			 */
			 $user = filter_var($_POST['login_name'], FILTER_SANITIZE_STRING);
			 //var_dump($user);
			 $pass = filter_var($_POST['login_password'],FILTER_SANITIZE_STRING);
			 //nuhtsuluudee shalgah , nuhtsul bieleegui tohioldold login ruu butsaah uildel hiih

			 //suragchiin medeeleliig student table ees avah 
			 $query = $pdo->prepare("SELECT * FROM SISI2.student WHERE userName = '$user' AND passWord1 = '$pass'");
			 $query->execute();
			 //oyutnii medeelel oldvol hevlej haruulna
			 if($row = $query->fetch()){
				if(isset($_POST['checkbox'])){	
					if($_POST['checkbox'] == 1){
						//hadgalah checkbox daraad amjilttai nevtersen tohioldold
						setcookie('username',$_POST['login_name'] ,time()+(7*60*60*24),"/");
						//var_dump($_COOKIE['username']);
						//ob_start iin tugsgul ymar negen output urd ni gargahgui 
						ob_end_flush();
					}
				}
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
				//
				while($row1 = $sql->fetch()){
					echo "<tr>";
					echo "<td> lesson: $row1->lesson_name</td>";
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
				echo"<a href='lougout.php'>Гарах</a>";
				}
				else{
					header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
					// echo "Уучлаарай таны нэвтрэх нууц үг юм уу пасс буруу юм шиг санагдахгүй бна уу ??";
				 }
			 }
			 //Oyutnii medeelel oldoogui tohioldol butsaad ilgeeh

		
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