<?php
include "header.php";


static $user_id_p;
$user_id_p = $_SESSION['user_id'];

static $user_name_p;
$user_name_p = $_SESSION['user_name'];

static $user_counnt_comment;
static $user_count_like;

static $user_counnt_comment_center;
static $user_count_like_center;
static $user_counnt_follow_center;

// data user
$data_user_query = "SELECT DISTINCT `user_name`,`Email`,`password`,`country`,`city`,`phone_number`,`icon` FROM `user` WHERE user.user_id=$user_id_p " or die(mysqli_error($con));

$run_query10 = mysqli_query($con, $data_user_query) or die(mysqli_error($con));
if (mysqli_num_rows($run_query10) > 0) {
    while ($row = mysqli_fetch_array($run_query10)) {
        $user_name = $row['user_name'];
        $Email = $row['Email'];
        $password = $row['password'];
        $country = $row['country'];
        $city = $row['city'];
        $phone_number = $row['phone_number'];
        $icon = $row['icon'];


    }
}
;


//button for cahng data for user. send the form and receives in the var
if (isset($_POST['btn_save'])) {

    //var for receives the data
    $user_name_edit = $_POST['user_name_edit'];
    $Email_edit = $_POST['Email_edit'];
    $password_edit = $_POST['password_edit'];
    if (strlen($password_edit) < 12) {
        $password_edit = md5($password_edit);
    }
    $country_edit = $_POST['country_edit'];
    $city_edit = $_POST['city_edit'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($picture_name == "" & $picture_type == "") {



        $query = mysqli_query($con, "UPDATE `user` SET `user_name`='".$user_name_edit."',`Email`='".$Email_edit."',`password`='".$password_edit."',`country`='".$country_edit."',`city`='".$city_edit."',`icon`='".$icon."'  WHERE `user_id`='".$user_id_p."'")or die(mysqli_error($con));

        if ($query) {
            Msg_Sucess();
        } else {
            Msg_Error1();

        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                $pic_name = time() . "_" . $picture_name; //اضافة الوقت اللي تم اظافة الصورة فيه من اجل عدم رفع صور منتجات متكررة بالأسماء
                move_uploaded_file($picture_tmp_name, "../img/user/" . $pic_name); //رفع الصورة إلى مجلد  الصور


                //update data for the user
                $query = mysqli_query($con, "UPDATE `user` SET `user_name`='".$user_name_edit."',`Email`='".$Email_edit."',`password`='".$password_edit."',`country`='".$country_edit."',`city`='".$city_edit."',`icon`='".$pic_name."'  WHERE `user_id`='".$user_id_p."'") or die(mysqli_error($con));


                if ($query) {

                    Msg_Sucess();


                } else {
                    Msg_Error1();

                }
            } else {

                Msg_Warning_size_icon_user();
            }

        } else {
            Msg_Warning_icon_user();

        }
    }


} 

// count the comment for user
$count_user_comment_query = "SELECT DISTINCT COUNT(`comment`) as `com`FROM `user` JOIN reactive_product ON user.user_id= reactive_product.user_id WHERE   user.user_id=" . $user_id_p . " AND reactive_product.comment !=''; " or die(mysqli_error($con));

$run_query11 = mysqli_query($con, $count_user_comment_query) or die(mysqli_error($con));



if ($run_query11) {
    $row = mysqli_fetch_array($run_query11);
    $user_counnt_comment = $row['com'];
}







// count liks for user
$count_user_lik_query = "SELECT DISTINCT COUNT(`user_like`) as `count_like` FROM `user` JOIN reactive_product ON user.user_id= reactive_product.user_id   WHERE  user.user_id=" . $user_id_p . " AND reactive_product.user_like>0 " or die(mysqli_error($con));

$run_query12 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
if ($run_query12) {
    $row = mysqli_fetch_array($run_query12);
    $user_count_like = $row['count_like'];
}







// count the comment from user for center
$count_user_comment_query = "SELECT DISTINCT COUNT(`comment`) as `com`FROM `user` JOIN reactive_company ON user.user_id= reactive_company.user_id WHERE   user.user_id=" . $user_id_p . " AND reactive_company.comment !='' " or die(mysqli_error($con));

$run_query13 = mysqli_query($con, $count_user_comment_query) or die(mysqli_error($con));
if ($run_query13) {
    $row = mysqli_fetch_array($run_query13);
    $user_counnt_comment_center = $row['com'];
}





// count liks from user for center
$count_user_lik_query = "SELECT DISTINCT COUNT(`user_like`) as `user_like`FROM `user` JOIN reactive_company ON  user.user_id= reactive_company.user_id WHERE   user.user_id=" . $user_id_p . " AND reactive_company.user_like>0 " or die(mysqli_error($con));

$run_query14 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
if ($run_query14) {
    $row = mysqli_fetch_array($run_query14);
    $user_count_like_center = $row['user_like'];
}


// count follow from user for center
$count_user_lik_query = "SELECT DISTINCT COUNT(`follow`) as `follow`FROM `user` JOIN reactive_company ON user.user_id= reactive_company.user_id WHERE   user.user_id=" . $user_id_p . " AND reactive_company.follow>0" or die(mysqli_error($con));

$run_query15 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
if ($run_query15) {
    $row = mysqli_fetch_array($run_query15);
    $user_counnt_follow_center = $row['follow'];
}



?>



<section class="content">
    <div class="container-fluid">

        <div class="row">


            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">
                            <?php echo $user_name ?>
                        </h3>
                        <h5 class="widget-user-desc">
                            <?php echo $phone_number ?>
                        </h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="../img/user/<?php echo $icon ?>"
                            alt="<?php echo $user_name ?>">
                    </div>
                    <br><br>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="info-box bg-gradient-success">
                                    <span class="info-box-icon "><i class="far fa-thumbs-up"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">الاعجاب</span>
                                        <span class="info-box-number">
                                            <?php echo $user_count_like ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <div class="col-sm-6">
                                <div class="info-box bg-gradient-danger">
                                    <span class="info-box-icon "><i class="far fa-comment"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">التعليقات</span>
                                        <span class="info-box-number">
                                            <?php echo $user_counnt_comment ?>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- this div for like and comment for center i do'n use because in not shar with center this website for one center
                            <div class="col-sm-4 ">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-thumbs-up"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">عدد اعجابات المراكز</span>
                                        <span class="info-box-number"><?php echo $user_count_like_center ?></span>
                                    </div>
        
                                    
                                </div>
                               
                            </div>




                            <div class="col-sm-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-comments"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">عدد التعليقات على المراكز</span>
                                        <span class="info-box-number"><?php echo $user_counnt_comment_center ?></span>
                                    </div>
                                   
                                </div>
                                
                            </div>


                            <div class="col-sm-4">
                                <div class="info-box bg-gradient-info">
                                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">عددالمراكز التي تتابعها</span>
                                        <span class="info-box-number"><?php echo $user_counnt_follow_center ?></span>
                                    </div>
                                    
                                </div>
                                
                            </div>




                            <div class="col-sm-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Messages</span>
                                        <span class="info-box-number">1,410</span>
                                    </div>
                                    
                                </div>
                               
                            </div>
                                -->
                        </div>
                        <!-- /.row -->
                        <form action="" id="frm1" method="post" type="form" name="form" enctype="multipart/form-data">

                            <div class="row">

                                <ul class="nav flex-column">

                                    <li class="nav-item">
                                        <label> الاسم</label>
                                        <input type="name" class="form-control" name="user_name_edit" required
                                            placeholder="الاسم" value="<?php echo $user_name ?>">
                                    </li>

                                    <li class="nav-item">
                                        <label> Email</label>
                                        <input type="email" class="form-control" name="Email_edit" placeholder="Email"
                                            value="<?php echo $Email ?>">

                                    </li>
                                    <div class="form-group">
                                        <li class="nav-item">
                                            <label>كلمة المرور</label>
                                            <input type="password" class="form-control" maxlength="12"
                                                name="password_edit" required placeholder="كلمة المرور"
                                                value="<?php echo $password ?>">
                                        </li>

                                        <li class="nav-item">
                                            <label> العنوان</label>
                                            <input type="address" class="form-control" name="country_edit" required
                                                placeholder="العنوان" value="<?php echo $country ?>">
                                        </li>

                                        <li class="nav-item">
                                            <label> الموقع</label>
                                            <input type="location" class="form-control" name="city_edit"
                                                placeholder="الموقع" value="<?php echo $city ?>">
                                        </li>

                                        <li class="nav-item">
                                            <label> الصورة الشخصية</label>
                                            <input type="file" class="form-control" name="picture"
                                                accept=".png, .jpg,.gif,.jpeg,jpe,.ico">


                                        </li>
                                </ul>

                            </div>
                    </div>
                    <div class="card-footer">
                        <!-- /.row -->

                        <button type="submit" id="btn_save" name="btn_save"
                            class="btn btn-block bg-gradient-danger btn-lg">تحديث البيانات</button>
                        </form>
                    </div>
                </div>

                <!-- /.widget-user -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>


<?php include('footer.php'); ?>