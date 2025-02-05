<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";





static $items_id = 0;


if (isset($_GET['items_id'])) {


    $items_id = $_GET['items_id'];

    static $fk_cat_ite_for;
    static $na_ite_fo;
    static $detali_ite_fo;
    static $img_ite_for;
    static $status_ite_for;

    $sql_quer_items_form = "SELECT * FROM `form_items_pro` WHERE `id_ite_for`='" . $items_id . "';";



    $execution_query_items_form = mysqli_query($con, $sql_quer_items_form) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_items_form) > 0) {
        while ($array_items_form = mysqli_fetch_array($execution_query_items_form)) {



            $fk_cat_ite_for = $array_items_form['fk_cat_ite_for'];

            $na_ite_fo = $array_items_form['na_ite_fo'];

            $detali_ite_fo = $array_items_form['detali_ite_fo'];


            $img_ite_for = $array_items_form['img_ite_for'];


            $status_ite_for = $array_items_form['status_ite_for'];
            if ($array_items_form['status_ite_for']) {
                $status_ite_for_form_status_sc = "checked";
            } else {
                $status_ite_for_form_status_sc = "check";
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
                <h1 style="float: right;">إدارة الاوصاف</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة الاوصاف</li>

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
                        <?php if ($items_id > 0) {
                        ?>
                        <h5> تعديل بيانات الوصف</h5>
                        <?php } else {
                        ?>
                        <h5> إضافة وصف</h5>

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
                                    <select name="pro_depart" id="pro_depart"
                                    class="form-control select2bs4"  style="width: 100%;" aria-label="اختر اي من الاقسام"
                                        required >


                                        <?php
                                        $depart_selected = 0;
                                        if ($items_id > 0) {
                                            $result_11 = mysqli_query($con, "SELECT DISTINCT depart.name_depart,cat.depart_id from categories cat JOIN department depart ON cat.depart_id=depart.deprat_id WHERE `cat_id`='" . $fk_cat_ite_for . "'  ") or die(mysqli_error($con));
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
                                    <select name="fk_cat_ite_for" id="fk_cat_ite_for" class="form-control select2bs4"  style="width: 100%;"
                                       aria-label="اختر اي من الاوصاف"
                                        required >

                                        <?php
                                        $depart_selected = 0;
                                        if ($items_id > 0) {
                                            $result_12 = mysqli_query($con, "SELECT DISTINCT `cat_id`,`cat_title` FROM `categories` WHERE `cat_id` =(SELECT DISTINCT  `fk_cat_ite_for` from form_items_pro WHERE `id_ite_for`='" . $items_id . "') ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_12) != 0) {
                                                $rowes = mysqli_fetch_array($result_12);
                                                $depart_selected = $rowes['cat_id'];
                                                echo " <option value='$rowes[cat_id]'> $rowes[cat_title]</option>";
                                            }


                                            $result = mysqli_query($con, "SELECT * FROM `categories` WHERE `depart_id` =(SELECT DISTINCT  `depart_id` from categories WHERE `cat_id`='" . $fk_cat_ite_for . "') and cat_id!='" . $depart_selected . "'   ;") or die(mysqli_error($con));
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

                                    <label>الاوصاف المتوفرة</label>
                                    <select name="items_mange" id="items_mange" class="form-control select2bs4"  style="width: 100%;"
                                       aria-label="اختر اي من الاوصاف"
                                        required >

                                        <?php
                                        $item_selected = 0;
                                        if ($items_id > 0) {
                                            $result_15 = mysqli_query($con, "SELECT DISTINCT `id_ite_for`,`na_ite_fo` FROM `form_items_pro` WHERE `id_ite_for`='".$items_id."' ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_15) != 0) {
                                                $rowes = mysqli_fetch_array($result_15);
                                                $item_selected = $rowes['id_ite_for'];
                                                echo " <option value='$rowes[id_ite_for]'> $rowes[na_ite_fo]</option>";
                                            }


                                            $result_16 = mysqli_query($con, "SELECT * FROM `form_items_pro` WHERE `fk_cat_ite_for` ='".$fk_cat_ite_for."' AND id_ite_for!='" . $item_selected . "'   ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_16) == 0) {
                                                echo "<option value='0'>لا يوجد اوصاف</option>";
                                            }
                                            while ($r = mysqli_fetch_array($result_16)) {
                                        ?>

                                        <option value="<?php echo $r['id_ite_for'] ?>">


                                            <?php echo $r['na_ite_fo'] ?>

                                        </option>
                                        <!-- cod for take the cate on select the department -->

                                        <?php
                                            }
                                        } else {
                                            echo "<option value='0'>أختر الوصف</option>";
                                        }

                                        ?>


                                    </select>



                                </div>
                                <div class="form-group">
                                    <label for="items_title"> أسم الوصف</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="items_title" id="items_title"
                                            required placeholder="اسم الوصف"
                                            value="<?php if ($items_id > 0) {
                                                                                                                                                                echo $na_ite_fo;
                                                                                                                                                            } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="items_id" id="items_id" value="<?php if ($items_id > 0) {
                                                                                                                    echo $items_id;
                                                                                                                } ?>">


                                <div class="form-group">
                                    <label for="imgpro"> صورة الوصف</label>
                                    <div class="input-group">
                                        <input type="file" name="picture" id="imgpro"
                                            accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                        <img id="proimg" src="<?php if ($items_id > 0) {
                                                                    echo "../../img/items_photo/$img_ite_for";
                                                                } ?>" width='100px' height='100px'
                                            class='img-fluid rounded'
                                            <?php if ($items_id == 0) {
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
                                    <label for="items_details">وصف الصنف</label>
                                    <div class="input-group">
                                        <textarea name="items_details" id="items_details" class="form-control m-1"
                                            rows="3" tabindex="4" placeholder="بيانات الوصف"
                                            style="height: 80px;"><?php if ($items_id > 0) {
                                                                                                                                                                                                echo $detali_ite_fo;
                                                                                                                                                                                            } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($items_id > 0) {
                                ?>
                                <button class="btn btn-block btn-warning" id="add_form_items_or_updata" type="submit"
                                    name="add_form_items_or_updata">تعديل
                                    <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                    <button class="btn btn-block btn-info" id="add_form_items_or_updata" type="submit"
                                        name="add_form_items_or_updata">إضافة
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

                            <table id="items_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>القسم</th>
                                        <th> الصنف</th>
                                        <th>الوصف</th>
                                        <th>بيانات الوصف</th>
                                        <th>حاله الوصف</th>
                                        <th>الوصول للوصف</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;
                                    $sql_7 = "SELECT cat.cat_title,`id_ite_for`,`fk_cat_ite_for`,`na_ite_fo`,`detali_ite_fo`,`img_ite_for`,`status_ite_for`,depart.name_depart FROM `form_items_pro` item_form JOIN categories cat ON item_form.fk_cat_ite_for=cat.cat_id JOIN department depart ON cat.depart_id=depart.deprat_id;";
                                    $result = mysqli_query($con, $sql_7) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td><?php echo $r['name_depart'] ?></td>
                                        <td><?php echo $r['cat_title'] ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded'
                                                src="../../img/items_photo/<?php echo $r['img_ite_for']; ?>"
                                                alt="<?php echo $r['na_ite_fo']; ?>">



                                            <?php echo $r['na_ite_fo'] ?>

                                            <input type="text" name="items_id" id='items_id' style='display: none;'
                                                value=" <?php echo $r['id_ite_for']; ?>"></input>
                                        </td>





                                        <td><?php echo $r['detali_ite_fo'] ?></td>



                                        <td>
                                            <?php
                                                if ($r['status_ite_for'] == 3) {

                                                    $state_items_sc = "check";
                                                } else {
                                                    $state_items_sc = "checked";
                                                }
                                                ?>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_items_1"
                                                    name="state_items_1" value="<?php echo $r['status_ite_for']; ?>"
                                                    <?php echo $state_items_sc; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>


                                        </td>
                                        <td>
                                            <?php
                                                if ($r['status_ite_for'] == 1) {
                                                    $state_items_sc = "checked";
                                                } else {
                                                    $state_items_sc = "check";
                                                }
                                                ?>

                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="state_items_2"
                                                    name="state_items_2" value="<?php echo $r['status_ite_for']; ?>"
                                                    <?php echo $state_items_sc; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>


                                        </td>
                                        <td>

                                            <a title="تعديل البيانات" class="btn btn-info btn-sm "
                                                href="mange_items_pro.php?items_id=<?php echo $r['id_ite_for'] ?>"
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