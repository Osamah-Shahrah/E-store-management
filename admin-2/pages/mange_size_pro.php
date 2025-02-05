<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";





static $size_id = 0;


if (isset($_GET['size_id'])) {


    $size_id = $_GET['size_id'];

    static $cat_fk_id;
    static $size;
    static $details;
    static $form_state;

    $sql_quer_size_form = "SELECT * FROM `form_size` WHERE `id_form`='" . $size_id . "';";



    $execution_query_size_form = mysqli_query($con, $sql_quer_size_form) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_size_form) > 0) {
        while ($array_size_form = mysqli_fetch_array($execution_query_size_form)) {



            $cat_fk_id = $array_size_form['cat_fk_id'];

            $size = $array_size_form['size'];

            $details = $array_size_form['details'];





            $form_state = $array_size_form['form_state'];
            if ($array_size_form['form_state']) {
                $size_state_form_status_sc = "checked";
            } else {
                $size_state_form_status_sc = "check";
            }
        }
    }
}


?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إدارة الاحجام</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-size"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-size active">إدارة الاحجام</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row">


            <div class="col-md-12">
                <div class="card card-success">
                    <div class="card-header">
                        <?php if ($size_id > 0) {
                        ?>
                        <h5> تعديل بيانات الحجم</h5>
                        <?php } else {
                        ?>
                        <h5> إضافة حجم</h5>

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
                                    <select name="size_depart" id="size_depart" class="form-control select2bs4"  style="width: 100%;"
                                        aria-label="اختر اي من الاقسام"
                                        required>


                                        <?php
                                        $depart_selected = 0;
                                        if ($size_id > 0) {
                                            $result_11 = mysqli_query($con, "SELECT DISTINCT depart.name_depart,cat.depart_id from categories cat JOIN department depart ON cat.depart_id=depart.deprat_id WHERE `cat_id`='" . $cat_fk_id . "'  ") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_11) != 0) {
                                                $rowes = mysqli_fetch_array($result_11);
                                                $depart_selected = $rowes['depart_id'];
                                                echo " <option value='$rowes[depart_id]'> $rowes[name_depart]</option>";
                                            }
                                        } else {
                                            echo "<option value='0'>أختر القسم</option>";
                                        }

                                        $result = mysqli_query($con, "SELECT  * FROM `department` WHERE `depart_state`<=2 AND deprat_id!='" . $depart_selected . "' ; ") or die(mysqli_error($con));
                                        if (mysqli_num_rows($result) == 0) {
                                            echo "<option value='0'>لا يوجد أقسام</option>";
                                        }
                                        while ($r = mysqli_fetch_array($result)) {
                                        ?>

                                        <option value="<?php echo $r['deprat_id'] ?>">


                                            <?php echo $r['name_depart'] ?>

                                        </option>
                                        <!-- cod for take the cate on select the department -->

                                        <?php
                                        }

                                        ?>
                                    </select>

                                    <label>الصنف</label>
                                    <select name="size_cat" id="size_cat" class="form-control select2bs4"  style="width: 100%;"  aria-label="اختر اي من الاصناف"
                                        required >

                                        <?php
                                        $depart_selected = 0;
                                        if ($size_id > 0) {
                                            $result_12 = mysqli_query($con, "SELECT DISTINCT `cat_id`,`cat_title` FROM `categories` WHERE `cat_id` =(SELECT DISTINCT  `cat_fk_id` from form_size WHERE `id_form`='" . $size_id . "') ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_12) != 0) {
                                                $rowes = mysqli_fetch_array($result_12);
                                                $depart_selected = $rowes['cat_id'];
                                                echo " <option value='$rowes[cat_id]'> $rowes[cat_title]</option>";
                                            }


                                            $result = mysqli_query($con, "SELECT * FROM `categories` WHERE `depart_id` =(SELECT DISTINCT  `depart_id` from categories WHERE `cat_id`='" . $cat_fk_id . "') and cat_id!='" . $depart_selected . "'   ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result) == 0) {
                                                echo "<option value='0'>لا يوجد اصناف</option>";
                                            }
                                            while ($r = mysqli_fetch_array($result)) {
                                        ?>

                                        <option value="<?php echo $r['cat_id'] ?>">


                                            <?php echo $r['cat_title'] ?>

                                        </option>
                                        <!-- cod for take the cate on select the department -->

                                        <?php
                                            }
                                        } else {
                                            echo "<option value='0'>أختر الصنف</option>";
                                        }

                                        ?>

                                    </select>

                                    <label>الاحجام الموجودة</label>
                                    <select name="form_size" id="form_size" class="form-control select2bs4"  style="width: 100%;" aria-label="اختر اي من الاحجام"
                                        required >

                                        <?php
                                        $size_selected = 0;
                                        if ($size_id > 0) {
                                            $result_13 = mysqli_query($con, "SELECT DISTINCT `id_form`,`size` FROM `form_size` WHERE id_form='" . $size_id . "' ; ") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_13) != 0) {
                                                $rowes = mysqli_fetch_array($result_13);
                                                $size_selected = $rowes['id_form'];
                                                echo " <option value='$rowes[id_form]'> $rowes[size]</option>";
                                            }


                                            $result_14 = mysqli_query($con, "SELECT DISTINCT `id_form`,`size` FROM `form_size` WHERE cat_fk_id ='" . $cat_fk_id . "' And id_form!='" . $size_selected . "'   ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_14) == 0) {
                                                echo "<option value='0'>لا يوجد احجام</option>";
                                            }
                                            while ($r = mysqli_fetch_array($result_14)) {
                                        ?>

                                        <option value="<?php echo $r['id_form'] ?>">


                                            <?php echo $r['size'] ?>

                                        </option>
                                        <!-- cod for take the cate on select the department -->

                                        <?php
                                            }
                                        } else {
                                            echo "<option value='0'>أختر حجم</option>";
                                        }

                                        ?>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="size_title"> أسم الحجم</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="size_title" id="size_title"
                                            required placeholder="اسم الحجم"
                                            value="<?php if ($size_id > 0) {
                                                                                                                                                                echo $size;
                                                                                                                                                            } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="size_id" id="size_id" value="<?php if ($size_id > 0) {
                                                                                                                echo $size_id;
                                                                                                            } ?>">



                                <div class="form-group">
                                    <label for="size_details">وصف الحجم</label>
                                    <div class="input-group">
                                        <textarea name="size_details" id="size_details" class="form-control m-1"
                                            rows="3" tabindex="4" placeholder="بيانات الحجم"
                                            style="height: 80px;"><?php if ($size_id > 0) {
                                                                                                                                                                                            echo $details;
                                                                                                                                                                                        } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($size_id > 0) {
                                ?>
                                <button class="btn btn-block btn-warning" id="add_form_size_or_updata" type="submit"
                                    name="add_form_size_or_updata">تعديل
                                    <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                    <button class="btn btn-block btn-info" id="add_form_size_or_updata" type="submit"
                                        name="add_form_size_or_updata">إضافة
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
                        <h5>جدول الاوصاف</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="size_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>القسم</th>
                                        <th> الصنف</th>
                                        <th>الحجم</th>
                                        <th>بيانات الحجم</th>
                                        <th>حاله الحجم</th>
                                        <th>الوصول</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;
                                    $sql_7 = "SELECT cat.cat_title,`id_form`,`cat_fk_id`,`size`,`details`,`form_state`,depart.name_depart FROM `form_size` size_form JOIN categories cat ON size_form.cat_fk_id=cat.cat_id JOIN department depart ON cat.depart_id=depart.deprat_id;";
                                    $result = mysqli_query($con, $sql_7) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td><?php echo $r['name_depart'] ?></td>
                                        <td><?php echo $r['cat_title'] ?></td>
                                        <td>

                                            <?php echo $r['size'] ?>

                                            <input type="text" name="size_id" id='size_id' style='display: none;'
                                                value=" <?php echo $r['id_form']; ?>"></input>
                                        </td>





                                        <td><?php echo $r['details'] ?></td>



                                        <td>
                                            <?php
                                                if ($r['form_state'] == 3) {

                                                    $state_size_sc = "check";
                                                } else {
                                                    $state_size_sc = "checked";
                                                }
                                                ?>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_size_1"
                                                    name="state_size_1" value="<?php echo $r['form_state']; ?>"
                                                    <?php echo $state_size_sc; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>


                                        </td>
                                        <td>
                                            <?php
                                                if ($r['form_state'] == 1) {
                                                    $state_size_sc = "checked";
                                                } else {
                                                    $state_size_sc = "check";
                                                }
                                                ?>

                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_size_2"
                                                    name="state_size_2" value="<?php echo $r['form_state']; ?>"
                                                    <?php echo $state_size_sc; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>


                                        </td>
                                        <td>

                                            <a title="تعديل البيانات" class="btn btn-info btn-sm "
                                                href="mange_size_pro.php?size_id=<?php echo $r['id_form'] ?>"
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
                <!-- /.card -->

            </div>
        </div>
    </div>
</section>


<?php
include "footer.php";


?>