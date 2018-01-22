<?php 
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");
# Lets use a seperate file for functions
require_once("functions.php");

session_start();
$sessiecounter = 0;

if(!isset($_SESSION["debug"])){$_SESSION["debug"] = "0";};

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
			$gameID = $_GET["gameid"];
			
			# let's see how many players there are in this game
			$queryplayers = 'SELECT `playerid` FROM `game` WHERE `gameid` = "'.$gameID.'" ORDER BY `playerid` DESC LIMIT 1';
			$dbplayers = mysqli_query($dbtwister, $queryplayers);
			$players = mysqli_fetch_array($dbplayers);
			
			# let's put that number into some variables
			$playersmax = $players["playerid"];
			$_SESSION["amountplayers"] = $playersmax;

			# get colors from database for each player
			for($i=1; $i <= $playersmax; $i++){
				$queryusers = 'SELECT * FROM `game` WHERE `gameid` = "'.$gameID.'" AND `playerid` ="'.$i.'";';
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
			
			
			
			
			if(isset($_POST["refeshtimer"])){
				$_SESSION["refreshTimer"] = $_POST["refeshtimer"];
			} 
			if(!isset($_POST["refeshtimer"], $_SESSION["refreshTimer"])){
				$_SESSION["refreshTimer"] = "25";
			}
			$playersmax = $_SESSION["amountplayers"];
			
			print(refreshTime($_GET["gameid"]));
			print(limb($playersmax));
			
			print('<meta http-equiv="refresh" content="'.$_SESSION["refreshTimer"].'">');
		}
		?>
		<script type="text/javascript">

			COUNTER_START = <?php echo $_SESSION["refreshTimer"]; ?>

			function tick () {
				if (document.getElementById ('counter').firstChild.data > 0) {
					document.getElementById ('counter').firstChild.data = document.getElementById ('counter').firstChild.data - 1
					setTimeout ('tick()', 1000)
				} else {
					document.getElementById ('counter').firstChild.data = 'done'
				}
			}

			if (document.getElementById) onload = function () {
				var t = document.createTextNode (COUNTER_START)
				var p = document.createElement ('P')
				p.appendChild (t)
				p.setAttribute ('id', 'counter')

				var body = document.getElementsByTagName ('BODY')[0]
				var firstChild = body.getElementsByTagName ('*')[0]

				body.insertBefore (p, firstChild)
				tick()
			}

		</script>
	</body>
</html>