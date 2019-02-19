<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'تقرير نسبة الإنجاز';
include_once "layout/header.php";
include_once "php/check_authentication.php";
include_once "php/functions.php";
$query = "
SELECT
  case_has_investigation.id_case_has_investigation
FROM
  prosecutor
  INNER JOIN case_has_investigation ON case_has_investigation.prosecutor_id = prosecutor.id
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
WHERE
  prosecutor.id > 11";
$results = mysqli_query($con, $query);
//loop
foreach ($results as $prosecutor) {
    $prosecutor_1 = $prosecutor['id_case_has_investigation'];
    $update_prosecutor= mysqli_query($con, "UPDATE `case_has_investigation` SET `depart_id` = '1' WHERE `case_has_investigation`.`id_case_has_investigation` = '$prosecutor_1';");

}
mysqli_commit($con);
