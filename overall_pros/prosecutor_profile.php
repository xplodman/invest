<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'عضو النيابة';
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
                    <h3 class="text-themecolor">عضو النيابة</h3>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- search form -->
            <!-- ============================================================== -->
            <?php
                $prosecutor_query="SELECT
  prosecutor.id,
  prosecutor.pros_id,
  prosecutor.name,
  prosecutor.status
FROM
  prosecutor
  INNER JOIN pros_has_users ON prosecutor.pros_id = pros_has_users.pros_id
WHERE
  prosecutor.id = '$_GET[id]'";?>
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
                                $result = mysqli_query($con, $prosecutor_query);
                                $prosecutor_info = mysqli_fetch_assoc($result);
                                ?>
                            <form method="post" action="php/edit_prosecutor.php?id=<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="prosecutor_id" id="prosecutor_id" value="<?php echo $_GET['id']; ?>">

                                <div class="form-group row">
                                    <label for="charge_name" class="col-md-2 col-form-label">أسم العضو</label>
                                    <div class="col-md-10">
                                        <div class="form-group has-danger">
                                            <input required  type="text" name="prosecuter_name" id="prosecuter_name" class="form-control" placeholder="أسم العضو" value="<?php echo $prosecutor_info['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pros_id" class="col-md-2 col-form-label">يتبع نيابة</label>
                                    <div class="col-md-10">
                                        <div class="form-group has-danger">
                                            <select required name="pros_id" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                <?php
                                                $query = "SELECT
  pros.id,
  pros.name
FROM
  pros
  INNER JOIN pros_has_users ON pros_has_users.pros_id = pros.id
WHERE
  pros_has_users.users_id = '$user_id'";
                                                $results=mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $pros){
                                                    ?>
                                                    <option <?php if ($prosecutor_info['pros_id']==$pros["id"]){echo 'selected';} ?> value="<?php echo $pros["id"];?>"><?php echo $pros["name"];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pros_id" class="col-md-2 col-form-label">حالة العضو</label>
                                    <div class="col-md-10">
                                        <div class="form-group has-danger">
                                            <select required name="status" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                <option <?php if ($prosecutor_info['status']=='1'){echo 'selected';} ?> value="1">مفعل</option>
                                                <option <?php if ($prosecutor_info['status']=='0'){echo 'selected';} ?> value="0">غير مفعل</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>
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