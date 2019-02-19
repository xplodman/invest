<?php

if (isset($_POST['charges']) AND !empty($_POST['charges'])){
//    echo '<pre>'; print_r($_POST['charges']); echo '</pre>';
}
if (isset($_POST['reason_to_done']) AND !empty($_POST['reason_to_done'])){
//    echo '<pre>'; print_r($_POST['reason_to_done']); echo '</pre>';
}
if (isset($_POST['case_status']) AND !empty($_POST['case_status'])){
//    echo '<pre>'; print_r($_POST['case_status']); echo '</pre>';
}

include_once "../php/connection.php";
include_once "../php/check_authentication.php";
include_once "../php/functions.php";
$user_id=$_SESSION['cj_investigation']['id'];
$user_nickname=$_SESSION['cj_investigation']['nickname'];
$user_job=$_SESSION['cj_investigation']['job'];
if (isset($_POST['prosecutor']) AND !empty($_POST['prosecutor'])){
    $prosecutor = $_POST['prosecutor'];
    $prosecutor_name="SELECT prosecutor.id, prosecutor.name FROM prosecutor WHERE 1+1";

    if (isset($_POST['prosecutor']) AND !empty($_POST['prosecutor'])){

        $prosecutor_name .=" AND prosecutor.id in (" . implode(",", array_map("intval", $prosecutor)) . ")";

    }
    $prosecutor_name.=" ORDER BY prosecutor.name ASC";
    $prosecutor_name = mysqli_query($con, $prosecutor_name);
    ?>
    <div class="table-responsive">
        <table id="datatable" style="text-align: center;" class="rtl table table-hover table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%" style="text-align: center;">م </th>
                <th width="40%" style="text-align: center;">أسم العضو </th>
                <th width="20%" style="text-align: center;">المتداول </th>
                <th width="20%" style="text-align: center;">تم التصرف </th>
                <th width="18%" style="text-align: center;">نسبة الإنجاز </th>

            </tr>
            </thead>
            <tbody>
            <?php
            $x='1';
            while($prosecutor_name_info = mysqli_fetch_assoc($prosecutor_name)) {
                ?>
                <tr data-child-value="<?php
                ?>">
                    <td><?php echo $x?></td>
                    <td><?php echo $prosecutor_name_info['name']?></td>
                    <td>
                        <?php
                        $prosecutor_id = $prosecutor_name_info['id'];
                        $undone_Count_investigation_query="SELECT
          Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS undone_Count_investigation
          FROM
          case_has_investigation
          INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
        WHERE
          case_has_investigation.status = 1 AND
          case_has_investigation.deleted = 0 AND
          case_has_investigation.case_status_idcase_status = 2 AND prosecutor.id = '$prosecutor_id'";

                        if ($_POST['all_in_year']==='1'){
                            $undone_Count_investigation_query.=" AND YEAR(case_has_investigation.receive_date) = YEAR(CURDATE())";
                        }else{
                            if (isset($_POST['date_from']) AND !empty($_POST['date_from'])){

                                $date_from = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_from']))->format("Y-n-j");
                                $undone_Count_investigation_query.=" AND case_has_investigation.receive_date >= '$date_from'";

                            }
                            if (isset($_POST['date_to']) AND !empty($_POST['date_to'])){
                                $date_to = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_to']))->format("Y-n-j");
                                $undone_Count_investigation_query.=" AND case_has_investigation.receive_date <= '$date_to'";

                            }
                        }

                        $undone_Count_investigation_query.=" GROUP BY prosecutor.name";
                        $undone_Count_investigation = mysqli_query($con, $undone_Count_investigation_query)or die(mysqli_error($con));

                        $undone_Count_investigation_info = mysqli_fetch_assoc($undone_Count_investigation);
                        if($undone_Count_investigation_info['undone_Count_investigation'] == null){echo '0';}else{echo $undone_Count_investigation_info['undone_Count_investigation']; }
                        ?>
                    </td>
                    <td>
                        <?php
                        $prosecutor_id = $prosecutor_name_info['id'];
                        $done_Count_investigation_query="SELECT
          Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS done_Count_investigation
          FROM
          case_has_investigation
          INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
        WHERE
          case_has_investigation.status = 1 AND
          case_has_investigation.deleted = 0 AND
          case_has_investigation.case_status_idcase_status = 1 AND prosecutor.id = '$prosecutor_id' ";


                        if ($_POST['all_in_year']==='1'){
                            $done_Count_investigation_query.=" AND YEAR(case_has_investigation.receive_date) = YEAR(CURDATE())";
                        }else{
                            if (isset($_POST['date_from']) AND !empty($_POST['date_from'])){

                                $date_from = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_from']))->format("Y-n-j");
                                $done_Count_investigation_query.=" AND case_has_investigation.receive_date >= '$date_from'";

                            }
                            if (isset($_POST['date_to']) AND !empty($_POST['date_to'])){
                                $date_to = DateTime::createFromFormat('d/m/Y',mysqli_real_escape_string($con, $_POST['date_to']))->format("Y-n-j");
                                $done_Count_investigation_query.=" AND case_has_investigation.receive_date <= '$date_to' ";
                            }
                        };

                        $done_Count_investigation = mysqli_query($con, $done_Count_investigation_query)or die(mysqli_error($con));

                        $done_Count_investigation_info = mysqli_fetch_assoc($done_Count_investigation);
                        if($done_Count_investigation_info['done_Count_investigation'] == null){echo '0';}else{echo $done_Count_investigation_info['done_Count_investigation']; }
                        ?>
                    </td>
                    <td>
                        <?php
                        $original= $undone_Count_investigation_info['undone_Count_investigation']+$done_Count_investigation_info['done_Count_investigation'];
                        $current = $done_Count_investigation_info['done_Count_investigation'];
                        if ($original=='0'){
                            $percentChange='0';
                        }else{
                            $percentChange = ($current/$original)*100;
                        }
                        echo number_format((float)$percentChange, 0, '.', '').' %';
                        ?>
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
    $(document).ready(function() {
        $('#datatable').DataTable({
            pageLength: 1000,
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
    });
</script>