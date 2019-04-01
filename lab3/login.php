
<!DOCTYPE html>
<html>
<head>
	<style>
	 	#cent{
            text-align:center;
            width:400px;
            position: absolute;
            border:5px solid black;
            background-color:yellow;
            left: 50%;
            top: 40%;
            position: absolute;
            -webkit-transform: translate3d(-50%, -50%, 0);
            -moz-transform: translate3d(-50%, -50%, 0);
            transform: translate3d(-50%, -50%, 0);
            
         }
         .image{
            display:table;
            background-repeat: no-repeat;
            background-image: url(num.png);
            height:900px;
            width:100%;
            position: relative;
            background-position: center;
            background-size: cover;



         }
	</style>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
<?php
echo <<<EOT
    <div class = "image">
	<div id="cent">
         <p> netreh huudas  </p>
        <form action = "index.php" method = "post">
EOT;
        if(isset($_COOKIE['username'])){
            $user = $_COOKIE['username'];
           echo "Username <input type='text' name = 'login_name' value = $user></br>";
        }else{
           echo "Username <input type='text' name = 'login_name' ></br>";
        }
        echo<<<EOT
            Password <input type="password" name = "login_password" ></br>
            Do u wanna save ? <input type = "checkbox" name = "checkbox" value = "1"></br>
            <a href="insert.php"><p>Sign up</p></a></br>
        <input type = "submit" value ="Sign in">
        </form>
    </div>
    </div>

EOT;
?>
</body>
</html>