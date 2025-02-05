<?php
include "header.php";



static $user_id_p = 0;
if (isset($_GET['id_user_edit'])) {
    $user_id_p = $_GET['id_user_edit'];

    static $user_counnt_comment;
    static $user_count_like;
    static $user_counnt_comment_center;
    static $user_count_like_center;
    static $user_counnt_follow_center;

    static $staute_user;
    // data user
    $data_user_query = "SELECT DISTINCT `user_name`,`Email`,`password`,`country`,`city`,`phone_number`,`icon`,`user_state`,`fk_permissions` FROM `user` WHERE user_id='" . $user_id_p . "'" or die(mysqli_error($con));

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
            $permissions = $row['fk_permissions'];
            $statue_user = $row['user_state'];
            if ($row['user_state']) {
                $staute_user = "checked";
            } else {
                $staute_user = "check";
            }




        }
    }

    // count the comment for user
    $count_user_comment_query = "SELECT DISTINCT COUNT(`comment`) as `com`FROM `user` JOIN reactive_product ON user.user_id= reactive_product.user_id WHERE   user.user_id='" . $user_id_p . "'  AND reactive_product.comment !=''; " or die(mysqli_error($con));

    $run_query11 = mysqli_query($con, $count_user_comment_query) or die(mysqli_error($con));

    if ($run_query11) {
        $row = mysqli_fetch_array($run_query11);
        $user_counnt_comment = $row['com'];
    }



    // count liks for user
    $count_user_lik_query = "SELECT DISTINCT COUNT(`user_like`) as `count_like` FROM `user` JOIN reactive_product ON user.user_id= reactive_product.user_id   WHERE  user.user_id='" . $user_id_p . "' AND reactive_product.user_like>0 " or die(mysqli_error($con));

    $run_query12 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
    if ($run_query12) {
        $row = mysqli_fetch_array($run_query12);
        $user_count_like = $row['count_like'];
    }







    // count the comment from user for center
    $count_user_comment_query = "SELECT DISTINCT COUNT(`comment`) as `com`FROM `user` JOIN reactive_company ON user.user_id= reactive_company.user_id WHERE   user.user_id='" . $user_id_p . "' AND reactive_company.comment !='' " or die(mysqli_error($con));

    $run_query13 = mysqli_query($con, $count_user_comment_query) or die(mysqli_error($con));
    if ($run_query13) {
        $row = mysqli_fetch_array($run_query13);
        $user_counnt_comment_center = $row['com'];
    }





    // count liks from user for center
    $count_user_lik_query = "SELECT DISTINCT COUNT(`user_like`) as `user_like`FROM `user` JOIN reactive_company ON  user.user_id= reactive_company.user_id WHERE   user.user_id='" . $user_id_p . "'  AND reactive_company.user_like>0 " or die(mysqli_error($con));

    $run_query14 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
    if ($run_query14) {
        $row = mysqli_fetch_array($run_query14);
        $user_count_like_center = $row['user_like'];
    }


    // count follow from user for center
    $count_user_lik_query = "SELECT DISTINCT COUNT(`follow`) as `follow`FROM `user` JOIN reactive_company ON user.user_id= reactive_company.user_id WHERE   user.user_id='" . $user_id_p . "'  AND reactive_company.follow>0" or die(mysqli_error($con));

    $run_query15 = mysqli_query($con, $count_user_lik_query) or die(mysqli_error($con));
    if ($run_query15) {
        $row = mysqli_fetch_array($run_query15);
        $user_counnt_follow_center = $row['follow'];
    }


    //Msg_Sucess();
}



?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir='rtl' align='right'>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">بيانات الموظف</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">بيانات الموظف</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>





<!-- Main content -->
<section class="content" dir='rtl' align='right'> 
    <div class="container-fluid">
        <div class="row">
            <!-- hear write the code -->

            <div class="col">



                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user-2"  >
                    <?php if ($user_id_p > 0) { ?>
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info" >
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="../../img/user/<?php if ($user_id_p > 0) {
                                    echo $icon;
                                } ?>" alt="<?php if ($user_id_p > 0) {
                                     echo $user_name;
                                 } ?>">
                            </div>
                            <h3 class="widget-user-username">

                                <?php if ($user_id_p > 0) {
                                    echo $user_name;
                                } ?>
                            </h3>
                            <h5 class="widget-user-desc">
                                <?php if ($user_id_p > 0) {
                                    echo $phone_number;
                                } ?>
                            </h5>
                        </div>
                    <?php } ?>
                    <div class="card-body">
                        <?php if ($user_id_p > 0) { ?>
                            <div class="row">
                                <div class="col">

                                    <div class="info-box bg-gradient-success">
                                        <span class="info-box-icon "><i class="far fa-thumbs-up"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">الاعجاب</span>
                                            <span class="info-box-number">
                                                <?php if ($user_id_p > 0) {
                                                    echo $user_count_like;
                                                } ?>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <div class="col">
                                    <div class="info-box bg-gradient-danger">
                                        <span class="info-box-icon "><i class="far fa-comment"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">التعليقات</span>
                                            <span class="info-box-number">
                                                <?php if ($user_id_p > 0) {
                                                    echo $user_counnt_comment;
                                                } ?>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- this div for like and comment for center i do'n use because in not shar with center this website for one center-->
                                <div class="col ">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-success"><i class="far fa-thumbs-up"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">عدد اعجابات المراكز</span>
                                            <span class="info-box-number">
                                                <?php if ($user_id_p > 0) {
                                                    echo $user_count_like_center;
                                                } ?>
                                            </span>
                                        </div>


                                    </div>

                                </div>




                                <div class="col">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info"><i class="far fa-comments"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">عدد التعليقات على المراكز</span>
                                            <span class="info-box-number">
                                                <?php if ($user_id_p > 0) {
                                                    echo $user_counnt_comment_center;
                                                } ?>
                                            </span>
                                        </div>

                                    </div>

                                </div>


                                <div class="col">
                                    <div class="info-box bg-gradient-info">
                                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">عددالمراكز التي تتابعها</span>
                                            <span class="info-box-number">
                                                <?php if ($user_id_p > 0) {
                                                    echo $user_counnt_follow_center;
                                                } ?>
                                            </span>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>
                        <!-- /.row -->
                        <form action="insert_data.php" id="form_chang_staff" class="text-start g-3 needs-validation row"
                            method="post" type="form" name="form_chang_staff" enctype="multipart/form-data">




                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_name_edit"> اسم الموظف</label>
                                    <div class="input-group" > 
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-text">@</i></span>
                                        </div>

                                        <input  type="name" class="form-control" name="user_name_edit"
                                            id="user_name_edit" required placeholder="الاسم" value="<?php if ($user_id_p > 0) {
                                                echo $user_name;
                                            } ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="phone_number">رقم الهاتف</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" id="phone_number" name="phone_number" type="text"
                                            class="form-control" data-inputmask='"mask": "(999) 999-999"' data-mask
                                            value="<?php if ($user_id_p > 0) {
                                                echo $phone_number;
                                            } ?>" required>
                                    </div>
                                    <!-- /.input group -->
                                </div>



                                <div class="form-group">
                                    <label for="Email_edit"> Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="Email_edit" id="Email_edit"
                                            placeholder="Email" value="<?php if ($user_id_p > 0) {
                                                echo $Email;
                                            } ?>" required>
                                    </div>
                                </div>



                                <div class="form-group">

                                    <label for="password_edit">كلمة المرور</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-mask"></i></span>
                                        </div>
                                        <input type="password" class="form-control" maxlength="12" name="password_edit"
                                            id="password_edit" required placeholder="كلمة المرور" value="<?php if ($user_id_p > 0) {
                                                echo $password;
                                            } ?>">
                                    </div>
                                </div>




                            </div>



                            <div class="col-md-6">

                                <?php if ($user_id_p > 0) { ?>
                                    <!-- this input for take user id and send in to page insert data for up data or delet and return user id for use chang data for new data for user -->
                                    <input type="text" style="display:none;" class="form-control" id="user_id_p" required
                                        name="user_id_p" value=" <?php if ($user_id_p > 0) {
                                            echo $user_id_p;
                                        } ?>" />
                                    <div class="form-group ">

                                        <label for="user_status">حالة الموظف</label>
                                        <div class="input-group">
                                            <input type="checkbox" class="form-control" id="user_status" name="user_status"
                                                value="<?php if ($user_id_p > 0) {
                                                    echo $statue_user;
                                                } ?>" <?php if ($user_id_p > 0) {
                                                     echo $staute_user;
                                                 } ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                                        </div>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#user_status').on('switchChange.bootstrapSwitch', function (event,
                                                state) {
                                                if (state) {

                                                    $(this).val('1');
                                                } else {
                                                    $(this).val('0');
                                                }


                                            });
                                        });
                                    </script>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="permissions">الصلاحيات</label>

                                    <select class="form-control select2bs4"  style="width: 100%;" id="permissions"
                                        name="permissions">

                                        <?php if ($user_id_p > 0) {
                                            $qu_us_and_permis = mysqli_query($con, "SELECT DISTINCT `id_user_permissions`,`name_user_permissions` FROM `user_permissions` JOIN `user` ON user_permissions.id_user_permissions =user.fk_permissions WHERE `status_user_permissions`!=0 AND user.user_id='" . $user_id_p . "' ;") or die(mysqli_error($con));
                                            if (mysqli_num_rows($qu_us_and_permis) > 0) {
                                                $data_us_permis = mysqli_fetch_array($qu_us_and_permis);



                                                echo "<option  selected='selected' value='$data_us_permis[id_user_permissions]'>$data_us_permis[name_user_permissions]</option>";
                                            }
                                        } else {
                                            echo "<option selected='selected' value='1'>إختر الصلاحيات</option>";
                                        }

                                        $query_user_permissions = "SELECT `id_user_permissions`,`name_user_permissions` FROM `user_permissions` WHERE `status_user_permissions`!=0 " or die(mysqli_error($con));

                                        $run_query_user_permissions = mysqli_query($con, $query_user_permissions) or die(mysqli_error($con));
                                        if (mysqli_num_rows($run_query_user_permissions) > 0) {
                                            while ($user_permissions = mysqli_fetch_array($run_query_user_permissions)) {




                                                echo "<option value='$user_permissions[id_user_permissions]'>$user_permissions[name_user_permissions]</option>";


                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="country_edit"> العنوان</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="address" class="form-control" name="country_edit" id="country_edit"
                                            required placeholder="العنوان" value="<?php if ($user_id_p > 0) {
                                                echo $country;
                                            } ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="city_edit"> الموقع</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-map-marker-alt mr-1"></i></span>
                                        </div>
                                        <input type="location" class="form-control" name="city_edit" id="city_edit"
                                            placeholder="الموقع" value="<?php if ($user_id_p > 0) {
                                                echo $city;
                                            } ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group" style="width: 100%;">
                                <label for="picture">الصورة الشخصية</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="picture" name="picture"
                                            accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                                        <label class="custom-file-label" for="picture">إخترالصورة</label>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    bsCustomFileInput.init();

                                });
                            </script>



                    </div>

                    <div class="card-footer">
                        <!-- /.row -->
                        <?php
                        if ($user_id_p > 0) {

                            echo " <button type='submit' id='btn_change_staff' name='btn_change_staff' class='btn btn-block bg-gradient-warning btn-lg'>تحديث البيانات</button>
                            <button  id='btn_delet_staff'  class='btn btn-block bg-gradient-danger  btn-lg'>حذف / إيقاف</button>";


                        } else {
                            echo " <button type='submit' id='btn_add_staff' name='btn_add_staff' class='btn btn-block bg-gradient-success btn-lg'>تسجيل</button>";
                        }
                        ?>


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

<script>
    //**************/ cod javascript  for page user_data to even in chang or add user \\**************\

    $(document).ready(function () {


        $("#btn_delet_staff").click(function () {

            var user_id_p = $("#user_id_p").val();
            //alert(user_id_p);
            $.post("run_ajax_fun.php", {
                user_id_p: user_id_p
            }, function (data) {


                if (data.messg == "1") {

                    //Msg_Sucess2();
                    location.reload();
                    //alert(user_id_p);
                } else {

                    //Msg_Error2();
                    //alert(user_id_p);
                    location.reload();
                }

            }, "json");
        });

    });
</script>

<?php include 'footer.php'; ?>