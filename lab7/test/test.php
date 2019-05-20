<?php 
	$conn= mysqli_connect('localhost','root','','sisi');
	mysqli_set_charset($conn, 'utf8');
	if(!$conn) die("aldaatai");
	$query="SELECT * from students";
	$result=mysqli_query($conn,$query);
	$fetched = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$output=json_encode($fetched);
	echo $output;
	

?>