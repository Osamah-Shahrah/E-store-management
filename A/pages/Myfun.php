<?php

include '../db.php';

//include 'message.php';



if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "UPDATE `product` SET `status_pro`='0' WHERE `product_id`=" . $id . ";";
    if (mysqli_query($con, $sql) or die(mysqli_error($con))) {

        // Msg_Sucess();
        header("location:manage_products.php");
    } else {
        // Msg_Error();
    }
}


//back the department 
if (isset($_GET['back_pro'])) {
    $back_pro = $_GET['back_pro'];
    $sql_back_prod = "UPDATE `product` SET `status_pro`=1 WHERE status_pro!=2 AND `product_id`=?";
    $stmt = mysqli_prepare($con, $sql_back_prod);
    mysqli_stmt_bind_param($stmt, "i", $back_pro);
    if (mysqli_stmt_execute($stmt)) {
        // Msg_Sucess();
        header("location:manage_products.php");
    } else {
        header("location:manage_products.php");
    }
    mysqli_stmt_close($stmt);
}

//add departmant  for company
function AddDepartment($departID, $comid)
{
    include '../db.php';
    $departSelected = mysqli_query($con, "SELECT * FROM `department` WHERE deprat_id=$departID AND `depart_state`<=2")
        or die(mysqli_error($con));
    $res = mysqli_fetch_array($departSelected);

    $ch = mysqli_query($con, "SELECT * FROM `department_com` WHERE deprat_id=$departID AND com_id=$comid")
        or die(mysqli_error($con));
    if (mysqli_num_rows($ch) > 0) {
        $msg = "تم إضافتة مسبقا";
        return false;
    } else {
        $insert = mysqli_query($con, "INSERT INTO `department_com`(
           `deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) 
      VALUES ('$res[deprat_id]','$res[name_depart]','$res[about_depart]','$comid','$res[depart_state]','$res[icon_depart]')")
            or die(mysqli_error($con));

        $yy = mysqli_query($con, "SELECT  * FROM `department_com` WHERE deprat_id='" . $departID . "' AND com_id='" . $comid . "'") or die(mysqli_error($con));
        $fr = mysqli_fetch_array($yy);
        if (mysqli_num_rows($yy) > 0) {


            $select = mysqli_query($con, "SELECT * FROM `categories` WHERE `depart_id`='" . $departID . "'") or die(mysqli_error($con));

            while ($rows = $select->fetch_assoc()) {
                $insert_cat = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`, `id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`, `state_cat_com`) VALUES 
('" . $rows['cat_id'] . "',
'" . $fr['id_depart_com'] . "',
'" . $fr['deprat_id'] . "','" . $comid . "',
'" . $fr['name_depart_com'] . "',
'" . $rows['cat_title'] . "','" . $rows['cat_image'] . "',
'" . $rows['cat_details'] . "','" . $rows['state_cat'] . "')") or die(mysqli_error($con));
                $cat_id = $con->insert_id;


                $select_search_item = mysqli_query($con, "SELECT * FROM `form_items_pro` WHERE `fk_cat_ite_for`='" . $rows['cat_id'] . "'") or die(mysqli_error($con));



                while ($rows_2 = $select_search_item->fetch_assoc()) {
                    $insert_item = mysqli_query($con, "INSERT INTO `items_product`(`fk_ite_for`, `fk_cat_ite`, `fk_pro_ite`, `name_items`, `item_prod_statues`, `imag_item_prod`, `details_item_prod`)  VALUES  
            ('" . $rows_2['id_ite_for'] . "',
            '" . $cat_id . "',
            '0',
            '" . $rows_2['na_ite_fo'] . "',
            '" . $rows_2['status_ite_for'] . "',
            '" . $rows_2['img_ite_for'] . "','" . $rows_2['detali_ite_fo'] . "')") or die(mysqli_error($con));
                }


                $select_search_size = mysqli_query($con, "SELECT * FROM `form_size` WHERE `cat_fk_id`='" . $rows['cat_id'] . "'") or die(mysqli_error($con));



                while ($rows_3 = $select_search_size->fetch_assoc()) {
                    $insert_size = mysqli_query($con, "INSERT INTO `size_product`(`fk_form_size`, `fk_id_pro`, `cat_fk_id_size`, `name_size`, `details_size`, `size_status`)  VALUES  
            ('" . $rows_3['id_form'] . "',
            '0',
            '" . $cat_id . "',
            '" . $rows_3['size'] . "',
            '" . $rows_3['details'] . "',
            '" . $rows_3['form_state'] . "')") or die(mysqli_error($con));
                }
            }
        }
    }
}

//add departmant  for company
function AddDelivery_comapny($Delivery_comapnyID, $comid)
{

    include '../db.php';
    $Delivery_comapnySelected = mysqli_query($con, "SELECT * FROM `delivery_form` WHERE id_delivery_form=$Delivery_comapnyID AND `delivery_statue_form`<=2")
        or die(mysqli_error($con));
    $res = mysqli_fetch_array($Delivery_comapnySelected);

    $ch = mysqli_query($con, "SELECT * FROM `delivery_com` WHERE fk_id_delivery_form=$Delivery_comapnyID AND delivery_fk_com=$comid")
        or die(mysqli_error($con));
    if (mysqli_num_rows($ch) > 0) {
        $msg = "تم إضافتة مسبقا";
        return false;
    } else {
        $insert = mysqli_query($con, "INSERT INTO `delivery_com`(`delivery_name`, `delivery_phone`, `delivery_address`, `delivery_email`,
         `delivery_icon`, `delivery_fk_com`, `delivery_type`,`delivery_details`,`fk_id_delivery_form`)
      VALUES ('$res[delivery_name_form]','$res[delivery_phone_form]','$res[delivery_address_form]','$res[delivery_email_form]','$res[delivery_icon_form]','$comid',
      '$res[delivery_type_form]','$res[delivery_details_form]','$res[id_delivery_form]')")
            or die(mysqli_error($con));
    }
}







function GetProductBy_depart_id($id, $com_id)
{
    include '../db.php';

    $result = mysqli_query($con, "SELECT DISTINCT  product.`product_id`,product_title,name_depart_com,name_cat_form,QR_number,image_path,price,opponent,product_desc,notice FROM `product` JOIN product_images pro_img ON product.product_id=pro_img.product_id,department_com,categories_com WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories_com.id_cat_com AND product.com_id='" . $com_id . "' AND product.id_depart_com='" . $id . "' AND `status_pro`=1 GROUP BY  product.`product_id` ") or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
?>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="osa<?php echo $id; ?>" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>
                                        #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;

                                while ($pro_depart = mysqli_fetch_array($result)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img src="../../img/product_images/<?php echo $pro_depart['image_path']; ?>" alt="<?php echo $pro_depart['product_title']; ?>" width='50px' height='50px' class='img-fluid rounded'>
                                            <?php echo $pro_depart['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_depart['product_id']; ?></p>
                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_depart['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_depart['name_cat_form']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_depart['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_depart['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>

                                            <?php echo $pro_depart['QR_number']; ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm " href='Myfun.php?delete&id=<?php echo $pro_depart['product_id'] ?>' id="" role="button">إيقاف</a>


                                            <a class="btn btn-primary btn-sm " class="btn_edit" id="<?php echo $pro_depart['product_id']; ?>" href="editproducts.php?proid=<?php echo $pro_depart['product_id']; ?>" role="button">تعديل</a>

                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                        <script>
                            $(function() {
                                $("#osa<?php echo $id; ?>").DataTable();
                                $('#example2').DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "searching": false,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": false,
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>


    <?php } else {
    ?>
        <p class="h5 text-center">لا يوجد منتجات</p>
<?php
    }
}
?>











<?php



function GetProduct_deleted_By_id_com($com_id)
{
    include '../db.php';


    $sql_st_pro1 = mysqli_query($con, "SELECT DISTINCT  product.`product_id`,product_title,name_depart_com,name_cat_form,QR_number,image_path,price,opponent,product_desc,notice  FROM `product` JOIN product_images pro_img ON product.product_id=pro_img.product_id,department_com,categories_com WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories_com.id_cat_com AND product.status_pro=0 AND product.com_id='" . $com_id . "' GROUP BY  product.`product_id`") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_st_pro1) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات محذوفة</h6>";
    } else {
?>



        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="table-deleted-product" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>
                                        #</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;
                                while ($pro_deleted = mysqli_fetch_array($sql_st_pro1)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $pro_deleted['image_path']; ?>" alt="<?php echo $pro_deleted['product_title']; ?>">
                                            <?php echo $pro_deleted['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_deleted['product_id']; ?></p>

                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_deleted['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_deleted['name_cat_form']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_deleted['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_deleted['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $pro_deleted['QR_number']; ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href='Myfun.php?back_pro=<?php echo $pro_deleted['product_id'] ?>' id="" role="button">
                                                <i class="fas fa-1x fa-sync-alt">
                                                </i>
                                                إعادة
                                            </a>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>






<?php

    }
}
?>





<?php



function GetProduct_deleted_by_admin_website_By_id_com($com_id)
{
    include '../db.php';


    $sql_st_pro1 = mysqli_query($con, "SELECT DISTINCT  product.`product_id`,product_title,name_depart_com,name_cat_form,QR_number,image_path ,price,opponent,product_desc,notice  FROM `product` JOIN product_images pro_img ON product.product_id=pro_img.product_id,department_com,categories_com WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories_com.id_cat_com AND product.status_pro=2 AND product.com_id='" . $com_id . "' GROUP BY  product.`product_id`") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_st_pro1) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات محذوفة</h6>";
    } else {
?>



        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="producte_deleted_by_admin_website" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;
                                while ($pro_deleted = mysqli_fetch_array($sql_st_pro1)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $pro_deleted['image_path']; ?>" alt="<?php echo $pro_deleted['product_title']; ?>">
                                            <?php echo $pro_deleted['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_deleted['product_id']; ?></p>

                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_deleted['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_deleted['name_cat_form']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_deleted['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_deleted['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $pro_deleted['QR_number']; ?>

                                        </td>

                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>






<?php

    }
}
?>







<?php



function Get_all_Product_By_id_com($com_id)
{
    include '../db.php';


    $sql_all_product = mysqli_query($con, "SELECT DISTINCT  product.`product_id`,product_title,name_depart_com,name_cat_form,QR_number,image_path,price,opponent,product_desc,notice,`status_pro`  FROM `product` JOIN product_images pro_img ON product.product_id=pro_img.product_id,department_com,categories_com WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories_com.id_cat_com  AND product.com_id='" . $_SESSION['comid'] . "' GROUP BY  product.`product_id`") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_all_product) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات </h6>";
    } else {
?>

        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="table-all-product" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>حالة المنتج</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count_row = 0;
                                while ($all_product = mysqli_fetch_array($sql_all_product)) {

                                ?>

                                    <tr>
                                        <td>
                                            <p><?php echo $count_row += 1; ?></p>
                                        </td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $all_product['image_path']; ?>" alt="<?php echo $all_product['product_title']; ?>">
                                            <?php echo $all_product['product_title']; ?>
                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $all_product['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $all_product['name_cat_form']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $all_product['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $all_product['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>

                                            <?php echo $all_product['QR_number']; ?>
                                        </td>
                                        <td>

                                            <?php
                                            if ($all_product['status_pro'] > 0) {
                                                if ($all_product['status_pro'] > 1) {
                                            ?>
                                                    <span class="badge badge-danger"> محذوف من إدارة الموقع </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge badge-success"> مفعل </span>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge badge-danger"> محذوف من إدارة المركز </span>
                                            <?php
                                            }
                                            ?>



                                        </td>
                                        <td>
                                            <div class="row">


                                                <div class="col col-sm-6 col-12">
                                                    <a title="عرض بيانات " class="btn btn-info   btn-sm" href="details-reactive-prod.php?details_prod_id=<?php echo $all_product['product_id'] ?>"><i class="fas fa-eye"></i></a>
                                                    <a title="إعادة" class="btn btn-success btn-sm" href='Myfun.php?back_pro=<?php echo $all_product['product_id'] ?>' id="" role="button"><i class="fas fa-1x fa-sync-alt"></i></a>
                                                </div>
                                                <div class="col col-sm-6  col-12">
                                                    <a title="حذف" class="btn btn-danger btn-sm " href='Myfun.php?delete&id=<?php echo $all_product['product_id'] ?>' id="" role="button"><i class="far fa-trash-alt"></i></a>
                                                    <a title="تعديل" class="btn btn-primary btn-sm " class="btn_edit" id="<?php echo $pro_depart['product_id']; ?>" href="editproducts.php?proid=<?php echo $all_product['product_id']; ?>" role="button"><i class="fas fa-edit"></i></a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php

    }
}
?>