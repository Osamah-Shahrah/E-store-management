<?php

error_reporting(0);
include('../db.php');
// Code user Registration
if(isset($_POST['login']))
{
$name=$_POST['fullname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$country=$_POST['country'];
$city=$_POST['city'];
$phone_number=$_POST['phone_number'];
$query=mysqli_query($con,"SELECT * FROM `user` WHERE `Email`='$email' and `password`='$password'");

if(mysqli_num_rows($query) > 0)
{
    echo "<script>alert('الاسم موجود بالفعل');</script>";
}
else
{
    $query_inser=mysqli_query($con,"INSERT INTO `user`(`user_name`, `Email`, `password`, `country`, `city`, `phone_number`,`icon`, `user_type`, `com_id`, `user_state`) VALUES('$name','$email','$password','$country','$city','$phone_number','1.png','0','0','1')");
    if($query_inser)
    {
       
        $query=mysqli_query($con,"SELECT * FROM `user` WHERE `Email`='$email' and `password`='$password'");
        $num=mysqli_fetch_array($query);
        if($num>0)
        {
        echo "<script>alert('تم تسجيل الدخول بنجاح');</script>";
        $_SESSION['email']=$num['email'];
        $_SESSION['user_id']=$num['user_id'];
        $_SESSION['user_name']=$num['user_name'];
        $_SESSION['icon_user']=$num['icon'];
        }
    }
    else{
        echo "<script>alert('لم تنجح عمليه التسجيل');</script>";
    }
}

}


?>


<script type="text/javascript">
function valid() {
    if (document.register.password.value != document.register.confirmpassword.value) {
        alert("Password and Confirm Password Field do not match  !!");
        document.register.confirmpassword.focus();
        return false;
    }
    return true;
}
</script>


<script>
function userAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_availability.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status1").html(data);
            $("#loaderIcon").hide();
        },
        error: function() {}
    });
}
</script>



<div class="wait overlay" style="display: none;">
    <div class="loader"></div>
</div>
<div class="container-fluid">
    <!-- row -->
    <div class="login-marg">
        <!-- Billing Details -->


        <!-- /Billing Details -->

        <form id="login" class="login100-form " method="post" name="register" onSubmit="return valid();">
            <div class="billing-details jumbotron">

                <div class="section-title">
                    <h2 class="login100-form-title ">سجل هنا</h2>
                </div>
                <div class="form-group ">

                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="text" name="fullname" id="fullname" required="" placeholder="الاسم الرباعي">
                </div>
                <!-- one input
                <div class="form-group">

                    <input class="input-borders input form-control " style=" border-radius: 30px; text-align: center;"type="text" name="l_name" id="l_name"
                        placeholder="الاسم الاخير">
                </div>
                -->
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="email" onBlur="userAvailability()" name="email" placeholder="البريد الإلكتروني"
                        required="">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="password" name="password" id="password" required="" placeholder="كلمة المرور">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="password" name="repassword" id="repassword" required="" placeholder="تاكيد كلمة المرور">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="text" name="phone_number" id="phone_number" required="" placeholder="رقم الجوال">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="text" name="country" id="country" placeholder="الدولة">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="text" name="city" id="city" required="" placeholder="المدينة">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit" name="login">تسجيل</button>
                </div>

            </div>


        </form>


    </div>

</div>
<script>
$(document).ready(function() {
    $(".changecolor").switchstylesheet({
        seperator: "color"
    });
    $('.show-theme-options').click(function() {
        $(this).parent().toggleClass('open');
        return false;
    });
});

$(window).bind("load", function() {
    $('.show-theme-options').delay(2000).trigger('click');
});
</script>
<!-- For demo purposes – can be removed on production : End -->`