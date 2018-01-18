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
			# check if post values are set, if not, don't display, if is set, show this.
			$amountplayers = $_POST["AmountPlayers"];
			$amountcolors = $_POST["AmountColors"];
			print("<br>Aantal gekozen spelers: ". $amountplayers. "<br>");
			print('<form action="game.php" method="POST">');
			for($i=1; $i <= $amountplayers; $i++){
				print("<h1>Speler: ".$i."</h1>");
				$queryusers = "SELECT * FROM `users`;";
				while ( $d=mysqli_fetch_assoc($dbtwister)) {
  					echo "<option value='{".$d['firstname']."}'>".$d['firstname']."</option>";
				}
				for($o=1; $o <= $amountcolors; $o++){
					print('Kleur '.$o.': <input type="color" name="player'.$i.'color'.$o.'"><br>');
				}
				print("<br>");
			}
			print('<input type="submit" value="Doorgaan"><input type="reset" value="Reset">');
			print('<input type="hidden" name="amountplayers" value='.$amountplayers.'>');
			print('<input type="hidden" name="amountcolors" value='.$amountcolors.'>');
			print('</form>');
			#doorsturen array(playerid => array(userid, kleur1, kleur2, kleur3))
		}
		DBtest($dbtwister);
		?>
		

	</body>
</html>