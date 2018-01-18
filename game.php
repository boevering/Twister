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
		#SELECT `playerid` FROM `game` WHERE `gameid` = "26d1cab1aa1e48489b971d4b558f3fe3ecd363eb" ORDER BY `playerid` DESC LIMIT 1';
		
			$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.' AND `playerid` ='.$i.'";';
			$db = mysqli_query($dbtwister, $queryusers);

			while ( $d=mysqli_fetch_assoc($db)) {
						print_r($d);
					}

		
		print_r(ColorPlayer($test, 1));
		
	
			
			

		?>
	</body>
</html>