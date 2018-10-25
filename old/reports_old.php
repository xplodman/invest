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
                                    <div class="col-md-3">
                                        <div class="form-group has-danger">
                                            <label class="control-label">التهم</label>
                                            <select multiple="multiple"
                                                    class="select2 form-control custom-select filters" name="charges[]" style="width: 100%; height:100%;">
                                                <?php
                                                $query = "SELECT
  charges.id_charges,
  charges.name AS charges_name
FROM
  charges
WHERE
  charges.status = 1 AND
  charges.deleted = 0";
                                                $results = mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $charges) {
                                                    ?>
                                                    <option value="<?php echo $charges["id_charges"]; ?>"
                                                        <?php
                                                        if (!empty($_POST['charges'])) {
                                                            if ($charges['id_charges'] == $_POST['charges']) {
                                                                echo 'selected="selected"';
                                                            }
                                                        } ?>
                                                    ><?php echo $charges["charges_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-danger">
                                            <label class="control-label">سبب البقاء</label>
                                            <select multiple="multiple"
                                                    class="select2 form-control custom-select filters"
                                                    name="reason_to_done[]" id="reason_to_done"
                                                    style="width: 100%; height:100%;">
                                                <?php
                                                $query = "SELECT
                                                      reason_to_done.id_reason_to_done,
                                                      reason_to_done.name AS reason_to_done_name
                                                    FROM
                                                      reason_to_done
WHERE
  reason_to_done.status = 1 AND
  reason_to_done.deleted = 0";
                                                $results = mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $reason_to_done) {
                                                    ?>
                                                    <option value="<?php echo $reason_to_done["id_reason_to_done"]; ?>"
                                                        <?php
                                                        if (!empty($_POST['reason_to_done'])) {
                                                            if ($reason_to_done['id_reason_to_done'] == $_POST['reason_to_done']) {
                                                                echo 'selected="selected"';
                                                            }
                                                        } ?>
                                                    ><?php echo $reason_to_done["reason_to_done_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="checkbox" id="all_reason_to_done" class="filled-in chk-col-red"/>
                                        <label for="all_reason_to_done">إختيار الكل</label>
                                    </div>
                                    <div class="col-md-3">
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
  pros_has_users.users_id = '$user_id'";
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
                                        <label for="all_prosecutor">إختيار الكل</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group has-danger">
                                            <label class="control-label">حالة القضية</label>
                                            <select name="case_status[]"
                                                    class="select2 form-control custom-select filters"
                                                    style="width: 100%; height:100%;" id="status" multiple="multiple">
                                                <?php
                                                $query = "SELECT
                                                      case_status.idcase_status,
                                                      case_status.name AS case_status_name
                                                    FROM
                                                      case_status";
                                                $results = mysqli_query($con, $query);
                                                //loop
                                                foreach ($results as $case_status) {
                                                    ?>
                                                    <option value="<?php echo $case_status["idcase_status"]; ?>"
                                                        <?php
                                                        if (!empty($_POST['case_status'])) {
                                                            if ($case_status['idcase_status'] == $_POST['case_status']) {
                                                                echo 'selected="selected"';
                                                            }
                                                        } ?>
                                                    ><?php echo $case_status["case_status_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="checkbox" id="all_status" class="filled-in chk-col-red"/>
                                        <label for="all_status">إختيار الكل</label>
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
<!-- ============================================================== -->
<!-- Chart JS -->
<script src="assets/plugins/c3-master/c3.min.js"></script>
<script src="assets/plugins/d3/d3.min.js"></script>
<!-- ============================================================== -->
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
</script>
<script>
    $(".filters").change(function () {
        var form_data = $('form').serialize();

        var charges = $("#charges option:selected").val();
        var reason_to_done = $("#reason_to_done option:selected").val();
        var prosecutor = $("#prosecutor option:selected").val();
        var status = $("#status option:selected").val();
        $.ajax({
            type: "POST",
            url: "test.php",
            data: form_data,

            success: function (data) {
                $("#content").html(data);
            }
        });
//            var $container = $("#content");
//            $container.load("test.php");
    });
</script>
<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

<?php
include_once "layout/common_script.php";
?>
</body>
</html>