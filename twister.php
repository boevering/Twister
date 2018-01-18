<!DOCTYPE html>
<html>
	<head>
		<title>Twister</title>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers? <input type="number" name="AmountPlayers"> <br>
			Aantal Kleuren per speler? <input type="number" name="AmountColors"> <br>
			<input type="submit">
		</form>
		<?php
		if(isset($_POST["AmountPlayers"], $_POST["AmountColors"])){
			$amountplayers = $_POST["AmountPlayers"];
			$amountcolors = $_POST["AmountColors"];
			print("<br>Aantal gekozen spelers: ". $amountplayers. "<br>");
			print('<form action="game.php" method="POST">');
			for($i=1; $i <= $amountplayers; $i++){
				for($o=1; $o <= $amountcolors; $o++){
					print('Speler: '.$i.', Kleur '.$o.': <input type="text" name="player'.$i.'color'.$o.'"><br>');
				}
				print("<br>");
			}
			print('<input type="submit"');
			print('</form>');
		}
		?>
	</body>
</html>