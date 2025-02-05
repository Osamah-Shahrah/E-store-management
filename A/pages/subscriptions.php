<?php

include 'header.php';


$com_id = $_SESSION['comid'];

?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">باقات الاشتراك</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">باقات الاشتراك</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>




<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row" dir="rtl">
            <!-- hear write the code -->

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-body">
                        <div class="row">


                            <?php
                            $res = mysqli_query($con, "SELECT * from bunch WHERE `bunch_form_status`!=0") or die(mysqli_error($con));
                            while ($r = mysqli_fetch_array($res)) {

                            ?>
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="position-relative p-3 bg-gray">
                                        <div class="ribbon-wrapper">

                                            <form action="insert_data.php" id="frm1" method="POST" enctype="multipart/form-data">
                                                <input type="number" name="bunch_form_id" id="bunch_form_id" style="display: none;" value="<?php echo $r['bunch_ID'] ?>">
                                                <input type="number" name="com_id" id="com_id" style="display: none;" value="<?php echo $com_id ?>">

                                                <input type="text" name="bunch_name_com" id="bunch_name_com" style="display: none;" value="<?php echo $r['bunch_form_name'] ?>">
                                                <input type="number" name="pro_count_com" id="pro_count_com" style="display: none;" value="<?php echo $r['bunch_form_pro_count'] ?>">
                                                <input type="number" name="bunch_com_price" id="bunch_com_price" style="display: none;" value="<?php echo $r['bunch_form_price'] ?>">
                                                <input type="text" name="bunch_com_about" id="bunch_com_about" style="display: none;" value="<?php echo $r['bunch_form_about'] ?>">

                                                <div class="ribbon bg-danger">
                                                    <?php echo $r['bunch_form_department']; ?>
                                                </div>
                                        </div>
                                        <p class="h5 text-center p-2">
                                            <?php echo $r['bunch_form_pro_count']; ?> <br>
                                            منتجاً
                                        </p>
                                        <p class="h5 text-center p-2">
                                            <?php echo $r['bunch_form_price']; ?>
                                            RY
                                        </p>
                                        <p class="h5 text-center p-2"><small> <?php echo $r['bunch_form_about']; ?></small>
                                        </p>
                                        <br>
                                        <button class="btn btn-block btn-warning " id="updata_subscriptions" type="submit" name="updata_subscriptions">تجديد الأشتراك
                                            <span data-feather="save"></span>
                                        </button>

                                        </form>
                                    </div>
                                </div>



                            <?php
                            }

                            ?>


                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <div class="col-12" dir="rtl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جدول حالات الباقات والاشتراكات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12 table-responsive p-0">

                                <table id="example1" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr role="row">
                                        <th>#</th>
                                            <th>اسم الباقة</th>
                                            <th> عدد المنتجات</th>
                                            <th>وصف الباقة</th>
                                            <th>تاريخ الطلب</th>
                                            <th>حالة الباقة</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $row_number=0;
                                        $sql_quer_bunch_com = "SELECT * FROM `bunch_com` bc WHERE bc.com_id='" . $com_id . "' ORDER BY bc.`date_subs` DESC ";
                                        $execution_query_bunch_com = mysqli_query($con, $sql_quer_bunch_com) or die(mysqli_error($con));

                                        while ($array_bunch_com = mysqli_fetch_array($execution_query_bunch_com)) {
                                        ?>

                                            <tr role="row" class="odd">
                                            <td>
                                            <?php echo$row_number+=1;?>
                                            

                                                </td>
                                                <td class="sorting_1">
                                                    <?php echo $array_bunch_com['bunch_name_com'] ?>

                                                </td>
                                                <td><span class="badge  badge-success">
                                                        <?php echo $array_bunch_com['pro_count_com']; ?>
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-danger">
                                                        <?php echo $array_bunch_com['bunch_com_about']; ?>
                                                    </span>
                                                </td>
                                                <td><span class="badge badge-danger">
                                                        <?php echo $array_bunch_com['date_subs']; ?>
                                                    
                                                </td>
                                                <td><?php
                                                    if ($array_bunch_com['bunch_com_status'] == 1) {
                                                        $bunch_com_status_sc = "checked";
                                                        ?>
                                                           <span class="badge badge-success">تم التفعيل</span>
                                                        <?php
                                                    } else {?>
                                                        <span class="badge badge-danger">الباقة لازالة تحت الطلب</span>
                                                        <?php
                                                    }
                                                    ?>
                                                   
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <th>الاجمالي</th>

                                            <th> إجمالي المنتجات </th>
                                            <th> إجمالي السعر</th>
                                            <th> إجمالي المنتجات المرفوعة</th>
                                            <th></th>
                                            <th> المنتجات المتبقية</th>

                                        </tr>

                                        <?php

                                        $sql_cen_bun = "SELECT c.com_id,c.com_name,c.icon,(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id . " ) count_prod,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id . " AND  bc.bunch_com_status=1 ) count_prod_bun_com,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id . " AND  bc.bunch_com_status=1 )-(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id . " ) remaining,(SELECT  SUM(bc.bunch_com_price) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id . " AND  bc.bunch_com_status=1)sum_price
                  FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE c.com_id=" . $com_id . " AND  bc.bunch_com_status=1  group  by c.com_name ;";
                                        $ex_sql_cen_bun = mysqli_query($con, $sql_cen_bun) or die(mysqli_error($con));

                                        while ($array_cen_bun = mysqli_fetch_array($ex_sql_cen_bun)) {
                                        ?>


                                            <tr style="background-color:#B5E81B;">

                                                <td>

                                                </td>

                                                <td><?php echo $array_cen_bun['count_prod_bun_com'] ?></td>
                                                <td><?php echo $array_cen_bun['sum_price'] ?></td>
                                                <td><?php echo $array_cen_bun['count_prod'] ?></td>
                                                <td></td>
                                                <td><?php echo $array_cen_bun['remaining'] ?></td>


                                            </tr>
                                        <?php

                                        }

                                        ?>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

        </div>

        <!-- /.container-fluid -->
</section>
<!-- /.content -->







<?php

include 'footer.php';
?>