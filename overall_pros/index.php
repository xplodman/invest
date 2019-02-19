<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'الصفحة الرئيسية';
include_once "layout/header.php";
include_once "php/check_authentication.php";
include_once "php/functions.php";
?>
<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">النيابة العامة</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <?php
        include_once "layout/topbar.php";
        include_once "layout/sidebar.php";
        ?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <?php
                    $pros_query="SELECT
  pros.id,
  pros.name
FROM
  overallpros_has_users
  INNER JOIN overallpros ON overallpros_has_users.overallpros_id = overallpros.id
  INNER JOIN pros ON pros.overallpros_id = overallpros.id
WHERE
  overallpros_has_users.users_id = '$user_id'
GROUP BY 
  pros.id";
                    $pros_query = mysqli_query($con, $pros_query);
                    while($pros_info = mysqli_fetch_assoc($pros_query)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="card">
                                <a href="investigation.php?pros_id=<?php echo $pros_info['id'] ?>">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div>
                                                <h4 class="card-title m-b-5"><span class="lstick"></span>إحصائية لدفتر حصر التحقيق لسنة <?php echo date('Y') ?> لنيابة <?php echo $pros_info['name'] ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="p-20 active text-center bg-info">
                                                <h4 class="text-white">ما تم حصره</h4>
                                                <h3 class="text-white m-b-0">
                                                    <?php
                                                    $all_case_has_investigation = mysqli_query($con,"SELECT
  Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  pros.id = '$pros_info[id]'");
                                                    $all_case_has_investigation = mysqli_fetch_assoc($all_case_has_investigation);

                                                    echo $all_case_has_investigation['Count_id_case_has_investigation'];
                                                    ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="p-20 active text-center bg-success">
                                                <h4 class="text-white">تم التصرف</h4>
                                                <h3 class="text-white m-b-0">
                                                    <?php
                                                    $done_case_has_investigation = mysqli_query($con,"SELECT
Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  case_has_investigation.case_status_idcase_status = 1 AND
  pros.id = '$pros_info[id]'");
                                                    $done_case_has_investigation = mysqli_fetch_assoc($done_case_has_investigation);

                                                    echo $done_case_has_investigation['Count_id_case_has_investigation'];
                                                    ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="p-20 active text-center bg-warning">
                                                <h4 class="text-white">متداول</h4>
                                                <h3 class="text-white m-b-0">
                                                    <?php
                                                    $undone_case_has_investigation = mysqli_query($con,"SELECT
  Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  case_has_investigation.case_status_idcase_status = 2 AND
  pros.id = '$pros_info[id]'");
                                                    $undone_case_has_investigation = mysqli_fetch_assoc($undone_case_has_investigation);

                                                    echo $undone_case_has_investigation['Count_id_case_has_investigation'];
                                                    ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- ============================================================== -->
                <!-- End PAge Content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php
            include_once "layout/footer.php";
            ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Chart JS -->
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <script src="assets/plugins/d3/d3.min.js"></script>
    <!-- ============================================================== -->
    <script>
        var chart = c3.generate({
            bindto: "#chart5",
            data: {
                columns: [
                    <?php
                    $query = "SELECT
  Count(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Count_charges,
  charges.name
FROM
  case_has_investigation_has_charges
  LEFT JOIN charges ON case_has_investigation_has_charges.charges_id_charges = charges.id_charges
  INNER JOIN case_has_investigation ON
    case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
  INNER JOIN `case` ON `case`.id = case_has_investigation.case_id
  INNER JOIN depart ON depart.id = `case`.depart_id
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id'
GROUP BY
  charges.name,
  charges.id_charges,
  pros_has_users.users_id
ORDER BY Count_charges DESC LIMIT 10";
                    $results=mysqli_query($con, $query);
                    while($y = mysqli_fetch_assoc($results)) {
                        echo "['".$y['name']."','".$y['Count_charges']."'],";
                    }
                    ?>

                ],
                type: 'donut',
                empty: {
                    label: {
                        text: "No Data Available"
                    }
                }
            },
            donut: {
                label: {
                    format: function(value, ratio, id) {
                        return value;
                    }
                }
            }
        });

        var chart = c3.generate({
            bindto: "#chart6",
            data: {
                columns: [
                    <?php
                    $query = "SELECT
  Count(case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS Count_reason_to_done,
  reason_to_done.name
FROM
  case_has_investigation_has_reason_to_done
  LEFT JOIN reason_to_done ON case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done =
    reason_to_done.id_reason_to_done
  INNER JOIN case_has_investigation ON
    case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON depart.id = `case`.depart_id
  INNER JOIN pros ON pros.id = depart.pros_id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id'
GROUP BY
  reason_to_done.name,
  pros_has_users.users_id
ORDER BY Count_reason_to_done DESC LIMIT 10";
                    $results=mysqli_query($con, $query);
                    while($y = mysqli_fetch_assoc($results)) {
                        echo "['".$y['name']."','".$y['Count_reason_to_done']."'],";
                    }
                    ?>

                ],
                type: 'donut',
                empty: {
                    label: {
                        text: "No Data Available"
                    }
                }
            },
            donut: {
                label: {
                    format: function(value, ratio, id) {
                        return value;
                    }
                }
            }
        });

        var chart = c3.generate({
            bindto: "#chart7",
            data: {
                x : 'x',
                columns: [
                    <?php
                    $x_query=mysqli_query($con, "SELECT
  prosecutor.id,
  prosecutor.name
FROM
  prosecutor
  INNER JOIN pros ON prosecutor.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id' AND prosecutor.status = '1'");

                    $x="['x'";
                    $y="['متداول'";
                    $z="['تم التصرف'";
                    while($x_result = mysqli_fetch_assoc($x_query)) {
                        $x.=",'".$x_result['name']."'";

                        $y_query=mysqli_query($con, "SELECT
          Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS undone_Count_investigation
          FROM
          case_has_investigation
          INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
        WHERE
          case_has_investigation.status = 1 AND
          case_has_investigation.deleted = 0 AND
          case_has_investigation.case_status_idcase_status = 2 AND prosecutor.id = '$x_result[id]'");
                        $y_result = mysqli_fetch_assoc($y_query);
                        $y.=",'".$y_result['undone_Count_investigation']."'";

                        $z_query=mysqli_query($con, "SELECT
          Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS done_Count_investigation
          FROM
          case_has_investigation
          INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
        WHERE
          case_has_investigation.status = 1 AND
          case_has_investigation.deleted = 0 AND
          case_has_investigation.case_status_idcase_status = 1 AND prosecutor.id = '$x_result[id]'");
                        $z_result = mysqli_fetch_assoc($z_query);
                        $z.=",'".$z_result['done_Count_investigation']."'";


                    }
                    $x.="],";
                    $y.="],";
                    $z.="],";
                    echo $x;
                    echo $y;
                    echo $z;
                    ?>
                ],
                type: 'bar',
                groups: [
                    ['متداول', 'تم التصرف']
                ],
                labels: true,
            },
            axis: {
                x: {
                    type: 'category', // this is needed to load string x value
                    tick: {
                        rotate: '45',
                        multiline: false
                    }
                }
            },
            grid: {
                y: {
                    lines: [{value:0}]
                }
            }
        });
    </script>

</body>
</html>