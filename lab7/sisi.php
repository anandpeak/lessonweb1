<?php
    $conn = mysqli_connect('localhost','root','Eff123456','sisi');
    mysqli_set_charset($conn, 'utf8');
    if(!$conn) die("aldaatai");
    $query = "SELECT * from major";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $output=json_encode($fetch);
    if(isset($_POST['majData'])){
        $maj = $_POST['majData'];
        $maj1 = json_decode($maj);
        $obj=$maj1->majVal;
        $queryStudents = "SELECT id from major where majorName = '$obj'";
        $resultStudent = mysqli_query($conn,$queryStudents);
        $resultStudent1 = mysqli_fetch_row($resultStudent);
       
        $queryStudents1 = "SELECT * from student where major = '$resultStudent1[0]'";
        $qq1 = mysqli_query($conn, $queryStudents1);
        $qq2 = mysqli_fetch_all($qq1, MYSQLI_ASSOC);
        $output1 = json_encode($qq2);
        echo $output1; 
        // $qq = "INSERT into del VALUES"."(NULL,'$qq2[1]')";
        // mysqli_query($conn,$qq); 

        // $result1 = mysqli_query($conn,$queryStudents1);
        // $fetchStudents = mysqli_fetch_all($result1,MYSQLI_ASSOC);
        // // $qq1 = "INSERT into del VALUES"."(NULL,'$fetchStudents')";
        // // mysqli_query($conn, $qq1);

        // echo $output1;
    }elseif(isset($_POST['studData1'])){
        // header('Content-type: application/xml');
        $stud = $_POST['studData'];
        $stud1 = json_decode($stud);
        $obj = $stud1->studVal;
        // // $queryStuInfo = "SELECT * from student where firstName = '$obj'";
        // $queryStuInfo = "INSERT into del VALUES"."(NULL,'$obj')";
        // mysqli_query($conn,$queryStuInfo);

        // $resultQuery = mysqli_query($conn,$queryStuInfo);
        // $studAllinfo = mysqli_fetch_row($resultQuery);


        $queryAllMaj = "SELECT * from lesson";
        $resultQuery1 = mysqli_query($conn,$queryAllMaj);
        $resultLesson = mysqli_fetch_all($resultQuery1, MYSQLI_ASSOC);
        $lessonOutput = json_encode($resultLesson);
        echo $lessonOutput;

        // echo 'hell';







        // echo '<?xml verion ="1.0" encoding ="UTF-8">';
        // echo "<major>";

        
        // while($row = mysqli_fetch_row($resultQuery1)){
        //     // $qq1 = "INSERT into del VALUES"."(NULL,'$row[4]')";
        //     //   mysqli_query($conn, $qq1);
        //     echo "<lessonName>" .$row[4].  "</lessonName>";
        //     echo "<lessonIndex>" .$row[2].  "</lessonIndex>";
        // }
        // echo "</major>";


        



        //XML uusgeh

    

    }
    else{
        echo $output;
    }
    
    


?>