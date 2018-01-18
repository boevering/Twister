<?php 
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");
# Lets use a seperate file for functions
require_once("functions.php");
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Twister</title>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers? <input type="number" max="10" name="AmountPlayers" value=<?php print($_POST["AmountPlayers"]);?>> <br>
			Aantal Kleuren per speler? <input type="number" max="10" name="AmountColors" value=<?php print($_POST["AmountColors"]);?>> <br>
			<input type="submit" value="Doorgaan"><input type="reset" value="Reset">
		</form>
		<?php
		if(isset($_POST["AmountPlayers"], $_POST["AmountColors"])){
			# $p is for the colornaming, this value is used in the query to sort out the color per player
			$p = 1;
			# check if post values are set, if not, don't display, if is set, show this.
			$amountplayers = $_POST["AmountPlayers"];
			$amountcolors = $_POST["AmountColors"];
			print("<br>Aantal gekozen spelers: ". $amountplayers. "<br>");
			print('<form action="#" method="POST">');
			for($i=1; $i <= $amountplayers; $i++){
				print("<h1>Speler: ".$i."</h1>");
				$queryusers = "SELECT * FROM `users`;";
				$db = mysqli_query($dbtwister, $queryusers);
				print ('<select name="userid'.$i.'">');
				while ( $d=mysqli_fetch_assoc($db)) {
  					echo "<option value=".$d['id'].">".$d['firstname']." ".$d['prefix']." ".$d['lastname']."</option>";
				}
				print("</select><br>");
				for($o=1; $o <= $amountcolors; $o++){
					print('Kleur '.$o.': <input type="color" name="color'.$p.'"><br>');
					$p++;
				}
				print("<br>");
			}
			print('<input type="hidden" name="AmountPlayers" value="'.$amountplayers.'">');
			print('<input type="hidden" name="AmountColors" value="'.$amountcolors.'">');
			print('<input type="submit" value="Doorgaan"><input type="reset" value="Reset">');
			print('</form>');
			#doorsturen array(playerid => array(userid, kleur1, kleur2, kleur3))
		}
			
		if(isset($_POST["userid1"])){
			$amountplayers = $_POST["AmountPlayers"];
			$amountcolors = $_POST["AmountColors"];
			#opvragen laatste gameID
			$MaxGameID = "SELECT `gameid` FROM `game` ORDER BY `gameid` DESC LIMIT 1;";
			$dbGM = mysqli_query($dbtwister, $MaxGameID);
			$row = mysqli_fetch_array($dbGM);
			$hashing = $_POST."". date("Y-m-d H:i:s")."". rand(0, 9999);
			$NewGameID = hash('ripemd160', $hashing);
			
			$q=1;
			for($i=1; $i <= $amountplayers; $i++){
					for($z=1; $z <= $amountcolors; $z++){
							$kleuren[$z]  = $_POST["color".$q];
							$q++;
					}
				$speler[$i] = $kleuren;
			}			
			
			for($i=1; $i <= $amountplayers; $i++){
				unset($kleur);
				foreach($speler[$i] as $color){
					$kleur .= $color.",";
				}
				
				#INSERT INTO `game` (`entryid`, `gameid`, `userid`, `colors`, `begintime`, `endtime`) VALUES (NULL, '1', '1', 'zwart,geel,blauw', '', '');
				$InsertGame = "INSERT INTO `game` (`gameid`,`playerid`, `userid`, `colors`, `begintime`, `endtime`) VALUES ('".$NewGameID."', '".$i."', '".$_POST["userid".$i]."', '".$kleur."', '".date("Y-m-d H:i:s")."', '');";
				$dbGM = mysqli_query($dbtwister, $InsertGame);
			}
			echo '<script type="text/javascript">location.href = "game.php?gameid='.$NewGameID.'"</script>';
		}
		#DBtest($dbtwister);
		?>
		

	</body>
</html>