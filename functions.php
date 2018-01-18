<?php
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");

function DBtest() {
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

?>