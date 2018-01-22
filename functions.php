<?php

function DBtest($dbtwister) {
		if (!$dbtwister) {
			print_r($dbtwister);
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
		echo "Host information: " . mysqli_get_host_info($dbtwister) . PHP_EOL;

		mysqli_close($dbtwister);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function refreshTime($gameid, $chosen){
	print('klaas '. $chosen.'<br>');
	print('<form action="game.php?gameid='.$gameid.'" method="POST">');
	/*print('<select onchange="this.form.submit()" name="refeshtimer" required>');
	print('<option value="15">15 sec.</option>');
	print('<option value="20">20 sec.</option>');
	print('<option selected value="25">25 sec.</option>');
	print('<option value="30">30 sec.</option>');
	print('<option value="35">35 sec.</option>'); */

	
	for($i = 5; $i <= 35; $i = $i + 50){
		if($i == $chosen){
			print('<option selected value="'.$i.'">'.$i.' sec.</option>');
		}
		else{
			print('<option value="'.$i.'">'.$i.' sec.</option>');
		}
	}
	print("</select>");
	print("</form>");
}

function ColorPlayer($colors){
	$colors_array = (explode(",", $colors));
	array_pop($colors_array);
	return($colors_array);
}

function limb($playersmax){
	# Give back a number for the limb,
	# 0 = left hand
	# 1 = right hand
	# 2 = left foot
	# 3 = right foot
	
	# extract colors from database array and put them in a color{#player} and pick random color in $colorplayer{#player} variable
	for($i=1; $i <= $playersmax; $i++){
		$x = $_SESSION["p".$i];
		${'color' . $i} = $x[0];
		${'colorplayer' . $i} = ${'color' . $i}[array_rand(${'color' . $i})]; 

		if($_SESSION["debug"] == "1"){
			print_r($x);
			print("<br>");
			print_r(${'colorplayer' . $i});
		}
				
	}
		
	#Print html to show the colors	
	for($i=1; $i <= $playersmax; $i++){
		print('<div style ="height: 250px; width: 200px; background-color:'.${'colorplayer'.$i}.';">Player: '.$i.'<br><img style="display: block; margin-left auto; margin-right: auto; height: 85%; width: 90%;" src="img/'.rand(0,3).'.png" /></div><br>');
	}
	
}

?>
