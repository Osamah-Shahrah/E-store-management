<?php
include 'header.php';



?>






<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">بيانات المتجر</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">بيانات المتجر</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


















<!-- Main content -->
<section class="content" >
    <div class="container-fluid">
        <div class="row">
            <!-- hear write the code -->



            <div class="col-md-12">

                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background: url('../../img/imag_comb/<?php echo $com_icon ?>') center center;">
                        <h3 class="widget-user-username text-right">
                            <?php echo $com_name ?>
                        </h3>
                        <h5 class="widget-user-desc text-right">
                            <?php echo $com_phone ?>
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="../../img/imag_comb/<?php echo $com_icon ?>" alt="<?php echo $com_name ?>" />
                    </div>



                    <div class="card-footer">
                        <div class="row">


                            <ul class="nav flex-column col-md-6">
                                <li class="nav-item">
                                    <a href="Users.php" class="nav-link">
                                        الموظفين <span class="float-right badge bg-primary">
                                            <?php echo $countUser[0] ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_products.php" class="nav-link">
                                        المنتجات <span class="float-right badge bg-info">
                                            <?php echo $count_Products[0]; ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="all_department.php" class="nav-link">
                                        الاقسام <span class="float-right badge bg-success">
                                            <?php echo $count_department[0] ?>
                                        </span>
                                    </a>
                                </li>

                            </ul>



                            <ul class="nav flex-column  col-md-6">
                                <li class="nav-item">
                                    <a href="subscriptions.php" class="nav-link">
                                        المنتجات المتبقية <span class="float-right badge bg-danger">
                                            <?php echo $remaning_bunch[0] ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_custmers.php" class="nav-link">
                                        المتابعين <span class="float-right badge bg-primary">
                                            <?php echo $count_follow[0] ?>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="reactive.php" class="nav-link">
                                        الاعجابات <span class="float-right badge bg-info">
                                            <?php echo $count_likes[0] ?>
                                        </span>
                                    </a>
                                </li>


                            </ul>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>





                </div>
                <!-- /.widget-user -->



                <!-- About Me Box -->
                <div class="card card-outline card-primary" >
                    <div class="card-header">
                        <h3 class="card-title">بيانات المتجر</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" align='right'>

                        <strong><i class="fas fa-lg fa-building"></i>
                            <?php echo $com_name; ?>
                        </strong>


                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> العنوان</strong>

                        <p class="text-muted">
                            <?php echo "<span class='tag tag-danger'> <i class='fas fa-sm fa-city'>:" . $com_City . "</i> </span>, <span class='tag tag-danger'> <i class='fas fa-sm fa-car'>:" . $com_address . "</i> </span>,<span class='tag tag-danger'> <i class='fas fa-sm fa-map-marker-alt'>:" . $com_location . "</i> </span>"; ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-lg fa-phone"></i>تواصل</strong>

                        <p class="text-muted">
                            <?php echo "<span class='tag tag-danger'> <i class='fas fa-sm fa-phone '>:" . $com_phone . "</i> </span>, <span class='tag tag-danger'> <i class='fas fa-sm fa-envelope'>:" . $com_email . "</i> </span>,<span class='tag tag-danger'> <i class='fab fa-whatsapp fa-sm'>:" . $com_whatsapp . "</i> </span>,<span class='tag tag-danger'> <i class='fab fa-telegram-plane fa-sm'>:" . $com_telegram . "</i> </span>"; ?>
                        </p>

                        <hr>

                        <strong><i class="fab fa-lg fa-facebook-f "></i>وسائل التواصل</strong>

                        <p class="text-muted">
                            <?php echo "<span class='tag tag-danger'> <i class='fab fa-facebook-f fa-sm '>:" . $com_facebook . "</i> </span>, <span class='tag tag-danger'> <i class='fab fa-instagram fa-sm'>:" . $com_instagram . "</i> </span>,<span class='tag tag-danger'> <i class='fab fa-twitter fa-sm '>:" . $com_twitter . "</i> </span>,<span class='tag tag-danger'> <i class='fab fa-linkedin fa-sm'>:" . $com_linkedin . "</i> </span>"; ?>
                        </p>

                        <hr>


                        <strong><i class="fas fa-link"></i>رابط الموقع</strong>

                        <p class="text-muted">
                            <?php echo $com_website_company; ?>
                        </p>


                        <strong><i class="far fa-file-alt mr-1"></i> وصف المتجر</strong>

                        <p class="text-muted">
                            <?php echo $com_about_company; ?>
                        </p>

                        <strong><i class="fa fa-comments fa-fw"></i>الرسالة الترحيبية</strong>

                        <p class="text-muted">
                            <?php echo $com_messg_comm; ?>
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

















                <div class="card card-outline card-primary collapsed-card" dir='rtl' align='right'>
                    <div class="card-header" data-card-widget="collapse">

                        <div class="card-tools" style="float: left;">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <h3 class="card-title" style="float: right;">تعديل البيانات</h3>



                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="display: none;">




                        <form action="insert_data.php" id="form_chang_myaccount" class="text-start g-3 needs-validation row" method="post" type="form" name="form_chang_myaccount" enctype="multipart/form-data">

                            <div class="row" style="width: 100%;">


                                <div class="col-md-6">
                                    <h5>البيانات الرائيسية</h5>



                                    <div class="form-group">
                                        <label for="com_name"> أسم المتجر</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                            </div>

                                            <input type="text" class="form-control" name="com_name" id="com_name" required placeholder="الاسم" value="<?php echo $com_name; ?>">
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="com_phone">رقم الهاتف</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" id="com_phone" name="com_phone" type="text" value="<?php
                                                                                                                    echo $com_phone;
                                                                                                                    ?>" class="form-control" data-inputmask='"mask": "999 999 999"' data-mask required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>







                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="city">المدينة</label>

                                            <select class="form-control select2bs4"  style="width: 100%;" id="city" name="city">

                                                <?php
                                                if ($com_City != "") {
                                                    echo "<option  selected='selected' value='" . $com_City . "'>" . $com_City . "</option>";
                                                } else {
                                                    echo "<option selected='selected' value=''>إختر المدينة</option>";
                                                }
                                                $query_user_permissions1 = "SELECT DISTINCT `city` FROM `company` WHERE `com_id`!='" . $_SESSION['comid'] . "' AND city!='" . $com_City . "' ;" or die(mysqli_error($con));
                                                $run_query_user_permissions2 = mysqli_query($con, $query_user_permissions1) or die(mysqli_error($con));
                                                if (mysqli_num_rows($run_query_user_permissions2) > 0) {

                                                    while ($user_permissions3 = mysqli_fetch_array($run_query_user_permissions2)) {

                                                        echo "<option value='$user_permissions3[city]'>$user_permissions3[city]</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="picture">شعار المركز</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="picture" name="picture" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                                <label class="custom-file-label" for="picture">إخترالصورة</label>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $(document).ready(function() {
                                            bsCustomFileInput.init();

                                        });
                                    </script>



                                </div>


                                <div class="col-md-6">
                                    <h5>العناوين</h5>


                                    <div class="form-group">
                                        <label for="address"> العنوان</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="العنوان" value="<?php
                                                                                                                                                echo $com_address;
                                                                                                                                                ?>">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="com_email"> Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" class="form-control" name="com_email" id="com_email" placeholder="Email" value="<?php echo $com_email; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location"> الموقع</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marker-alt mr-1"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="location" id="location" placeholder="الموقع" value="<?php echo $com_location; ?>">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="com_about_company">وصف المتجر</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <textarea class="form-control" rows="2" name="com_about_company" id="com_about_company" required placeholder="وصف المتجر"><?php echo $com_about_company; ?></textarea>


                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row" style="width: 100%;">

                                <div class="col-md-6">
                                    <h5>بيانات التواصل</h5>

                                    <div class="form-group">
                                        <label for="com_whatsapp"> وتس اب</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-whatsapp fa-lg"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_whatsapp" id="com_whatsapp" placeholder="وتس اب" value="<?php
                                                                                                                                                        echo $com_whatsapp;
                                                                                                                                                        ?>">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="com_telegram"> تلجرام</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" for="com_telegram"><i class="fab fa-telegram-plane fa-lg" for="com_telegram"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_telegram" id="com_telegram" placeholder="تلجرام" value="<?php echo $com_telegram; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="com_website_company"> رابط الموقع</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_website_company" id="com_website_company" required placeholder="رابط الموقع" value="<?php echo $com_website_company; ?>">
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="com_messg_comm">رسالة التواصل</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-comments fa-fw"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_messg_comm" id="com_messg_comm" placeholder="رسالة التواصل" value="<?php
                                                                                                                                                                    echo $com_messg_comm;
                                                                                                                                                                    ?>">
                                        </div>

                                    </div>





                                </div>


                                <div class="col-md-6">
                                    <h5> التواصل الاجتماعي</h5>

                                    <div class="form-group">
                                        <label for="com_instagram"> انستجرام</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-instagram fa-lg fa-fw"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_instagram" id="com_instagram" placeholder="انستجرام" value="<?php
                                                                                                                                                            echo $com_instagram;
                                                                                                                                                            ?>">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="com_facebook">فيسبوك</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-facebook-f fa-lg fa-fw"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_facebook" id="com_facebook" placeholder="فيسبوك" value="<?php echo $com_facebook; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="com_twitter"> تويتر</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-twitter fa-lg fa-fw"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_twitter" id="com_twitter" placeholder="تويتر" value="<?php echo $com_twitter; ?>">
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label for="com_linkedin">لينكد ان</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fab fa-linkedin fa-lg fa-fw"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="com_linkedin" id="com_linkedin" placeholder="لينكد ان" value="<?php echo $com_linkedin; ?>">
                                        </div>
                                    </div>


                                </div>


                            </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button class="btn btn-block btn-info" id="sub" type="submit" name="btn_save_data_profile">حفظ
                            <span data-feather="save"></span>
                        </button>

                        </form>


                    </div>

                </div>
                <!-- /.card -->




            </div>
            <!-- /.col-12 -->

        </div><!-- /.container-fluid -->
    </div>
</section>
<!-- /.content -->


<?php
include 'footer.php';
?>