<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$owner_id=$_SESSION['cj_investigation']['id'];

$prosecuter_name= mysqli_real_escape_string($con, $_POST['prosecuter_name']);
$pros_id= mysqli_real_escape_string($con, $_POST['pros_id']);

$max_prosecuter_id = mysqli_query($con, "SELECT Max(prosecutor.id) AS Max_id FROM prosecutor");
$max_prosecuter_id = mysqli_fetch_row($max_prosecuter_id);
$max_prosecuter_id = implode("", $max_prosecuter_id);
$max_prosecuter_id = $max_prosecuter_id+1;

$insert_prosecuter = mysqli_query($con, "INSERT INTO `cj_investigation`.`prosecutor` (`id`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `pros_id`) VALUES ('$max_prosecuter_id', '$prosecuter_name', CURRENT_TIMESTAMP, NULL, '1', '0', '$pros_id');")or die(mysqli_error($con));

if ($insert_prosecuter){
    mysqli_commit($con);
    header('Location: ../prosecutor_settings.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../prosecutor_settings.php?backresult=0'); //رقم الحيازة مكرر
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

