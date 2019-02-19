<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'إعدادات التصرفات';
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
                <div class="col-md-4 align-self-center">
                    <h3 class="text-themecolor">التصرفات</h3>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_initial_action"> إضافة تصرف</button>
                </div>
                <div class="col-md-1 align-self-center">

                </div>
                <div class="col-md-4 align-self-center">
                    <h3 class="text-themecolor">التصرفات النهائية</h3>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_final_action"> إضافة تصرف نهائي </button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="15%">الرقم الموحد</th>
                                        <th width="85%">أسم التصرف</th>
                                        <?php
                                        if ($_SESSION['cj_investigation']['role_id']=='1'){
                                            ?>
                                            <th width="15%">تفعيل التصرف</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $initial_action_query="SELECT
  initial_action.initial_action_id,
  initial_action.initial_action_name,
  initial_action.status
FROM
  initial_action
WHERE
  initial_action.deleted = 0";
                                    $initial_action_result = mysqli_query($con, $initial_action_query);
                                    while($initial_action_info = mysqli_fetch_assoc($initial_action_result)) {
                                        if ($_SESSION['cj_investigation']['role_id']!='1' & $initial_action_info['status']=='0'){
                                            goto  end_while;
                                        }
                                        ?>
                                        <tr data-child-value="<?php
                                        ?>">
                                            <td>
                                                <?php echo $initial_action_info['initial_action_id']?>
                                            </td>
                                            <td>
                                                <?php echo $initial_action_info['initial_action_name']?>
                                            </td>
                                            <?php
                                            if ($_SESSION['cj_investigation']['role_id']=='1'){
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($initial_action_info['status']=='1'){
                                                        ?>
                                                        <a href="php/change_initial_action_status.php?initial_action_id=<?php echo $initial_action_info['initial_action_id']."&".'status=0' ?>">
                                                            <button type="button" class="btn waves-effect waves-light btn-danger">
                                                                تعطيل
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }elseif($initial_action_info['status']=='0'){
                                                        ?>
                                                        <a href="php/change_initial_action_status.php?initial_action_id=<?php echo $initial_action_info['initial_action_id']."&".'status=1' ?>">
                                                            <button type="button" class="btn waves-effect waves-light btn-info">
                                                                تفعيل
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        end_while:
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th width="15%">الرقم الموحد</th>
                                        <th width="85%">أسم التصرف</th>
                                        <?php
                                        if ($_SESSION['cj_investigation']['role_id']=='1'){
                                            ?>
                                            <th width="15%">تفعيل التصرف</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable_2" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="15%">الرقم الموحد</th>
                                        <th width="85%">أسم التصرف النهائي</th>
                                        <?php
                                        if ($_SESSION['cj_investigation']['role_id']=='1'){
                                            ?>
                                            <th width="15%">تفعيل التصرف</th>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $final_action_query="SELECT
  final_action.final_action_id,
  final_action.final_action_name,
  final_action.status
FROM
  final_action
WHERE
  final_action.deleted = 0";
                                    $final_action_result = mysqli_query($con, $final_action_query);
                                    while($final_action_info = mysqli_fetch_assoc($final_action_result)) {
                                        if ($_SESSION['cj_investigation']['role_id']!='1' & $final_action_info['status']=='0'){
                                            goto  end_while_2;
                                        }
                                        ?>
                                        <tr data-child-value="<?php
                                        ?>">
                                            <td>
                                                <?php echo $final_action_info['final_action_id']?>
                                            </td>
                                            <td>
                                                <?php echo $final_action_info['final_action_name']?>
                                            </td>
                                            <?php
                                            if ($_SESSION['cj_investigation']['role_id']=='1'){
                                                ?>
                                                <td>
                                                    <?php
                                                    if ($final_action_info['status']=='1'){
                                                        ?>
                                                        <a href="php/change_final_action_status.php?final_action_id=<?php echo $final_action_info['final_action_id']."&".'status=0' ?>">
                                                            <button type="button" class="btn waves-effect waves-light btn-danger">
                                                                تعطيل
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }elseif($final_action_info['status']=='0'){
                                                        ?>
                                                        <a href="php/change_final_action_status.php?final_action_id=<?php echo $final_action_info['final_action_id']."&".'status=1' ?>">
                                                            <button type="button" class="btn waves-effect waves-light btn-info">
                                                                تفعيل
                                                            </button>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        end_while_2:
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th width="15%">الرقم الموحد</th>
                                        <th width="85%">أسم التصرف</th>
                                        <?php
                                        if ($_SESSION['cj_investigation']['role_id']=='1'){
                                            ?>
                                            <th width="15%">تفعيل التصرف</th>
                                            <?php
                                        }
                                        ?>
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
                this.api().columns(':eq(99),:eq(3)').every( function () {
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
        $('#datatable tfoot th').not(':eq(99),:eq(5),:eq(2)').each(function() {
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
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function() {
        $('#datatable_2').DataTable({
            initComplete: function () {
                this.api().columns(':eq(99),:eq(3)').every( function () {
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
        $('#datatable_2 tfoot th').not(':eq(99),:eq(5),:eq(2)').each(function() {
            var title = $(this).text();
            $(this).html('<input class="col-lg-12" type="text" placeholder="'+title+'" />');
        });
        // DataTable
        var table = $('#datatable_2').DataTable();
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