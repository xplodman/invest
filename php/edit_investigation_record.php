<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$user_id=$_SESSION['cj_investigation']['id'];

$investigation_id=$_POST['investigation_id'];
$case_id=$_POST['case_id'];
$investigation_number=mysqli_real_escape_string($con, $_POST['investigation_number']);
$investigation_year=mysqli_real_escape_string($con, $_POST['investigation_year']);
$case_number=mysqli_real_escape_string($con, $_POST['case_number']);
$case_year=mysqli_real_escape_string($con, $_POST['case_year']);
$case_main_ledger=mysqli_real_escape_string($con, $_POST['main_ledger']);
$case_depart=mysqli_real_escape_string($con, $_POST['depart']);
$prosecutor=mysqli_real_escape_string($con, $_POST['prosecutor']);
$case_status=mysqli_real_escape_string($con, $_POST['case_status']);
$notes=mysqli_real_escape_string($con, $_POST['notes']);
$receive_date = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['receive_date']))->format("Y-n-j");
echo $receive_date;
$update_case_has_investigation= mysqli_query($con, "UPDATE case_has_investigation SET `investigation_number` = '$investigation_number', `investigation_year` = '$investigation_year', `case_status_idcase_status` = '$case_status', `prosecutor_id` = '$prosecutor', `notes` = '$notes', `receive_date` = '$receive_date', `updatedate` = NOW() WHERE id_case_has_investigation= $investigation_id;");

if ($update_case_has_investigation === false) {
    header('Location: ../investigation.php?id='.$investigation_id.'&backresult=2'); //رقم الحصر مكرر
    exit;
}
$update_case= mysqli_query($con, "UPDATE `case` SET `depart_id` = '$case_depart', `main_ledger_id` = '$case_main_ledger', `case_number` = '$case_number', `case_year` = '$case_year' WHERE `case`.`id` = '$case_id';");

if ($update_case === false) {
    header('Location: ../investigation.php?id='.$investigation_id.'&backresult=3'); //رقم القضية مكرر
    exit;
}
if (empty($_POST['charges'])) {
    $delete_charges = mysqli_query($con, "DELETE FROM `case_has_investigation_has_charges` WHERE `case_has_investigation_has_charges`.`case_has_investigation_id_case_has_investigation` = '$investigation_id';");

}else{
    $charges = $_POST['charges'];
    $max_case_has_investigation_has_charges_id = mysqli_query($con, "SELECT Max(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Max_case_has_investigation_has_charges_id FROM case_has_investigation_has_charges");

    $max_case_has_investigation_has_charges_id = mysqli_fetch_row($max_case_has_investigation_has_charges_id);
    $max_case_has_investigation_has_charges_id = implode("", $max_case_has_investigation_has_charges_id);
    $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;

    $delete_charges = mysqli_query($con, "DELETE FROM `case_has_investigation_has_charges` WHERE `case_has_investigation_has_charges`.`case_has_investigation_id_case_has_investigation` = '$investigation_id';");


    $len_charges =  count($charges);
    for($y=0 ; $y < $len_charges ; $y++)  // insert into case_has_investigation_has_charges
    {
        $insert_charges = mysqli_query($con, "INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES ('$investigation_id', '$charges[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_charges_id');");

        $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
    }
}

if (empty($_POST['reason_to_done'])) {
    $delete_charges = mysqli_query($con, "DELETE FROM `case_has_investigation_has_reason_to_done` WHERE `case_has_investigation_has_reason_to_done`.`case_has_investigation_id_case_has_investigation` = '$investigation_id';");
}else{
    $reason_to_done = $_POST['reason_to_done'];
    $max_case_has_investigation_has_reason_to_done_id = mysqli_query($con, "SELECT Max (case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS Max_case_has_investigation_has_reason_to_done_id FROM case_has_investigation_has_reason_to_done");
    $max_case_has_investigation_has_reason_to_done_id = mysqli_fetch_row($max_case_has_investigation_has_reason_to_done_id);
    $max_case_has_investigation_has_reason_to_done_id = implode("", $max_case_has_investigation_has_reason_to_done_id);
    $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;

    $delete_charges = mysqli_query($con, "DELETE FROM `case_has_investigation_has_reason_to_done` WHERE `case_has_investigation_has_reason_to_done`.`case_has_investigation_id_case_has_investigation` = '$investigation_id';");

    $len_reason_to_done =  count($reason_to_done);
    for($y=0 ; $y < $len_reason_to_done ; $y++)  // insert into case_has_reason_to_done
    {
        $insert_reason_to_done = mysqli_query($con, "INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES ('$investigation_id', '$reason_to_done[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_reason_to_done_id');");

        $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
    }
}

mysqli_commit($con);
header('Location: ../investigation_profile.php?id='.$investigation_id.'&backresult=1');
exit;//if ($insert_case){
//
//    $max_investigation_id = mysqli_query($con, "SELECT MAX(id_case_has_investigation) FROM `case_has_investigation`");
//    $max_investigation_id = mysqli_fetch_row($max_investigation_id);
//    $max_investigation_id = implode("", $max_investigation_id);
//    $max_investigation_id = $max_investigation_id+1;
//
//    $insert_investigation = mysqli_query($con, "INSERT INTO `case_has_investigation` (`id_case_has_investigation`, `investigation_number`, `investigation_year`, `case_id`, `case_status_idcase_status`, `users_id`, `prosecutor_id`, `createdate`, `updatedate`, `status`, `deleted`) VALUES ('$max_investigation_id', '$investigation_number', '$investigation_year', '$max_case_id', '$case_status', '$user_id', '$prosecutor', CURRENT_TIMESTAMP, NULL, '1', '0');");
//
//    if ($insert_investigation){
//        $max_case_has_investigation_has_charges_id = mysqli_query($con, "SELECT Max(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Max_case_has_investigation_has_charges_id FROM case_has_investigation_has_charges");
//        $max_case_has_investigation_has_charges_id = mysqli_fetch_row($max_case_has_investigation_has_charges_id);
//        $max_case_has_investigation_has_charges_id = implode("", $max_case_has_investigation_has_charges_id);
//        $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
//
//        $len_charges =  count($charges);
//        for($y=0 ; $y < $len_charges ; $y++)  // insert into case_has_investigation_has_charges
//        {
//            $insert_charges = mysqli_query($con, "INSERT INTO `case_has_investigation_has_charges` (`case_has_investigation_id_case_has_investigation`, `charges_id_charges`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_charges_id`) VALUES ('$max_investigation_id', '$charges[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_charges_id');");
//
//            $max_case_has_investigation_has_charges_id = $max_case_has_investigation_has_charges_id+1;
//        }
//
//        $max_case_has_investigation_has_reason_to_done_id = mysqli_query($con, "SELECT Max case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS Max_case_has_investigation_has_reason_to_done_id FROM case_has_investigation_has_reason_to_done");
//        $max_case_has_investigation_has_reason_to_done_id = mysqli_fetch_row($max_case_has_investigation_has_reason_to_done_id);
//        $max_case_has_investigation_has_reason_to_done_id = implode("", $max_case_has_investigation_has_reason_to_done_id);
//        $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
//
//        $len_reason_to_done =  count($reason_to_done);
//        for($y=0 ; $y < $len_reason_to_done ; $y++)  // insert into case_has_investigation_has_charges
//        {
//            $insert_reason_to_done = mysqli_query($con, "INSERT INTO `case_has_investigation_has_reason_to_done` (`case_has_investigation_id_case_has_investigation`, `reason_to_done_id_reason_to_done`, `createdate`, `updatedate`, `status`, `deleted`, `case_has_investigation_has_reason_to_done_id`) VALUES ('$max_investigation_id', '$reason_to_done[$y]', CURRENT_TIMESTAMP, NULL, '1', '0', '$max_case_has_investigation_has_reason_to_done_id');");
//
//            $max_case_has_investigation_has_reason_to_done_id = $max_case_has_investigation_has_reason_to_done_id+1;
//        }
//        mysqli_commit($con);
//        header('Location: ../investigation.php?backresult=1');
//        exit;
//    }else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
//        header('Location: ../investigation.php?backresult=2'); //رقم الحيازة مكرر
//        exit;
//    }
//}else{ // القضية مكررة أو هناك مشكلة في اضافة القضية
//    header('Location: ../investigation.php?backresult=3'); //رقم الحيازة مكرر
//    exit;
//}
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

