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
	<head>
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
			echo $row['gameid'];
			$row = mysqli_fetch_array($dbGM);
			$NewGameID = $row['gameid']+1;
			
			$x = 1;
			$q = 1;
			for($i=1; $i <= $amountplayers; $i++){
					for($z=$x; $z <= $amountcolors * $i; $z++){
							$kleuren[$q]  = $_POST["color".$z];
							$q++;
						print("<br> q=".$q);
						print("<br> Z=".$z);
						print("<br> i=".$i);
						print("<br> color5".$color5);
					}
				$speler = array($i => $kleuren);
				$x = $i * $amountcolors;
			}
			print("Speler: ");
			print_r($speler);
			print("<br>Kleuren: ");
			print_r($kleuren);
			print("<br>kaas");
			
			
			for($i=1; $i <= $amountplayers; $i++){
				#INSERT INTO `game` (`entryid`, `gameid`, `userid`, `colors`, `begintime`, `endtime`) VALUES (NULL, '1', '1', 'zwart,geel,blauw', '', '');
				$InsertGame = "INSERT INTO `game` (`gameid`, `userid`, `colors`, `begintime`, `endtime`) VALUES ('".$NewGameID."', '".$_POST["userid".$i]."', 'zwart,geel,blauw', '', '');";
			}
				
		}
		#DBtest($dbtwister);
		?>
		

	</body>
</html>