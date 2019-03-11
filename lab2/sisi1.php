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
	//student1 = buh oyutnii medeelel hadgalah oyutnii undsen objectuud bagtana
	//student2 = oyutan dundaas ymar negen oiroltsoo utgaar haihad hargalzah oyutnii neriig medeelluudtei gargaj irj, neriig ni butsaana
	//lessons1 = buh undsen hicheeluudiig hadgalsan bolno
	//lesson3 =  daalgavar 3iig guitsetgehed hicheeluudiin index hadgalsan array bolno
	/*
		Lesson turliin ugugduliin butets ni hicheeliin kredit bolon, index, tuhain hicheeliin neriig aguuldag
		Student turliin ugugduliin butets ni uuriin ner, major, ovog, sisiId bolon tuhain oyutnii uzsen hicheeliig bagtaah husnegten huvisagchtai ene ni oyutan anh orj irhed dotor ni hicheel uzeegui bh bogood student turliin object ni hicheel nemeh addlessons() function tai.




	*/
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
			public function addlesson($index){
				global $lessons1;
				$n = count($lessons1);
				for($i = 0; $i<$n ; $i++){
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
		$student1[0] -> addlesson("cs202");
		$student1[0] -> addlesson("cs204");
		$student1[0] -> addlesson("cs200");
		$student1[0] -> addlesson("cs306");

		$student1[1] = new student("tsatsral","munkbat","b0637","software");
		$student1[1] -> addlesson("cs205");
		$student1[1] -> addlesson("cs101");
		$student1[1] -> addlesson("cs204");
		$student1[1] -> addlesson("cs301");
		//var_dump($student1);
		$les = $student1[0]->getlessons(0);
		echo "<p>". $les ."</p>";
		//$q1 = 2112;
		//$q = "cs" + "$q1";
		//echo "$q";

	//lab4


		
		//tuhain oyutnii neriig haihad medeelel ni garj irne
		//$student2 = array();
		function findName($findName, $student1){

			$n = count($student1);
			var_dump($n);
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
			//$i heden shirheg oyutan baigaag haruulna
			for($i=0; $i<$n; $i++){
				$c = strlen($student1[$i]->getfirstName());
				$j=0;
				$p=0;
				$sName = $student1[$i]->getfirstName();
				//$j haij baigaa oyutnii neriig tulgaj baigaa huvisagch
				//$p tuhain oyutnii nernii guuj baigaa huvisagch
				while($p < $c){
					//var_dump($sName[$p]);
					if($findName[$j] == $sName[$p]){
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

		//daalgavar 2
		echo"<h2> Daalgavar 2 </h2>";
		echo "<h2>oyutnii nereer haisnii daraa medeelel gargah baidal</h2>";
		$student2 = findName("a",$student1);
		echo "<br>";
		var_dump($student2[1]);
		
		echo "<br>";
		$numles = 0;

		

		$sisiId1 = "b1020";
		$lesson3 = array("cs301", "cs303");

		function addlesson($sisiId1, $lesson3){
			global $student1;
			global $lessons1;
			$n = count($lesson3);
			for($i = 0; $student1[$i-1] != end($student1); $i++){
				if($student1[$i]->getsisiId() == $sisiId1){
					for($j=0; $j<$n;$j++){
						//print_r($lesson3[0]);
						$student1[$i]->addlesson($lesson3[$j]);
					}
				}
			}
		} 
		addlesson($sisiId1,$lesson3);
		echo "<h2>Daalgavar 3</h2>";
		echo "<h2>Hicheel nemegdesnii daraa</h2>";
		findName("a",$student1); 					//Nemegdsen hicheeliig haruulahdaa omnoh function aa ashiglasan 
		function sort_print($student1){
			global $student1;
			echo "<br>";
			echo "<h2>Dooroos sortloson ni </h2>";
			rsort($student1);
			$x = count($student1);
			echo"<table>";
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
			for($i = 0; $i < $x; $i++){
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
			}
			echo "</table>";

		}
				echo "<h2> daalgavar 4 </h2>";
		sort_print($student1);
		//print_r($student1);

		//lab 5

		echo "<h2> daalgavar5 file-d write, read hiisen baidal</h2>";
		function write_read(){
			global $student1, $student2;
			$myfile = fopen("lab2a.txt", "w");
			fwrite($myfile, print_r($student1,TRUE));
			$read1 = file_get_contents("lab2a.txt");
			print_r($read1);
			fclose($myfile);
		}
		write_read();

/*
		function addlesson(){
			global $numles;
			echo "heden hicheel songoh oruulah";
			echo "<input type=\"number\" id=\"myNumber\" value = \"1\">";
			echo "<button onclick = \"myFunction()\">oruulah</button>";
			echo "<script>
					function myFunction() {
					 numl = document.getElementById(\"myNumber\").value;
					 return numl;
					}
					</script>";
		}
		addlesson();
		var_dump($numles);*/
		


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