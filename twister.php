<!DOCTYPE html>
<html>
	<head>
		<title>Twister</title>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers<input type="number" name="Aantal">
			<input type="submit">
		</form>
		<?php
		if(isset($_POST["Aantal"])){
			$spelers = $_POST["Aantal"];
			print("aantal spelers ". $spelers);
			print('<form action="game.php" method="POST">');
			for($i=1; $i <= $spelers; $i++){
				print('Kleuren(gescheiden door komma)<input type="text" name="kleuren"><br>');
			}
			print('<input type="submit"');
			print('</form>');
		}
		?>
	</body>
</html>