<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";





static $cat_id = 0;


if (isset($_GET['cat_id'])) {


    $cat_id = $_GET['cat_id'];

    static $cat_title;
    static $depart_id;
    static $state_cat;
    static $cat_image;
    static $cat_details;

    $sql_quer_cat_form = "SELECT * FROM `categories` WHERE `cat_id`='" . $cat_id . "';";



    $execution_query_cat_form = mysqli_query($con, $sql_quer_cat_form) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_cat_form) > 0) {
        while ($array_bunch_form = mysqli_fetch_array($execution_query_cat_form)) {



            $cat_title = $array_bunch_form['cat_title'];

            $depart_id = $array_bunch_form['depart_id'];

            $cat_image = $array_bunch_form['cat_image'];


            $cat_details = $array_bunch_form['cat_details'];


            $bunch_form_status = $array_bunch_form['state_cat'];
            if ($array_bunch_form['state_cat']) {
                $bunch_form_status_sc = "checked";
            } else {
                $bunch_form_status_sc = "check";
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
                <h1 style="float: right;">إدارة الاصناف</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة الاصناف</li>

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
                        <?php if ($cat_id > 0) {
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
                        <form action="insert_data_admin.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>القسم</label>
                                    <select name="deprat_id" id="deprat_id"  class="form-control select2bs4"  style="width: 100%;" aria-label="اختر اي من الاقسام" required >


                                        <?php
                                        $depart_selected = 0;
                                        if ($cat_id > 0) {
                                            $result_10 = mysqli_query($con, "SELECT DISTINCT depart.name_depart,cat.depart_id from categories cat JOIN department depart ON cat.depart_id=depart.deprat_id WHERE `cat_id`='" . $cat_id . "'  ") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result_10) != 0) {
                                                $rowes = mysqli_fetch_array($result_10);
                                                $depart_selected=$rowes['depart_id'];
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


                                </div>


                                <div class="form-group">
                                    <label for="cat_title"> أسم الصنف</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="cat_title" id="cat_title" required placeholder="اسم الصنف" value="<?php if ($cat_id > 0) {
                                                                                                                                                            echo $cat_title;
                                                                                                                                                        } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="cat_id" id="cat_id" value="<?php if ($cat_id > 0) {
                                                                                                                echo $cat_id;
                                                                                                            } ?>">


                                <div class="form-group">
                                    <label for="imgpro"> صورة الصنف</label>
                                    <div class="input-group">
                                        <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                        <img id="proimg" src="<?php if ($cat_id > 0) {
                                                                    echo "../../img/cat_images/$cat_image";
                                                                } ?>" width='100px' height='100px' class='img-fluid rounded' <?php if ($cat_id == 0) {
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
                                    <label for="cat_details">وصف الصنف</label>
                                    <div class="input-group">
                                        <textarea name="cat_details" id="cat_details" class="form-control m-1" rows="3" tabindex="4" placeholder="وصف الصنف" style="height: 80px;"><?php if ($cat_id > 0) {
                                                                                                                                                                                        echo $cat_details;
                                                                                                                                                                                    } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($cat_id > 0) {
                                ?>
                                    <button class="btn btn-block btn-warning" id="add_categories_or_updata" type="submit" name="add_categories_or_updata">تعديل
                                        <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                        <button class="btn btn-block btn-info" id="add_categories_or_updata" type="submit" name="add_categories_or_updata">إضافة
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

                            <table id="cat_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th> القسم</th>
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
                                    $sql_7 = "SELECT depart.name_depart,cat.cat_id,cat.cat_title,cat.state_cat,cat.cat_image,cat.cat_details from categories cat JOIN department depart ON cat.depart_id=depart.deprat_id;";
                                    $result = mysqli_query($con, $sql_7) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $count_row += 1; ?></td>

                                            <td><?php echo $r['name_depart'] ?></td>
                                            <td>
                                                <img width='50px' height='50px' class='img-fluid rounded' src="../../img/cat_images/<?php echo $r['cat_image']; ?>" alt="<?php echo $r['cat_title']; ?>">



                                                <?php echo $r['cat_title'] ?>

                                                <input type="text" name="cat_id" id='cat_id' style='display: none;' value=" <?php echo $r['cat_id']; ?>"></input>
                                            </td>





                                            <td><?php echo $r['cat_details'] ?></td>



                                            <td>
                                                <?php
                                                if ($r['state_cat'] == 3) {

                                                    $state_cat_sc = "check";
                                                } else {
                                                    $state_cat_sc = "checked";
                                                }
                                                ?>
                                                <div class="input-group">
                                                    <input type="checkbox" class="form-control" id="state_cat_1" name="state_cat_1" value="<?php echo $r['state_cat']; ?>" <?php echo $state_cat_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                                </div>


                                            </td>
                                            <td>
                                                <?php
                                                if ($r['state_cat'] == 1) {
                                                    $state_cat_sc = "checked";
                                                } else {
                                                    $state_cat_sc = "check";
                                                }
                                                ?>

                                                <div class="input-group">
                                                    <input type="checkbox" class="form-control" id="state_cat_2" name="state_cat_2" value="<?php echo $r['state_cat']; ?>" <?php echo $state_cat_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                                </div>


                                            </td>
                                            <td>

                                                <a title="تعديل البيانات" class="btn btn-info btn-sm " href="mange_categories.php?cat_id=<?php echo $r['cat_id'] ?>" role=" button"> <i class="fas fa-edit"></i></a>
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


                <!--   -------------------------------------------------------------------------------------------------->
                <div class="card card-secondary">

                    <div class="card-header">
                        <h5> الاصناف المقترحة </h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="cat_table_new" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المركز</th>
                                        <th>ألقسم</th>
                                        <th>الصنف</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>دمج البيانات مع</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;
                                    $result = mysqli_query($con, "SELECT * FROM categories_com cat_com JOIN company ON cat_com.com_id_fk=company.com_id WHERE cat_com.cat_id_fk=0 OR cat_com.deprat_id_fk=0;") or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $count_row += 1; ?></td>
                                            <td><?php echo $r['com_name'] ?></td>
                                            <td><?php echo $r['name_depart_form'] ?></td>
                                            <td>
                                                <img width='50px' height='50px' class='img-fluid rounded' src="../../img/cat_images/<?php echo $r['cat_image_com']; ?>" alt="<?php echo $r['name_cat_form']; ?>">



                                                <?php echo $r['name_cat_form'] ?>




                                                <input type="text" style='display: none;' name="id_cat_com" id='id_cat_com' value=" <?php echo $r['id_cat_com']; ?>"></input>
                                            </td>
                                            <td><?php echo $r['cat_details_com'] ?></td>

                                            <td>
                                                <?php
                                                if ($r['state_cat_com'] == 0) {

                                                    echo "<span class='float-right badge bg-warning'>طلب الاضافة</span>";
                                                } elseif ($r['state_cat_com'] == 1) {
                                                    echo "<span class='float-right badge bg-success'>فعال</span>";
                                                } elseif ($r['state_cat_com'] == 2) {
                                                    echo "<span class='float-right badge bg-info'>موقف الوصول من إدارة الموقع</span>";
                                                } elseif ($r['state_cat_com'] == 3) {
                                                    echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة الموقع</span>";
                                                } elseif ($r['state_cat_com'] == 4) {
                                                    echo "<span class='float-right badge bg-info'>موقف الوصول من إدارة المركز</span>";
                                                } elseif ($r['state_cat_com'] == 5) {
                                                    echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة المركز</span>";
                                                }
                                                ?>



                                            </td>
                                            <td>

                                                <input type="text" name="join_with_4" id='join_with_4' <?php if ($r['cat_id_fk'] == 0 && $r['deprat_id_fk'] == 0) {
                                                            echo "style='display: none;' > 
                                                            <span class='float-right badge bg-danger'> القسم لهاذا الصنف غير موجود سيتم إضافة القسم عندالموافقة</span";
                                                        } ?> >
                                            </td>

                                            <td>

                                                <input type="button" name="lol" id="lol" title="تعديل البيانات" class="btn btn-info btn-sm " value="قبول" role=" button">

                                            </td>


                                        </tr>
                                    <?php

                                    }

                                    ?>


                                    <script>
                                        //**************/ script to  butoon merge the categores  this cod used on page mange_categories  \\**************\                      
                                        $(document).ready(function() {
                                            $('input[name="lol"]').on('click', function(event, state) {

                                                var join_with_4 = $(this).closest('tr').find('input[name="join_with_4"]').val();
                                                var id_cat_com = $(this).closest('tr').find('input[name="id_cat_com"]').val();
                                                var rq = window.confirm("هل حقاً تريد إضافة القسم او دمجه");
                                                if (rq) {

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'insert_data_admin.php',
                                                        data: {
                                                            add_or_merge:1,
                                                            id_cat_com: id_cat_com,
                                                            join_with_1: join_with_4

                                                        },
                success: function (data, status) {
                    // Handle success response
                    if (status === 'success') {
                        window.location.reload();
                    }
                },
                error: function (req, status) {
                    // Handle error response
                    console.log(req);

                }

                                                    });

                                                }


                                            });
                                        });
                                    </script>


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