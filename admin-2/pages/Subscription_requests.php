<?php
session_start();
include "../db.php";
include "header.php";
include "message.php";



?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">طلبات إضافة الباقات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">طلبات إضافة الباقات</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>






<section class="content" dir='rtl' align="right">
    <div class="card" dir='rtl'>




        <div class="card-header">
            جدول طلبات تجديد الاشتراكات
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="example1" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>اسم المركز</th>
                                    <th> اسم الباقة</th>
                                    <th>عدد المنتجات </th>
                                    <th>وصف الباقة</th>
                                    <th>تاريخ الطلب</th>
                                    <th>سعر الباقة</th>
                                    <th>حالة الباقة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_quer_bunch_com = "SELECT c.com_id,c.icon,c.com_name,bc.`id_bunch_com`,bc.`bunch_name_com`,bc.`pro_count_com`,bc.bunch_com_about,bc.`date_subs`,bc.`bunch_com_price`,bunch_com_status FROM `bunch_com`bc JOIN company c ON bc.`com_id`=c.com_id WHERE bc.`bunch_com_status`=0 ORDER BY `bc`.`date_subs` DESC ";
                                $execution_query_bunch_com = mysqli_query($con, $sql_quer_bunch_com) or die(mysqli_error($con));

                                while ($array_bunch_com = mysqli_fetch_array($execution_query_bunch_com)) {
                                ?>

                                    <tr role="row" class="odd">

                                        <td>
                                            <input type="number" name="id_bunch_com" id="id_bunch_com" style="display: none;" value="<?php echo $array_bunch_com['id_bunch_com'] ?>">

                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_comb/<?php echo $array_bunch_com['icon']; ?>" alt="<?php echo $array_bunch_com['com_name']; ?>">
                                            <?php echo $array_bunch_com['com_name'] ?>
                                        </td>
                                        <td><span class="badge badge-success">
                                                <?php echo $array_bunch_com['bunch_name_com']; ?>
                                            </span>
                                        </td>
                                        <td><span class="badge badge-success">
                                                <?php echo $array_bunch_com['pro_count_com']; ?>
                                            </span>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $array_bunch_com['bunch_com_about']; ?>
                                            </span>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $array_bunch_com['date_subs']; ?>
                                            </span>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $array_bunch_com['bunch_com_price']; ?>
                                            </span>
                                        </td>
                                        <td><?php
                                            if ($array_bunch_com['bunch_com_status']) {
                                                $bunch_com_status_sc = "checked";
                                            } else {
                                                $bunch_com_status_sc = "check";
                                            }
                                            ?>
                                            <div class="input-group">
                                                <input type="checkbox" class="form-control" id="bunch_com_status" name="bunch_com_status" value="<?php echo $array_bunch_com['bunch_com_status']; ?>" <?php echo $bunch_com_status_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                            </div>

                                        </td>
                                    </tr>

                                <?php
                                }

                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->








    </div>
</section>





<?php
include "footer.php";
?>