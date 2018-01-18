<?php 
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");
# Lets use a seperate file for functions
require_once("functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Twister</title>
	</head>
	<body>
		<?php
		$gameid = $_GET["gameid"];
		
		$test = "21, 136, 152, 126";
		
		
		print_r(ColorPlayer($test, 1));
		
	
			
			

		?>
	</body>
</html>