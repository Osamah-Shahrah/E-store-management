<?php
session_start();
include "../db.php";
include "auth.php";
include "header.php";
include "message.php";



?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إدارة المراكز التجارية</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة المراكز التجارية</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>







<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
    <a href="company.php?"
class="btn btn-info confirm-btn1">
                                    <i class="fas fa-plus"></i> إضافة مركز تجاري
                                </a>



        <div class="card-body pb-0">
            

            <div class="row d-flex align-items-stretch ">

                <?php
                $sql_user = "SELECT `com_id`,`com_name`,`com_phone`,`city`,`address`,`com_email`,`icon`,`com_status` FROM `company`  WHERE `com_status`!=0 and `com_status`<=3;";
                $res_user = mysqli_query($con, $sql_user);
                while ($users_data = mysqli_fetch_array($res_user)) {

                    ?>


                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">

                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>
                                            <?php echo $users_data['com_name']; ?>
                                        </b></h2>
                                    <p class="text-muted text-sm"><b>About: </b>
                                        <?php echo $users_data['city']; ?>
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> Address:
                                            <?php echo $users_data['address']; ?>
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #:
                                            <?php echo $users_data['com_phone']; ?>
                                        </li>

                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-map-marker-alt mr-1"></i></span> Map #:
                                            <?php echo $users_data['city']; ?>
                                        </li>
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-trash-alt"></i></span> statue :
                                            <?php if ($users_data['com_status'] == 1) {
                                                    echo " <span class=' badge bg-success'>مفعل</span>";
                                                } else
                                                    echo "<span class=' badge bg-danger'>موقف</span>";
                                                ?>
                                        </li>
                                    </ul>
                                </div>
                                <div  class="col-5 text-center">
                                    <img src="../../img/imag_comb/<?php echo $users_data['icon']; ?>"
                                        alt="<?php echo $users_data['com_name']; ?>" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a  class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                    
                                <a href="mange_one_company.php?com_id=<?php echo $users_data['com_id']; ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> عرض البيانات
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php }
                ?>




            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>






<!-- Main content -->
<section class="content" dir='rtl' align="right">


    <div class="card" dir='rtl'>
        <div class="card-header">
            <h3 class="card-title">جدول المراكز والاشتراكات</h3>
        </div>

        <div class="card-body">
            <div class="col-sm-12 table-responsive p-0">

                <table id="company_table" class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th># </th>
                            <th>بيانات المراكز</th>
                            <th>تاريخ اخر تحديث</th>
                            <th>حالة المركز</th>
                            <th>الوصول للمركز</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count_row = 0;
                        $sql = mysqli_query($con, "SELECT c.com_id,c.com_name,c.icon,c.date_modifide,c.com_status,mc.status FROM company c JOIN mang_com mc ON c.com_id=mc.com_id WHERE  com_status!=4 AND`status`!=4");
                        while ($r = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?php echo $count_row += 1; ?></td>
                                <td>
                                    <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_comb/<?php echo $r['icon']; ?>" alt="<?php echo $r['com_name']; ?>">
                                    <?php echo $r['com_name']; ?>
                                    <input type="text" name="com_id" id='com_id' style='display: none;' value=" <?php echo $r['com_id']; ?>"></input>
                                </td>
                                <td>
                                    <p id='com_name'><?php echo $r['date_modifide']; ?></p>
                                </td>
                                <td>


                                    <?php
                                    if ($r['status'] == 3) {
                                        $staute_user_Enabled = "check";
                                    } else {
                                        $staute_user_Enabled = "checked";
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="checkbox" class="form-control" id="staute_user_Enabled" name="staute_user_Enabled" value="<?php echo $r['status']; ?>" <?php echo $staute_user_Enabled; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                    </div>

                                    <div class="modal fade" id="confirmationModal2" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmationModalLabel">إشعار</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    if ($r['status'] == 3) {
                                                    ?>
                                                        هل فعلا تريد تفعيل الوصول للمركز ؟

                                                    <?php
                                                    } else {
                                                    ?>
                                                        هل فعلا تريدايقاف الوصول للمركز ؟
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary confirm-btn1">موافق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                </td>








                                <td>
                                    <?php
                                    if ($r['com_status'] == 1) {
                                        $staute_com_show = "checked";
                                    } else {
                                        $staute_com_show = "check";
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="checkbox" class="form-control" id="com_status" name="com_status" value="<?php echo $r['com_status']; ?>" <?php echo $staute_com_show; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                    </div>

                                    <div class="modal fade" id="confirmationModal1" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmationModalLabel">إشعار</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    if ($r['com_status'] == 2) {
                                                    ?>
                                                        هل فعلا تريد تفعيل ضهور المركز؟

                                                    <?php
                                                    } else {
                                                    ?>
                                                        هل فعلا تريد ايقاف ضهور المركز؟
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary confirm-btn">موافق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>


                                <td>
                                    <div class="tools">
                                        <a title="تعديل البيانات" href="company.php?com_id=<?php echo $r['com_id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
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
















    <div class="card" dir='rtl'>
        <div class="card-header">
            <h3 class="card-title">جدول المراكز المرفوضة</h3>
        </div>

        <div class="card-body">
            <div class="col-sm-12 table-responsive p-0">

                <table id="company_table_unacceptable" class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th># </th>
                            <th>بيانات المراكز</th>
                            <th>تاريخ اخر تحديث</th>

                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count_row = 0;
                        $sql = mysqli_query($con, "SELECT c.com_id,c.com_name,c.icon,c.date_modifide,c.com_status,mc.status FROM company c JOIN mang_com mc ON c.com_id=mc.com_id WHERE  com_status=4 AND`status`=4");
                        while ($r = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td><?php echo $count_row += 1; ?></td>
                                <td>
                                    <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_comb/<?php echo $r['icon']; ?>" alt="<?php echo $r['com_name']; ?>">
                                    <?php echo $r['com_name']; ?>
                                    <input type="text" name="com_id" id='com_id' style='display: none;' value=" <?php echo $r['com_id']; ?>"></input>
                                </td>
                                <td>
                                    <p id='com_name'><?php echo $r['date_modifide']; ?></p>
                                </td>

                                <td>
                                    <div class="tools">
                                        <a title="تعديل البيانات" href="company.php?com_id=<?php echo $r['com_id']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </a>
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

</section>



<?php
include "footer.php";
?>