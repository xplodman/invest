<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$user_id=$_SESSION['cj_investigation']['id'];

$possession_id=$_POST['possession_id'];
$case_id=$_POST['case_id'];

$possession_number=$_POST['possession_number'];
$possession_year=$_POST['possession_year'];
$case_number=$_POST['case_number'];
$case_year=$_POST['case_year'];
$main_ledger=$_POST['main_ledger'];
$depart=$_POST['depart'];
$receive_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['receive_date'])));
$subject=$_POST['subject'];
$prosecutor=$_POST['prosecutor'];

if (!empty($_POST['completion_send_date'])) {
    $completion_send_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['completion_send_date'])));
}else{
    $completion_send_date = $_POST['completion_send_date'];
    $completion_send_date = NULL;
}

if (!empty($_POST['completion_delegate'])) {
    $completion_delegate = $_POST['completion_delegate'];
}else{
    $completion_delegate = $_POST['completion_delegate'];
    $completion_delegate = NULL;
}

if (!empty($_POST['completion_receive_date'])) {
    $completion_receive_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['completion_receive_date'])));
}else{
    $completion_receive_date = $_POST['completion_receive_date'];
    $completion_receive_date = NULL;
}

if (!empty($_POST['prosecution_decision'])) {
    $prosecution_decision = $_POST['prosecution_decision'];
}else{
    $prosecution_decision = $_POST['prosecution_decision'];
    $prosecution_decision = NULL;
}

if (!empty($_POST['case_send_date'])) {
    $case_send_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['case_send_date'])));
}else{
    $case_send_date = $_POST['case_send_date'];
    $case_send_date = NULL;
}

if (!empty($_POST['case_send_number'])) {
    $case_send_number = $_POST['case_send_number'];
}else{
    $case_send_number = $_POST['case_send_number'];
    $case_send_number = NULL;
}

$update_possession = mysqli_query($con, "UPDATE `cj_family`.`possession` SET `case_receive_date` = '$receive_date', `prosecutor_id` = '$prosecutor', `completion_send_date` = '$completion_send_date', `completion_delegate` = '$completion_delegate', `completion_receive_date` = '$completion_receive_date', `prosecution_decision` = '$prosecution_decision', `case_send_date` = '$case_send_date', `case_send_number` = '$case_send_number', `updatedate` = NOW(), `subject_id` = '$subject' WHERE `possession`.`id` = '$possession_id'");

//$update_possession_number = mysqli_query($con, "UPDATE `cj_family`.`possession` SET `possession_number` = '$possession_number', `possession_year` = '$possession_year' WHERE `possession`.`id` = '$possession_id'");

if ($update_possession) {

    mysqli_commit($con);
    mysqli_close($con);
    header('Location: ../possession_profile.php?id='.$possession_id.'&backresult=1');
    exit;
//    $update_case = mysqli_query($con, "UPDATE `cj_family`.`case` SET `updatedate` = NOW(), `depart_id` = '$depart', `main_ledger_id` = '$main_ledger', `case_number` = '$case_number', `case_year` = '$case_year' WHERE `case`.`id` = '$case_id';");
//    if ($update_case) {
//        mysqli_commit($con);
//        mysqli_close($con);
//        header('Location: ../possession_profile.php?id='.$possession_id.'&backresult=1');
//        exit;
//    }else{
//        header('Location: ../possession_profile.php?id='.$possession_id.'&backresult=3');
//        exit;
//    }
}else{
    header('Location: ../possession_profile.php?id='.$possession_id.'&backresult=2');
    exit;
}
?>

<!--<table>-->
<!--    --><?php
//    $intLat = !empty($intLat) ? "'$intLat'" : "NULL";
//
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

