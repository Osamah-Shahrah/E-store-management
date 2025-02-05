<?php
include "auth.php";
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
    <link rel="stylesheet" href="mystyle.css">


    <!-- Select2 important for select  -->
    <link rel="stylesheet" href="../../Design/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../Design/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <script src="../../Design/pages/assets/js/jquery-3.6.0.min.js"></script>



</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" dir="rtl">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home.php" class="nav-link"> الرئيسية</a>
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
                                <img src="../../Design/dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
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
                                <img src="../../Design/dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
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
                                <img src="../../Design/dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
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
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar user panel (optional) -->
            <?php if (isset($_SESSION['username']) != "") {  ?>
            <a href="home.php" class="d-block">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../img/user/<?php echo $_SESSION['user_icon'] ?>" class="img-circle elevation-2"
                            alt="<?php echo $_SESSION['username']; ?>">
                    </div>
                    <div class="info">
                        <span class="brand-text font-weight-light"><?php echo $_SESSION['username']; ?></span>
                    </div>
                </div>
            </a>
            <?php } ?>


            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    mange order
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
 
                                <li class="nav-item">
                                    <a href="home.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>الرئيسية</p>
                                    </a>
                                </li>

                               
                            </ul>
                        </li>






                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                     الاقسام والاصناف
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">



                                <li class="nav-item">
                                    <a href="mange_department.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> إدارة الأقسام </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="mange_categories.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>إدارة الاصناف </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="mange_items_pro.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>إدارة الاوصاف </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="mange_size_pro.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>إدارة الاحجام </p>
                                    </a>
                                </li>
                            </ul>
                        </li>




                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    إدارة المراكز التجارية
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="orderAcceptable.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>طلبات انضمام المراكز</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="mang_comany.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>إدارة المراكز</p>
                                    </a>
                                </li>
                            </ul>
                        </li>





                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                إدارة باقات الاشتراك
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="mang_bunch.php" class="nav-link">
                                        <i class="far fa-envelope"></i>
                                        <p>  باقات الاشتراك </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="Subscrips.php" class="nav-link">
                                        <i class="fas fa-lg fa-building"></i>
                                        <p> المراكز والباقات</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="Subscription_requests.php" class="nav-link">
                                        <i class="fas fa-inbox"></i>
                                        <p>طلبات إضافة الباقات</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-header">EXAMPLES</li>

                        <li class="nav-item">
                            <a href="calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
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
                if (r == true) {
                    $.get("logout.php");

                    window.location(location.reload());

                } else {

                }


            });

        });
        </script>



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">