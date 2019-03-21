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
		$db = "dasgal3";
		$conn = mysqli_connect($servername, $username, $password, $db);
	   
	   if(! $conn ) {
	      die('Could not connect: ' . mysql_error());
	   }
	   
	   echo 'Connected successfully';
	   /*
	   $sql = "CREATE DATABASE dasgal3";
	   if ($conn->query($sql) === TRUE) {
		    echo "Database created successfully";
		} else {
		    echo "Error creating database: " . $conn->error;
		}
		*/

		
		$das = "dasgal3";
		$sql = "SELECT * FROM books";
		//mysqli_query SQL query ajiluulj bn 
		$result = mysqli_query($conn,$sql);

		
		$touch = "use $das";
		if(!($conn->query($touch))){
			die(" holbogdoj chadsangui ee: ". mysql_error());
		}else{
			echo "<br>";
			echo "amjilttai DB " .$das. "tei holbogdloo";
			var_dump($touch);
		}
	
		/*
		$sql = "CREATE TABLE books (
			author VARCHAR(30) NOT NULL,
			title VARCHAR(30) NOT NULL,
			category VARCHAR(50) NOT NULL,
			YEAR INT(4) NOT NULL,
			ISBN INT NOT NULL
			)";
			*/
		//		$result = mysqli_query($conn,$sql);

		//$sql = "INSERT INTO books (author, title, category, YEAR, ISBN) VALUES ('David.F', 'JavaScript: The Definitive Guide', 'web', '2014','97814')";
		echo "<br>";
		var_dump($result);
		$resl = $result;
		if(!$result) die ("Failed" . mysql_error());
		$rows = mysqli_num_rows($result);
		//heden mur baigaag $rows hiij bn 
		echo "<br><br>";
			
		for($j = 0; $j < $rows; $j++){
			//fetch associative array
			//mysql_result php 7 version deer baihgui bolson
			//fetch_assoc() hiigdeh burdee mor oo nemeed, assoc array aa $row["row_name"] butets ruu oruulj bn
			$row = $result -> fetch_assoc();
				echo "<br>";
				//var_dump($row);
				echo "author: ". $row["author"]. "   <br>  title: ". $row["title"]. "   <br>   category:". $row["category"]. "    <br>  YEAR: ". $row["YEAR"]. "   <br>   ISBN: ". $row["ISBN"]."<br>";
			
		}
		$resl = mysqli_query($conn,$sql);
		//$resl = $result ugj bolku bsan;
		for($j = 0; $j < $rows; $j++){
			
			$row = mysqli_fetch_row($resl);
			echo "author: ". $row[0]. "   <br>  title: ". $row[1]. "   <br>   category:". $row[2]. "    <br>  YEAR: ". $row[3]. "   <br>   ISBN: ". $row[4]."<br>";
			echo "<br>";
			echo "<br>";

		}
		//require_once == import




		if(isset($_POST['delete']) && isset($_POST['ISBN'])){
			$isbn = $_POST['ISBN'];
			$query = "DELETE FROM books WHERE ISBN='$isbn'";
			//ustgah querry ajilluullaad shalgaj baina
			if(!mysqli_query($conn, $query)){
				echo "DELETE failed: $query <br>".mysql_error()."<br><br>";
			}
		}
		
		if(isset($_POST['author']) &&
			isset($_POST['title']) &&
			isset($_POST['category']) &&
			isset($_POST['YEAR']) &&
			isset($_POST['ISBN'])
		){
			$author = $_POST['author'];
			$title = $_POST['title'];
			$category = $_POST['category'];
			$year = $_POST['YEAR'];
			$isbn = $_POST['ISBN'];

			$query = "INSERT INTO books VALUES". "('$author', '$title', '$category', '$year', '$isbn')";
			if(!mysqli_query($conn, $query)){
				echo "INSERT failed: $query<br>".mysqli_error();	
			}
	} 
	echo <<<EOT
	<form action = "dasgaluud3.php" method = "post"> <pre>
		Author <input type = "text" name = "author">
		Title <input type = "text" name = "title">
		Category <input type = "text" name = "category">
		YEAR <input type = "text" name = "YEAR">
		ISBN <input type = "text" name = "ISBN">
			 <input type = "submit" value = "ADD RECORD">
	</pre></form>
EOT;
	$query = "SELECT * FROM books";
	$result = mysqli_query($conn,$query);

	if(!$result) die ("DATAbase Access failed ". mysql_error());
	$rows = mysqli_num_rows($result);
	for($j = 0; $j < $rows ; $j++){
		$row = mysqli_fetch_row($result);
		echo <<< _END
			<pre>
				Author $row[0]
				Title $row[1]
			Category $row[2]
				Year $row[3]
				ISBN $row[4]
			</pre>
			<form action = "dasgaluud3.php" method = "post">
					<input type = "hidden" name = "delete" value = "yes">
					<input type = "hidden" name = "ISBN" value = "$row[4]">
			<input type = "submit" value = "DELETE RECORD">
				</form>

_END;
	}
	/* ajillahgui baisan 
	function get_post($var)
	{
		var_dump(mysqli_real_escape_string($conn,$_POST[$var]));
	  return mysqli_real_escape_string($_POST[$var]);
	}*/
	mysqli_close($conn);


				/* 
		if ($conn->query($result) === TRUE) {
			echo " created successfully";
		} else {
			echo "Error  " . $conn->error();
		}

				mysqli_close($conn);
				
				*/
			
	?>
	<p id="demo"></p>
		<script> 
			var var1 = "<?php echo $row[2]; ?>";
			document.getElementById("demo").innerHTML = var1 + " oruulav";
		</script>

</body>
</html>