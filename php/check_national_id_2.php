<?php 
	$db = mysqli_connect('localhost', 'root', 'root', 'cj_family');
	
	if (isset($_POST['national_id_2_check'])) {
		$national_id_2 = $_POST['national_id_2'];

		$sql = "SELECT * FROM `person` WHERE `national_id` = $national_id_2";
		$results = mysqli_query($db, $sql);

		if (mysqli_num_rows($results) > 0) {
			echo "taken";	
		}else{
			echo 'not_taken';
		}
		exit();
	}
?>
