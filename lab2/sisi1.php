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
</head>
<body>
	<?php
	//composition burdel haritsaa

		class lesson{
			public $kredit;
			public $index;
			public $lessonName;

			public function __construct($lessonName, $index){
				$this->lessonName = $lessonName;
				$this->index = $index;
				$this->kredit = 3;
			}
			public function getlessonName(){
				return $this->lessonName;
			}
			public function index(){
				return $this->index;
			}
			public function kredit(){
				return $this->kredit;
			}
			public function setKredit($kredit){
				$this->kredit = $kredit;
			}
		}




		class student{
			public $firstName;
			public $lastName;
			public $sisiId;
			public $major;
			public $lessons = array();

			public function __construct($firstName, $lastName, $sisiId, $major){
				$this->firstName = $firstName;
				$this->lastName = $lastName;
				$this->sisiId = $sisiId;
				$this->major = $major;
			}
			public function setfirstName($firstName){
				$this->firstName = $firstName;
			}
			public function setlastName($lastName){
				$this->lastName = $lastName;
			}
			public function setsisiID($sisiId){
				$this->sisiId = $sisiId;
			}
			public function setMajor($major){
				$this->major = $major;
			}
			public function addlesson($index, $lessons1, $n){
				for($i = 0; $i<=$n ; $i++){
					//var_dump($lessons1[$i]->index());
					if($index == $lessons1[$i]->index()){
						$this->lessons[] = $lessons1[$i];
						//var_dump($lessons1[$i]->index());
					}
				}
			}
			public function getfirstName(){
				return $this->firstName;
			}
			public function getlastName(){
				return $this->lastName;
			}
			public function getsisiId(){
				return $this->sisiId;
			}
			public function getMajor(){
				return $this->major;
			}
			public function getlessons($p){
				return $this->lessons[$p]->lessonName;
			}
		}
		$lessons1[] = new lesson("web","cs200");	
		$lessons1[] = new lesson("c","cs101");
		$lessons1[] = new lesson("obejct","cs202");
		$lessons1[] = new lesson("java","cs203");
		$lessons1[] = new lesson("tusul","cs303");
		$lessons1[] = new lesson("data-structure","cs301");
		$lessons1[] = new lesson("OSystem","cs204");
		$lessons1[] = new lesson("assembler","cs205");
		$lessons1[] = new lesson("graphic", "cs306");

		$student1[0] = new student("anand","altanhkhuyag","b1020","computer-science");
		$student1[0] -> addlesson("cs202",$lessons1,8);
		$student1[0] -> addlesson("cs204",$lessons1,8);
		$student1[0] -> addlesson("cs200",$lessons1,8);
		$student1[0] -> addlesson("cs306",$lessons1,8);

		$student1[1] = new student("tsatsral","munkbat","b0637","software");
		$student1[1] -> addlesson("cs205",$lessons1,8);
		$student1[1] -> addlesson("cs101",$lessons1,8);
		$student1[1] -> addlesson("cs204",$lessons1,8);
		$student1[1] -> addlesson("cs301",$lessons1,8);
		//var_dump($student1);
		$les = $student1[0]->getlessons(0);
		echo "<p>". $les ."</p>";
		//$q1 = 2112;
		//$q = "cs" + "$q1";
		//echo "$q";

		

		$student2 = array();
		function findName($findName, $student1,$n,$student2){
			echo "<table>";
			echo "<tr>";
				echo "<td>";
					echo "<p>" ."firstName". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."lastName". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."sisiId". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."major". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."Lessons". "</p>";
				echo "</td>";
			echo "</tr>";
			$b = strlen($findName);
			for($i=0; $i<2; $i++){
				$c = strlen($student1[$i]->getfirstName());
				$j=0;
				$p=0;
				$sName = $student1[$i]->getfirstName();
				while($p < $c){
					if($findName[$j] == $sName[$p]){
						//var_dump($sName[$p]);
						$j++;
						$p++;
					}
					elseif($b == $j){
						$student2[] = $sName;
						$num++;
						echo "<tr>";
							echo "<td>";
								echo "<p>". $student1[$i]->getfirstName() . "</p>";
							echo "</td>";
							echo "<td>";
								echo "<p>". $student1[$i]->getlastName() . "</p>";
							echo "</td>";
							echo "<td>";
								echo "<p>". $student1[$i]->getsisiId() . "</p>";
							echo "</td>";
							echo "<td>";
								echo "<p>". $student1[$i]->getMajor() . "</p>";
							echo "</td>";
							echo "<td>";
								$kr = 0;
								while($student1[$i]->getlessons($kr)){
									echo "<p>". $student1[$i]->getlessons($kr) . "</p>";
									$kr++;
								}
							echo "</td>";
						echo "</tr>";
						//var_dump($student2);
						break;

					}
					elseif($p < $c && $find[$j] != $sName[$p]){
						$j = 0;
						$p++;
					}
				}
			}
			echo "</table>";
			return $student2;
		}

		$student2 = findName("a",$student1,2,$student2);
		var_dump($student2[1]);
		$endStudent;

		/*
		echo "<table>";
			echo "<tr>";
				echo "<td>";
					echo "<p>" ."firstName". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."lastName". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."sisiId". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."major". "</p>";
				echo "</td>";
				echo "<td>";
					echo "<p>" ."Lessons". "</p>";
				echo "</td>";
			echo "</tr>";
		for($i = 0; $student2[$i] != end($student2) ; $i++){ 					// student2 array dotor baigaa elementuudiig hamgiin suuliin element hurtel davtaj, tuhain songogdoj avsan elementee student1 tei jishene
			for($j = 0; $student1[$j] != end($student1); $j++){
				if($student2[$i] == $student1[$j]->getfirstName()){
					echo "<tr>";
						echo "<td>";
							echo "<p>". $student1[$j]->getfirstName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getlastName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getsisiId() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getMajor() . "</p>";
						echo "</td>";
						echo "<td>";
							$kr = 0;
							while($student1[$j]->getlessons($kr)){
								echo "<p>". $student1[$j]->getlessons($kr) . "</p>";
								$kr++;
							}
						echo "</td>";
					echo "</tr>";
				}
			}
			if($student2[$i] == $student1[$j]->getfirstName()){
				echo "<tr>";
						echo "<td>";
							echo "<p>". $student1[$j]->getfirstName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getlastName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getsisiId() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getMajor() . "</p>";
						echo "</td>";
						echo "<td>";
							$kr = 0;
							while($student1[$j]->getlessons($kr)){
								echo "<p>". $student1[$j]->getlessons($kr) . "</p>";
								$kr++;
							}
						echo "</td>";
					echo "</tr>";
			}
		}
		for($j = 0; $student1[$j] != end($student1); $j++){
				if($student2[$i] == $student1[$j]->getfirstName()){
					echo "<tr>";
						echo "<td>";
							echo "<p>". $student1[$j]->getfirstName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getlastName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getsisiId() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getMajor() . "</p>";
						echo "</td>";
						echo "<td>";
							$kr = 0;
							while($student1[$j]->getlessons($kr)){
								echo "<p>". $student1[$j]->getlessons($kr) . "</p>";
								$kr++;
							}
						echo "</td>";
					echo "</tr>";
				}
			}
			if($student2[$i] == $student1[$j]->getfirstName()){
				echo "<tr>";
						echo "<td>";
							echo "<p>". $student1[$j]->getfirstName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getlastName() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getsisiId() . "</p>";
						echo "</td>";
						echo "<td>";
							echo "<p>". $student1[$j]->getMajor() . "</p>";
						echo "</td>";
						echo "<td>";
							$kr = 0;
							while($student1[$j]->getlessons($kr)){
								echo "<p>". $student1[$j]->getlessons($kr) . "</p>";
								$kr++;
							}
						echo "</td>";
					echo "</tr>";
			}

		*/

	?>
</body>
</html>