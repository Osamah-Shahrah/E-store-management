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
                    <li class="breadcrumb-item active">التاكد من الايداع </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>





<?php

$sel_or_no_ch_mo = mysqli_query($con, "SELECT DISTINCT `id_order`,`cu_name`,`cus_phone`,`type_order`,`address_order` FROM `order`JOIN order_item ON id_order=order_item.fk_order WHERE `chack_order`=1 AND  `status_order`=1   AND  `chack_money`=0 AND `com_id_ord`=" . $_SESSION['comid'] . "   ORDER BY `order`.`date_add` ASC;") or die(mysqli_error($con));
if (mysqli_num_rows($sel_or_no_ch_mo) == 0) {
    echo "<h6 class='text-center'>لا يوجد طلبات</h6>";
} else {


    while ($da_se_ch_mo = mysqli_fetch_array($sel_or_no_ch_mo)) {

        $total_pris_coun = mysqli_query($con, "SELECT COUNT(id_item_order)cou,SUM(total_item) price_total FROM `order_item` WHERE `order_item`.`fk_order` =" . $da_se_ch_mo['id_order'] . " AND `com_id_item_ord`=" . $_SESSION['comid'] . "   ;") or die(mysqli_error($con));
        $t_p_c = mysqli_fetch_array($total_pris_coun);

?>

<div class="card collapsed-card">


    <div class="card-header border-transparent">
        <div class="row">
            <div class="col-1" data-card-widget="collapse">
                <h3 class="card-title" style="float: right;">
                    #
                    <?php echo $da_se_ch_mo['id_order'] ?>
                </h3>
            </div>
            <div class="col-2" data-card-widget="collapse">
                <h3 class="card-title" style="float: right;">
                    <?php echo $da_se_ch_mo['cu_name'] ?>
                </h3>
            </div>
            <div class="col-2" data-card-widget="collapse">
                <h3 class="card-title">
                    السعر/
                </h3>
            </div>
            <div class="col-2 text-align-center" data-card-widget="collapse">
                <h3 class="card-title" style="float: right;">
                    <?php echo $t_p_c['price_total'] ?>
                </h3>
            </div>



            <div class="col-5">
                <form action="insert_data.php" method="post" type="form" name="form_check_mony" style="float:left;"
                    enctype="multipart/form-data">
                    <label s id="po" class="btn btn-primary-sm">
                        <i class="fa fa-upload"></i>

                        <input type="file" class="form-control" name="picture" id="img_chek_money"
                            accept=".png, .jpg,.gif,.jpeg,jpe,.ico" style="display:none;">
                        اختر الصورة
                    </label>
                    <script>
                    $("#po").click(function() {
                        $("#img_chek_money").click();
                    });
                    </script>
                    <button type="submit" class="btn btn-success btn-sm " id="id_order_check" name="id_order_check"
                        value="<?php echo $da_se_ch_mo['id_order'] ?>" s><i class="icon fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body " style="display: none;">
        <div class="table-responsive">
            <?php
                    $result_q = mysqli_query($con, "SELECT id_item_order,product.product_title,price_one,quantity_item,total_item,note,product.product_image FROM `order_item`LEFT JOIN product ON order_item.fk_pro=product.product_id  WHERE `fk_order` ='" . $da_se_ch_mo['id_order'] . "'   AND `com_id_item_ord`=" . $_SESSION['comid'] . "  ;") or die(mysqli_error($con));
                    if (mysqli_num_rows($result_q) > 0) {
                    ?>


            <table class="table m-0">
                <thead>
                    <tr>
                        <th>
                            بيانات المنتج
                        </th>
                        <th>
                            سعر الحبة
                        </th>
                        <th>
                            الكمية
                        </th>
                        <th>
                            إجمالي
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php


                                    while (list($id_item_order, $product_title, $price_one, $quantity_item, $total_item, $note, $product_image) = mysqli_fetch_array($result_q)) {
                                        echo "
                        <tr>
                           <td>
                           <div class='d-flex '>

                           
                               <img src='../../img/product_images/$product_image'  width='50px' height='50px' class='img-fluid rounded'  alt='$product_title' >
                           

                           
                               <h6 class='mb-0 text-m'>$product_title</h6>
                           

                        </div>
                       </td>
                           <td ><span class='badge badge-warning'>$price_one</span></td>
                           <td ><span class='badge badge-success'>$quantity_item</span></td>
                           <td><span class='badge badge-danger'>  $total_item</span></td>

                           
                           "; ?>
                    </tr>
                    <?php

                                    }
                            ?>
                </tbody>



            </table>

            <?php } else {
                    ?>
            <p class="h5 text-center"> لا يوجد منتجات</p>
            <?php
                    }

                    ?>

        </div>
    </div>

</div>

<?php

    }
}
?>

<!-- div row for all order acceccpt chack money -->

<div class="card collapsed-card">
    <div class="card-header border-transparent" data-card-widget="collapse">
        <br>
        <h3 class="card-title" style="float: right;">
            الطلبات المكتملة
        </h3>
        <div class="card-tools" style="float: left;">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body " style="display: none;">


        <?php

        $result = mysqli_query($con, "SELECT DISTINCT `id_order`,`cu_name`,`cus_phone`,`type_order`,`address_order` FROM `order`JOIN order_item ON id_order=order_item.fk_order WHERE `chack_order`=1 AND  `status_order`=1   AND  `chack_money`=1 AND `com_id_ord`=" . $_SESSION['comid'] . " ORDER BY `order`.`date_add` ASC;") or die(mysqli_error($con));
        if (mysqli_num_rows($result) == 0) {
            echo "<h6 class='text-center'>لا يوجد طلبات مكتملة</h6>";
        } else {
            while ($r = mysqli_fetch_array($result)) {
                $total_pris_coun_com = mysqli_query($con, "SELECT COUNT(id_item_order)cou,SUM(total_item)price_total FROM `order_item` WHERE `fk_order` =" . $r['id_order'] . "  AND `com_id_item_ord`=" . $_SESSION['comid'] . "   ;") or die(mysqli_error($con));
                $t_p_c_com = mysqli_fetch_array($total_pris_coun_com);
        ?>

        <div class="card collapsed-card">
            <div class="card-header border-transparent">
                <div class="row">


                    <div class="col-2" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">
                            #
                            <?php echo $r['id_order'] ?>
                        </h3>
                    </div>


                    <div class="col-3" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">
                            <?php echo $r['cu_name'] ?>
                        </h3>
                    </div>

                    <div class="col-2" data-card-widget="collapse">

                        <h3 class="card-title">
                            السعر/
                        </h3>

                    </div>

                    <div class="col-2" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">
                            <?php echo $t_p_c_com['price_total'] ?>
                        </h3>

                    </div>

                    <div class="col-3" data-card-widget="collapse">
                        <i style="float:left;" class="icon fas fa-check"></i>

                    </div>

                </div>


            </div>
            <!-- /.card-header -->
            <div class="card-body " style="display: none;">
                <div class="table-responsive">



                    <?php
                            $result_q_m = mysqli_query($con, "SELECT id_item_order,product.product_title,price_one,quantity_item,total_item,note,product.product_image FROM `order_item`LEFT JOIN product ON order_item.fk_pro=product.product_id  WHERE `fk_order` ='" . $r['id_order'] . "'  AND `com_id_item_ord`=" . $_SESSION['comid'] . "  ;") or die(mysqli_error($con));
                            if (mysqli_num_rows($result_q_m) > 0) {
                            ?>


                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>
                                    بيانات المنتج
                                </th>
                                <th>
                                    سعر الحبة
                                </th>
                                <th>
                                    الكمية
                                </th>
                                <th>
                                    إجمالي
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php


                                            while (list($id_item_order, $product_title, $price_one, $quantity_item, $total_item, $note, $product_image) = mysqli_fetch_array($result_q_m)) {
                                                echo "
                        <tr>
                           <td>
                           <div class='d-flex '>

                           
                               <img src='../../img/product_images/$product_image' style='width: 20%;height:50px'  width='50px' height='50px' class='img-fluid rounded' alt='$product_title' >
                           

                           
                               <h6 class='mb-0 text-m'>$product_title</h6>
                           

                        </div>
                       </td>
                           <td ><span class='badge badge-warning'>$price_one</span></td>
                           <td ><span class='badge badge-success'>$quantity_item</span></td>
                           <td><span class='badge badge-danger'>  $total_item</span></td>

                           
                           "; ?>
                            </tr>
                            <?php

                                            }
                                    ?>
                        </tbody>



                    </table>

                    <?php } else {
                            ?>
                    <p class="h5 text-center"> لا يوجد منتجات مختارة</p>
                    <?php
                            }

                            ?>

                </div>



            </div>

        </div>



        <?php


            }
        }
        ?>

    </div>
</div>
<?php

include "footer.php";


?>