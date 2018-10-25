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
                <div class="">
                    <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_investigation_record"> إضافة قيد </button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- search form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <a class="collapse-link  waves-effect waves-dark" data-toggle="collapse" data-target="#search">
                            <div class="card-header bg-info">
                                <h4 class="<?php if (isset($_POST['submit'])){echo"blink";} ?> m-b-0 text-white ">للبحث داخل الدفتر</h4>
                            </div>
                        </a>
                        <?php
                        if (isset($_POST['submit']))
                        {
                            $investigation_query="SELECT
  case_has_investigation.investigation_number,
  case_has_investigation.investigation_year,
  `case`.case_number,
  `case`.case_year,
  depart.name AS depart_name,
  main_ledger.name AS main_ledger_name,
  case_has_investigation.case_status_idcase_status,
  users.nickname,
  prosecutor.name AS prosecutor_name,
  case_has_investigation.id_case_has_investigation,
  case_has_investigation.createdate,
  case_status.name AS case_status_name
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN main_ledger ON `case`.main_ledger_id = main_ledger.id
  INNER JOIN users ON case_has_investigation.users_id = users.id
  INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
  INNER JOIN case_status ON case_has_investigation.case_status_idcase_status = case_status.idcase_status
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
  INNER JOIN case_has_investigation_has_charges ON case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation = case_has_investigation.id_case_has_investigation
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  pros_has_users.users_id = '$user_id'";
                            if (!empty($_POST['investigation_number'])) {
                                $investigation_number=$_POST['investigation_number'];
                                if(trim($investigation_number) != ''){$investigation_query .= " AND  `case_has_investigation`.investigation_number='$investigation_number'";}
                            }
                            if (!empty($_POST['investigation_year'])) {
                                $investigation_year=$_POST['investigation_year'];
                                if(trim($investigation_year) != ''){$investigation_query .= " AND  `case_has_investigation`.investigation_year='$investigation_year'";}
                            }
                            if (!empty($_POST['case_number'])) {
                                $case_number=$_POST['case_number'];
                                if(trim($case_number) != ''){$investigation_query .= " AND  `case`.case_number='$case_number' ";}
                            }
                            if (!empty($_POST['case_year'])) {
                                $case_year=$_POST['case_year'];
                                if(trim($case_year) != ''){$investigation_query .= " AND  `case`.case_year='$case_year'";}
                            }
                            if (!empty($_POST['case_main_ledger'])) {
                                $case_main_ledger=$_POST['case_main_ledger'];
                                if(trim($case_main_ledger) != ''){$investigation_query .= " AND   main_ledger.id ='$case_main_ledger'";}
                            }
                            if (!empty($_POST['case_depart'])) {
                                $depart=$_POST['case_depart'];
                                if(trim($depart) != ''){$investigation_query .= " AND depart.id ='$depart'";}
                            }
                            if (!empty($_POST['prosecutor'])) {
                                $prosecutor=$_POST['prosecutor'];
                                if(trim($prosecutor) != ''){$investigation_query .= " AND prosecutor.id ='$prosecutor'";}
                            }
                            if (!empty($_POST['charges'])) {
                                $charges=$_POST['charges'];
                                if(trim($charges) != ''){$investigation_query .= " AND case_has_investigation_has_charges.charges_id_charges ='$charges'";}
                            }
                            if (!empty($_POST['reason_to_done'])) {
                                $reason_to_done=$_POST['reason_to_done'];
                                if(trim($reason_to_done) != ''){$investigation_query .= " AND case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done = '$reason_to_done'";}
                            }
                            if (!empty($_POST['case_status'])) {
                                $case_status=$_POST['case_status'];
                                if(trim($case_status) != ''){$investigation_query .= " AND case_status.idcase_status = '$case_status'";}
                            }
                            $investigation_query .= " GROUP BY case.id";
                        }else{
                            $investigation_query="SELECT
  case_has_investigation.investigation_number,
  case_has_investigation.investigation_year,
  `case`.case_number,
  `case`.case_year,
  depart.name AS depart_name,
  main_ledger.name AS main_ledger_name,
  case_has_investigation.case_status_idcase_status,
  users.nickname,
  prosecutor.name AS prosecutor_name,
  case_has_investigation.id_case_has_investigation,
  case_has_investigation.createdate,
  case_status.name AS case_status_name
FROM
  case_has_investigation
  INNER JOIN `case` ON case_has_investigation.case_id = `case`.id
  INNER JOIN depart ON `case`.depart_id = depart.id
  INNER JOIN main_ledger ON `case`.main_ledger_id = main_ledger.id
  INNER JOIN users ON case_has_investigation.users_id = users.id
  INNER JOIN prosecutor ON case_has_investigation.prosecutor_id = prosecutor.id
  INNER JOIN case_status ON case_has_investigation.case_status_idcase_status = case_status.idcase_status
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
  INNER JOIN case_has_investigation_has_charges ON case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation = case_has_investigation.id_case_has_investigation

WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  pros_has_users.users_id = '$user_id'
GROUP BY 
  `case`.id";
                        }?>
                        <div class="collapse card-body" id="search">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم الحصر</label>
                                        <div class="col-md-1">
                                            <div class="form-group has-danger">
                                                <input type="number" name="investigation_number" id="investigation_number" class="form-control" placeholder="رقم" value="<?php if (!empty($_POST['investigation_number'])) {echo $_POST['investigation_number'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group has-danger">
                                                <input  type="number" name="investigation_year" id="investigation_year" class="form-control" placeholder="سنة" value="<?php if (!empty($_POST['investigation_year'])) {echo $_POST['investigation_year'];}?>">
                                            </div>
                                        </div>
                                        <label for="example-search-input" class="col-md-2 col-form-label"></label>
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم القضية</label>
                                        <div class="col-md-1">
                                            <div class="form-group has-danger">
                                                <input type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم" value="<?php if (!empty($_POST['case_number'])) {echo $_POST['case_number'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group has-danger">
                                                <input type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة" value="<?php if (!empty($_POST['case_year'])) {echo $_POST['case_year'];}?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <select name="case_main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>جدول</option>
                                                    <?php
                                                    $query = "SELECT
  main_ledger.id,
  main_ledger.name
FROM
  main_ledger";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $main_ledger){
                                                        ?>
                                                        <option value="<?php echo $main_ledger["id"];?>"

                                                            <?php
                                                            if (!empty($_POST['case_main_ledger'])) {
                                                                if($main_ledger['id']==$_POST['case_main_ledger']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>

                                                        ><?php echo $main_ledger["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-danger">
                                                <select  name="case_depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>القسم</option>
                                                    <?php
                                                    $query = "SELECT
  depart.id,
  depart.name
FROM
  depart
  INNER JOIN pros ON depart.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id'";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $depart){
                                                        ?>
                                                        <option value="<?php echo $depart["id"];?>"

                                                            <?php
                                                            if (!empty($_POST['case_depart'])) {
                                                                if($depart['id']==$_POST['case_depart']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>

                                                        ><?php echo $depart["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">التهم</label>
                                                <select class="select2 form-control custom-select" name="charges"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT
  charges.id_charges,
  charges.name AS charges_name
FROM
  charges
WHERE
  charges.status = 1 AND
  charges.deleted = 0";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $charges){
                                                        ?>
                                                        <option value="<?php echo $charges["id_charges"];?>"
                                                            <?php
                                                            if (!empty($_POST['charges'])) {
                                                                if($charges['id_charges']==$_POST['charges']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>
                                                        ><?php echo $charges["charges_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">سبب البقاء</label>
                                                <select class="select2 form-control custom-select" name="reason_to_done" style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT
                                                      reason_to_done.id_reason_to_done,
                                                      reason_to_done.name AS reason_to_done_name
                                                    FROM
                                                      reason_to_done
WHERE
  reason_to_done.status = 1 AND
  reason_to_done.deleted = 0";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $reason_to_done){
                                                        ?>
                                                        <option value="<?php echo $reason_to_done["id_reason_to_done"];?>"
                                                            <?php
                                                            if (!empty($_POST['reason_to_done'])) {
                                                                if($reason_to_done['id_reason_to_done']==$_POST['reason_to_done']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>
                                                        ><?php echo $reason_to_done["reason_to_done_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">أسم العضو المعروض عليه القضية</label>
                                                <select  name="prosecutor" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT
  prosecutor.id,
  prosecutor.name
FROM
  prosecutor
  INNER JOIN pros ON prosecutor.pros_id = pros.id
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id' AND prosecutor.status = '1'";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $prosecutor){
                                                        ?>
                                                        <option value="<?php echo $prosecutor["id"];?>"

                                                            <?php
                                                            if (!empty($_POST['prosecutor'])) {
                                                                if($prosecutor['id']==$_POST['prosecutor']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>
                                                        ><?php echo $prosecutor["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">حالة القضية</label>
                                                <select  name="case_status" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
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
                                                        <option value="<?php echo $case_status["idcase_status"];?>"
                                                            <?php
                                                            if (!empty($_POST['case_status'])) {
                                                                if($case_status['idcase_status']==$_POST['case_status']){
                                                                    echo 'selected="selected"';
                                                                }
                                                            }?>
                                                        ><?php echo $case_status["case_status_name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="form-actions">
                                        <button name="submit" type="submit" class="btn btn-success"> <i class="fa fa-check"></i> بحث</button>
                                        <a name="reset_search" href="investigation.php" class="btn btn-danger"> <i class=""></i> إلغاء البحث</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of search form -->
            <!-- ============================================================== -->
<?php //echo $investigation_query ?>
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%">رقم الحصر </th>
                                        <th width="18%">الرقم القضائي </th>
                                        <th class="selectable_column" width="17%">وكيل النيابة </th>
                                        <th class="searchable_column" width="13%">التهمة </th>
                                        <th width="20%">سبب البقاء </th>
                                        <th class="selectable_column" width="20%">حالة القضية </th>
                                        <th width="9%"></th><!--tools-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $result = mysqli_query($con, $investigation_query);
                                    while($investigation_info = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr data-child-value="<?php
                                        ?>">
                                            <td>
                                                <?php echo $investigation_info['investigation_number']." / ".$investigation_info['investigation_year']?>
                                            </td>
                                            <td>
                                                <?php echo $investigation_info['case_number']." / ".$investigation_info['case_year']." / ".$investigation_info['main_ledger_name']." / ".$investigation_info['depart_name']?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $investigation_info['prosecutor_name']
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $reason_to_done = mysqli_query($con, "
																SELECT
  charges.name AS charges_name
FROM
  case_has_investigation_has_charges
  INNER JOIN charges ON case_has_investigation_has_charges.charges_id_charges = charges.id_charges
  INNER JOIN case_has_investigation ON case_has_investigation.id_case_has_investigation =
    case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation
WHERE
  case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation] AND
  case_has_investigation_has_charges.status = 1 AND
  case_has_investigation_has_charges.deleted = 0");
                                                $color = "purple";
                                                while ($reason_to_done_info = $reason_to_done->fetch_assoc()) {
                                                    ?>
                                                    <button type="button" class="btn waves-effect waves-light btn-primary">
                                                        <?php
                                                        echo $reason_to_done_info['charges_name']
                                                        ?>
                                                       </button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $reason_to_done = mysqli_query($con, "
																SELECT
  reason_to_done.name AS reason_to_done_name,
  case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id
FROM
  case_has_investigation_has_reason_to_done
  INNER JOIN reason_to_done ON case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done =
    reason_to_done.id_reason_to_done
  INNER JOIN case_has_investigation ON
    case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
WHERE
  case_has_investigation_has_reason_to_done.case_has_investigation_id_case_has_investigation = $investigation_info[id_case_has_investigation] AND
  case_has_investigation_has_reason_to_done.status = 1 AND
  case_has_investigation_has_reason_to_done.deleted = 0");
                                                $color = "purple";
                                                while ($reason_to_done_info = $reason_to_done->fetch_assoc()) {
                                                    ?>
                                                <button type="button" class="btn waves-effect waves-light btn-danger">
                                                        <?php
                                                        echo $reason_to_done_info['reason_to_done_name']
                                                        ?>
                                                </button>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $investigation_info['case_status_name']
                                                ?>
                                            </td>
                                            <td>
                                                <a href="investigation_profile.php?id=<?php echo $investigation_info['id_case_has_investigation'] ?>">
                                                    <button type="button" class="btn waves-effect waves-light btn-info">
                                                        للتعديل
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th width="10%">رقم الحصر </th>
                                        <th width="18%">الرقم القضائي </th>
                                        <th width="17%">وكيل النيابة </th>
                                        <th width="13%">التهمة </th>
                                        <th width="20%">سبب البقاء </th>
                                        <th width="20%">حالة القضية </th>
                                        <th class="unsearchable" width="9%"></th><!--tools-->
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    // DataTable
</script>
<script>
    // Date Picker
    jQuery('.date_autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'd-m-yy'
    });
</script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('#datatable').DataTable({
            initComplete: function () {
                this.api().columns(':eq(2),:eq(5)').every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            },
            pageLength: 10,
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            order: [2, 'desc'],
            dom: 'lfrtip',
        });
        $('#datatable tfoot th').not(':eq(2),:eq(5),:eq(6)').each(function() {
            var title = $(this).text();
            $(this).html('<input class="col-lg-12" type="text" placeholder="'+title+'" />');
        });
        // DataTable
        var table = $('#datatable').DataTable();
        // Apply the search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
    });
</script>
<script>
    function blink(selector){
        $(selector).fadeOut('slow', function(){
            $(this).fadeIn('slow', function(){
                blink(this);
            });
        });
    }

    blink('.blink');
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>