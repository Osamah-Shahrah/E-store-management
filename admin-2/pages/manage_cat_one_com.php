<?php
include "../db.php";


global $com_id;

if (isset($_GET['com_id'])) {

    $com_id = $_GET['com_id'];
}

static $id_cat_com = 0;


if (isset($_GET['id_cat_com'])) {


    $id_cat_com = $_GET['id_cat_com'];

    static $cat_id_fk;
    static $id_depart_com_fk;
    static $deprat_id_fk;
    static $com_id_fk;
    static $name_depart_form;
    static $name_cat_form;
    static $cat_image_com;
    static $cat_details_com;
    static $state_cat_com;

    $sql_quer_cat_form = "SELECT * FROM categories_com cat_com JOIN department_com dep_com ON cat_com.id_depart_com_fk=dep_com.id_depart_com WHERE `id_cat_com`='" . $id_cat_com . "' AND com_id_fk='" . $com_id . "'  ;";



    $execution_query_cat_form = mysqli_query($con, $sql_quer_cat_form) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_cat_form) > 0) {
        while ($array_bunch_form = mysqli_fetch_array($execution_query_cat_form)) {


            $cat_id_fk = $array_bunch_form['cat_id_fk'];

            $id_depart_com_fk = $array_bunch_form['id_depart_com_fk'];

            $deprat_id_fk = $array_bunch_form['deprat_id_fk'];


            $com_id_fk = $array_bunch_form['com_id_fk'];

            $name_depart_form = $array_bunch_form['name_depart_form'];

            $name_cat_form = $array_bunch_form['name_cat_form'];

            $cat_image_com = $array_bunch_form['cat_image_com'];


            $cat_details_com = $array_bunch_form['cat_details_com'];


            $state_cat_com = $array_bunch_form['state_cat_com'];
            if ($array_bunch_form['state_cat_com']) {
                $state_cat_com_y = "checked";
            } else {
                $state_cat_com_y = "check";
            }
        }
    }
}














?>




<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row">


            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <?php if ($id_cat_com > 0) {
                        ?>
                        <h5> تعديل بيانات الصنف</h5>
                        <?php } else {
                        ?>
                        <h5> إضافة صنف</h5>

                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="insert_data_admin.php" id="" class="text-start g-3 needs-validation row"
                            method="POST" type="form" name="" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>القسم</label>
                                    <select name="id_depart_com_fk" id="id_depart_com_fk" class="form-control select2bs4"  style="width: 100%;"
                                        required>


                                        <?php
                                        $depart_selected = 0;
                                        if ($id_cat_com > 0) {
                                            $result_10 = mysqli_query($con, "SELECT  * FROM categories_com cat_com JOIN department_com dep_com ON cat_com.id_depart_com_fk=dep_com.id_depart_com WHERE cat_com.com_id_fk='" . $com_id . "' And cat_com.`id_cat_com`='" . $id_cat_com . "'") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_10) != 0) {
                                                $rowes = mysqli_fetch_array($result_10);
                                                $depart_selected = $rowes['id_depart_com'];
                                                echo " <option value='$rowes[id_depart_com]'> $rowes[name_depart_com]</option>";
                                            }
                                        } else {
                                            echo "<option value='0'>أختر القسم</option>";
                                        }

                                        $result = mysqli_query($con, "SELECT  * FROM department_com   WHERE `com_id`='" . $com_id . "'  AND `depart_state_com`<=2 AND id_depart_com!='" . $depart_selected . "' ; ") or die(mysqli_error($con));
                                        if (mysqli_num_rows($result) == 0) {
                                            echo "<option value='0'>لا يوجد أقسام</option>";
                                        }
                                        while ($r = mysqli_fetch_array($result)) {
                                        ?>

                                        <option value="<?php echo $r['id_depart_com'] ?>">


                                            <?php echo $r['name_depart_com'] ?>

                                        </option>
                                        <!-- cod for take the cate on select the department -->

                                        <?php
                                        }

                                        ?>
                                    </select>


                                </div>


                                <div class="form-group">
                                    <label for="name_cat_form"> أسم الصنف</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="name_cat_form" id="name_cat_form"
                                            required placeholder="اسم الصنف"
                                            value="<?php if ($id_cat_com > 0) {
                                                                                                                                                                    echo $name_cat_form;
                                                                                                                                                                } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="id_cat_com" id="id_cat_com"
                                    value="<?php if ($id_cat_com > 0) {
                                                                                                                        echo $id_cat_com;
                                                                                                                    } ?>">


                                <div class="form-group">
                                    <label for="imgpro"> صورة الصنف</label>
                                    <div class="input-group">
                                        <input type="file" name="picture" id="imgpro"
                                            accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                        <img id="proimg" src="<?php if ($id_cat_com > 0) {
                                                                    echo "../../img/cat_images/$cat_image_com";
                                                                } ?>" width='100px' height='100px'
                                            class='img-fluid rounded'
                                            <?php if ($id_cat_com == 0) {
                                                                                                                                    echo "style='display: none;'";
                                                                                                                                } ?>>

                                        <script>
                                        function openfile() {
                                            document.getElementById('imgpro').click();
                                        }
                                        $(document).ready(function() {
                                            var proimg = $("#proimg");

                                            $("#imgpro").change(function(e) {
                                                var tmppath = URL.createObjectURL(e.target.files[0]);

                                                proimg.fadeIn("fast").attr('src', tmppath)

                                            })
                                        })
                                        </script>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cat_details_com">وصف الصنف</label>
                                    <div class="input-group">
                                        <textarea name="cat_details_com" id="cat_details_com" class="form-control m-1"
                                            rows="3" tabindex="4" placeholder="وصف الصنف"
                                            style="height: 80px;"><?php if ($id_cat_com > 0) {
                                                                                                                                                                                                echo $cat_details_com;
                                                                                                                                                                                            } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($id_cat_com > 0) {
                                ?>
                                <button class="btn btn-block btn-warning" id="add_categories_or_updata_for_company"
                                    type="submit" name="add_categories_or_updata_for_company">تعديل
                                    <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                    <button class="btn btn-block btn-info" id="add_categories_or_updata_for_company"
                                        type="submit" name="add_categories_or_updata_for_company">إضافة
                                        <span data-feather="save"></span>

                                        <?php
                                    }
                                        ?>
                            </div>

                        </form>
                    </div>
                </div>



                <div class="card card-secondary">

                    <div class="card-header">
                        <h5>جدول الاصناف</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="cat_com_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>القسم</th>
                                        <th>الصنف</th>
                                        <th>وصف الصنف</th>
                                        <th>حاله الصنف</th>
                                        <th>الوصول للصنف</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;

                                    $result = mysqli_query($con, "SELECT * FROM categories_com cat_com JOIN department_com dep_com ON cat_com.id_depart_com_fk=dep_com.id_depart_com WHERE cat_com.com_id_fk='" . $com_id . "' ;") or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>

                                        <td><?php echo $r['name_depart_com'] ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded'
                                                src="../../img/cat_images/<?php echo $r['cat_image_com']; ?>"
                                                alt="<?php echo $r['name_cat_form']; ?>">



                                            <?php echo $r['name_cat_form'] ?>

                                            <input type="text" name="id_cat_com" id='id_cat_com' style='display: none;'
                                                value=" <?php echo $r['id_cat_com']; ?>"></input>
                                        </td>





                                        <td><?php echo $r['cat_details_com'] ?></td>



                                        <td>
                                            <?php
                                                if ($r['state_cat_com'] !=3 ) {

                                                    $state_cat_com = "checked";
                                                } else {
                                                    $state_cat_com = "check";
                                                }
                                                ?>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_cat_com1"
                                                    name="state_cat_com1" value="<?php echo $r['state_cat_com']; ?>"
                                                    <?php echo $state_cat_com; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>


                                        </td>
                                        <td>
                                            <?php
                                                if ($r['state_cat_com'] == 1) {
                                                    $state_cat_com = "checked";
                                                } else {
                                                    $state_cat_com = "check";
                                                }
                                                ?>

                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_cat_com2"
                                                    name="state_cat_com2" value="<?php echo $r['state_cat_com']; ?>"
                                                    <?php echo $state_cat_com; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />

                                            </div>


                                        </td>
                                        <td>

                                            <a title="تعديل البيانات" class="btn btn-info btn-sm "
                                                href="mange_one_company.php?id_cat_com=<?php echo $r['id_cat_com'] ?>&&com_id=<?php echo $com_id; ?>"
                                                role=" button"> <i class="fas fa-edit"></i></a>
                                        </td>


                                    </tr>
                                    <?php

                                    }

                                    ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</section>