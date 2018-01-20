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
		$queryplayers = 'SELECT `playerid` FROM `game` WHERE `gameid` = "'.$gameid.'" ORDER BY `playerid` DESC LIMIT 1';
		$dbplayers = mysqli_query($dbtwister, $queryplayers);
		$players = mysqli_fetch_array($dbplayers);
		$playersmax = $players["playerid"];
		
		
		for($i=1; $i <= $playersmax; $i++){
			$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.'" AND `playerid` ="'.$i.'";';
			$dbusers = mysqli_query($dbtwister, $queryusers);

			while ( $d=mysqli_fetch_assoc($dbusers)) {

					$colors_player[$i] = array(ColorPlayer($d["colors"], 1));
			}
		}
		print_r($colors_player[[1]]);
		
	
			
			

		?>
	</body>
</html>