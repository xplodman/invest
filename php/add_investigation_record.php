<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$user_id=$_SESSION['cj_investigation']['id'];

$investigation_number= mysqli_real_escape_string($con, $_POST['investigation_number']);
$investigation_year=mysqli_real_escape_string($con, $_POST['investigation_year']);
$case_number=mysqli_real_escape_string($con, $_POST['case_number']);
$case_year=mysqli_real_escape_string($con, $_POST['case_year']);
$case_main_ledger=mysqli_real_escape_string($con, $_POST['case_main_ledger']);
$case_depart=mysqli_real_escape_string($con, $_POST['case_depart']);
$receive_date = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['receive_date']))->format("Y-m-d");

if (isset($_POST['charges']) && !empty($_POST['charges'])) {
    foreach($_POST['charges'] AS $val) {
        $charges[] = mysqli_real_escape_string($con, $val);
    }
}
if (isset($_POST['reason_to_done']) && !empty($_POST['reason_to_done'])) {
    foreach($_POST['reason_to_done'] AS $val) {
        $reason_to_done[] = mysqli_real_escape_string($con, $val);
    }
}
$prosecutor=mysqli_real_escape_string($con, $_POST['prosecutor']);
$case_status=mysqli_real_escape_string($con, $_POST['case_status']);
$notes=mysqli_real_escape_string($con, $_POST['notes']);

$max_case_id = mysqli_query($con, "SELECT Max(`case`.id) AS Max_case_id FROM `case`");
$max_case_id = mysqli_fetch_row($max_case_id);
$max_case_id = implode("", $max_case_id);
$max_case_id = $max_case_id+1;

$insert_case = mysqli_query($con, "INSERT INTO `case` (`id`, `createdate`, `updatedate`, `status`, `deleted`, `depart_id`, `main_ledger_id`, `case_number`, `case_year`) VALUES ('$max_case_id', CURRENT_TIMESTAMP, NULL, '1', '0', '$case_depart', '$case_main_ledger', '$case_number', '$case_year')");

if ($insert_case){

    $max_investigation_id = mysqli_query($con, "SELECT MAX(id_case_has_investigation) FROM `case_has_investigation`");
    $max_investigation_id = mysqli_fetch_row($max_investigation_id);
    $max_investigation_id = implode("", $max_investigation_id);
    $max_investigation_id = $max_investigation_id+1;

    $insert_investigation = mysqli_query($con, "INSERT INTO `case_has_investigation` (`id_case_has_investigation`, `investigation_number`, `investigation_year`, `case_id`, `case_status_idcase_status`, `users_id`, `prosecutor_id`, `createdate`, `updatedate`, `status`, `deleted`, `notes`, `receive_date`) VALUES ('$max_investigation_id', '$investigation_number', '$investigation_year', '$max_case_id', '$case_status', '$user_id', '$prosecutor', CURRENT_TIMESTAMP, NULL, '1', '0', '$notes', '$receive_date')");

    if ($insert_investigation){
        if (isset($_POST['charges']) && !empty($_POST['charges'])) {
            $max_case_has_investigation_has_charges_id = mysqli_query($con, "SELECT Max(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Max_case_has_investigation_has_charges_id FROM case_has_investigation_has_charges");
            $max_case_has_investigation_has_charges_id = mysqli_fetch_row($max_case_has_investigation_has_charges_id);
            $max_case_has_investigation_has_charges_id = implode("", $max_case_has_investigation_has_charges_id);
            $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;

            $len_charges =  count($charges);
            for($y=0 ; $y < $len_charges ; $y++)  // insert into case_has_investigation_has_charges
            {
                $insert_charges = mysqli_query($con, "INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES ('$max_investigation_id', '$charges[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_charges_id')");

                $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
            }
        }

        if (isset($_POST['reason_to_done']) && !empty($_POST['reason_to_done'])) {
            $max_case_has_investigation_has_reason_to_done_id = mysqli_query($con, "SELECT Max case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS Max_case_has_investigation_has_reason_to_done_id FROM case_has_investigation_has_reason_to_done");
            $max_case_has_investigation_has_reason_to_done_id = mysqli_fetch_row($max_case_has_investigation_has_reason_to_done_id);
            $max_case_has_investigation_has_reason_to_done_id = implode("", $max_case_has_investigation_has_reason_to_done_id);
            $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;

            $len_reason_to_done =  count($reason_to_done);
            for($y=0 ; $y < $len_reason_to_done ; $y++)  // insert into case_has_investigation_has_charges
            {
                $insert_reason_to_done = mysqli_query($con, "INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES ('$max_investigation_id', '$reason_to_done[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_reason_to_done_id')") ;

                $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
            }
        }

        mysqli_commit($con);
        header('Location: ../investigation.php?backresult=1');
        exit;
    }else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
        header('Location: ../investigation.php?backresult=2'); //رقم الحيازة مكرر
        exit;
    }
}else{ // القضية مكررة أو هناك مشكلة في اضافة القضية
    header('Location: ../investigation.php?backresult=3'); //رقم الحيازة مكرر
    exit;
}
?>
<!--<table>-->
<!--    --><?php
//    foreach ($_POST as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        if (is_array($value)){
//            print_r($value);
//        }else{
//            echo $value;
//        }
//        echo "</td>";
//        echo "</tr>";
//    }
//    ?>
<!--</table>-->

