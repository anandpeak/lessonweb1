<?php
	$postdata = file_get_contents("php://input");
	$arr = json_decode($postdata);
	
	var_dump($arr);
	

	
?>