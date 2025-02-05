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
                    <li class="breadcrumb-item active">إضافة طلب</li>
                </ol>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>




<section class="content">
    <div class="container-fluid">
        <div class="row" dir="rtl">
            <!-- hear write the code -->

            <div class="col-12" align="right">


                <!--div input details for item_order  -->
                <div class="card" dir="rtl">
                    <div class="card-header border-transparent" data-card-widget="collapse">
                        <h3 class="card-title" style="float: right;">تحديد منتجات الطلب</h3>
                    </div>

                    <div class="card-body " style="display: block;">
                        <form action="insert_data.php" method="post" id="form_add_item" name="form_add_item" style="margin: bottom 20px ;" enctype="multipart/form-data" autocomplete="on">

                            <div align="center">
                                <img width='100px' height='100px' class='img-fluid rounded' name="img" id="img" style="display: none;">
                            </div>



                            <input type="number" name="comid" id="comid" value="<?php echo $_SESSION['comid'] ?>" tabindex="1" style="display:none;">

                            <div class="row">

                                <!-- div group for right the input add product for order -->
                                <div class="col-sm-6">
                                    <label for="id_pro">اسم المنتج</label>

                                    <select name="id_pro" id="id_pro" class="form-control select2bs4" style="width: 100%;" tabindex="1" class="form-control m-1" required>
                                        <option>أختر احد المنتجات</option>
                                        <?php

                                        $result = mysqli_query($con, "SELECT  *  FROM `product` WHERE `status_pro`=1 AND com_id='" . $com_id . "'") or die(mysqli_error($con));
                                        if (mysqli_num_rows($result) == 0) {
                                            echo "<option>لا يوجد منتجات</option>";
                                        }
                                        while ($r = mysqli_fetch_array($result)) {
                                        ?>

                                            <option value="<?php echo $r['product_id'] ?>">


                                                <?php echo $r['product_title'] ?>

                                            </option>
                                            <!-- cod for take the cate on select the department -->

                                        <?php
                                        }

                                        ?>
                                    </select>

                                </div>




                                <div class="col-sm-6">
                                    <!-- div group for name the product -->
                                    <label for="product">رقم المنتج</label>
                                    <div class="input-group input-group-outline mb-1">
                                        <input type="text" name="product" id="product" readonly required class="form-control m-1">

                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <label for="quantity">الكمية</label>
                                    <div class="input-group input-group-outline mb-1">
                                        <input type="number" id="quantity" name="quantity" tabindex="2" class="form-control m-1" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <!-- div group for price the product -->
                                    <label for="price">السعر الحبه</label>
                                    <div class="input-group input-group-outline mb-1">
                                        <input type="number" name="price" id="price" readonly required class="form-control m-1">

                                    </div>
                                </div>

                                <div class="col-sm">
                                    <label for="total_price">إجمالي السعر</label>
                                    <div class="input-group input-group-outline mb-1">
                                        <input type="number" name="total_price" id="total_price" class="form-control m-1" readonly required>
                                    </div>
                                </div>

                                <!-- div group for size the product-item-order -->
                                <div class="col-sm-6">
                                    <label for="pro_size">مقاسات المنتج</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="pro_size" name="pro_size">
                                        <option>مقاسات المنتج</option>
                                    </select>
                                </div>


                                <!-- div group for color the product-item-order -->
                                <div class="col-sm-6">
                                    <label for="pro_color">الوان المنتج</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="pro_color" name="pro_color">
                                        <option>لون المنتج</option>
                                    </select>
                                </div>

                            </div>

                            <div class="input-group input-group-outline mb-1">
                                <textarea name="notice_item" id="notice_item" class="form-control m-1" rows="3" tabindex="4" placeholder="ملاحظات على المنتج" style="height: 80px;"></textarea>
                            </div>

                            <button type="submit" id="btn_add_item" name="btn_add_item" value="submit" required tabindex="5" class="btn btn-block btn-warning btn-lg">إضافة المنتج</button>
                        </form>





                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right;">جدول منتجات الطلب</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive ">
                                        <table class="table table-hover text-nowrap">
                                            <?php

                                            include '../db.php';
                                            $result = mysqli_query($con, "SELECT id_item_order,product.product_title,size_product.name_size,price_one,quantity_item,total_item,note,product.product_image FROM `order_item`LEFT JOIN product ON order_item.fk_pro=product.product_id LEFT JOIN size_product ON order_item.pro_size_id=size_product.id_size_pro WHERE `fk_order` = 1 AND `com_id_item_ord`= " . $_SESSION['comid'] . " ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($result) > 0) {
                                                $qu_to_pri = mysqli_query($con, "SELECT COUNT(id_item_order)cou,SUM(total_item)price_total FROM `order_item` WHERE `fk_order` = 1 AND `com_id_item_ord`= " . $_SESSION['comid'] . " ;") or die(mysqli_error($con));
                                                $sel = mysqli_fetch_array($qu_to_pri);
                                            ?>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>بيانات المنتج</th>
                                                        <th>القياس</th>
                                                        <th>سعر الحبة</th>
                                                        <th>الكمية</th>
                                                        <th>إجمالي السعر</th>
                                                        <th>الملاحظات</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $count_row = 0;
                                                    while (list($id_item_order, $product_title, $name_size, $price_one, $quantity_item, $total_item, $note, $product_image) = mysqli_fetch_array($result)) {

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $count_row += 1; ?></td>
                                                            <td> <img src='../../img/product_images/<?php echo $product_image ?>' width='50px' height='50px' class='img-fluid rounded' alt='$product_title'>
                                    </div>

                                    <?php echo $product_title ?>

                                    </td>
                                    <td><?php echo $name_size ?></td>
                                    <td><?php echo $price_one ?></td>
                                    <td><?php echo $quantity_item ?></td>
                                    <td><?php echo $total_item ?></td>
                                    <td><?php echo $note ?></td>
                                    <td>
                                    <td class="align-middle text-center text-sm"> <a class="badge badge-sm bg-gradient-danger" href='insert_data.php?del_item&id_item=<?php echo $id_item_order ?>'>إزالة</a>
                                    </td>
                                    </td>
                                    </tr>
                                <?php }

                                ?>







                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1"><b class="h6"> العدد:
                                                <?php echo $sel['cou'] ?>
                                            </b></td>
                                        <td colspan="2"><b class="h6">الاجمالي:
                                                <?php echo $sel['price_total'] ?>
                                            </b></td>
                                        <td colspan="3"><a class="btn btn-block-sm  btn-danger" href='insert_data.php?del_all_item' tabindex="6">إزالة
                                                الكل
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>

                            <?php
                                            } else {

                            ?>
                                <p class="h5 text-center"> لا يوجد منتجات مختارة</p>
                            <?php } ?>

                            </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>



                    </div>
                </div>



                <!--div input details customer  -->
                <form action="insert_data.php" method="POST" type="form" name="form_add_order" enctype="multipart/form-data" autocomplete="on">

                    <div class="card collapsed-card">
                        <div class="card-header border-transparent" data-card-widget="collapse">
                            <h3 class="card-title" style="float: right;">بيانات العميل</h3>
                        </div>
                        <div class="card-body  " style="display: none;">


                            <div class="form-group">
                                <label for="name_coustomer">اسم العميل</label>
                                <input type="text" name="name_coustomer" id="name_coustomer" class="form-control" required tabindex="7">
                            </div>

                            <div class="form-group">
                                <label for="phone_number">رقم الهاتف</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" required tabindex="8">

                            </div>


                            <div class="form-group">
                                <label for="pers_gift">نوع الطلب شخصية هدية</label>
                                <select name="pers_gift" id="pers_gift" class="form-control select2bs4" style="width: 100%;" required>
                                    <option class="op" value="شخصية">
                                        <b class="h5">شخصية </b>
                                    </option>
                                    <option class="op" value="هدية">
                                        <b class="h5"> هدية </b>
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="location">الموقع على الخريطة</label>
                                <input type="map" name="location" id="location" class="form-control" tabindex="10">
                            </div>

                            <div class="form-group">
                                <label for="address_order">العنوان</label>
                                <input type="text" name="address_order" id="address_order" class="form-control" required tabindex="11">
                            </div>
                        </div>
                    </div>

                    <!--div input details  for shipping -->
                    <div class="card collapsed-card">
                        <div class="card-header border-transparent" data-card-widget="collapse">
                            <h3 class="card-title" style="float: right;">بيانات التوصيل</h3>
                        </div>
                        <div class="card-body ">
                            <!--div input details  for delivery -->
                            <div class="form-group">
                                <label for="delivery">إخترشركة التوصيل</label>
                                <select name="delivery" id="delivery" class="form-control select2bs4" style="width: 100%;" required>
                                    <?php
                                    $result = mysqli_query($con, "SELECT `id_delivery`,`delivery_name` FROM `delivery_com`") or die(mysqli_error($con));
                                    if (mysqli_num_rows($result) == 0) {
                                        echo "<option >لا يوجد  شركات توصيل</option>";
                                    }
                                    while ($r = mysqli_fetch_array($result)) {
                                    ?>
                                        <option class="op" value="<?php echo $r['id_delivery'] ?>">

                                            <b class="h5">
                                                <?php echo $r['delivery_name'] ?>
                                            </b>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="shipping_type">يرجاء تحديد سرعة التوصيل</label>
                                <select name="shipping_type" id="shipping_type" class="form-control select2bs4" style="width: 100%;" onchange="shipping_date();" required>
                                    <option value="fast"><b class="h5">سريع</b></option>
                                    <option value="normal"><b class="h5">طبيعي</b></option>
                                    <option value="in_date"><b class="h5">في تاريخ معين </b></option>
                                </select>

                            </div>
                            <div class="input-group input-group-outline mb-1">
                                <label for="date_receipt">تاريخ التوصيل</label>
                                <input type="date" name="date_receipt" id="date_receipt" class="form-control m-1" tabindex="" readonly required tabindex="14">
                            </div>
                            <div class="input-group input-group-outline mb-1">
                                <label for="cost_ship">التكلفة💎</label>
                                <input type="number" name="cost_ship" id="cost_ship" class="form-control m-1" required tabindex="15">
                            </div>
                            <div class="form-group">
                                <label for="type_order">نوع الدفع</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="type_order" name="type_order">
                                    <option value="1">دفع مسبق</option>
                                    <option value="2">دفع عندالاستلام</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                <textarea name="notice_order" id="notice_order" class="form-control" tabindex="17" placeholder="الملاحظات"></textarea>
                                <label for="notice_order">يرجاء كتابة اي ملاحضات هنا</label>
                            </div>

                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit" id="btn_save_order" name="btn_save_order" tabindex="18" class="btn btn-block btn-success btn-lg">إضافةالطلب</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

<?php

include "footer.php";


?>