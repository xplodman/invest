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
            <!-- ============================================================== -->
            <!-- search form -->
            <?php
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
  case_status.name AS case_status_name,
  initial_action.initial_action_id,
  initial_action.initial_action_name,
  final_action.final_action_id,
  final_action.final_action_name
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
  INNER JOIN case_has_investigation_has_charges ON
    case_has_investigation_has_charges.case_has_investigation_id_case_has_investigation =
    case_has_investigation.id_case_has_investigation
  LEFT JOIN final_action ON case_has_investigation.final_action_id = final_action.final_action_id
  LEFT JOIN initial_action ON case_has_investigation.initial_action_id = initial_action.initial_action_id
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  pros.id = '$_GET[pros_id]'
GROUP BY 
  `case`.id
ORDER BY
  case_has_investigation.investigation_year DESC,
  case_has_investigation.investigation_number DESC";
            ?>
            <!-- end of search form -->
            <!-- ============================================================== -->
<?php //echo $investigation_query ?>
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="table-responsive">
                                <table id="datatable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="10%">رقم الحصر </th>
                                        <th width="10%">الرقم القضائي </th>
                                        <th class="selectable_column" width="17%">وكيل النيابة </th>
                                        <th class="searchable_column" width="5%">التهمة </th>
                                        <th width="20%">سبب البقاء </th>
                                        <th class="selectable_column" width="20%">حالة القضية </th>
                                        <th class="selectable_column" width="20%">التصرف المبدئي </th>
                                        <th class="selectable_column" width="20%">التصرف النهائي </th>
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
                                                    <button type="button" class="btn waves-effect waves-light btn-info">
                                                        <?php echo $investigation_info['investigation_number']." / ".$investigation_info['investigation_year']?>
                                                    </button>
                                            </td>
                                            <td>
                                                <?php echo $investigation_info['case_number']." / ".$investigation_info['case_year']." <br> ".$investigation_info['main_ledger_name']." / ".$investigation_info['depart_name']?>
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
  case_has_investigation_has_charges.deleted = 0
GROUP BY
  case_has_investigation_has_charges.case_has_investigation_has_charges_id");
                                                $color = "purple";
                                                while ($reason_to_done_info = $reason_to_done->fetch_assoc()) {
                                                    ?>
                                                    <h4>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary">
                                                        <?php
                                                        echo $reason_to_done_info['charges_name']
                                                        ?>
                                                       </button>
                                                    </h4>
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
                                                    <h4>
                                                        <button type="button" class="btn waves-effect waves-light btn-danger">
                                                            <?php
                                                            echo $reason_to_done_info['reason_to_done_name']
                                                            ?>
                                                        </button>
                                                    </h4>
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
                                                <?php
                                                echo $investigation_info['initial_action_name']
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $investigation_info['final_action_name']
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th width="10%">رقم الحصر </th>
                                        <th width="10%">الرقم القضائي </th>
                                        <th width="17%">وكيل النيابة </th>
                                        <th width="5%">التهمة </th>
                                        <th width="20%">سبب البقاء </th>
                                        <th width="20%">حالة القضية </th>
                                        <th width="20%">التصرف المبدئي </th>
                                        <th width="20%">التصرف النهائي </th>
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
                this.api().columns(':eq(2),:eq(5),:eq(6),:eq(7)').every( function () {
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
            order: [],
            dom: 'lfrtip',
        });
        $('#datatable tfoot th').not(':eq(2),:eq(5),:eq(6),:eq(7),:eq(8)').each(function() {
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
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 150; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var y = 1; //Initial field counter is 1
        var fieldHTML = '<div class="form-group row col-sm-12"><div class="col-sm-2"><button type="button" class="btn btn-danger btn-circle remove_button"><i class="fa fa-minus"></i> </button></div><div class="col-sm-4"><div class="form-group has-danger"><input required type="text" name="investigation_session_date[]" id="" class="form-control date_autoclose filters" placeholder="تاريخ الجلسة" autocomplete="off"></div></div><div class="col-sm-6"><div class="form-group has-danger"><input type="text" name="investigation_session_note[]" id="" class="form-control" placeholder="ملاحظات"></div></div></div>'; //New input field html
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            y++; //Increment field counter
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
                jQuery('.date_autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'd-m-yy',
                    showWeek: true,
                    firstDay: 1
                });
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>