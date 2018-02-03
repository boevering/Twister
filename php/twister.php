<?php 
require_once("../Connections/twister.php");

if (!isset($_POST["call_id"])) {
	mysqli_close($dbtwister);
	echo "fuck off";
}
else {
	$id = $_POST["call_id"];

	if ($id == "dummy") {
		$arr = array('result' => true, 'RogierAKACoffeeLady_Wins' => false);
		echo json_encode($arr);
	}
	elseif ($id == "get_users") {
		$query = "SELECT * FROM User;";
		$result = mysqli_query($dbtwister, $query)
			or die("Error: ".mysqli_error($dbtwister));

		$users = array();
		while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$users[] = $data;
		}

		echo json_encode($users);
	} else {
		echo "invalid call_id";
	}

	mysqli_close($dbtwister);
}

?>