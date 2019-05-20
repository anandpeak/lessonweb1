<?php
    header("Content-type: image/png");
    $string = "abcdefghijklmnopqrstuvwxyz0123456789"; 
    for ($i = 0; $i < 5; $i++) { 
        $pos = rand(0,35); 
        $str .= $string[$pos]; 
    }
    $img_handle = ImageCreate (60, 22) or die ("Amjiltgui"); 
    $back_color = ImageColorAllocate($img_handle,102,102,153); 
    $txt_color = ImageColorAllocate($img_handle,255,255,255); 
    ImageString($img_handle, 31, 5, 0, $str, $txt_color); 
    session_start(); 
    $_SESSION['img_number'] = $str;
    Imagepng($img_handle); 
    
?>