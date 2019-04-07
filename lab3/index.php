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
			 $pass1 = filter_var($_POST['login_password'],FILTER_SANITIZE_STRING);
			 //nuhtsuluudee shalgah , nuhtsul bieleegui tohioldold login ruu butsaah uildel hiih
			 $a = $pass1;
			 $b = 'aa';
			 $pass= hash('ripemd128', "$b$a");
			 //suragchiin medeeleliig student table ees avah 
			 $query = $pdo->prepare("SELECT * FROM SISI2.users WHERE userName = '$user' AND userPassword = '$pass' AND staff_id IS NULL");
			 $query->execute();
			 
 			 //admin hereglegchiin medeelel shalgah, admin hereglegchiin alert 3 bn 
			 $query1 = $pdo->prepare("SELECT * FROM SISI2.users WHERE userName = '$user' AND userPassword = '$pass' AND alert = '3'");
			 $query1->execute();

			 $query2 = $pdo->prepare("SELECT * FROM SISI2.users WHERE userName = '$user' AND userPassword = '$pass'");
			 $query2->execute();

			 if($row5 = $query1->fetch()){
				//cookie eer adminii id g ywuulj olon admintai bol hen ogsniin olj bh 
				header("Location: http://localhost:8080/~macuser/web1/lab3/users.php");
				}
			 elseif($row = $query->fetch()){
				 //adminaas ymar negen handalt avaagui uyiin oyutnii medeelluud
				$query3 = $pdo->prepare("SELECT * FROM SISI2.users WHERE student_id = '$row->student_id'");
				$query3->execute();
				$row4 = $query3->fetch();
				//var_dump($row4->alert);
				//var_dump($row->alert);

				if($row4->alert == NULL){
					//login in hiihdee checkbox darval daraa orhod username hadgalagdsan bhaar cookie hiiw
					if(isset($_POST['checkbox'])){	
						if($_POST['checkbox'] == 1){
							//hadgalah checkbox daraad amjilttai nevtersen tohioldold
							setcookie('username',$_POST['login_name'] ,time()+(7*60*60*24),"/");
							//var_dump($_COOKIE['username']);
							//ob_start iin tugsgul ymar negen output urd ni gargahgui 
							ob_end_flush();
						}
					}
					var_dump($row->student_id);
					$query4 = $pdo->prepare("SELECT * FROM SISI2.student WHERE id = '$row->student_id'");
					$query4->execute();
					$row5 = $query4->fetch();
					echo "<h3>Оюутны мэдээлэл</h3>";		
					echo "<table>";
					echo <<<EOT
					<tr>
						<td>ID:			$row5->id</td>
						<td>Firstname: $row5->firstName</td>
						<td>LastName: $row5->lastName</td>
						<td>Gender: $row5->gender</td>
						<td>Major_id: $row5->major_id</td>
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
						$ss = $pdo->prepare("SELECT * FROM SISI2.stu_les s, SISI2.lesson l WHERE s.lesson_id = '$qur' AND l.id = '$row1->id' AND s.student_id = '$row5->id'");
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
							echo 	"<input type = 'hidden' name = 'stu_id' value = $row5->id>";
						}
						echo 	"</tr>";
					}
					echo "</table>";
					echo"<input type='submit' value = 'save'>";
					echo"</form>";
					echo"<a href='lougout.php'>Гарах</a>";
					}
				// inactive suragchid
				elseif($row4->alert == 1){
					setcookie('inactive','Таны эрх хаагдсан байна. Та системийн админтай холбодоно уу. Баярлалаа' ,time()+(1),"/");
					header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
					}
				// pass solih shaardlagtai suragchid
				elseif($row4->alert == 2){
					setcookie('pass',$row4->id,time()+(1),"/");
					header("Location: http://localhost:8080/~macuser/web1/lab3/pass.php");
					}
				} 
			elseif($row3 = $query2->fetch()){
				// var_dump($row3->student_id);
				if($row3 ->student_id == NULL){
					//engiin staff orj irhed
					if($row3 ->alert == NULL){
						setcookie('username',$_POST['login_name'] ,time()+(7*60*60*24),"/");
						header("Location: http://localhost:8080/~macuser/web1/lab3/list.php");
					}
					//staff iig inactive bolgoh
					elseif($row3->alert == 1){
						setcookie('inactive','Таны эрх хаагдсан байна. Та системийн админтай холбодоно уу. Баярлалаа' ,time()+(1),"/");
						header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
					}
					//staff iin pass iig solih
					elseif($row3 ->alert == 2){
						setcookie('pass',$row3->id,time()+(1),"/");
						header("Location: http://localhost:8080/~macuser/web1/lab3/pass.php");
					}
				}
			}
			else{
				setcookie("pass","Nevtreh nuuts ug buruu baina",time()+5,"/");
				header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
				// echo "Уучлаарай таны нэвтрэх нууц үг юм уу пасс буруу юм шиг санагдахгүй бна уу ??";
				}
			 }
			 //Oyutnii medeelel oldoogui tohioldol butsaad ilgeeh

		
		if(isset($_POST['check']) &&
			isset($_POST['stu_id'])){
				print_r($_POST['stu_id']);
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