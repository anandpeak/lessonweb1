<!DOCTYPE html>
<!-- index.php -->
<html>
  <head>
   <meta charset="UTF-8">
  </head>
  <body>
    <!-- Статик болон динамик агуулгын ялгаа -->
    <p>Энэ бол статик агуулга.</p>
    
    <?php echo "PHP скриптээр, програмын кодоор үүсгэсэн динамик агуулга."; ?>
    <p>Вэб серверийн цаг: 
       <span><?php 
              // Системийн цагийг HTTP гаралтад бичих
              echo "Өнөөдөр бол " . date("Y/m/d");
             ?></span>
    <p>
      <!-- 
        Alias
        http://localhost:8080/sisi

        Redirect
        http://localhost:8080/aanaa

        VirtualHost
        Virtual.mn
        http://phpmyadmin.local:8080


        Freenom.com //domain name avsan
        infinityfree.net //web hosting , maganager geh met //https://cpanel.epizy.com/panel/indexpl.php
        https://www.youtube.com/watch?v=v_jZP4WvZ-w
       -->
  </body>
</html>