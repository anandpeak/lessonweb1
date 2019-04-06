<?php
ob_start();
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
    if(isset($_COOKIE['pass'])){
        $id = $_COOKIE['pass'];
    }
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $pass = $row[4];
    echo "<h3>$row[3] Хэрэглэгч таны нууц үг шаардлага хангаагүй тул гаардлага хангахуйц нууц үг оруулна уу</h3>";
    echo "<h4>Таны нууц үгэнд 2 том үсэг 2 жижиг үсэг тусгай тэмдэгт тоо агуулахыг анхаарна уу</h4>";
    echo "<p>$pass</p>";
    echo "<table>";
    echo <<<EOT
    <form action = "pass.php" method = "post">
        <tr>
         <td>passWord</td><td> <input type = "password" name = "passWord1"></td>
        </tr>
        <tr>
         <td>Re-password</td><td> <input type = "password" name = "passWord2"</td>
        </tr>
        <input type = "hidden" name = "row" value = '$row[0]'>
    </table>
    <input type = "submit" value = хадгалах>
    </form>
EOT;
    if(isset($_POST['passWord1']) &&
        isset($_POST['passWord2'])&&
        isset($_POST['row'])
    ){
        var_dump($row[0]);
        $row = $_POST['row'];
        $pass1 = $_POST['passWord1'];
        $pass2 = $_POST['passWord2'];
        if($pass1 == $pass2){
           // echo "bolson";
            //var_dump($pass2);
            if($pass1 != $pass){
                $uppercase = preg_match('@[A-Z]@', $pass1);
                $lowercase = preg_match('@[a-z]@', $pass1);
                $number    = preg_match('@[0-9]@', $pass1);
                $char      = preg_match('@[$,#,&,^,*]@', $pass1);
                if(!$uppercase || !$lowercase || !$number || strlen($pass1) < 6 || !$char) {
                    // tell the user something went wrong
                    setcookie('pass1','таны оруулсан нууц үг хэтэрхий сул байна',time()+10,"/");
                    header("Location: http://localhost:8080/~macuser/web1/lab3/pass.php");
                }
                elseif(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{6}^',$pass1)){
                    $query = "UPDATE users SET userPassword = '$pass1' WHERE id = '$row'";
                    mysqli_query($conn, $query);
                    $query1 = "UPDATE users SET alert = NULL WHERE id = '$row'";
                    mysqli_query($conn, $query1);
                    setcookie('pass','Дээд зэргийн код амжилттай орууллаа.', time()+10, "/");
                    header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
                    //AA$0aaapo
                }
                elseif(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z]).{6}^',$pass1)){
                    $query = "UPDATE users SET userPassword = '$pass1' WHERE id = '$row'";
                    mysqli_query($conn, $query);
                    $query1 = "UPDATE users SET alert = NULL WHERE id = '$row'";
                    mysqli_query($conn, $query1);
                    setcookie('pass','Дунд зэргийн код амжилттай орууллаа.', time()+10, "/");
                    header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");

                }
            }
        }
       
    }
    if(isset($_COOKIE['pass1'])){
        $sul = $_COOKIE['pass1'];
        echo "<h3>$sul</h3>";
    }
    ob_end_flush();

?>
</body>
</html>