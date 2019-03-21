<?php 
    $servername = "localhost:3306";
    $username = "root";
    $password = "Eff123456";
    $db = "SISI2";
    

    try{
    $pdo = new PDO('mysql:host=localhost; dbname = SISI2; port=3306', $username, $password);
    $pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    echo "amjilttai";

    }catch(PDOException $e){
        echo "aldaatai:" . $e->getMessage();
    }
    // if(!$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ)){
    //   echo"aldaa";
    //} 
    $stmt = $pdo->prepare('SELECT * FROM SISI2.student');
    $stmt->execute();
    while($row = $stmt->fetch()){
        echo $row->firstName.'<br>';
    }

    $author = "anand";

    $sql = "SELECT * FROM SISI2.student where firstName = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$author]);
    $posts = $stmt->fetchAll();
    echo "<br>";
    foreach($posts as $post){
        echo $post->firstName . "<br>";
    }

    echo "<br>";
    $sql = 'SELECT * from SISI2.student where firstName = :firstName';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['firstName' => $author]);
    $posts = $stmt->fetchAll();
    foreach($posts as $post){
        echo $post->firstName . "<br>";
    }

?>