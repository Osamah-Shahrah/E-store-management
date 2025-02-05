<?php
session_start();
include "../db.php";
include 'auth.php';
include "header.php";
include "message.php";

?>
<?php

////////////////////////Company
//All company 
$sql_count_Centers = mysqli_query($con, "select DISTINCT count(*) AS C from company ");
$count_Centers = mysqli_fetch_array($sql_count_Centers);
//All company working 
$sql_count_Centers_working = mysqli_query($con, "select count(*) AS C from company WHERE `com_status`=1");
$count_Centers_working = mysqli_fetch_array($sql_count_Centers_working);
//All company request to added
$sql_count_Centers_request = mysqli_query($con, "select count(*) AS C from company WHERE `com_status`=0");
$count_Centers_request = mysqli_fetch_array($sql_count_Centers_request);
//All company stoped from user or manger the company
$sql_count_Centers_stoped = mysqli_query($con, "select count(*) AS C from company WHERE `com_status`=2");
$count_Centers_stoped = mysqli_fetch_array($sql_count_Centers_stoped);
//All company stoped from manger wep site 
$sql_count_Centers_stoped_admin = mysqli_query($con, "select count(*) AS C from company WHERE `com_status`=3");
$count_Centers_stoped_admin = mysqli_fetch_array($sql_count_Centers_stoped_admin);
//count company unacceptable  from manger wep site 
$sql_Centers_unacceptable_admin = mysqli_query($con, "select count(*) AS C from company WHERE `com_status`=4");
$count_Centers_unacceptable_admin = mysqli_fetch_array($sql_Centers_unacceptable_admin);



////////////////////////Admin web site
//All admin web site 
$sql_countUser = mysqli_query($con, "select count(*) AS C from admin_info");
$countUser = mysqli_fetch_array($sql_countUser);
//All admin web site stoped
$sql_countUser_stoped = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_state`=0");
$countUser_stoped = mysqli_fetch_array($sql_countUser_stoped);
//All admin web site working
$sql_countUser_working = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_state`=1");
$countUser_working = mysqli_fetch_array($sql_countUser_working);
//All admin web site blocked from open web site
$sql_countUser_working_deleted = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_state`=2");
$countUser_working_deleted = mysqli_fetch_array($sql_countUser_working_deleted);

////////////////////////implementation-Admin web site
//can't do any thing guest see home page 
$sql_cant_do_any_thing = mysqli_query($con, "select count(*) AS C from admin_info  WHERE `admin_type`=0");
$admin_cant_do_any_thing = mysqli_fetch_array($sql_cant_do_any_thing);
//he can do any thing
$sql_admin_do_any_thing = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_type`=1");
$admin_do_any_thing = mysqli_fetch_array($sql_admin_do_any_thing);
//control company
$sql_control_company = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_type`=2");
$admin_control_company = mysqli_fetch_array($sql_control_company);
//control bunch
$sql_control_bunch = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_type`=3");
$admin_control_bunch = mysqli_fetch_array($sql_control_bunch);
//control customer
$sql_admin_control_customer = mysqli_query($con, "select count(*) AS C from admin_info WHERE `admin_type`=4");
$admin_control_customer = mysqli_fetch_array($sql_admin_control_customer);


////////////////////////Product
//All product for all company
$sql_count_product = mysqli_query($con, "select count(*) AS C from product ");
$count_product = mysqli_fetch_array($sql_count_product);
//All product working
$sql_count_product_working = mysqli_query($con, "select count(*) AS C from product WHERE `status_pro`=1;");
$count_product_working = mysqli_fetch_array($sql_count_product_working);
//All product stoped from mang company
$sql_count_product_stop_from_user = mysqli_query($con, "select count(*) AS C from product WHERE `status_pro`=0;");
$count_product_stop_from_user = mysqli_fetch_array($sql_count_product_stop_from_user);
//All product stoped from admin web site
$sql_count_product_stoped = mysqli_query($con, "select count(*) AS C from product WHERE `status_pro`=2;");
$count_product_stoped = mysqli_fetch_array($sql_count_product_stoped);



////////////////////////Department
//All department admin web site published
$sql_count_department = mysqli_query($con, "select count(*) AS C from department");
$count_department = mysqli_fetch_array($sql_count_department);
//All department working
$sql_count_department_working = mysqli_query($con, "select count(*) AS C from department WHERE `depart_state`=1;");
$count_department_working = mysqli_fetch_array($sql_count_department_working);
//All department the user request 
$sql_count_department_request_add = mysqli_query($con, "select count(*) AS C from department WHERE `depart_state`=0;");
$count_department_request_add = mysqli_fetch_array($sql_count_department_request_add);
//All stoped
$sql_count_department_stoped = mysqli_query($con, "select count(*) AS C from department WHERE `depart_state`=2;");
$count_department_stoped = mysqli_fetch_array($sql_count_department_stoped);

////////////////////////categories
//All categories
$sql_count_categories = mysqli_query($con, "SELECT COUNT(`cat_id`) categories FROM `categories`;");
$count_categories = mysqli_fetch_array($sql_count_categories);
//All the categories request
$sql_count_categories_request = mysqli_query($con, "SELECT COUNT(`cat_id`) categories FROM `categories` WHERE `state_cat`=0;");
$count_categories_request = mysqli_fetch_array($sql_count_categories_request);
//All the categories working
$sql_count_categories_working = mysqli_query($con, "SELECT COUNT(`cat_id`) categories FROM `categories` WHERE `state_cat`=1;");
$count_categories_working = mysqli_fetch_array($sql_count_categories_working);
//All the categories stoped
$sql_count_categories_stoped = mysqli_query($con, "SELECT COUNT(`cat_id`) categories FROM `categories` WHERE `state_cat`=2;");
$count_categories_stoped = mysqli_fetch_array($sql_count_categories_stoped);



////////////////////////Staff company
//All  staff of the copmany
$sql_count_user = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_type`=1");
$count_user = mysqli_fetch_array($sql_count_user);
//All staff stoped from manager the company 
$sql_count_user_stoped_manger = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=0 AND `user_type`=1;");
$count_user_stoped_manger = mysqli_fetch_array($sql_count_user_stoped_manger);
//All staff working
$sql_count_user_working = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=1 AND `user_type`=1;");
$count_user_working = mysqli_fetch_array($sql_count_user_working);
//All staff stoped from admin web site
$sql_count_user_stoped_admin = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=2 AND `user_type`=1;");
$count_user_stoped_admin = mysqli_fetch_array($sql_count_user_stoped_admin);

////////////////////////Customer
//All Account Customer
$sql_count_customer = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_type`=2");
$count_customer = mysqli_fetch_array($sql_count_customer);
//All Account Customer he/she stoped his/her Account
$sql_count_customer_stoped = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=0 AND `user_type`=2;");
$count_customer_stoped = mysqli_fetch_array($sql_count_customer_stoped);
//All Account Customer working
$sql_count_customer_working = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=1 AND `user_type`=2;");
$count_customer_working = mysqli_fetch_array($sql_count_customer_working);
//All Account Customer stoped from admin web site
$sql_count_customer_stoped_admin = mysqli_query($con, "SELECT COUNT(user_id) user FROM `user`WHERE `user_state`=2 AND `user_type`=2;");
$count_customer_stoped_admin = mysqli_fetch_array($sql_count_customer_stoped_admin);



////////////////////////Bunch
//All Bunch
$sql_count_Bunch = mysqli_query($con, "SELECT COUNT(bunch_ID) bunch FROM `bunch` ");
$count_Bunch = mysqli_fetch_array($sql_count_Bunch);
//All Bunch stoped 
$sql_count_Bunch_stoped = mysqli_query($con, "SELECT COUNT(bunch_ID) bunch FROM `bunch` WHERE `bunch_form_status`=0");
$count_Bunch_stoped = mysqli_fetch_array($sql_count_Bunch_stoped);
//All Bunch working
$sql_count_Bunch_working = mysqli_query($con, "SELECT COUNT(bunch_ID) bunch FROM `bunch` WHERE `bunch_form_status`=1");
$count_Bunch_working = mysqli_fetch_array($sql_count_Bunch_working);



////////////////////////Delivery Company
//All Delivery Company
$sql_count_Delivery_Company = mysqli_query($con, "SELECT COUNT(`id_delivery`) delivery_com  FROM `delivery_com`;");
$count_Delivery_Company = mysqli_fetch_array($sql_count_Delivery_Company);
//All Delivery Company request
$sql_count_Delivery_Company_request = mysqli_query($con, "SELECT  COUNT(`id_delivery`) delivery_com  FROM `delivery_com` WHERE `delivery_statue`=0   ; ");
$count_Delivery_Company_request = mysqli_fetch_array($sql_count_Delivery_Company_request);
//All Delivery Company working
$sql_count_Delivery_Company_working = mysqli_query($con, "SELECT  COUNT(`id_delivery`) delivery_com  FROM `delivery_com` WHERE `delivery_statue`=1   ;");
$count_Delivery_Company_working = mysqli_fetch_array($sql_count_Delivery_Company_working);
//All Delivery Company stoped 
$sql_count_Delivery_Company_stoped = mysqli_query($con, "SELECT  COUNT(`id_delivery`) delivery_com  FROM `delivery_com` WHERE `delivery_statue`=2   ;");
$count_Delivery_Company_stoped = mysqli_fetch_array($sql_count_Delivery_Company_stoped);
//All Delivery Company stoped_from admin
$sql_count_Delivery_Company_stoped_admin = mysqli_query($con, "SELECT  COUNT(`id_delivery`) delivery_com  FROM `delivery_com` WHERE `delivery_statue`=3   ;");
$count_Delivery_Company_stoped_admin = mysqli_fetch_array($sql_count_Delivery_Company_stoped_admin);
//All Delivery Company unacceptable 
$sql_count_Delivery_Company_unacceptable = mysqli_query($con, "SELECT  COUNT(`id_delivery`) delivery_com  FROM `delivery_com` WHERE `delivery_statue`=4   ;");
$count_Delivery_Company_unacceptable = mysqli_fetch_array($sql_count_Delivery_Company_unacceptable);









////////////////////////Reactive Company
//All Reactive Company
$sql_count_Reactive_Company = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company`");
$count_Reactive_Company = mysqli_fetch_array($sql_count_Reactive_Company);
//All Reactive Company like
$sql_count_Reactive_Company_like = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `user_like`=1 ;");
$count_Reactive_Company_like = mysqli_fetch_array($sql_count_Reactive_Company_like);
//All Reactive Company follow
$sql_count_Reactive_Company_follow = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `follow`=1  ;");
$count_Reactive_Company_follow = mysqli_fetch_array($sql_count_Reactive_Company_follow);
//All Reactive Company comment
$sql_count_Reactive_Company_comment = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `comment`!='' ;");
$count_Reactive_Company_comment = mysqli_fetch_array($sql_count_Reactive_Company_comment);






////////////////////////Reactive Product
//All Reactive Product
$sql_count_Reactive_Product = mysqli_query($con, "SELECT COUNT(`reactive_product_id`) reactive_product FROM `reactive_product` WHERE `user_like`!=0 AND `comment`!='';");
$count_Reactive_Product = mysqli_fetch_array($sql_count_Reactive_Product);
//All Reactive Product like
$sql_count_Reactive_Product_like = mysqli_query($con, "SELECT COUNT(`reactive_product_id`) reactive_product FROM `reactive_product` WHERE `user_like`!=0");
$count_Reactive_Product_like = mysqli_fetch_array($sql_count_Reactive_Product_like);
//All Reactive Product comment
$sql_count_Reactive_Product_comment = mysqli_query($con, "SELECT COUNT(`reactive_product_id`) reactive_product FROM `reactive_product` WHERE `comment`!=''");
$count_Reactive_Product_comment = mysqli_fetch_array($sql_count_Reactive_Product_comment);







////////////////////////Order
//All Order
$sql_count_Order = mysqli_query($con, "SELECT COUNT(`id_order`) orders FROM `order`;");
$count_Order = mysqli_fetch_array($sql_count_Order);
//All Account Customer he/she stoped his/her Account
$sql_count_Order_complited = mysqli_query($con, "SELECT COUNT(`id_order`) orders FROM `order` WHERE `chack_order` =1 AND `chack_money` =1 AND `processor_order`=1 AND `delivery_order`=1;");
$count_Order_complited = mysqli_fetch_array($sql_count_Order_complited);
//All Account Customer working
$sql_count_Order_new = mysqli_query($con, "SELECT COUNT(`id_order`) orders FROM `order` WHERE `chack_order` !=1 AND `chack_money` !=1 AND `processor_order`!=1 AND `delivery_order`!=1;");
$count_Order_new = mysqli_fetch_array($sql_count_Order_new);
//All Account Customer stoped from admin web site
$sql_count_Order_deleted = mysqli_query($con, "SELECT COUNT(`id_order`) orders FROM `order` WHERE `status_order`=0;");
$count_Order_deleted = mysqli_fetch_array($sql_count_Order_deleted);








?>






<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">الصفحة الرائيسية</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>






<!-- Main content -->
<section class="content">
    <div class="container-fluid">


        <div class="row">
            <!-- hear write the code -->







            <div class="col-lg-6">





                <div class="card">
                    <a href="mang_comany.php" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">المراكز التجارية</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers[0]; ?>
                                </span>
                                <span class="text-muted">كافة المراكز التجارية</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers_working[0]; ?>
                                </span>
                                <span class="text-muted"> الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers_request[0]; ?>
                                </span>
                                <span class="text-muted">طلب الانضمام الى الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers_stoped[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفه من إدارة المراكز</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers_stoped_admin[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفة من إدارة الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Centers_unacceptable_admin[0]; ?>
                                </span>
                                <span class="text-muted"> الغير مقبولة</span>
                            </p>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">مدراء الموقع</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $countUser[0]; ?>
                                </span>
                                <span class="text-muted">كل إدارة الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $countUser_stoped[0]; ?>
                                </span>
                                <span class="text-muted">الموظفين الموقفين</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $countUser_working[0]; ?>
                                </span>
                                <span class="text-muted">الموظفين الفعالين</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $countUser_working_deleted[0]; ?>
                                </span>
                                <span class="text-muted">الممنوعين من الدخول</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <p class="d-flex flex-column text-right">

                            <span class="text-muted">صلاحيات الموظفين</span>
                        </p>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">لايوجد صلاحيات</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?php echo $admin_cant_do_any_thing[0]; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted"> كافة الصلاحيات</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?php echo $admin_do_any_thing[0]; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted"> إدارة
                                            المراكز</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?php echo $admin_control_company[0]; ?>
                                            <span>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted"> إدارة
                                            الباقات</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?php echo $admin_control_bunch[0]; ?>
                                            <span>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 ">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted"> إدارة
                                            العملاء</span>
                                        <span class="info-box-number text-center text-muted mb-0"><?php echo $admin_control_customer[0]; ?>
                                            <span>
                                            </span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">المنتجات</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_product[0]; ?>
                                </span>
                                <span class="text-muted">كل المنتجات</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_product_working[0]; ?>
                                </span>
                                <span class="text-muted"> المفعلة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_product_stop_from_user[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفه من إدارة المراكز</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_product_stoped[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفه من إدارة الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">الاقسام</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_department[0]; ?>
                                </span>
                                <span class="text-muted">كافة الاقسام</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_department_working[0]; ?>
                                </span>
                                <span class="text-muted"> الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_department_request_add[0]; ?>
                                </span>
                                <span class="text-muted"> المطلوبة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_department_stoped[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">الاصناف</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_categories[0]; ?>
                                </span>
                                <span class="text-muted">كافة الاصناف</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_categories_request[0]; ?>
                                </span>
                                <span class="text-muted"> المطلوبة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_categories_working[0]; ?>
                                </span>
                                <span class="text-muted"> الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_categories_stoped[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">موظفين المراكز التجارية</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_user[0]; ?>
                                </span>
                                <span class="text-muted">كافة الموظفين</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_user_stoped_manger[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفين من إدارة المركز</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_user_working[0]; ?>
                                </span>
                                <span class="text-muted"> الفعالين</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_user_stoped_admin[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفين من إدارة الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>


            </div>



            <div class="col-lg-6">






                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">العملاء</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_customer[0]; ?>
                                </span>
                                <span class="text-muted">كافة العملاء</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_customer_stoped[0]; ?>
                                </span>
                                <span class="text-muted">الحسابات الموقفه</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_customer_working[0]; ?>
                                </span>
                                <span class="text-muted">الحسابات الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_customer_stoped_admin[0]; ?>
                                </span>
                                <span class="text-muted"> الموقفة من إدارة الموقع</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>



                <div class="card">
                    <a href="mang_bunch.php" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">الباقات</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Bunch[0]; ?>
                                </span>
                                <span class="text-muted">كافة الباقات</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Bunch_stoped[0]; ?>
                                </span>
                                <span class="text-muted">الموقفة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Bunch_working[0]; ?>
                                </span>
                                <span class="text-muted">الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">شركات التوصيل</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company[0]; ?>
                                </span>
                                <span class="text-muted">كافة الشركات </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company_request[0]; ?>
                                </span>
                                <span class="text-muted">طلبات الانضمام</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company_working[0]; ?>
                                </span>
                                <span class="text-muted">الفعالة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company_stoped[0]; ?>
                                </span>
                                <span class="text-muted">الموقفة من إدارة المراكز</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company_stoped_admin[0]; ?>
                                </span>
                                <span class="text-muted">الموقفة من إدارة الموقع</span>
                            </p>
                        </div>


                        <!-- /.d-flex -->



                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Delivery_Company_unacceptable[0]; ?>
                                </span>
                                <span class="text-muted">الغير مقبولة</span>
                            </p>
                        </div>
                    </div>
                </div>



                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">التفاعلات مع المراكز التجارية</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Company[0]; ?>
                                </span>
                                <span class="text-muted">كافة التفاعلات </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Company_like[0]; ?>
                                </span>
                                <span class="text-muted">إعاجب </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Company_follow[0]; ?>
                                </span>
                                <span class="text-muted">المتابعة </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Company_comment[0]; ?>
                                </span>
                                <span class="text-muted">التعليقات</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>





                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">التفاعل مع المنتجات</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Product[0]; ?>
                                </span>
                                <span class="text-muted">كافة التفاعلات</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Product_like[0]; ?>
                                </span>
                                <span class="text-muted">الاعجاب </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Reactive_Product_comment[0]; ?>
                                </span>
                                <span class="text-muted">التعليقات </span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>

                <div class="card">
                    <a href="#" class="btn btn-info btn-sm ">
                        <div class="card-header border-0" style="float: right;">
                            <h3 class="card-title">الطلبات</h3>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">

                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Order[0]; ?>
                                </span>
                                <span class="text-muted">كافة الطلبات</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-warning text-xl">
                                <i class="ion ion-ios-cart-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Order_complited[0]; ?>
                                </span>
                                <span class="text-muted"> المكتملة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Order_new[0]; ?>
                                </span>
                                <span class="text-muted"> الجديدة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold">
                                    <?php echo $count_Order_deleted[0]; ?>
                                </span>
                                <span class="text-muted"> المحذوفة</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->
                    </div>
                </div>







            </div>

        </div>




        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="areaChart"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="donutChart"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="pieChart"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="stackedBarChart"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->



<?php
include "footer.php";
?>