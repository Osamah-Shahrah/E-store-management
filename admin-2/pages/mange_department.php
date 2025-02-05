<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";










static $deprat_id = 0;


if (isset($_GET['deprat_id'])) {


    $deprat_id = $_GET['deprat_id'];

    static $name_depart;
    static $about_depart;
    static $icon_depart;
    static $depart_state;

    $sql_quer_department = "SELECT * FROM `department` WHERE `deprat_id`='" . $deprat_id . "';";



    $execution_query_department = mysqli_query($con, $sql_quer_department) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_department) > 0) {
        while ($array_department = mysqli_fetch_array($execution_query_department)) {


            $deprat_id = $array_department['deprat_id'];
            $name_depart = $array_department['name_depart'];
            $about_depart = $array_department['about_depart'];
            $icon_depart = $array_department['icon_depart'];
            $depart_state = $array_department['depart_state'];
            if ($array_department['depart_state'] == 1) {
                $depart_state_sc = "checked";
            } else {
                $depart_state_sc = "check";
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
                <h1 style="float: right;">إدارة الاقسام</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة الاقسام</li>
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
                        <?php if ($deprat_id > 0) {
                        ?>
                            <h5> تعديل بيانات القسم</h5>
                        <?php } else {
                        ?>
                            <h5> إضافة قسم</h5>

                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="insert_data_admin.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name_depart"> أسم القسم</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="name_depart" id="name_depart" required placeholder="اسم القسم" value="<?php if ($deprat_id > 0) {
                                                                                                                                                                echo $name_depart;
                                                                                                                                                            } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="deprat_id" id="deprat_id" value="<?php if ($deprat_id > 0) {
                                                                                                                    echo $deprat_id;
                                                                                                                } ?>">


                                <div class="form-group">
                                    <label for="imgpro"> صورة القسم</label>
                                    <div class="input-group">
                                        <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                        <img id="proimg" src="<?php if ($deprat_id > 0) {
                                                                    echo "../../img/imag_depart/$icon_depart";
                                                                } ?>" width='100px' height='100px' class='img-fluid rounded' <?php if ($deprat_id == 0) {
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
                                    <label for="about_depart">وصف القسم</label>
                                    <div class="input-group">
                                        <textarea name="about_depart" id="about_depart" class="form-control m-1" rows="3" tabindex="4" placeholder="وصف القسم" style="height: 80px;"><?php if ($deprat_id > 0) {
                                                                                                                                                                                            echo $about_depart;
                                                                                                                                                                                        } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($deprat_id > 0) {
                                ?>
                                    <button class="btn btn-block btn-warning" id="add_department_or_updata" type="submit" name="add_department_or_updata">تعديل
                                        <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                        <button class="btn btn-block btn-info" id="add_department_or_updata" type="submit" name="add_department_or_updata">إضافة
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
                        <h5>جدول الاقسام</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="department_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th>اسم القسم</th>
                                        <th>وصف القسم</th>
                                        <th>حالة القسم</th>
                                        <th>الوصول للقسم</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;
                                    $sql = "SELECT * FROM `department` WHERE `depart_state`!=0 ORDER BY `deprat_id` ASC ;";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $count_row += 1; ?></td>
                                            <td>
                                                <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_depart/<?php echo $r['icon_depart']; ?>" alt="<?php echo $r['name_depart']; ?>">



                                                <?php echo $r['name_depart'] ?>

                                                <input type="text" name="deprat_id" id='deprat_id' style='display: none;' value=" <?php echo $r['deprat_id']; ?>"></input>
                                            </td>
                                            <td><?php echo $r['about_depart'] ?></td>


                                            <td>
                                                <?php
                                                if ($r['depart_state'] == 3) {

                                                    $depart_state_sc = "check";
                                                } else {
                                                    $depart_state_sc = "checked";
                                                }
                                                ?>
                                                <div class="input-group">
                                                    <input type="checkbox" class="form-control" id="depart_state1" name="depart_state1" value="<?php echo $r['depart_state']; ?>" <?php echo $depart_state_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                                </div>


                                            </td>
                                            <td>
                                                <?php
                                                if ($r['depart_state'] == 1) {
                                                    $depart_state_sc = "checked";
                                                } else {
                                                    $depart_state_sc = "check";
                                                }
                                                ?>

                                                <div class="input-group">
                                                    <input type="checkbox" class="form-control" id="depart_state2" name="depart_state2" value="<?php echo $r['depart_state']; ?>" <?php echo $depart_state_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                                </div>


                                            </td>
                                            <td>

                                                <a title="تعديل البيانات" class="btn btn-info btn-sm " href="mange_department.php?deprat_id=<?php echo $r['deprat_id'] ?> role=" button"> <i class="fas fa-edit"></i></a>
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






                <div class="card card-secondary">

                    <div class="card-header">
                        <h5> الاقسام المقترحة </h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="department_table_join" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المركز</th>
                                        <th>البيانات</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>دمج البيانات مع</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row = 0;
                                    $sql = "SELECT c.com_id,c.com_name,dep_com.icon_depart_com,dep_com.name_depart_com,dep_com.about_depart_com,dep_com.id_depart_com,dep_com.depart_state_com FROM `department_com` dep_com JOIN company c ON dep_com.com_id=c.com_id WHERE  dep_com.deprat_id=0 GROUP by dep_com.name_depart_com;";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                            <td><?php echo $count_row += 1; ?></td>
                                            <td><?php echo $r['com_name'] ?></td>
                                            <td>
                                                <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_depart/<?php echo $r['icon_depart_com']; ?>" alt="<?php echo $r['name_depart_com']; ?>">



                                                <?php echo $r['name_depart_com'] ?>

                                                <input type="text" name="id_depart_com" id='id_depart_com' style='display: none;' value=" <?php echo $r['id_depart_com']; ?>"></input>
                                            </td>
                                            <td><?php echo $r['about_depart_com'] ?></td>

                                            <td>
                                                <?php
                                                if ($r['depart_state_com'] == 0) {

                                                    echo "<span class='float-right badge bg-warning'>طلب الاضافة</span>";
                                                } elseif ($r['depart_state_com'] == 1) {
                                                    echo "<span class='float-right badge bg-success'>فعال</span>";
                                                } elseif ($r['depart_state_com'] == 2) {
                                                    echo "<span class='float-right badge bg-info'>موقف الوصول من إدارة الموقع</span>";
                                                } elseif ($r['depart_state_com'] == 3) {
                                                    echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة الموقع</span>";
                                                } elseif ($r['depart_state_com'] == 4) {
                                                    echo "<span class='float-right badge bg-info'>موقف الوصول من إدارة المركز</span>";
                                                } elseif ($r['depart_state_com'] == 5) {
                                                    echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة المركز</span>";
                                                }
                                                ?>



                                            </td>
                                            <td>

                                                <input type="text" name="join_with" id='join_with'></input>
                                            </td>

                                            <td>

                                                <input type="button" name="ll" id="ll" title="تعديل البيانات" class="btn btn-info btn-sm " value="قبول" role=" button">


                                            </td>


                                        </tr>
                                    <?php

                                    }

                                    ?>
                                    <script>
                                        //**************/ script to  butoon swetch for stope or turn on the department  this cod used on page all_department  \\**************\                      
                                        $(document).ready(function() {
                                            $('input[name="ll"]').on('click', function(event, state) {

                                                var join_with = $(this).closest('tr').find('input[name="join_with"]').val();
                                                var id_depart_com = $(this).closest('tr').find('input[name="id_depart_com"]').val();
                                                var r = window.confirm("هل حقاً تريد إضافة القسم او دمجه");
                                                if (r) {

                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'insert_data_admin.php',
                                                        data: {
                                                            id_depart_com: id_depart_com,
                                                            join_with: join_with

                                                        }

                                                        ,
                                                        success: function(data, status) {
                                                            // Handle success response
                                                            if (status === 'success') {
                                                                window.location.reload();
                                                            }
                                                        },
                                                        error: function(req, status) {
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