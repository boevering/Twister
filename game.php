<?php 
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");
# Lets use a seperate file for functions
require_once("functions.php");

session_start();
$sessiecounter = 0;

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Twister</title>
	</head>
	<body>
		<?php
		if($_SESSION["stage"] != "4"){
			$gameid = $_GET["gameid"];
			$queryplayers = 'SELECT `playerid` FROM `game` WHERE `gameid` = "'.$gameid.'" ORDER BY `playerid` DESC LIMIT 1';
			$dbplayers = mysqli_query($dbtwister, $queryplayers);
			$players = mysqli_fetch_array($dbplayers);
			$playersmax = $players["playerid"];

			# get colors from database for each player
			for($i=1; $i <= $playersmax; $i++){
				$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.'" AND `playerid` ="'.$i.'";';
				$dbusers = mysqli_query($dbtwister, $queryusers);

				while ( $d=mysqli_fetch_assoc($dbusers)) {
						$_SESSION["p".$i] = array(ColorPlayer($d["colors"]));
				}
			}
			print('I looked it up in the database!<br>');
			print_r($_SESSION["p1"]."<br>");
			# this is for later, make sure after this the session stage is set correctly
			#$_SESSION["stage"] = "4";
		}
		
		if($_SESSION["stage"] == "4"){
			print("Sesion found!<br>");
		}
		
		# extract colors from database array and put them in a color{#player} and pick random color in $colorplayer{#player} variable
		for($i=1; $i <= $playersmax; $i++){
			$x = $colors_player[$i];
			${'color' . $i} = $x[0];
			${'colorplayer' . $i} = ${'color' . $i}[array_rand(${'color' . $i})]; 
			$_SESSION[$i] = ${'color'.$i};
		}

		#Print html to show the colors	
		for($i=1; $i <= $playersmax; $i++){
			print('<div style ="background-color:'.${'colorplayer'.$i}.'">player'.$i.'</div><br>');
		}
		print(limb());

		
		
		?>
	</body>
</html>