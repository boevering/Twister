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
		print($_POST[1]);
		print('kaas');
		
		if((isset($_POST))==1){
			$gameid = $_GET["gameid"];
			$queryplayers = 'SELECT `playerid` FROM `game` WHERE `gameid` = "'.$gameid.'" ORDER BY `playerid` DESC LIMIT 1';
			$dbplayers = mysqli_query($dbtwister, $queryplayers);
			$players = mysqli_fetch_array($dbplayers);
			$playersmax = $players["playerid"];

			#get colors from database for each player
			for($i=1; $i <= $playersmax; $i++){
				$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameid.'" AND `playerid` ="'.$i.'";';
				$dbusers = mysqli_query($dbtwister, $queryusers);

				while ( $d=mysqli_fetch_assoc($dbusers)) {

						$colors_player[$i] = array(ColorPlayer($d["colors"], 1));
				}
			}
		
		}
		if(isset($_POST)){
			foreach($_POST as $player => $colors){
				${'color'.$player} = $colors;
				print_r(${'color'.$player});
			}
		}
		
		#extract colors from database array and put them in a color{#player} array and pick random color in $colorplayer{#player} variable
		for($i=1; $i <= $playersmax; $i++){
			$x = $colors_player[$i];
			${'color' . $i} = $x[0];
			${'colorplayer' . $i} = ${'color' . $i}[array_rand(${'color' . $i})]; 
			$_POST[$i] = ${'color'.$i};
			
		}

			
			
			
		for($i=1; $i <= $playersmax; $i++){
			print('<div style ="background-color:'.${'colorplayer'.$i}.'">player'.$i.'</div><br>');
		}
		
	
			
			

		?>
	</body>
</html>