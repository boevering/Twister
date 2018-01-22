<?php 
# Let's make sure the database is connected, use $dbtwister as database (file on server, NOT on Github!)
require_once("Connections/twister.php");
# Lets use a seperate file for functions
require_once("functions.php");
# Lets also start a session here so we can put the colors in there for now
session_start();
$_SESSION["debug"] = "0";
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Twister</title>
		<script type="text/javascript">
			function display() {
					document.getElementById('add').style.display = 'block';
			}
		</script>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers? <input type="number" max="10" name="AmountPlayers" value=<?php print($_POST["AmountPlayers"]);?> required> <br>
			Aantal Kleuren per speler? <input type="number" max="10" name="AmountColors" value=<?php print($_POST["AmountColors"]);?> required> <br>
			<input type="submit" value="Doorgaan"><input type="reset" value="Reset">
		</form>
		<?php
		if(isset($_POST["AmountPlayers"], $_POST["AmountColors"])){
			# $p is for the colornaming, this value is used in the query to sort out the color per player
			$p = 1;
			
			# check if post values are set, if not, don't display, if is set, show this.
			$_SESSION["amountplayers"] = $_POST["AmountPlayers"];
			$_SESSION["amountcolors"] = $_POST["AmountColors"];
			$amountplayers = $_SESSION["amountplayers"];
			$amountcolors = $_SESSION["amountcolors"];
			
			print("<br>Aantal gekozen spelers: ". $amountplayers. "<br>");
			print('<form action="twister.php" method="POST">');
			for($i=1; $i <= $amountplayers; $i++){
				print("<h1>Speler: ".$i."</h1>");
				$queryusers = "SELECT * FROM `users`;";
				$db = mysqli_query($dbtwister, $queryusers);
				print ('<select name="userid'.$i.'" required>');
				print ('<option selected disabled>Kies speler:</option>');
				while ( $d=mysqli_fetch_assoc($db)) {
  					echo "<option value=".$d['id'].">".$d['firstname']." ".$d['prefix']." ".$d['lastname']."</option>";
				}
				print("</select>");
				print(" ");
				print('<input type="button" value="Toevoegen" onclick="display()"><br>');
				print('<div id="add" style="display:none"><input type="text" placeholder="Voornaam" name="firstname">');
				print('<input type="text" placeholder="Tussenvoegsel" name="prefix">');
				print('<input type="text" placeholder="Achternaam" name="lastname"></div>');
				
				print("<br>");
				for($o=1; $o <= $amountcolors; $o++){
					print('Kleur '.$o.': <input type="color" value="'.$_POST["color'.$p."].'" name="color'.$p.'"><br>');
					$p++;
				}
				print("<br>");
			}
			print('<input type="submit" value="Doorgaan"><input type="reset" value="Reset">');
			print('</form>');
		}
			
		if(isset($_POST["userid1"])){
			$amountplayers = $_SESSION["amountplayers"];
			$amountcolors = $_SESSION["amountcolors"];
			
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
				
				$InsertGame = "INSERT INTO `game` (`gameid`,`playerid`, `userid`, `colors`, `begintime`, `endtime`) VALUES ('".$NewGameID."', '".$i."', '".$_POST["userid".$i]."', '".$kleur."', '".date("Y-m-d H:i:s")."', '');";
				$dbGM = mysqli_query($dbtwister, $InsertGame);
				
				# also put colors in session so when next button is used no database connection is needed
				$_SESSION["p".$i] = array(ColorPlayer($kleur));
			}
			
			$_SESSION["stage"] = "4";
			echo '<script type="text/javascript">location.href = "game.php?gameid='.$NewGameID.'"</script>';
		}
		mysqli_close($dbtwister);
		#DBtest($dbtwister);
		?>
	</body>
</html>