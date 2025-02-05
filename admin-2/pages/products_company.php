<?
include "../db.php";
//include "insert_data_admin.php";
global $com_id;

if (isset($_GET['com_id'])) {

    $com_id = $_GET['com_id'];
}
?>
<!-- Main content -->
<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row" dir="rtl">
            <!-- hear write the code -->

            <div class="col-12">


                <div class="col mb-3 " align="right">
                    <?php $result1_depart = mysqli_query($con, "SELECT * from department_com WHERE com_id='" . $com_id . "'  ;") or die(mysqli_error($con));
                    while ($r_depart = mysqli_fetch_array($result1_depart)) {
                        echo '
                        <span class="h5 m-1 btn bg-info text-white"><a  href="#' . $r_depart['id_depart_com'] . '">' . $r_depart['name_depart_com'] . '</a></span> ';
                    }

                    ?>
                </div>

                <!-- product_department for all the products to his compane he can chang or delet the product -->
                <div class="card collapsed-card">
                    <div class="card-header border-transparent" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">كافة المنتجات</h3>

                        <div class="card-tools" style="float: left;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive" style="display: none;">

                        <?php

                        Get_all_Product_By_id_com($com_id);


                        ?>
                    </div>
                </div>

                <ul class="list-group l1" style="padding: 0%;">
                    <?php

                    $result = mysqli_query($con, "SELECT * from department_com WHERE com_id='" . $com_id . "' ;") or die(mysqli_error($con));
                    if (mysqli_num_rows($result) == 0) {
                        echo "<h6 class='text-center'>لا يوجد أقسام</h6>";
                    } else {
                        while ($r = mysqli_fetch_array($result)) {

                    ?>
                    <li class='list-group' id="<?php echo $r['id_depart_com'] ?>">


                        <div class="card collapsed-card">
                            <div class="card-header border-transparent" data-card-widget="collapse">
                                <h3 class="card-title" style="float: right;">
                                    <?php echo $r['name_depart_com'] ?>
                                </h3>
                                <div class="card-tools" style="float: left;">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-1">
                                <div id="<?php echo $r['id_depart_com'] ?>">
                                    <div class="">
                                        <?php GetProductBy_depart_id($r['id_depart_com'], $com_id) ?>

                                    </div>
                                </div>


                            </div>

                        </div>

                    </li>
                </ul>
                <!--product _department-->
                <?php
                            if (isset($_GET['products'])) {

                                GetProductBy_depart_id($_GET['depart_id'], $com_id);
                            }

                ?>

                <?php

                        }
                    }
        ?>

                <!-- product_department for the product deleted and button for back the product -->
                <div class="card collapsed-card">
                    <div class="card-header border-transparent" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">المنتجات المحذوفة</h3>

                        <div class="card-tools" style="float: left;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body  table-responsive" style="display: none;">

                        <?php

                GetProduct_deleted_By_id_com($com_id);


                ?>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- product_department for the product deleted from manger website don't have button for back   -->
                <div class="card collapsed-card">
                    <div class="card-header border-transparent" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">المنتجات المحذوفة من قبل إدارة الموقع
                        </h3>

                        <div class="card-tools" style="float: left;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body  table-responsive" style="display: none;">

                        <?php

                GetProduct_deleted_by_admin_website_By_id_com($com_id);


                ?>
                    </div>
                    <!-- /.card-body -->
                </div>











            </div>






        </div>
    </div>
</section>
<!-- /.content -->