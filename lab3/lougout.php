<?php
    setcookie('username',"",time()-(7*60*60*24),"/");
    header("Location: http://localhost:8080/~macuser/web1/lab3/login.php");
?>