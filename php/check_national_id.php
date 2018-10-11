<?php 
	$db = mysqli_connect('localhost', 'root', 'root', 'cj_family');
	
	if (isset($_POST['national_id_check'])) {
		$national_id = $_POST['national_id'];

		$sql = "SELECT * FROM `person` WHERE `national_id` = $national_id";
		$results = mysqli_query($db, $sql);

		if (mysqli_num_rows($results) > 0) {
			echo "taken";	
		}else{
			echo 'not_taken';
		}
		exit();
	}
?>
