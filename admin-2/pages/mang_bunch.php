<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";

static $bunch_ID = 0;


if (isset($_GET['bunch_ID'])) {


    $bunch_ID = $_GET['bunch_ID'];

    static $bunch_form_name;
    static $bunch_form_bunch_form_pro_count;
    static $bunch_form_price;
    static $bunch_form_about;
    static $bunch_form_status;
    static $bunch_form_department;

    $sql_quer_bunch_form = "SELECT * FROM `bunch` WHERE `bunch_ID`='" . $bunch_ID . "';";



    $execution_query_bunch_form = mysqli_query($con, $sql_quer_bunch_form) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_bunch_form) > 0) {
        while ($array_bunch_form = mysqli_fetch_array($execution_query_bunch_form)) {


            $bunch_ID = $array_bunch_form['bunch_ID'];
            $bunch_form_name = $array_bunch_form['bunch_form_name'];

            $bunch_form_pro_count = $array_bunch_form['bunch_form_pro_count'];

            $bunch_form_price = $array_bunch_form['bunch_form_price'];


            $bunch_form_about = $array_bunch_form['bunch_form_about'];
            $bunch_form_department = $array_bunch_form['bunch_form_department'];

            $bunch_form_status = $array_bunch_form['bunch_form_status'];
            if ($array_bunch_form['bunch_form_status']) {
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
                <h1 style="float: right;">إدارة الباقات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة الباقات</li>

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
                        <?php if ($bunch_ID > 0) {
                        ?>
                            <h5> تعديل بيانات الباقة</h5>
                        <?php } else {
                        ?>
                            <h5> إضافة باقة</h5>

                        <?php
                        }
                        ?>
                    </div>
                    <div class="card-body">
                        <form action="insert_data_admin.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">







                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="bunch_form_name"> أسم الباقة</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="bunch_form_name" id="bunch_form_name" required placeholder="اسم الباقة" value="<?php if ($bunch_ID > 0) {
                                                                                                                                                                            echo $bunch_form_name;
                                                                                                                                                                        } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                    </div>
                                </div>
                                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                                <input style="display:none;" type="text" name="bunch_ID" id="bunch_ID" value="<?php if ($bunch_ID > 0) {
                                                                                                                    echo $bunch_ID;
                                                                                                                } ?>">

                                <div class="row">
                                    <div class="col-6">
                                        <label for="bunch_form_pro_count">عدد المنتجات</label>

                                        <div class="input-group">

                                            <input dir='ltr' type="number" id="bunch_form_pro_count" name="bunch_form_pro_count" type="text" value="<?php if ($bunch_ID > 0) {
                                                                                                                                                        echo $bunch_form_pro_count;
                                                                                                                                                    } ?>" class="form-control" data-mask required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-monay">🛒</i></span>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>

                                    <div class="col-6">
                                        <label for="bunch_form_price">سعر الباقة </label>

                                        <div class="input-group">

                                            <input dir='ltr' type="number" id="bunch_form_price" name="bunch_form_price" type="text" value="<?php if ($bunch_ID > 0) {
                                                                                                                                                echo $bunch_form_price;
                                                                                                                                            } ?>" class="form-control" data-mask required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-monay">$</i></span>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>




                                </div>

                                <div class="form-group">
                                    <label for="bunch_form_department"> قسم الباقة</label>
                                    <div class="input-group">

                                        <input type="text" class="form-control" name="bunch_form_department" id="bunch_form_department" required placeholder="قسم  الباقة" value="<?php if ($bunch_ID > 0) {
                                                                                                                                                                                        echo $bunch_form_department;
                                                                                                                                                                                    } ?>">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">%</i></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bunch_form_about">وصف الباقة</label>
                                    <div class="input-group">

                                        <textarea name="bunch_form_about" id="bunch_form_about" class="form-control m-1" rows="3" tabindex="4" placeholder="وصف الباقة" style="height: 80px;"><?php if ($bunch_ID > 0) {
                                                                                                                                                                echo $bunch_form_about;
                                                                                                                                                            } ?></textarea>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($bunch_ID > 0) {
                                ?>
                                    <button class="btn btn-block btn-warning" id="add_bunch_or_updata" type="submit" name="add_bunch_or_updata">تعديل
                                        <span data-feather="save"></span>
                                    <?php } else {
                                    ?>
                                        <button class="btn btn-block btn-info" id="add_bunch_or_updata" type="submit" name="add_bunch_or_updata">إضافة
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
                        <h5>جدول باقات الاشتراكات</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="subscraib_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                        <th>اسم الباقة</th>
                                        <th>عدد المنتجات</th>
                                        <th>سعر الباقة</th>
                                        <th>قسم الباقة</th>
                                        <th>وصف الباقة</th>
                                        <th>تاريخ الاضافة</th>
                                        <th>تاريخ التحديث</th>
                                        <th>حالة الباقة</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count_row=0;
                                    $sql = "SELECT * FROM `bunch` ORDER BY `bunch`.`bunch_form_date_updata` ASC ;";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>

                                        <tr>
                                        <td><?php echo$count_row+=1; ?></td>
                                            <td>

                                                <?php echo $r['bunch_form_name'] ?>

                                                <input type="text" name="bunch_ID" id='bunch_ID' style='display: none;' value=" <?php echo $r['bunch_ID']; ?>"></input>
                                            </td>
                                            <td><?php echo $r['bunch_form_pro_count'] ?></td>
                                            <td><?php echo $r['bunch_form_price'] ?></td>
                                            <td><?php echo $r['bunch_form_department'] ?></td>
                                            <td><?php echo $r['bunch_form_about'] ?></td>
                                            <td><?php echo $r['bunch_form_date_add'] ?></td>
                                            <td><?php echo $r['bunch_form_date_updata'] ?></td>
                                            <td>
                                                <?php
                                                if ($r['bunch_form_status']) {
                                                    $bunch_form_status_sc = "checked";
                                                } else {
                                                    $bunch_form_status_sc = "check";
                                                }
                                                ?>
                                                <div class="input-group">
                                                    <input type="checkbox" class="form-control" id="bunch_form_status" name="bunch_form_status" value="<?php echo $r['bunch_form_status']; ?>" <?php echo $bunch_form_status_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                                </div>


                                            </td>
                                            <td>

                                                <a title="تعديل البيانات" class="btn btn-info btn-sm " href="mang_bunch.php?bunch_ID=<?php echo $r['bunch_ID'] ?> role=" button"> <i class="fas fa-edit"></i></a>
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