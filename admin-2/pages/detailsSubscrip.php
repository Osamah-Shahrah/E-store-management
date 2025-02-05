<?php
session_start();
include "../db.php";
include "header.php";
//include "message.php";
$com_name = $_GET['com_name'];

$com_id_o = $_GET['com_id'];
$sql = "SELECT c.com_id,c.com_name,c.icon,(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_o . ") count_prod,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1 ) count_prod_bun_com,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1 )-(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_o . " ) remaining
FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  c.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1  group  by c.com_name;";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));
if ($result) {
    $r = mysqli_fetch_array($result);
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">المراكز والباقات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">المراكز والباقات</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<div id='respon'>


</div>



<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row">

            <div class="col-md-12">
                <div class="card" dir='rtl'>
                    <div class="row">

                        <span id="comid" style="display: none;"><?php echo $com_id_o; ?></span>

                        <div class="col-md-6">
                            <div class="text-center border">
                                <h2 class="h4"> أسم المركز</h2>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border text-center">
                                <h2 class="h5"><?php echo $com_name ?></h2>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-center border">
                                <h2 class="h4">
                                    المنتجات المتاحة</h2>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="border text-center ">
                                <h2 class="h5"><?php echo $r['count_prod_bun_com'] ?></h2>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="text-center border">
                                <h2 class="h4">
                                    عدد منتجات المركز </h2>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border text-center ">
                                <h2 class="h5"><?php echo $r['count_prod'] ?></h2>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="text-center border">
                                <h2 class="h4">
                                    عدد المنتجات المتبقية</h2>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="border text-center ">
                                <h2 class="h5"><?php echo $r['remaining']
                                                ?></h2>
                            </div>
                        </div>





                        <div class="col-md-6">
                            <div class="text-center border">
                                <h2 class="h4">
                                    إضافة باقة
                                </h2>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border ">

                                <select class="form-control select2bs4"  style="width: 100%;"  name="bunch" id="bunch" required>
                                    <option class="h5"> إختر الباقة </option>
                                    <?php
                                    $res = mysqli_query($con, "SELECT * from bunch") or die(mysqli_error($con));
                                    while ($r = mysqli_fetch_array($res)) {

                                    ?>

                                    <option id="<?php echo $r['bunch_ID']; ?>"><?php echo $r['bunch_form_name'] ?>
                                    </option>
                                    <?php
                                    }

                                    ?>


                                </select>

                            </div>
                        </div>


                    </div>
                    <div class="col-md-12 text-center border">
                        <a class="btn btn-block btn-success btn-flat" id="btntt" href="#" role="button">تجديد </a>
                    </div>
                </div>


                <div class="card card-info" id="oopo">
                    <div class="card-header">
                        <h5>الباقات المشترك بها :<?php echo $com_name; ?></h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="subscraib_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>اسم الباقة</th>
                                        <th> عدد المنتجات</th>
                                        <th> سعر الباقة</th>
                                        <th> حول الباقة</th>
                                        <th> القسم</th>
                                        <th> تاريخ الاشتراك</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_7 = "SELECT `id_bunch_com`,`date_subs`,`bunch_com_status`,`bunch_name_com`,`pro_count_com`,`bunch_com_price`,`bunch_com_about`,`bunch_com_depatr` FROM `bunch_com`bc JOIN company c ON bc.`com_id`=c.com_id  WHERE c.`com_id`= " . $com_id_o . " AND (bc.bunch_com_status=1 or bc.bunch_com_status=2) ;";
                                    $result_4 = mysqli_query($con, $sql_7) or die(mysqli_error($con));
                                    while ($r = mysqli_fetch_array($result_4)) {

                                    ?>

                                    <tr>

                                        <td>
                                            <input type="number" name="id_bunch_com_detailsSubscrip"
                                                id="id_bunch_com_detailsSubscrip" style="display: none;"
                                                value="<?php echo $r['id_bunch_com'] ?>">
                                            <?php echo $r['bunch_name_com'] ?>
                                        </td>
                                        <td><?php echo $r['pro_count_com'] ?></td>
                                        <td><?php echo $r['bunch_com_price'] ?></td>
                                        <td><?php echo $r['bunch_com_about'] ?></td>
                                        <td><?php echo $r['bunch_com_depatr'] ?></td>
                                        <td><?php echo $r['date_subs'] ?></td>
                                        <td>
                                            <?php
                                                if ($r['bunch_com_status'] == 1) {
                                                    $bunch_com_status_sc = "checked";
                                                } else {
                                                    $bunch_com_status_sc = "check";
                                                }
                                                ?>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control"
                                                    id="bunch_com_status_detailsSubscrip"
                                                    name="bunch_com_status_detailsSubscrip"
                                                    value="<?php echo $r['bunch_com_status']; ?>"
                                                    <?php echo $bunch_com_status_sc; ?> data-bootstrap-switch
                                                    data-off-color="danger" data-on-color="success" />
                                            </div>

                                            <div class="modal fade" id="confirmationModal3" tabindex="-1" role="dialog"
                                                aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmationModalLabel">إشعار
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                                if ($r['bunch_com_status'] == 1) {
                                                                ?>
                                                            هل تريد فعلا ايقاف الباقة؟
                                                            <?php
                                                                } else {
                                                                ?>
                                                            هل تريد فعلا تفعيل الباقة؟
                                                            <?php
                                                                }
                                                                ?>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-primary confirm-btn">موافق</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>


                                    </tr>





                                    <?php

                                    }
                                    ?>


                                <tfoot>
                                    <tr>
                                        <th>الاجمالي</th>

                                        <th> إجمالي المنتجات </th>
                                        <th> إجمالي السعر</th>
                                        <th> إجمالي المنتجات المرفوعة</th>
                                        <th> المنتجات المتبقية</th>

                                        <th> </th>
                                        <th></th>
                                    </tr>

                                    <?php

                                    $sql_cen_bun = "SELECT c.com_id,c.com_name,c.icon,(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_o . " ) count_prod,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1 ) count_prod_bun_com,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1 )-(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_o . " ) remaining,(SELECT  SUM(bc.bunch_com_price) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE  bc.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1)sum_price
                  FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE c.com_id=" . $com_id_o . " AND  bc.bunch_com_status=1  group  by c.com_name ;";
                                    $ex_sql_cen_bun = mysqli_query($con, $sql_cen_bun) or die(mysqli_error($con));

                                    while ($array_cen_bun = mysqli_fetch_array($ex_sql_cen_bun)) {
                                    ?>


                                    <tr style="background-color:#B5E81B;">

                                        <td>

                                        </td>

                                        <td><?php echo $array_cen_bun['count_prod_bun_com'] ?></td>
                                        <td><?php echo $array_cen_bun['sum_price'] ?></td>
                                        <td><?php echo $array_cen_bun['count_prod'] ?></td>
                                        <td><?php echo $array_cen_bun['remaining'] ?></td>

                                        <td><?php //echo $array_cen_bun['remaining'] 
                                                ?></td>

                                        <td>


                                        </td>


                                    </tr>
                                    <?php

                                    }

                                    ?>
                                </tfoot>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>

</section>
<?php

include "footer.php";
?>