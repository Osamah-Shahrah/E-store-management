<?php

error_reporting(0);

if(isset($_POST['submit']))
{

 $phone_number=$_POST['phone_number'];
   $password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM `user` WHERE `phone_number`='$phone_number' and `password`='$password'")or die(mysqli_error($con));
$num=mysqli_fetch_array($query);
if($num!=0)
{
//echo "<script>alert('تم تسجيل الدخول بنجاح');</script>";

$_SESSION['email']=$num['Email'];
$_SESSION['phone_number']=$num['phone_number'];
$_SESSION['user_id']=$num['user_id'];
$_SESSION['user_name']=$num['user_name'];
$_SESSION['icon_user']=$num['icon'];

}
else
{
 echo "<script>alert('اسم المستخدم اوكلمة المرور خطاء');</script>";
$phone_number=$_POST['phone_number'];
header('location:index.php');

}
}


?>

<div class="wait overlay" style="display: none;">
    <div class="loader"></div>
</div>
<div class="container-fluid">
    <!-- row -->
    <div class="login-marg">

        <form  class="login100-form " method="post">
            <div class="billing-details jumbotron">
                <div class="section-title">
                    <h2 class="login100-form-title ">تسجيل الدخول</h2>
                </div>


                <div class="form-group">
                    <label for="number">رقم الهاتف</label>
                    <input class="form-control" style=" border-radius: 30px; text-align: center;" type="text"
                        name="phone_number" placeholder="رقم الهاتف" id="password" required="">
                </div>

                <div class="form-group">
                    <label for="phone_number">كلمة المرور</label>
                    <input class="form-control" style=" border-radius: 30px; text-align: center;" type="password"
                        name="password" placeholder="كلمة المرور" id="password" required="">
                </div>

                <div class="text-pad" style=" border-radius: 30px; text-align: center;">
                    <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#templatemo_forgit_pass">
                        هل نسيت كلمة المرور؟
                    </a>

                    <a   data-bs-toggle="modal" data-bs-target="#create_account">
                       إنشاء حساب 
                    </a>

                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" type="submit" name="submit">دخول</button>
                </div>
            </div>

        </form>
      

    </div>


</div>
<!-- div the  forgit password form -->
<div class="modal fade" id="templatemo_forgit_pass" role="dialog">
    <div class="modal-dialog" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <?php
                                include "forgit_pass.php";
    
                            ?>

            </div>

        </div>

    </div>
</div>
<!-- end div the  password -->




<!-- div for create account-->
<div class="modal fade" id="create_account" role="dialog">
    <div class="modal-dialog" >

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <?php
                                include "register.php";
    
                            ?>

            </div>

        </div>

    </div>
</div>
<!-- end div create account -->


<script>
$(document).ready(function() {
    $(".changecolor").switchstylesheet({
        seperator: "color"
    });
    $('.show-theme-options').click(function() {
        //$(this).parent().toggleClass('open');

        return false;
    });
});

$(window).bind("load", function() {
    $('.show-theme-options').delay(2000).trigger('click');
});
</script>