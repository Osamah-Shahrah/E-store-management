<?php

include 'header.php';


?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إدارة الطلبات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item">إدارة الطلبات</li>
                    <li class="breadcrumb-item active"> طلبات الملغيه</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>






<section class="content">
    <div class="container-fluid" dir="rtl">




        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جدول الطلبيات المكتملة</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <div class="col-sm-12 table-responsive">
                    <table id="check_order_deleted" class="table table-bordered table-striped dataTable" role="grid"
                        aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th>رقم الطلب</th>
                                <th>اسم العميل</th>
                                <th>هاتف العميل</th>
                                <th>إجمالي السعر</th>
                                <th>حال الطلب</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $result = mysqli_query($con, "SELECT DISTINCT `id_order`,`cu_name`,`cus_phone`,`type_order`,`address_order` FROM `order`JOIN order_item ON id_order=order_item.fk_order WHERE `status_order`=0  AND `com_id_ord`=" . $_SESSION['comid'] . "  ORDER BY `order`.`date_add` ASC;") or die(mysqli_error($con));
                            if (mysqli_num_rows($result) == 0) {
                                echo "<h6 class='text-center'>لا يوجد طلبات مكتملة</h6>";
                            } else {
                                while ($r = mysqli_fetch_array($result)) {
                                    $total_pris_coun_com = mysqli_query($con, "SELECT COUNT(id_item_order)cou,SUM(total_item)price_total FROM `order_item` WHERE `fk_order` =" . $r['id_order'] . "  AND `com_id_item_ord`=" . $_SESSION['comid'] . "   ;") or die(mysqli_error($con));
                                    $t_p_c_com = mysqli_fetch_array($total_pris_coun_com);
                            ?>


                            <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $r['id_order'] ?></td>
                                <td><?php echo $r['cu_name'] ?></td>
                                <td><?php echo $r['cus_phone'] ?></td>
                                <td><?php echo $t_p_c_com['price_total'] ?></td>
                                <td>
                                    <div class="col-3" data-card-widget="collapse">
                                        <i style="float:left;" class="fas fa-times"></i>
                                    </div>


                                </td>

                            </tr>


                            <?php


                                }
                            }
                            ?>

                        </tbody>

                    </table>
                </div>






            </div>
            <!-- /.card-body -->
        </div>


    </div>
</section>

<?php

include "footer.php";


?>