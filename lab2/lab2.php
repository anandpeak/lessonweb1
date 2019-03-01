
<!DOCTYPE html>
<html>
<head>
	<style>
	 	table{
	 		border:1px solid black;
	 		width: 100%;
	 	}
	 	tr, td{
	 		border:1px solid black;
	 	}
	</style>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		echo "Lab2 davtaltaar husnegt uusgeh";
		echo "<table>";
		$s = 0;
			for($i=0; $i<5; $i++){
				echo "<tr>";
					for($j=0; $j<4; $j++){
						echo "<td>";
							echo "<p>". $s ."</p>";
							$s++; 
						echo "</td>";
					}
				echo "</tr>";
					
			}
		echo "</table>";
	?>

</body>
</html>