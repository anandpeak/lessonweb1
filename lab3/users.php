
<!DOCTYPE html>
<html>
<head>
	<style>
	 	table{
	 		border:1px solid black;
	 		width: 80%;
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
		h3{
			display:inline;
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
    $query = "SELECT * FROM users";

   $sql = mysqli_query($conn,$query);
    
    $rows = mysqli_num_rows($sql);
    echo "<table>";
    for($j = 0; $j < $rows; $j++){
        //fetch associative array 
        //mysql_result php 7 version deer baihgui bolson
        //fetch_assoc() hiigdeh burdee mor oo nemeed, assoc array aa $row["row_name"] butets ruu oruulj bn
        $row = mysqli_fetch_row($sql);
        echo <<<EOT
        <tr>
            <td>ID:			$row[0]</td>
            <td>student id: $row[1]</td>
            <td>staff id: 	$row[3]</td>
            <td>username: 	$row[4]</td>
            <td>password:   $row[5]</td>
            <td>
                <form action = "update.php" method="get">
                    <input type = "hidden" name = "update" value = "yes"> 
                    <input type = "hidden" name = "id" value= "$row[0]">
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