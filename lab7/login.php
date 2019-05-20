<?php
session_start(); 
$conn = mysqli_connect('localhost','root','Eff123456','sisi');
mysqli_set_charset($conn, 'utf8');
if(!$conn) die("aldaatai");
    if(isset($_GET['userId'])){
        $user = $_GET['userId'];
        $user1 = json_decode($user);
        $obj = $user1->usName;
        $query = "SELECT * from users where studUser = '$obj'";
        $result = mysqli_query($conn,$query);
        if(mysqli_fetch_row($result)){
            echo 1;
        }else{
            echo 0;
        }
    }
    if(isset($_POST['capt'])){
        $captVal = $_POST['capt'];
        // echo $captVal;
        $sessVal = $_SESSION['img_number'];
        // echo $sessVal;
        if($sessVal == $captVal){
            header("Location:http://localhost:8081/~macuser/web1/lab7/sisi.html");
        }else{
            header("Location:http://localhost:8081/~macuser/web1/lab7/login.html");
        }
    }
?>