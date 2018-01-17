<html>
	<head>
		<title>TWISTER</title>
	</head>
	<body>
		<form action="twister.php" method="POST">
			Aantal Spelers<input type="number" name="Aantal">
			<input type="submit">
		</form>
		<?php\
		if isset($Aantal){
			spelers = $_POST["Aantal"];
			for ($i=1, $i<= "spelers", $i++){
				print(	
								Kleuren speler $i<input type="text" name="speler$i">
					);
			}
		}
		else{
			print("Vul formulier in!")
		}
		?>


	</body>
</html>