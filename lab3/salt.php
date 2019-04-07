<?php
    $a = 'QQQQ$1a';
    $b = 'aa';
    $tok = hash('ripemd128',"$b$a");
    $tok1= hash('ripemd128', "$a$b");
    var_dump($tok,$tok1);

?>