<?php

if (isset($_POST['charges']) AND !empty($_POST['charges'])) {
//    echo '<pre>'; print_r($_POST['charges']); echo '</pre>';
}
if (isset($_POST['reason_to_done']) AND !empty($_POST['reason_to_done'])) {
//    echo '<pre>'; print_r($_POST['reason_to_done']); echo '</pre>';
}
if (isset($_POST['case_status']) AND !empty($_POST['case_status'])) {
//    echo '<pre>'; print_r($_POST['case_status']); echo '</pre>';
}
if (isset($_POST['case_status']) AND !empty($_POST['case_status'])) {
//    echo '<pre>'; print_r($_POST['case_status']); echo '</pre>';
}

include_once "../php/connection.php";
include_once "../php/check_authentication.php";
include_once "../php/functions.php";
$user_id = $_SESSION['cj_investigation']['id'];
$user_nickname = $_SESSION['cj_investigation']['nickname'];
$user_job = $_SESSION['cj_investigation']['job'];
if (isset($_POST['reason_to_done']) AND !empty($_POST['reason_to_done'])) {
    $reason_to_done = $_POST['reason_to_done'];
    $reason_to_done_imploded = implode(",", array_map("intval", $reason_to_done));
    $reason_to_done_query = "SELECT
  `case`.case_number,
  `case`.case_year,
  main_ledger.name AS main_ledger_name,
  depart.name AS depart_name,
  case_has_investigation.investigation_number,
  case_has_investigation.investigation_year,
  case_has_investigation.id_case_has_investigation,
  case_has_investigation.notes,
  reason_to_done.name AS reason_to_done_name,
  prosecutor.name AS prosecutor_name
FROM
  case_has_investigation
  INNER JOIN case_has_investigation_has_reason_to_done ON
    case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN users ON case_has_investigation.users_id = users.id
  INNER JOIN pros_has_users ON pros_has_users.users_id = users.id
  INNER JOIN pros ON pros_has_users.pros_id = pros.id
  INNER JOIN depart ON `case`.depart_id = depart.id AND pros.id = depart.pros_id
  INNER JOIN reason_to_done ON case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done =
    reason_to_done.id_reason_to_done
  INNER JOIN main_ledger ON `case`.main_ledger_id = main_ledger.id
  INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
WHERE
  pros_has_users.users_id = '$user_id' AND
  case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done in ($reason_to_done_imploded)";
    if (isset($_POST['prosecutor']) AND !empty($_POST['prosecutor'])) {
        $prosecutor = $_POST['prosecutor'];
        $reason_to_done_query .= " AND prosecutor.id in (" . implode(",", array_map("intval", $prosecutor)) . ")";
    }
    if ($_POST['all_in_year']==='1'){
        $reason_to_done_query.=" AND YEAR(case_has_investigation.receive_date) = YEAR(CURDATE())";
    }else{
        if (isset($_POST['date_from']) AND !empty($_POST['date_from'])){

            $date_from = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_from']))->format("Y-n-j");
            $reason_to_done_query.=" AND case_has_investigation.receive_date >= '$date_from'";

        }
        if (isset($_POST['date_to']) AND !empty($_POST['date_to'])){
            $date_to = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_to']))->format("Y-n-j");
            $reason_to_done_query.=" AND case_has_investigation.receive_date <= '$date_to' ";
        }
    };
    $reason_to_done_query .= "GROUP BY 
  case_has_investigation.id_case_has_investigation";
//    if (isset($_POST['prosecutor']) AND !empty($_POST['prosecutor'])){
//
//        $prosecutor_name .=" AND prosecutor.id in (" . implode(",", array_map("intval", $prosecutor)) . ")";
//
//    }
//    $prosecutor_name.=" ORDER BY prosecutor.name ASC";
    $reason_to_done_query = mysqli_query($con, $reason_to_done_query);
    ?>
    <div class="table-responsive">
        <table id="datatable2" style="text-align: center;" class="rtl table table-hover table-bordered" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th style="text-align: center;">م</th>
                <th style="text-align: center;">الرقم القضائي</th>
                <th style="text-align: center;">رقم الحصر</th>
                <th style="text-align: center;">وكيل النيابة</th>
                <th style="text-align: center;">سبب البقاء</th>
                <th style="text-align: center;">ملاحظات</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $x = '1';
            while ($reason_to_done_info = mysqli_fetch_assoc($reason_to_done_query)) {
                ?>
                <tr data-child-value="<?php
                ?>">
                    <td><?php echo $x ?></td>
                    <td>
                        <?php echo $reason_to_done_info['investigation_number'] . " / " . $reason_to_done_info['investigation_year'] ?>
                    </td>
                    <td>
                        <?php echo $reason_to_done_info['case_number'] . " / " . $reason_to_done_info['case_year'] . " / " . $reason_to_done_info['main_ledger_name'] . " / " . $reason_to_done_info['depart_name'] ?>
                    </td>
                    <td>
                        <?php echo $reason_to_done_info['prosecutor_name'] ?>
                    </td>
                    <td><?php
                        $y=1;

                        $combined_reason_to_done_query = mysqli_query($con, "
                        SELECT
  reason_to_done.id_reason_to_done,
  reason_to_done.name
FROM
  case_has_investigation
  INNER JOIN case_has_investigation_has_reason_to_done ON
    case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
  INNER JOIN reason_to_done ON case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done =
    reason_to_done.id_reason_to_done
WHERE
  case_has_investigation.id_case_has_investigation = '$reason_to_done_info[id_case_has_investigation]'
                        ");
                        while ($combined_reason_to_done_info = mysqli_fetch_assoc($combined_reason_to_done_query)) {
                            ?><button type="button" class="btn waves-effect waves-light btn-danger"><?php echo $combined_reason_to_done_info['name']?></button><?php
                            if (mysqli_num_rows($combined_reason_to_done_query)!=$y){
                                echo " - ";
                                $y++;
                            }
                        }?></td>
                    <td>
                        <?php echo $reason_to_done_info['notes'] ?>
                    </td>
                </tr>
                <?php
                $x++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
<script>
    $('#datatable2').DataTable({
        pageLength: 10,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom: 'B',
        buttons: [
            'excel'
        ]
    });
</script>