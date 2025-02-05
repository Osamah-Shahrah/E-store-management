<?php
session_start();
include 'header.php';
include '../db.php';
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="float: right;">طلبات تفعيل الانضمام</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="float:left!important;">
            
              <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
              <li class="breadcrumb-item active">طلبات تفعيل الانضمام</li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>






<!-- Main content -->
<section class="content" dir='rtl' align="right">
    <div class="card" dir='rtl'>
        <div class="card-header">
            <h5>جدول طلبات المراكز </h5>
        </div>

        <div class="card-body">
            <div class="col-sm-12 table-responsive p-0">

                <table id="company_table" class="table table-bordered table-striped ">
                    <thead>
                        <tr>
                            <th>رقم المركز</th>
                            <th class="h6">أسم المركز</th>
                            <th class="h6">الشعار</th>

                            <th class="h6">المدينة</th>
                            <th class="h6">العنوان</th>
                            <th class="h6">الإيميل</th>

                            <th class="h6">تلفون</th>

                            <th class="h6">الحالة</th>
                            <th class="h6">تاريخ التقديم</th>

                            <th class="h6">comm_Reg</th>
                            <th class="h6">تاريخ التحديث</th>
                            <th class="h6">الموقع</th>

                            <th class="h6">واتساب</th>
                            <th class="h6">تلجرام</th>
                            <th class="h6">موقع الويب</th>

                            <th class="h6">انستجرام</th>
                            <th class="h6">فيسبوك</th>
                            <th class="h6">X</th>

                            <th class="h6">لينكد ان</th>
                            <th class="h6">حول المركز</th>
                            <th class="h6">رسالة المركز</th>



                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = mysqli_query($con, "SELECT * FROM `company` c JOIN mang_com mc ON c.com_id=mc.com_id WHERE c.com_status=0 AND mc.status=0");
                        while ($r = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $r['com_id']; ?>

                                    <input type="text" name="com_id_accept" id='com_id_accept' style='display: none;' value=" <?php echo $r['com_id']; ?>"></input>
                                </td>
                                <td>
                                    <?php echo $r['com_name']; ?>
                                </td>
                                <td>
                                    <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_comb/<?php echo $r['icon']; ?>" alt="<?php echo $r['com_name']; ?>" class="img-circle img-size-32 mr-2">
                                </td>
                                <td>
                                    <?php echo $r['city']; ?>
                                </td>
                                <td>
                                    <?php echo $r['address']; ?>
                                </td>
                                <td>
                                    <?php echo $r['com_email']; ?>
                                </td>
                                <td>
                                    <?php echo $r['com_phone']; ?>
                                </td>
                                <td>
                                    <?php echo $r['com_status']; ?>

                                    <?php
                                    if ($r['com_status']) {
                                        $com_status_sc = "checked";
                                    } else {
                                        $com_status_sc = "check";
                                    }
                                    ?>
                                    <div class="input-group">
                                        <input type="checkbox" class="form-control" id="com_status" name="com_status" value="<?php echo $r['com_status']; ?>" <?php echo $com_status_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                    </div>

                                </td>
                                <td>
                                    <?php echo $r['date_added']; ?>
                                </td>
                                <td>
                                    <?php echo $r['comm_Reg']; ?>
                                </td>
                                <td>
                                    <?php echo $r['date_modifide']; ?>
                                </td>
                                <td>
                                    <?php echo $r['location']; ?>
                                </td>
                                <td>
                                    <?php echo $r['whatsapp']; ?>
                                </td>
                                <td>
                                    <?php echo $r['telegram']; ?>
                                </td>
                                <td>
                                    <?php echo $r['website_company']; ?>
                                </td>
                                <td>
                                    <?php echo $r['instagram']; ?>
                                </td>
                                <td>
                                    <?php echo $r['facebook']; ?>
                                </td>
                                <td>
                                    <?php echo $r['twitter']; ?>
                                </td>
                                <td>
                                    <?php echo $r['linkedin']; ?>
                                </td>

                                <td>
                                    <?php echo $r['about_company']; ?>
                                </td>
                                <td>
                                    <?php echo $r['messg_comm']; ?>
                                </td>

                                <td>
                                    <button type="button" id="accept_new_center" name="accept_new_center" class="btn btn-block btn-success btn-sm">قبول الطلب</button>
                                    <button type="button" id="non_accept_new_center" name="non_accept_new_center" class="btn btn-block btn-danger btn-sm">رفض الطلب</button>



                                    <div class="modal fade" id="confirmationModal5" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                                    if ($r['com_status']) {
                                                    ?>
                                                        هل تريد فعلا رفض المركز بشكل كامل؟
                                                    <?php
                                                    } else {
                                                    ?>
                                                        هل تريد فعلا قبول المركز بشكل كامل؟
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary confirm-btn5">موافق</button>
                                                </div>
                                            </div>
                                        </div>
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