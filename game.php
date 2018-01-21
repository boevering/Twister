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
		if(!isset($_SESSION["stage"])){
			# get the GameID from the URL.
			$gameid = $_GET["gameid"];
			
			# let's see how many players there are in this game
			$queryplayers = 'SELECT `playerid` FROM `game` WHERE `gameid` = "'.$gameid.'" ORDER BY `playerid` DESC LIMIT 1';
			$dbplayers = mysqli_query($dbtwister, $queryplayers);
			$players = mysqli_fetch_array($dbplayers);
			
			# let's put that number into some variables
			$playersmax = $players["playerid"];
			$_SESSION["amountplayers"] = $playersmax;

			# get colors from database for each player
			for($i=1; $i <= $playersmax; $i++){
				$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.'" AND `playerid` ="'.$i.'";';
				$dbusers = mysqli_query($dbtwister, $queryusers);

				#put the colors in a session so we can re-use the numbers without a database
				while ( $d=mysqli_fetch_assoc($dbusers)) {
						$_SESSION["p".$i] = array(ColorPlayer($d["colors"]));
				}
			}
			if($_SESSION["debug"] == "1"){
				print('I looked it up in the database!<br>');
				print_r($d);
			}

			# this is for later, make sure after this the session stage is set correctly
			$_SESSION["stage"] = "5";
		}
		
		if($_SESSION["stage"] == "4"){
			if($_SESSION["debug"] == "1"){
				print("Sesion found!<br>");
				print_r($_SESSION["p1"]);
			}
			# let's go to stage 5
			$_SESSION["stage"] = "5";
		}
		
		if($_SESSION["stage"] == "5"){
			$playersmax = $_SESSION["amountplayers"];
			
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
				print('<div style ="background-color:'.${'colorplayer'.$i}.'">player'.$i.'</div><br>');
			}
			
			print(limb());
		}
		
		
		?>
	</body>
</html>