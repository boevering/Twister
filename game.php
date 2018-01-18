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
		
		$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.'";';
		$db = mysqli_query($dbtwister, $queryusers);
		print("klaas");
		print($queryusers);
		while ( $d=mysqli_fetch_assoc($db)) {
  					print_r($d);
				}
		
		
		print_r(ColorPlayer($test, 1));
		
	
			
			

		?>
	</body>
</html>