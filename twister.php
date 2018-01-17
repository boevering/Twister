<!DOCTYPE html>
<html>
	<head>
		<title>TWISTER</title>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers<input type="number" name="Aantal">
			<input type="submit">
		</form>
		<?php
		if(isset($_POST["Aantal"])){
			$spelers = $_POST["Aantal"];
			print("aantal spelers". $spelers);
		}
		else{
			print("you failed");
		}
		?>


	</body>
</html>