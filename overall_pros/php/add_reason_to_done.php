<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$owner_id=$_SESSION['cj_investigation']['id'];

$reason_to_done_name= mysqli_real_escape_string($con, $_POST['reason_to_done_name']);

$max_reason_to_done_id = mysqli_query($con, "SELECT Max(`reason_to_done`.id_reason_to_done) AS Max_reason_to_done_id FROM `reason_to_done`");
$max_reason_to_done_id = mysqli_fetch_row($max_reason_to_done_id);
$max_reason_to_done_id = implode("", $max_reason_to_done_id);
$max_reason_to_done_id = $max_reason_to_done_id+1;

$insert_reason_to_done = mysqli_query($con, "INSERT INTO `cj_investigation`.`reason_to_done` (`id_reason_to_done`, `name`, `createdate`, `updatedate`, `status`, `deleted`) VALUES ('$max_reason_to_done_id', '$reason_to_done_name', CURRENT_TIMESTAMP, NULL, '0', '0');")or die(mysqli_error($con));

if ($insert_reason_to_done){
    mysqli_commit($con);
    header('Location: ../reason_to_done_settings.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../reason_to_done_settings.php?backresult=0'); //رقم الحيازة مكرر
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

