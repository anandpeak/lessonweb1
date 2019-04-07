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
       if(isset($_POST['tiim'])){
        $b = $_POST['tiim'];
        if($b == 1){

            echo "<p>Zowshoorow</p>";
           
            $password = $_COOKIE['pass2'];
            $userName = $_COOKIE['pass3'];
            $position = $_COOKIE['pass4'];
            $firstName = $_COOKIE['pass5'];
            $lastName = $_COOKIE['pass6'];
            $major = $_COOKIE['pass7'];
            if($major == NULL){
            $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$position','$userName','$password')";
                if(!mysqli_query($conn, $query)){
                echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                        echo "INSERT failed: $query<br>".mysqli_error();	
                    }
                }
                else{
                    $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$position','$major')";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	    
                        }
                        $last_id = $conn->insert_id;
                        $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                }
            setcookie('pass','амжилттай муу код хадгалагдлаа',time()+5,"/");
            header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");

        }
        else{
            header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
        }
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
                <input type = "hidden" name = "pass">
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
                <input type = "hidden" name = "pass">
           </form>
           </table> 
EOT;
        }
    }
    elseif(isset($_POST['pass'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $password = $_POST['passWord1'];
        $gender = $_POST['gender'];
        $major = $_POST['major_id'];
        $position = $_POST['pos'];

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $char      = preg_match('@[$,#,&,^,*]@', $password);

        $query = "SELECT * FROM users WHERE userName = '$userName'";
        $res = mysqli_query($conn, $query);

        if(!mysqli_fetch_row($res)){
            if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || !$char) {
                // tell the user something went wrong
                header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
            }
            else{
                if(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                    if($position != NULL){

                        $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$position','$userName','$password')";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        $last_id = $conn->insert_id;
                        $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        setcookie('pass','Дээд зэргийн код амжилттай орууллаа.', time()+10, "/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
                    }
                    else{
                        $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        $last_id = $conn->insert_id;
                        $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        setcookie('pass','Дээд зэргийн код амжилттай орууллаа.', time()+10, "/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
                    }
                }
                elseif(preg_match('^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{6}^',$password)){
                    if($position != NULL){
                        $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$position','$userName','$password')";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        $last_id = $conn->insert_id;
                        $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        setcookie('pass','Дунд зэргийн код амжилттай орууллаа.', time()+10, "/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
                    }
                    else{
                        $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        $last_id = $conn->insert_id;
                        $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
                        if(!mysqli_query($conn, $query)){
                            echo "INSERT failed: $query<br>".mysqli_error();	
                        }
                        setcookie('pass','Дунд зэргийн код амжилттай орууллаа.', time()+10, "/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
                    }
                }
                else{
                    if($position != NULL){
                        setcookie('pass1','Таны оруулсан нууц үг сул байна. Нууц үг 2том үсэг 3н жижиг үсэг оруулсан байвал дараагын зэрэглэлд орохыг анхаарна уу', time()+1,"/");
                        setcookie('pass2',$password,time()+20,"/");
                        setcookie('pass3',$userName,time()+20, "/");
                        setcookie('pass4',$position,time()+20,"/");
                        setcookie('pass5',$firstName, time()+20, "/");
                        setcookie('pass6',$lastName, time()+20, "/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
                    }
                    else{
                        setcookie('pass1','Таны оруулсан нууц үг сул байна. Нууц үг 2том үсэг 3н жижиг үсэг оруулсан байвал дараагын зэрэглэлд орохыг анхаарна уу', time()+100,"/");
                        setcookie('pass2',$password,time()+20,"/");
                        setcookie('pass3',$userName,time()+20, "/");
                        setcookie('pass4',$gender,time()+20,"/");
                        setcookie('pass5',$firstName, time()+20, "/");
                        setcookie('pass6',$lastName, time()+20, "/");
                        setcookie('pass7',$major,time()+20,"/");
                        header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
                    }
                }
            }
        }
        else{
            //ner davhardsan tohioldold
            setcookie('pass', 'Нэр давхардсан байна дахин оролдоно уу', time()+5,"/");
            header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
        }

    }
    elseif(isset($_COOKIE['pass1'])){
        $pass1 = $_COOKIE['pass1'];
        $pass2 = $_COOKIE['pass2'];
        echo "$pass1";
        echo "$pass2";
        echo <<<EOT
        <br>
                <table>
                        <form action = "insert.php" method = "post">
                            <input type = "hidden" name ="tiim" value = '1'>
                            <input type = "submit" value = "Tiim"> 
                        </form>
                        <form action = "insert.php" method = "post">
                            <input type = "hidden" name ="ugui" value = '2'>
                            <input type = "submit" value = "Ugui"> 
                        </form>
                </table>
EOT;
    }
    
    else{
      
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
    ob_end_flush();












 /*      


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
        
        if(isset($_POST['tiim'])){
            if($_POST['tiim'] == '1'){
                if(isset($_COOKIE['firstname'])&&
                    isset($_COOKIE['lastname'])&&
                    isset($_COOKIE['password'])
                ){
                    setcookie('firstname',$firstName, time()+20, "/");
                    setcookie('lastname',$lastName, time()+20, "/");
                    setcookie('position',$pos, time()+20, "/");
                    setcookie('username',$userName, time()+20, "/");
                    setcookie('password',$password, time()+20, "/");

                    $firstName = $_COOKIE['firstname'];
                    $lastName = $_COOKIE['lastname'];
                    $pos = $_COOKIE['poisition'];
                    $userName = $_COOKIE['username'];
                    $password = $_COOKIE['password'];
                  }
                $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$pos','$userName','$password')";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                setcookie('pass','Муу зэргийн код амжилттай орууллаа.' , time()+10, "/");
                header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
            }
        }
        if(isset($_POST['ugui'])){
            header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
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
        //nuhtsuluud shalgah
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $char      = preg_match('@[$,#,&,^,*]@', $password);


        $query1 = "SELECT * FROM user WHERE userName = '$userName'";
        $res = mysqli_query($conn, $query1);
        if(!mysqli_fetch_row($res)){

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || !$char) {
            // tell the user something went wrong
            header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
        }
        else{
            if(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                setcookie('pass','Дээд зэргийн код амжилттай орууллаа.', time()+10, "/");
                 header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
            }
            if(preg_match('^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                setcookie('pass','Дунд зэргийн код амжилттай орууллаа.', time()+10, "/");
                header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
            }
            else{
                echo "sul bn ";
            }
        }   
    }
    else{
        echo "Tanii oruulsan pass buruu bn <br> Hamgiin bagdaa 1tom useg 1 jijig useg too tusgai temdegt baina";
    }
        //uildel duussanii daraa login page ruu butsah uuniig zaaval neeh
        //header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");

        $query = "INSERT INTO student VALUES"."(NULL,'$firstName','$lastName','$userName','$password','$gender','$major')";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
        $last_id = $conn->insert_id;
        $query = "INSERT INTO users VALUES"."(NULL, '$last_id',NULL,'$userName','$password',NULL)";
        if(!mysqli_query($conn, $query)){
            echo "INSERT failed: $query<br>".mysqli_error();	
        }
    }elseif(isset($_POST['firstName'])&&
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

        $query1 = "SELECT * FROM user WHERE userName = '$userName'";
        $res = mysqli_query($conn, $query1);
        //omno username burtgeltei bnuu ugui u shalgaj bn 
        if(!mysqli_fetch_row($res)){

        if(!$uppercase || !$lowercase || !$number || strlen($password) < 6 || !$char) {
            // tell the user something went wrong
            header("Location: http://localhost:8080/~macuser/web1/lab3/insert.php");
        }
        else{
            if(preg_match('^(?=.*[A-Z].*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$pos','$userName','$password')";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                setcookie('pass','Дээд зэргийн код амжилттай орууллаа.', time()+10, "/");
                 header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
            }
            if(preg_match('^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z].*[a-z].*[a-z]).{8}^',$password)){
                $query = "INSERT INTO staff VALUES"."(NULL,'$firstName','$lastName','$pos','$userName','$password')";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                $last_id = $conn->insert_id;
                $query = "INSERT INTO users VALUES"."(NULL, NULL,'$last_id','$userName','$password',NULL)";
                if(!mysqli_query($conn, $query)){
                    echo "INSERT failed: $query<br>".mysqli_error();	
                }
                setcookie('pass','Дунд зэргийн код амжилттай орууллаа.', time()+10, "/");
                header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
            }
            else{
                echo "<p>Таны оруулсан нууц үг сул байна. Хадгалах уу</p>";
                setcookie('firstname',$firstName, time()+20, "/");
                setcookie('lastname',$lastName, time()+20, "/");
                setcookie('position',$pos, time()+20, "/");
                setcookie('username',$userName, time()+20, "/");
                setcookie('password',$password, time()+20, "/");
                echo <<<EOT
                    <form action = "insert.php" method = "post">
                        <input type = "hidden" name ="tiim" value = '1'>
                        <input type = "submit" value = "Tiim"> 
                    </form>
                    <form action = "insert.php" method = "post">
                        <input type = "hidden" name ="ugui" value = '1'>
                        <input type = "submit" value = "Ugui"> 
                    </form>
EOT;
            }
        }   
    }
    else{
        echo "<h5>Burtgel davhardsan baina</h5>";
    }
        
        //uildel duussanii daraa login page ruu butsah uuniig zaaval neeh
        //header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
    }




 */

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