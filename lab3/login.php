
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
            background-image: url("https://scontent.fuln6-1.fna.fbcdn.net/v/t1.0-9/12391829_971768356204046_291233703035688686_n.png?_nc_cat=108&_nc_eui2=AeEz0lR5zK5I29c7aRQ0Ji_O58KQiH9lp6NQSO9EJipZIr6J0vcOgQqnl1CqJ1-QZkgcvawUsk7I9NRprVkEfGcuKkbSF-jqryZ05lQrJfWYBQ&_nc_ht=scontent.fuln6-1.fna&oh=3492de21e48eb2ad79fe45bcc3c02b53&oe=5D16E9FB");
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
    <div class = "image">
	<div id="cent">
         <p> netreh huudas  </p>
        <form action = "index.php" method = "post">
            Username<input type="text" name = "login_name" ></br>
            Password <input type="password" name = "login_password" ></br>
           <input type = "submit" value ="Sign in">
        </form>
    </div>
    </div>
</body>
</html>