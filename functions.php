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
	# Give back a number for the limb,
	# 0 = left hand
	# 1 = right hand
	# 2 = left foot
	# 3 = right foot
	return(rand(0,3));
}

?>
