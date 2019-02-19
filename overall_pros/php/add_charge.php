<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$owner_id=$_SESSION['cj_investigation']['id'];

$charge_name= mysqli_real_escape_string($con, $_POST['charge_name']);

$max_charge_id = mysqli_query($con, "SELECT Max(`charges`.id_charges) AS Max_charges_id FROM `charges`");
$max_charge_id = mysqli_fetch_row($max_charge_id);
$max_charge_id = implode("", $max_charge_id);
$max_charge_id = $max_charge_id+1;

$insert_charge = mysqli_query($con, "INSERT INTO `cj_investigation`.`charges` (`id_charges`, `name`, `createdate`, `updatedate`, `status`, `deleted`, `owner_id`, `admin_id`) VALUES ('$max_charge_id', '$charge_name', CURRENT_TIMESTAMP, NULL, '0', '0', '$owner_id', '0');")or die(mysqli_error($con));

if ($insert_charge){
    mysqli_commit($con);
    header('Location: ../charges_settings.php?backresult=1');
    exit;
}else{ // رقم الحصر مكرر او هناك مشكلة في اضافة رقم الحصر
    header('Location: ../charges_settings.php?backresult=0'); //رقم الحيازة مكرر
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

