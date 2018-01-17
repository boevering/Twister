<!DOCTYPE html>
<html>
	<head>
		<title>TWISTER</title>
	</head>
	<body>
		<form action="twister.php" method="GET">
			Aantal Spelers<input type="number" name="Aantal">
			<input type="submit">
		</form>
		<?php
		if(isset($_GET["Aantal"])){
			print("Hello world");
		}
		else{
			print("you failed");
		}
		?>


	</body>
</html>