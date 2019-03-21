<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		$servername = "localhost:3306";
		$username = "root";
		$password = "Eff123456";

		   $conn = mysqli_connect($servername, $username, $password);
	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
	   
	   echo 'Connected successfully';
	   /*creaing database
	   $sql = "CREATE DATABASE SISI2";
	   if ($conn->query($sql) === TRUE) {
		    echo "Database created successfully";
		} else {
		    echo "Error creating database: " . $conn->error;
		}
		*/
		$touch = "use SISI2";
		if(!($conn->query($touch))){
			die(" holbogdoj chadsangui ee: ". mysql_error());
		}
		/*
		$sql = "CREATE TABLE student(
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			firstName VARCHAR(50) NOT NULL ,
			lastName  VARCHAR(50) NOT NULL ,
			userName VARCHAR(50) NOT NULL ,
			passWord1 VARCHAR (50) NOT NULL , 
			gender CHAR(1),
			major_id INT NOT NULL 
		) AUTO_INCREMENT = 100";*/
		/*
		$sql = "CREATE TABLE lesson (
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			index1 VARCHAR(10) NOT NULL,
			lesson_name VARCHAR(50) NOT NULL,
			credit INT NOT NULL
		)AUTO_INCREMENT = 10";*/
		$sql = "CREATE TABLE major (
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			year_confirmed INT(4) ,
			description VARCHAR(255) NOT NULL
		) AUTO_INCREMENT = 50";
		if(!mysqli_query($conn, $sql)){
			echo "INSERT failed: $sql<br>".mysqli_error();	
		}else{
			echo"amjilttai";
		}
		 mysqli_close($conn);
		
		 
	?>
</body>
</html>