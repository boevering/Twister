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
		print('<div style ="height: 250px; width: 200px; background-color:'.${'colorplayer'.$i}.';">Player: '.$i.'<br><img style="height: 85%; width: 90%;" src="img/'.rand(0,3).'.png" /></div><br>');
	}
	
}

?>
