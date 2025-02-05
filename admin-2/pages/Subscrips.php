<?php
session_start();
include "../db.php";
include "header.php";
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;"> المراكز والباقات</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة المراكز والباقات</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>





<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row">

            <div class="col-md-12">
                <div class="card card-info">


                    <div class="card-header">
                        <h5>جدول المراكز والاشتراكات</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="col-sm-12 table-responsive p-0">

                            <table id="subscraib_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>بيانات المركز</th>
                                        <th>إجمالي المنتجات</th>
                                        <th>إجمالي الاشتراكات</th>
                                        <th> المتبقية</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT DISTINCT bc.com_id FROM `bunch_com` bc JOIN company c ON bc.com_id=c.com_id;";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                    while ($r = mysqli_fetch_array($result)) {
                                        $com_id_7 = $r['com_id'];

                                        $sql_cen_bun = "SELECT c.com_id,c.com_name,c.icon,(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_7 . ") count_prod,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE `bunch_com_status`=1 AND bc.com_id=" . $com_id_7 . " ) count_prod_bun_com,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE `bunch_com_status`=1 AND bc.com_id=" . $com_id_7 . " )-(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $com_id_7 . " ) remaining
                                    FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE c.com_id=" . $com_id_7 . "  And `bunch_com_status`=1 group  by c.com_name;";
                                        $ex_sql_cen_bun = mysqli_query($con, $sql_cen_bun) or die(mysqli_error($con));

                                        while ($array_cen_bun = mysqli_fetch_array($ex_sql_cen_bun)) {
                                    ?>

                                    <tr>

                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded'
                                                src="../../img/imag_comb/<?php echo $array_cen_bun['icon']; ?>"
                                                alt="<?php echo $array_cen_bun['com_name']; ?>">
                                            <?php echo $array_cen_bun['com_name'] ?>
                                        </td>
                                        <td><?php echo $array_cen_bun['count_prod'] ?></td>
                                        <td><?php echo $array_cen_bun['count_prod_bun_com'] ?></td>
                                        <td><?php echo $array_cen_bun['remaining'] ?></td>
                                        <td>

                                            <a title="إضافة باقة" class="btn btn-danger btn-sm "
                                                href="detailsSubscrip.php?com_id=<?php echo $array_cen_bun['com_id'] ?>&com_name=<?php echo $array_cen_bun['com_name'] ?>"
                                                role="button"> <i class="fas fa-edit"></i></a>

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
                <!-- /.card -->

            </div>
        </div>
    </div>

</section>

<?php
include "footer.php";
?>