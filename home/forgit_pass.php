<?php
error_reporting(0);
include('../db.php');
// Code user Registration
if(isset($_POST['submit']))
{
$name=$_POST['fullname'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$repassword=md5($_POST['repassword']);
$country=$_POST['country'];
$city=$_POST['city'];
$phone_number=$_POST['phone_number'];
$query=mysqli_query($con,"SELECT * FROM `user` WHERE `Email`='$email' and `user_name`='$name' and `city`='$city' and `country`=$country and `phone_number`=$phone_number ")or die(mysqli_error($con));

if(mysqli_num_rows($query) > 0)
{
    $row = mysqli_fetch_array($query);
    $id=$row['user_id'];
    $query_inser=mysqli_query($con,"UPDATE `user` SET  `password`=$repassword WHERE `user_id`=$id")or die(mysqli_error($con));
    
    echo "<script>alert('تم تعديل البيانات بنجاح');</script>";
}
else
{
   
        echo "<script>alert('لم تنجح العمليه');</script>";
    
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
                    <h2 class="login100-form-title ">اكتب البيانات المدخلة سابقا</h2>
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
                        type="password" name="password" id="password" required="" placeholder="كلمة المرورالقديمه">
                </div>
                <div class="form-group">
                    <input class="input form-control input-borders" style=" border-radius: 30px; text-align: center;"
                        type="password" name="repassword" id="repassword" required="" placeholder=" تاكيد كلمة المرور الجديد">
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
                    <button class="btn btn-success" type="submit" name="submit">تسجيل</button>
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