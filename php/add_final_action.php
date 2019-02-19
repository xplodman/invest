<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$owner_id=$_SESSION['cj_investigation']['id'];

$final_action_name= mysqli_real_escape_string($con, $_POST['final_action_name']);

$insert_final_action = mysqli_query($con, "INSERT INTO `final_action` (`final_action_id`, `final_action_name`, `createdate`, `updatedate`, `status`, `deleted`, `owner_id`, `admin_id`) VALUES (NULL, '$final_action_name', CURRENT_TIMESTAMP, NULL, '0', '0', '$owner_id', '0');")or die(mysqli_error($con));

if ($insert_final_action){
    mysqli_commit($con);
    header('Location: ../actions_settings.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../actions_settings.php?backresult=0'); //رقم الحيازة مكرر
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

