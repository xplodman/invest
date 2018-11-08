<div class="modal inmodal" id="add_charge" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">إضافة تهمة</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_charge.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="charge_name" class="col-md-2 col-form-label">أسم التهمة</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="charge_name" id="charge_name" class="form-control" placeholder="أسم التهمة">
                                    <small class="form-control-feedback"> سوف يقوم النظام بإعتماد هذه التهمة في خلال 24 ساعة إلا أن تكون مكررة </small>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> تسجيل</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_reason_to_done" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">إضافة سبب للبقاء</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_reason_to_done.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="charge_name" class="col-md-2 col-form-label">أسم سبب البقاء</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="reason_to_done_name" id="reason_to_done_name" class="form-control" placeholder="أسم سبب البقاء">
                                    <small class="form-control-feedback"> سوف يقوم النظام بإعتماد هذا السبب في خلال 24 ساعة إلا أن يكون مكرراً </small>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> تسجيل</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_prosecuter" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">إضافة عضو نيابة</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_prosecuter.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="charge_name" class="col-md-2 col-form-label">أسم العضو</label>
                            <div class="col-md-10">
                                <div class="form-group has-danger">
                                    <input required  type="text" name="prosecuter_name" id="prosecuter_name" class="form-control" placeholder="أسم العضو">
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
                                        foreach ($results as $depart){
                                            ?>
                                            <option value="<?php echo $depart["id"];?>"><?php echo $depart["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> تسجيل</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal" id="add_investigation_record" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">إضافة قيد</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="php/add_investigation_record.php">
                    <div class="form-body">
                        <div class="form-group row">
                            <label for="example-search-input" class="col-md-1 col-form-label">رقم الحصر</label>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="investigation_number" id="investigation_number" class="form-control" placeholder="رقم">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <input required type="number" name="investigation_year" id="investigation_year" class="form-control" placeholder="سنة">
                                </div>
                            </div>
                            <label for="receive_date" class="col-md-2 col-form-label">تاريخ الورود</label>
                            <div class="col-md-4">
                                <div class="form-group has-danger">
                                    <input required type="text" name="receive_date" id="receive_date" class="form-control date_autoclose filters" placeholder="تاريخ الورود">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-search-input" class="col-md-1 col-form-label">رقم القضية</label>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group has-danger">
                                    <input required  type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <select required name="case_main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
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
                                            <option value="<?php echo $main_ledger["id"];?>"><?php echo $main_ledger["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-danger">
                                    <select required name="case_depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
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
                                            <option value="<?php echo $depart["id"];?>"><?php echo $depart["name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-danger">
                                    <label class="control-label">التهم</label>
                                    <select multiple="multiple" class="form-control custom-select select2" name="charges[]" style="width: 100%; height:100%;">
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
                                            <option value="<?php echo $charges["id_charges"];?>"><?php echo $charges["charges_name"];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-danger">
                                    <label class="control-label">سبب البقاء</label>
                                    <select multiple="multiple" class="form-control custom-select select2" name="reason_to_done[]" style="width: 100%; height:100%;">
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
                                            <option value="<?php echo $prosecutor["id"];?>"><?php echo $prosecutor["name"];?></option>
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
                                            <option value="<?php echo $case_status["idcase_status"];?>"><?php echo $case_status["case_status_name"];?></option>
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
                                    <textarea name="notes" maxlength="200" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> تسجيل</button>
                            <button class="btn btn-inverse" type="button" data-dismiss="modal">إلغاء</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
