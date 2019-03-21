
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
        $conn = mysqli_connect($servername, $username, $password, $db);	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
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
    }
       echo <<<EOT

       <form action = "insert.php" method = "post">
        <pre>
            firstName<input type = "text" name = "firstName">
            lastName <input type = "text" name = "lastName">
            userName <input type = "text" name = "userName">
            passWord <input type = "password" name = "passWord1">
            Gender   <input type = "text" name = "gender">
            Major    <input type = "number" name = "major_id">
                <input type = "submit" value = "Insert">
        </pre>
       </form>
EOT;

        
	?>
</body>
</html>