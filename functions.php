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

function limb(){
	#ledemaat kiezen
	#$limb = array('left leg', 'right leg', 'left arm', 'right arm');
	#return array_rand($limb, 1);
	return(rand(0,3));
}

?>
