

<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "Eff123456";
    $db = "SISI2";
    $conn = mysqli_connect($servername, $username, $password, $db);	
    if(isset($_COOKIE['pass'])){
        $id = $_COOKIE['pass'];
    }
    echo "<p>$id</p>";



?>