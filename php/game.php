<?php 

if (!isset($_POST["call_id"])) {
	echo "fuck off";
}
else {
	$id = $_POST["call_id"];

	if ($id == "dummy") {
		$arr = array('result' => true, 'RogierWins' => false);
		echo json_encode($arr);
	}
	elseif ($id == "asdasd") {
	
	}
}

?>