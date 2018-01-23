<?php 
require_once("../Connections/twister.php");
require_once("functions.php");
session_start();
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Twister</title>
		<script type="text/javascript" src="../js/functions.js"></script>
		<script type="text/javascript" src="../js/twister.js"></script>
		<link rel="stylesheet" type="text/css" href="../style/modal.css">
	</head>
	<body>
		<?php
		if(isset(["insert"])){
			$InsertPlayer = "INSERT INTO `users`(`firstname`, `prefix`, `lastname`) VALUES ('".test_input($_POST["firstname"])."','".test_input($_POST["prefix"])."','".test_input($_POST["lastname"])."');";
			$dbGM = mysqli_query($dbtwister, $InsertPlayer);
						
			$_POST["AmountPlayers"] = $_SESSION["amountplayers"];
			$_POST["AmountColors"] = $_SESSION["amountcolors"];
		}
		
		if(isset($_POST["AmountPlayers"], $_POST["AmountColors"])){
		
			# check if post values are set, if not, don't display, if is set, show this.
			$_SESSION["amountplayers"] = $_POST["AmountPlayers"];
			$_SESSION["amountcolors"] = $_POST["AmountColors"];
			$amountplayers = $_POST["AmountPlayers"];
			$amountcolors = $_SESSION["amountcolors"];

			readfile('../html/Setup.html');

			?>

			<br>Aantal gekozen spelers: <?php echo $_POST['AmountPlayers']; ?><br>
			<form action="twister.php" method="POST">

			<?php
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
				print('<button type="button" id="myBtn">Toevoegen</button><br>');


				for(var i = 0; i < $amountcolors; i++){
					print('Kleur '+ i + ': <input type="color" value="' + $_POST["color" + i] + '" name="color' + i + '"/> <br>');
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
		?>

		<div id="myModal" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				<p><form action="twister.php" method="post">
					<h1>Vul de volgende velden in:</h1>
					<input type="text" name="firstname" placeholder="Voornaam" required><br>
					<input type="text" name="prefix" placeholder="Tussenvoegsel"><br>
					<input type="text" name="lastname" placeholder="Achternaam" required><br><br>
					<input type="hidden" name="insert">
					<input type="reset" value="Reset"><input type="submit" value="Toevoegen">
					</form></p>
			</div>

		</div>
		<br>
	</body>
</html>