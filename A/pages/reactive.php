<?php

include 'header.php';


?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إشعارات المنتجات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إشعارات المنتجات</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>



<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row" style=" text-align-last: center;">
            <!-- hear write the code -->

            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">جدول المنتجات المتفاعل معها</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12 table-responsive p-0">

                                    <table id="example1" class="table table-bordered table-hover dataTable " role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th >اسم المنتج</th>
                                                <th> عدد الاعجابات</th>
                                                <th >عدد التعليقات</th>
                                                <th >الصورة</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php


                                            $sql = "SELECT `product_id`,`product_title`,`product_image` FROM `product` WHERE  `com_id`='" . $_SESSION['comid'] . "' ";
                                            $res = mysqli_query($con, $sql);
                                            while ($r = mysqli_fetch_array($res)) {

                                                $sql_query = "SELECT  COUNT(r.product_id) 'count_like' FROM product JOIN  reactive_product AS r ON r.product_id=product.product_id WHERE r.user_like>0 AND r.product_id ='" . $r['product_id'] . "' AND `com_id`='" . $_SESSION['comid'] . "'";
                                                $rests = mysqli_query($con, $sql_query);
                                                $sql_count = mysqli_fetch_array($rests);

                                                $sql_query_comm = "SELECT  COUNT(r.product_id) 'count_comm' from product JOIN  reactive_product AS r ON r.product_id=product.product_id WHERE r.comment!='' AND r.product_id ='" . $r['product_id'] . "' AND `com_id`='" . $_SESSION['comid'] . "'";
                                                $rests_comm = mysqli_query($con, $sql_query_comm);
                                                $sql_count_comm = mysqli_fetch_array($rests_comm);
                                                ?>
                                            <a href="pages/examples/invoice.html">
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        <?php echo $r['product_title'] ?>

                                                    </td>
                                                    <td><span class="badge badge-success">
                                                            <?php echo $sql_count['count_like']; ?>
                                                        </span>
                                                    </td>
                                                    <td><span class="badge badge-danger">
                                                            <?php echo $sql_count_comm['count_comm']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <img style="width: 35%;height:50px"
                                                            src="../../img/product_images/<?php echo $r['product_image'] ?>"
                                                            class="img-circle elevation-2"
                                                            alt="<?php echo $r['product_title'] ?>">


                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info   btn-sm"
                                                            href="details-reactive-prod.php?details_prod_id=<?php echo $r['product_id'] ?>">
                                                            <i class="fas fa-eye">
                                                            </i>
                                                            عرض
                                                        </a>
                                                    </td>
                                                </tr>
                                            </a>
                                            <?php }
                                            ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>




            </div>



        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->



<?php
include "footer.php";


?>