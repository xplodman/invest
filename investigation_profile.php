<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'حصر التحقيق';
include_once "layout/header.php";
include_once "php/check_authentication.php";
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-10 align-self-center">
                    <h3 class="text-themecolor">دفتر / حصر التحقيق</h3>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- search form -->
            <!-- ============================================================== -->
            <?php
                $investigation_query="
SELECT
  case_has_investigation.investigation_number,
  case_has_investigation.investigation_year,
  case_has_investigation.notes,
  `case`.case_number,
  `case`.case_year,
  depart.name AS depart_name,
  depart.id AS depart_id,
  main_ledger.name AS main_ledger_name,
  main_ledger.id AS main_ledger_id,
  case_has_investigation.case_status_idcase_status,
  users.nickname,
  prosecutor.id AS prosecutor_id,
  prosecutor.name AS prosecutor_name,
  case_has_investigation.id_case_has_investigation,
  case_has_investigation.createdate,
  case_status.idcase_status,
  case_status.name AS case_status_name,
  `case`.id AS case_id
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN main_ledger ON `case`.main_ledger_id = main_ledger.id
  INNER JOIN users ON case_has_investigation.users_id = users.id
  INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
  INNER JOIN case_status ON case_has_investigation.case_status_idcase_status = case_status.idcase_status
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  case_has_investigation.id_case_has_investigation = $_GET[id]";?>
            <!-- ============================================================== -->
            <!-- end of search form -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <a class="collapse-link" data-toggle="collapse" data-target="#search">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">تفاصيل السجل</h4>
                            </div>
                        </a>
                        <div class="card-body">
                                <?php
                                $result = mysqli_query($con, $investigation_query);
                                $investigation_info = mysqli_fetch_assoc($result);
                                ?>
                            <form method="post" action="php/edit_investigation_record.php?id=<?php echo $_GET['id']; ?>">

                                <input type="hidden" name="investigation_id" id="investigation_id" value="<?php echo $investigation_info['id_case_has_investigation']; ?>">
                                <input type="hidden" name="case_id" id="case_id" value="<?php echo $investigation_info['case_id']; ?>">

                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم الحصر</label>
                                        <div class="col-md-1">
                                            <label class="col-md-12 col-form-label">الرقم</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="investigation_number" id="investigation_number" class="form-control" placeholder="رقم" value="<?php echo $investigation_info['investigation_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="col-md-12 col-form-label">السنة</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"type="number" name="investigation_year" id="investigation_year" class="form-control" placeholder="سنة" value="<?php echo $investigation_info['investigation_year']; ?>">
                                            </div>
                                        </div>
                                        <label for="example-search-input" class="col-md-2 col-form-label"></label>
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم القضية</label>
                                        <div class="col-md-1">
                                            <label class="col-md-12 col-form-label">الرقم</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم" value="<?php echo $investigation_info['case_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="col-md-12 col-form-label">السنة</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة" value="<?php echo $investigation_info['case_year']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="col-md-12 col-form-label">الجدول</label>
                                                <select required name="main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>جدول</option>
                                                    <?php
                                                    $query = "SELECT * FROM main_ledger";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $main_ledger){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($main_ledger)) {
                                                                if((int)$investigation_info['main_ledger_id'] == (int)$main_ledger['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $main_ledger["id"];?>"><?php echo $main_ledger["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <label class="col-md-12 col-form-label">القسم</label>
                                                <select required name="depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>القسم</option>
                                                    <?php
                                                    $query = "SELECT * FROM depart";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $depart){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($depart)) {
                                                                if((int)$investigation_info['depart_id'] == (int)$depart['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $depart["id"];?>"><?php echo $depart["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">التهم</label>
                                                <select multiple="multiple" class="form-control custom-select bootstrapDualListbox" name="charges[]">
                                                    <?php
                                                    $query = "SELECT
  charges.name AS charges_name,
  charges.id_charges
FROM
  charges
  INNER JOIN case_has_investigation_has_charges ON case_has_investigation_has_charges.charges_id_charges =
    charges.id_charges
WHERE
  case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation]
  GROUP BY charges.id_charges";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $charges){
                                                        ?>
                                                        <option selected value="<?php echo $charges["id_charges"];?>"><?php echo $charges["charges_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $query = "SELECT
  charges.name AS charges_name,
  charges.id_charges
FROM
  charges
WHERE
  charges.id_charges not in (SELECT
  charges.id_charges
FROM
  charges
  INNER JOIN case_has_investigation_has_charges ON case_has_investigation_has_charges.charges_id_charges =
    charges.id_charges
WHERE
  case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation]
  GROUP BY charges.id_charges)
  GROUP BY charges.id_charges";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $charges){
                                                        ?>
                                                        <option value="<?php echo $charges["id_charges"];?>"><?php echo $charges["charges_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">سبب البقاء</label>
                                                <select multiple="multiple" class="form-control custom-select bootstrapDualListbox" name="reason_to_done[]">
                                                    <?php
                                                    $query = "SELECT
  reason_to_done.id_reason_to_done,
  reason_to_done.name AS reason_to_done_name
FROM
  reason_to_done
  INNER JOIN case_has_investigation_has_reason_to_done ON
    case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done = reason_to_done.id_reason_to_done
WHERE
  case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation]
  GROUP BY reason_to_done.id_reason_to_done";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $reason_to_done){
                                                        ?>
                                                        <option selected value="<?php echo $reason_to_done["id_reason_to_done"];?>"><?php echo $reason_to_done["reason_to_done_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $query = "SELECT
  reason_to_done.id_reason_to_done,
  reason_to_done.name AS reason_to_done_name
FROM
  reason_to_done
WHERE
  reason_to_done.id_reason_to_done NOT IN (
  SELECT
  reason_to_done.id_reason_to_done
FROM
  reason_to_done
  INNER JOIN case_has_investigation_has_reason_to_done ON
    case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done = reason_to_done.id_reason_to_done
WHERE
  case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation]
  GROUP BY reason_to_done.id_reason_to_done)
  GROUP BY reason_to_done.id_reason_to_done";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $reason_to_done){
                                                        ?>
                                                        <option value="<?php echo $reason_to_done["id_reason_to_done"];?>"><?php echo $reason_to_done["reason_to_done_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group has-danger">
                                                <label class="control-label">أسم العضو المعروض عليه القضية</label>
                                                <select required name="prosecutor" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <?php
                                                    $query = "SELECT * FROM prosecutor";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $prosecutor){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($prosecutor)) {
                                                                if((int)$investigation_info['prosecutor_id'] == (int)$prosecutor['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $prosecutor["id"];?>"><?php echo $prosecutor["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-danger">
                                                <label class="control-label">حالة القضية</label>
                                                <select required name="case_status" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT
                                                      case_status.idcase_status,
                                                      case_status.name AS case_status_name
                                                    FROM
                                                      case_status";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $case_status){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($case_status)) {
                                                                if((int)$investigation_info['idcase_status'] == (int)$case_status['idcase_status']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $case_status["idcase_status"];?>"><?php echo $case_status["case_status_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-md-1 col-form-label">ملاحظات</label>
                                        <div class="col-md-12">
                                            <div class="form-group has-danger">
                                                <textarea name="notes" maxlength="200" rows="2" class="form-control"><?php echo $investigation_info["notes"];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <?php
        include_once "layout/footer.php";
        include_once "layout/modals.php";
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
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- This is data table -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="assets/plugins/toast-master/js/jquery.toast.js"></script>

<!-- Bootstrap Duallistbox -->
<script src="assets/plugins/bootstrap-duallistbox/bootstrap-duallistbox.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<!-- end - This is for export functionality only -->
<script>
    $('#datatable').DataTable({
        aaSorting: [ ],
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ],
        columnDefs: [ {
            visible: false,
            targets:   -2
        } ]
    });

    // DataTable
    var table = $('#datatable').DataTable();
</script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function () {
        $(".select2").select2({
        });
        // Add event listener for opening and closing details
        $('#datatable').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
</script>
<script>
    // Date Picker
    jQuery('.date_autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'd-m-yy'
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>