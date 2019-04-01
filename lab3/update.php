<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "Eff123456";
    $db = "SISI2";
    $conn = mysqli_connect($servername, $username, $password, $db);	
    if(! $conn ) {
        die('Could not connect: ' . mysql_error());
     }
     if (isset($_GET['firstName']) && 
     isset($_GET['lastName']) &&
     isset($_GET['userName']) &&
     isset($_GET['password']) &&
     isset($_GET['gender']) &&
     isset($_GET['major_id'])
     ){
         $id = $_GET['id'];
        $firstname = $_GET['firstName'];
        $lastname = $_GET['lastName'];
        $username = $_GET['userName'];
        $password = $_GET['password'];
        $gender = $_GET['gender'];
        $major = $_GET['major_id'];
        $query = "UPDATE student SET firstName = '$firstname', lastName = '$lastname', userName = '$username', passWord1='$password', gender='$gender', major_id = '$major' WHERE id = '$id'";
        mysqli_query($conn,$query);
     }

     if(isset($_GET['update']) &&
        isset($_GET['id'])
     ){
         $id = $_GET['id'];
         $query = "SELECT * FROM student WHERE id = '$id'";
         $result = mysqli_query($conn, $query);
         if(!$result) die ("DATAbase Access failed ". mysql_error());
         $row = mysqli_fetch_row($result);

         //Cookies
         setcookie('id',$id,time()+60*60*24*7,"/");
         var_dump($_COOKIE['id']);

         echo <<<EOT
        <form action = "update.php" method = "get">
            <pre>

                Id : <input type = "number" name = "id" value = $row[0]>
                firstname: <input type = "text" name = "firstName" value = $row[1]>
                lastname: <input type = "text" name = "lastName" value = $row[2]>
                username: <input type = "text" name = "userName" value = $row[3]>
                password: <input type = "password" name = "password" value = $row[4]>
                gender : <input type = "text" name = "gender" value = $row[5]>
                major " <input type = "number" name = "major_id" value = $row[6]>
                <a href="list.php"><input type = "submit" value="SAVE"></a>
            </pre>
        </form>
        
EOT;

     }

?>