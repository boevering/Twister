<?php 
require_once("../Connections/twister.php");

if (!isset($_POST["call_id"])) {
	mysqli_close($dbtwister);
	echo "fuck off";
}
else {
	$id = $_POST["call_id"];

	if ($id == "dummy") {
		$arr = array('result' => true, 'RogierWins' => false);
		echo json_encode($arr);
	}
	elseif ($id == "get_users") {

		$query = "SELECT * FROM 'User';";
		$result = mysqli_query($dbtwister, $query);
		$data = mysqli_fetch_array(MYSQLI_BOTH, $result);

		echo json_encode($data);
	} else {
		echo "invalid call_id";
	}

	mysqli_close($dbtwister);
}

?>