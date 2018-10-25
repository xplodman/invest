<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'التقارير';
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
                <div class="col-lg-12">
                    <div class="card">
                        <a class=" waves-effect waves-dark" data-target="#search">
                            <div class="card-header bg-info">
                                <h4 class="blink m-b-0 text-white ">تحديد التقرير</h4>
                            </div>
                        </a>
                        <div class="card-body" id="search">
                            <form method="post" id="form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label FOR="prosecutor" class="control-label">أسم العضو المعروض عليه
                                                القضية</label>
                                            <select multiple="multiple"
                                                    class="select2 form-control custom-select filters"
                                                    name="prosecutor[]" id="prosecutor"
                                                    style="width: 100%; height:100%;">
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
                                                $results = mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $prosecutor) {
                                                    ?>
                                                    <option value="<?php echo $prosecutor["id"]; ?>"

                                                        <?php
                                                        if (!empty($_POST['prosecutor'])) {
                                                            if ($prosecutor['id'] == $_POST['prosecutor']) {
                                                                echo 'selected="selected"';
                                                            }
                                                        } ?>
                                                    ><?php echo $prosecutor["name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="checkbox" id="all_prosecutor" class="filled-in chk-col-red"/>
                                        <label for="all_prosecutor">إختيار كل الأعضاء</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label for="date_from" class="control-label">تاريخ الورود من</label>
                                                    <input required type="text" name="date_from" id="date_from" class="form-control date_autoclose filters" placeholder="تاريخ الورود من">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                    <label for="date_to" class="control-label">تاريخ الورود إلى</label>
                                                    <input required type="text" name="date_to" id="date_to" class="form-control date_autoclose filters" placeholder="تاريخ الورود إلى">

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="0" name="all_in_year" class="filled-in chk-col-red filters"/>
                                        <input type="checkbox" value="1" id="all_in_year" name="all_in_year" class="filled-in chk-col-red filters"/>
                                        <label for="all_in_year">داخل السنة بأكملها</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" id="content">
                        </div>
                    </div>
                </div>
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
<script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<!-- ============================================================== -->
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<!-- ============================================================== -->
<!-- Chart JS -->
<script src="assets/plugins/c3-master/c3.min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<!-- ============================================================== -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    function blink(selector) {
        $(selector).fadeOut('slow', function () {
            $(this).fadeIn('slow', function () {
                blink(this);
            });
        });
    }

    blink('.blink');
</script>
<script>
    $(".select2").select2();

    $("#all_reason_to_done").change(function () {
        if ($("#all_reason_to_done").is(':checked')) {
            $("#reason_to_done > option").prop("selected", true);
            $("#reason_to_done").trigger("change");
        } else {
            $("#reason_to_done > option").prop("selected", false);
            $("#reason_to_done").trigger("change");
        }
    });

    $("#all_prosecutor").change(function () {
        if ($("#all_prosecutor").is(':checked')) {
            $("#prosecutor > option").prop("selected", true);
            $("#prosecutor").trigger("change");
        } else {
            $("#prosecutor > option").prop("selected", false);
            $("#prosecutor").trigger("change");
        }
    });

    $("#all_status").change(function () {
        if ($("#all_status").is(':checked')) {
            $("#status > option").prop("selected", true);
            $("#status").trigger("change");
        } else {
            $("#status > option").prop("selected", false);
            $("#status").trigger("change");
        }
    });

    $("#all_in_year").change(function () {
        if ($("#all_in_year").is(':checked')) {
            $("#date_from").prop('disabled', true);
            $("#date_to").prop('disabled', true);
        } else {
            $("#date_from").prop('disabled', false);
            $("#date_to").prop('disabled', false);
        }
    });
</script>
<script src="../assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script>
    $(".filters").change(function () {
        var form_data = $('form').serialize();

        var charges = $("#charges option:selected").val();
        var reason_to_done = $("#reason_to_done option:selected").val();
        var prosecutor = $("#prosecutor option:selected").val();
        var status = $("#status option:selected").val();
        $.ajax({
            type: "POST",
            url: "php/get_report_data.php",
            data: form_data,

            success: function (data) {
                $("#content").html(data);
            }
        });
//            var $container = $("#content");
//            $container.load("test.php");
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>