<?php 	ob_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<style>
	 	table{
	 		border:1px solid black;
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
        $conn = mysqli_connect($servername, $username, $password, $db);	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
       }
 


       if(isset($_POST['Status'])){
        $st = $_POST['Status'];
        if($st == 'Staff'){
            echo <<<EOT
            <h3>Ажилтан та өөрийн мэдээллээ оруулна уу</h3>
            <table width = 240px>
           <form action = "insert.php" method = "post">
           <tr>
                <td>firstName</td><td><input type = "text" name = "firstName"></td>
            </tr>
            <tr>
                <td>lastName</td><td> <input type = "text" name = "lastName"></td>
            </tr>
            <tr>
                <td>userName</td><td> <input type = "text" name = "userName"></td>
            </tr>
            <tr>
                <td>passWord</td><td> <input type = "password" name = "passWord1"></td>
            </tr>
            <tr>
                <td>Position </td> <td><input type = "text" name = "pos"></td>
            </tr>
            <tr>
                  <td> <input style= 'background-color:yellow;' type = "submit" value = "Insert"></td>
            </tr>
           </form>
           </table>
EOT;
        }if($st == 'Student'){
            echo <<<EOT
            <h3>Оюутан та өөрийн мэдээллээ оруулна уу</h3>
            <table width = 240px>
           <form action = "insert.php" method = "post">
           <tr>
                <td>firstName</td><td><input type = "text" name = "firstName"></td>
            </tr>
            <tr>
                <td>lastName</td><td> <input type = "text" name = "lastName"></td>
            </tr>
            <tr>
                <td>userName</td><td> <input type = "text" name = "userName"></td>
            </tr>
            <tr>
                <td>passWord</td><td> <input type = "password" name = "passWord1"></td>
            </tr>
            <tr>
                <td>Gender </td><td>  <input type = "text" name = "gender"></td>
            </tr>
            <tr>
                <td>Major   </td> <td><input type = "number" name = "major_id"></td>
            </tr>
            <tr>
                  <td> <input style= 'background-color:yellow;' type = "submit" value = "Insert"></td>
            </tr>
           </form>
           </table> 
EOT;
        }
    }else{
        echo "<h3>Та бүртгэлийн хуудсанд нэвтэрлээ</h3><br>";
        echo "<h3>Бүртгэлийн Статус аа сонгоно уу<h3><br>";
        echo <<<EOT
    
            <form action = "insert.php" method = "post">
                <select name = "Status">
                    <option value = "Staff">Ажилтан</option>
                    <option value = "Student">Сурагч</option>
                </select>
                <br>
                <input type = "submit">
            </form>
EOT;
    }


       if(isset($_POST['firstName']) &&
       isset($_POST['lastName']) &&
       isset($_POST['userName']) &&
       isset($_POST['passWord1']) &&
       isset($_POST['gender']) &&
       isset($_POST['major_id'])
       ){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $password = $_POST['passWord1'];
        $gender = $_POST['gender'];
        $major = $_POST['major_id'];

        $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
        $last_id = $conn->insert_id;
        $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password')";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
        header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
    }if(isset($_POST['firstName'])&&
    isset($_POST['lastName'])&&
    isset($_POST['pos'])&&
    isset($_POST['userName'])&&
    isset($_POST['passWord1']) ){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $password = $_POST['passWord1'];
        $pos = $_POST['pos'];
        //nuhtsuluud shalgah
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $char      = preg_match('@[$,#,&,^,*]@', $password);
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || !$char) {
            // tell the user something went wrong
            echo " suga ";
        }
        else{
            if(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                echo "mash sn";
            }
            if(preg_match('^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                echo "bolomjiin"; 
            }
            else{
                echo "sul bn ";
            }
        }   
        $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$pos','$userName','$password')";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
        $last_id = $conn->insert_id;
        $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password')";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
        //uildel duussanii daraa login page ruu butsah uuniig zaaval neeh
        //header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
    }
    ob_end_flush();




 

    /*
       echo <<<EOT
        <table width = 240px>
       <form action = "insert.php" method = "post">
       <tr>
            <td>firstName</td><td><input type = "text" name = "firstName"></td>
        </tr>
        <tr>
            <td>lastName</td><td> <input type = "text" name = "lastName"></td>
        </tr>
        <tr>
            <td>userName</td><td> <input type = "text" name = "userName"></td>
        </tr>
        <tr>
            <td>passWord</td><td> <input type = "password" name = "passWord1"></td>
        </tr>
        <tr>
            <td>Gender </td><td>  <input type = "text" name = "gender"></td>
        </tr>
        <tr>
            <td>Major   </td> <td><input type = "number" name = "major_id"></td>
        </tr>
        <tr>
              <td> <input style= 'background-color:yellow;' type = "submit" value = "Insert"></td>
        </tr>
       </form>
       </table>
EOT;
*/
        
	?>
</body>
</html>