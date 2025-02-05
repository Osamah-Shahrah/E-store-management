<?php

/*if(session_status())
{
  echo "osamah";
}
*/
session_start();
include 'auth.php';
include '../db.php';
include "message.php";

//$sql = mysqli_query($con, "SELECT DISTINCT user.user_name,user.icon 'user_icon' FROM  user  WHERE user.Email='".$_SESSION['user_phon']." ' AND user.password='" . $_SESSION['pass'] . "'") or die(mysqli_error($con));
//$result = mysqli_fetch_array($sql);






$sql_data_com = mysqli_query($con, "SELECT DISTINCT * from company where com_id='" . $_SESSION['comid'] . "'") or die(mysqli_error($con));
if ($sql_data_com) {
    $r = mysqli_fetch_array($sql_data_com);
    $com_name = $r['com_name'];

    $com_phone = $r['com_phone'];
    $com_City = $r['city'];
    $com_address = $r['address'];
    $com_email = $r['com_email'];
    $com_icon = $r['icon'];


    $com_location = $r['location'];

    $com_whatsapp = $r['whatsapp'];
    $com_telegram = $r['telegram'];

    $com_website_company = $r['website_company'];
    $com_instagram = $r['instagram'];
    $com_facebook = $r['facebook'];
    $com_twitter = $r['twitter'];
    $com_linkedin = $r['linkedin'];

    $com_about_company = $r['about_company'];
    $com_messg_comm = $r['messg_comm'];
}



$com_id = $_SESSION['comid'];










//count users
$q1 = mysqli_query($con, "select count(*) AS C from user where com_id='" . $_SESSION['comid'] . "'");
$countUser = mysqli_fetch_array($q1);
//count product
$q2 = mysqli_query($con, "select count(*) AS C from product where com_id='" . $_SESSION['comid'] . "'");
$count_Products = mysqli_fetch_array($q2);
//count department
$q3 = mysqli_query($con, "select count(*) AS C from department_com where com_id='" . $_SESSION['comid'] . "'");
$count_department = mysqli_fetch_array($q3);
//count likes
$q4 = mysqli_query($con, "SELECT COUNT(*) AS 'Likes' FROM `reactive_company` WHERE com_id='" . $_SESSION['comid'] . "'AND user_like=1");
$count_likes = mysqli_fetch_array($q4);

//count flollowing
$q5 = mysqli_query($con, "SELECT COUNT(*) AS 'Likes' FROM `reactive_company` WHERE com_id='" . $_SESSION['comid'] . "' AND follow=1");
$count_follow = mysqli_fetch_array($q5);
//count bunch
$q6 = mysqli_query($con, "SELECT DISTINCT c.com_id KK,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE `bunch_com_status`=1 AND bc.com_id=" . $_SESSION['comid'] . " )-(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $_SESSION['comid'] . " ) remaining,(SELECT COUNT(p.product_id) FROM company c  JOIN product p ON c.com_id=p.com_id WHERE c.com_id=" . $_SESSION['comid'] . ") count_prod,(SELECT  SUM(bc.pro_count_com) FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id  WHERE `bunch_com_status`=1 AND bc.com_id=" . $_SESSION['comid'] . " ) count_prod_bun_com
FROM company c  JOIN `bunch_com` bc ON c.com_id= bc.com_id JOIN product p ON c.com_id=p.com_id ");
$remaning_bunch = mysqli_fetch_array($q6);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>لوحة التحكم</title>

    <link rel="apple-touch-icon" href="../img/web_img/icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../img/web_img/icon.png">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../../Design/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../Design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">






    <!-- DataTables -->
    <link rel="stylesheet" href="../../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">







    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../Design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../Design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->



    <!-- daterange picker -->
    <link rel="stylesheet" href="../../Design/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../Design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../Design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../../Design/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../../Design/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">










    <!-- css for message -->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../Design/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../Design/plugins/toastr/toastr.min.css">



    <!-- mystyle for them my website -->
    <link rel="stylesheet" href="mystyle2.css">


    <!-- Select2 important for select  -->
    <link rel="stylesheet" href="../../Design/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../Design/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <script src="../../Design/pages/assets/js/jquery-3.6.0.min.js"></script>



</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home.php" class="nav-link"><i class="fas fa-home"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home.php" class="nav-link">Contact</a>
                </li>
            </ul>


            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="بحث" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $com_website_company ?>">
                        <i class="fas fa-store"></i>
                    </a>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../Design/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../Design/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../../Design/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="reactive.php" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="reactive.php" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="reactive.php" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="reactive.php" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <?php if (isset($_SESSION['username']) != "") {  ?>
                    <li class="nav-item dropdown ">
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                <img src="../../img/user/<?php echo $_SESSION['user_icon'] ?>" class="img-circle elevation-2" alt="<?php echo $_SESSION['username']; ?>">
                            </div>
                            <div class="info">
                                <a href="home.php" class="d-block"><?php echo $_SESSION['username']; ?></a>
                            </div>
                        </div>
                        </i>
                    <?php } ?>

                    <?php if (isset($_SESSION['username']) != "") {  ?>
                    <li class="nav-item dropdown ">
                        <a class="brand-link" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <img src="../../img/user/<?php echo $_SESSION['user_icon'] ?>" class="brand-image img-circle elevation-3" style="opacity: .8" alt="<?php echo $_SESSION['username']; ?>">
                            <span class="brand-text font-weight-light"><?php echo $_SESSION['username']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="javascript:;"> Profile</a>
                            <a class="dropdown-item" href="javascript:;">
                                <span class="badge bg-red pull-right">50%</span>
                                <span>Settings</span>
                            </a>
                            <a class="dropdown-item" href="javascript:;">Help</a>
                            <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home.php" class="brand-link">
                <img src="../../img/imag_comb/<?php echo $com_icon ?>" alt="../../img/imag_comb/<?php echo $com_name ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php echo $com_name ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <?php if (isset($_SESSION['username']) != "") {  ?>
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../../img/user/<?php echo $_SESSION['user_icon'] ?>" class="img-circle elevation-2" alt="<?php echo $_SESSION['username']; ?>">
                        </div>
                        <div class="info">
                            <a href="home.php" class="d-block"><?php echo $_SESSION['username']; ?></a>
                        </div>
                    </div>
                <?php } ?>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    إدارة الطلبات
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add_order.php" class="nav-link">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>إضافة طلب</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="chack_money.php" class="nav-link">
                                        <i class="icon fas fa-check"></i>
                                        <p>التاكد من الايداع</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="chack_procsseor.php" class="nav-link">
                                        <i class="fas fa-inbox"></i>
                                        <p>تجهيز</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="chack_delivery.php" class="nav-link">
                                        <i class="fas fa-ambulance"></i>
                                        <p>التوصيل</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="check_order_complete.php" class="nav-link">
                                        <i class="icon fas fa-check"></i>
                                        <p>المكتملة</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="check_order_deleted.php" class="nav-link">
                                        <i class="far fa-times-circle"></i>
                                        <p>ملغية</p>
                                    </a>
                                </li>


                            </ul>
                        </li>



                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    المنتجات والتفاعلات
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="manage_products.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>المنتجات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="reactive.php" class="nav-link">
                                        <i class="fas fa-bullhorn"></i>
                                        <p>الإشعارات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    الاقسام والاصناف
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="all_department.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>الأقسام </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_cat.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> الاصناف</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_cat.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> الاوصاف</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manage_cat.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> الاحجام</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    المركز والموظفين
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="myaccount.php" class="nav-link">
                                        <i class="far fa-file-alt"></i>
                                        <p>بيانات المركز</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="Users.php" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>الموظفين</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="subscriptions.php" class="nav-link">
                                        <i class="nav-icon far fa-plus-square"></i>
                                        <p>الأشتراكات</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="manage_custmers.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>العملاء</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="delivery_com.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>شركات التوصيل</p>
                            </a>
                        </li>



                        <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link" id="">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تسجيل الخروج</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    <p>تسجيل الخروج</p>
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>



        <script>
            $(document).ready(function() {
                $("#logout").click(function() {
                    var r = window.confirm("هل تريد فعلا تسجيل الخروج ");
                    if (r == "true") {
                        // $.get("logout.php");
                        // header("location:user_data_chang.php");
                        window.open(logout.php);

                    } else {
                        window.location.reload();
                    }


                });

            });
        </script>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">