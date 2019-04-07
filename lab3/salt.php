<?php
    $a = 'Q1$aaaaaa';
    $b = 'aa';
    $tok1= hash('ripemd128', "$b$a");
    var_dump($tok,$tok1);

    //b1020 asdf
    //admin aanaa
    //gggg Q1$aaaaaa
    //qwe4 123
    //Avirmed EEfff123456$
    //nono EEfff123456$
    //mydag EEfff123456$11
?>