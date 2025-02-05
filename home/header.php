<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <?php
    session_start();

    include('../db.php');

    include "auth.php";
    include "message.php";
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
}


    $system_query = " SELECT DISTINCT * FROM `system_info` " or die(mysqli_error($con));
    $run1_query = mysqli_query($con, $system_query) or die(mysqli_error($con));
    if (mysqli_num_rows($run1_query) > 0) {

        while ($row = mysqli_fetch_array($run1_query)) {
            $name_system = $row['name_system'];
            $Email = $row['Email'];
            $phon_number = $row['phon_number'];
            $address = $row['address'];
            $icon_system = $row['icon_system'];
            $whatsapp = $row['whatsapp'];
            $telegram = $row['telegram'];
            $website_system = $row['website_system'];
            $instagram = $row['instagram'];
            $facebook = $row['facebook'];
            $twitter = $row['twitter'];
            $linkedin = $row['linkedin'];
            $about_system = $row['about_system'];

        }
    }
    ;


    ?>
    <title>
        <?php echo $name_system ?>
    </title>

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">


    <link rel="icon" type="image/png" href="../img/system/<?php echo $icon_system ?>.png">

    <link rel="apple-touch-icon" href="../img/system/<?php echo $icon_system ?>.png">

    <link rel="shortcut icon" href="../img/system/<?php echo $icon_system ?>.ico" type="image/x-icon">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylseheet" href="assets/css/bootstrap.rtl.min.css">
    <link type="text/css" rel="stylesheet" href="accountbtn.css" />
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <script src="assets/js/jquery-3.6.0.min.js"></script>



















    <style>
    

    @keyframes come-in {
        0% {
            -webkit-transform: translatey(100px);
            transform: translatey(100px);
            opacity: 0;
        }

        30% {
            -webkit-transform: translateX(-50px) scale(0.4);
            transform: translateX(-50px) scale(0.4);
        }

        70% {
            -webkit-transform: translateX(0px) scale(1.2);
            transform: translateX(0px) scale(1.2);
        }

        100% {
            -webkit-transform: translatey(0px) scale(1);
            transform: translatey(0px) scale(1);
            opacity: 1;
        }
    }

    * {
        margin: 0;
        padding: 0;
    }

    .floating-container {
        position: fixed;
        width: 100px;
        height: 100px;
        bottom: 0;
        right: 0;
        margin: 35px 25px;
    }

    .floating-container:hover {
        height: 300px;
    }

    .floating-container:hover .floating-button {
        box-shadow: 0 10px 25px rgba(44, 179, 240, 0.6);
        -webkit-transform: translatey(5px);
        transform: translatey(5px);
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .floating-container:hover .element-container .float-element:nth-child(1) {
        -webkit-animation: come-in 0.4s forwards 0.2s;
        animation: come-in 0.4s forwards 0.2s;
    }

    .floating-container:hover .element-container .float-element:nth-child(2) {
        -webkit-animation: come-in 0.4s forwards 0.4s;
        animation: come-in 0.4s forwards 0.4s;
    }

    .floating-container:hover .element-container .float-element:nth-child(3) {
        -webkit-animation: come-in 0.4s forwards 0.6s;
        animation: come-in 0.4s forwards 0.6s;
    }

    .floating-container .floating-button {
        position: absolute;
        width: 65px;
        height: 65px;
        background: #2cb3f0;
        bottom: 0;
        border-radius: 50%;
        left: 0;
        right: 0;
        margin: auto;
        color: white;
        line-height: 65px;
        text-align: center;
        font-size: 23px;
        z-index: 100;
        box-shadow: 0 10px 25px -5px rgba(44, 179, 240, 0.6);
        cursor: pointer;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }

    .floating-container .float-element {
        position: relative;
        display: block;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        margin: 15px auto;
        color: white;
        font-weight: 500;
        text-align: center;
        line-height: 50px;
        z-index: 0;
        opacity: 0;
        -webkit-transform: translateY(100px);
        transform: translateY(100px);
    }

    .floating-container .float-element .material-icons {
        vertical-align: middle;
        font-size: 16px;
    }

    .floating-container .float-element:nth-child(1) {
        background: #42A5F5;
        box-shadow: 0 20px 20px -10px rgba(66, 165, 245, 0.5);
    }

    .floating-container .float-element:nth-child(2) {
        background: #4CAF50;
        box-shadow: 0 20px 20px -10px rgba(76, 175, 80, 0.5);
    }

    .floating-container .float-element:nth-child(3) {
        background: #FF9800;
        box-shadow: 0 20px 20px -10px rgba(255, 152, 0, 0.5);
    }

    /* end them the button   */


    body {

        text-align: right;

    }

    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    input[type="text"i] {
        padding: 1px 2px;

    }



    .form-group {
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    .container .jumbotron,
    .container-fluid .jumbotron {
        padding-right: 15px;
        padding-left: 15px;
        border-radius: 20px;
    }

    .billing-details {
        margin-bottom: 10px;
    }

    .jumbotron {
        padding-top: 30px;
        padding-bottom: 30px;
        margin-bottom: 10px;
        color: inherit;
        background-color: #eee;
    }
    </style>

</head>




<body>
    <!-- Close Top Nav -->




    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                <?php echo $name_system ?>
            </a>




            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">

                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">الصفحة الرئسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">المراكز التجارية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">من نحن</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"> انضم لنا</a>
                    </li>

                </ul>

                <!-- div the account and search and my sealh-->
                <div class="navbar align-self-center d-flex">
                    <!--div search form-->
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <!-- end the form to search-->



                    <!-- url or button  to mysealh -->
                    <!--count product for basket -->
                    <?php
                    if ((isset($user_id))) {

                        ?>
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="fales">
                        <i class="fa fa-fw fa-bookmark text-success  mr-1"></i>
                        <?php
                            $count_prod_query = "SELECT COUNT(product.product_id)as 'proud_count' FROM product JOIN reactive_product on product.product_id=reactive_product.product_id WHERE reactive_product.user_id=$user_id and reactive_product.cart_status!=0" or die(mysqli_error($con));
                            $run_query2 = mysqli_query($con, $count_prod_query);
                            if (mysqli_num_rows($run_query2) > 0) {
                                while ($row = mysqli_fetch_array($run_query2)) {
                                    $proud_count = $row['proud_count'];
                                }
                                ;
                            }
                            ?>
                        <span class="badge badge-danger navbar-badge">
                            <?php echo $proud_count; ?>
                        </span>

                    </a>


                    <div class=" dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                        <?php
                            echo "<div class=' overflow-auto ' style='height:310px;width:100% '>";
                            $prod_bascet_query = "SELECT product.product_title,product.price,product.opponent,product.product_image FROM product JOIN reactive_product on product.product_id=reactive_product.product_id WHERE reactive_product.user_id=$user_id and reactive_product.cart_status!=0" or die(mysqli_error($con));
                            $run_query2 = mysqli_query($con, $prod_bascet_query);
                            if (mysqli_num_rows($run_query2) > 0) {
                                while ($row = mysqli_fetch_array($run_query2)) {
                                    $product_title = $row['product_title'];
                                    $price = $row['price'];
                                    $opponent = $row['opponent'];
                                    $product_image = $row['product_image'];
                                    ?>

                        <a href="#" class="dropdown-item">
                            <!-- bascet Start -->
                            <div class="media">
                                <!-- imag the proudect-->
                                <img src=" ../img/product_images/<?php echo $product_image ?>" class="img-size-50 mr-3">
                                <!-- name the product-->
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">

                                        <?php echo $product_title; ?>


                                    </h3>
                                    <p class="text-sm">
                                        <?php echo $price; ?>
                                    </p>
                                </div>

                            </div>
                            <!-- Message End -->

                        </a>
                        <!-- line button product -->
                        <div class="dropdown-divider"></div>
                        <?php
                                }
                                ;
                            }
                            ?>

                        <!-- more the product-->
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">عرض كافة المنتجات المحفوظة</a>
                    </div>
                </div>


                <?php }
                    ?>


                <!-- url or button  to open search -->
                <a class="nav-icon d-none d-lg-inline" href="12" data-bs-toggle="modal"
                    data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>




                <!-- url or button  to myaccount -->


                <ul class="navbar-nav ml-auto">



                    <?php
                    if ((isset($_SESSION['user_id']))) {

                        ?>
                    <!-- account Dropdown Menu -->
                    <li class='nav-item dropdown user-menu'>
                        <!-- shourt name and imag -->
                        <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                            <img src='../img/user/<?php echo $_SESSION['icon_user']; ?>'
                                class='user-image img-circle elevation-2' alt='<?php echo $_SESSION['user_name']; ?>'>
                            <!-- name the account short -->
                            <span class='d-none d-md-inline'>
                                <?php echo $_SESSION['user_name']; ?>
                            </span>
                        </a>

                        <ul class='dropdown-menu dropdown-menu-lg dropdown-menu-right'>
                            <!-- User image -->
                            <li class='user-header bg-primary'>
                                <img src='../img/user/<?php echo $_SESSION['icon_user']; ?>'
                                    class='img-circle elevation-2' alt='<?php echo $_SESSION['user_name']; ?>'>
                                <!-- name the user -->
                                <p>
                                    <?php echo $_SESSION['user_name']; ?>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class='user-footer'>
                                <a href='personal.php' class='btn btn-default btn-flat'>البيانات الشخصية</a>
                                <a href='logout.php' class='btn btn-default btn-flat float-right'>خروج</a>
                            </li>
                        </ul>
                    </li>

                    <?php
                    } else {

                        ?>
                    <!-- account Dropdown Menu -->
                    <li class='nav-item dropdown user-menu'>
                        <!-- shourt name and imag -->
                        <a href='#' class='nav-link dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                            <img src='../img/user/1.png' class='user-image img-circle elevation-2' alt='User Image'>
                            <!-- name the account short -->
                            <span class='d-none d-md-inline'>تسجبل الدخول</span>
                        </a>

                        <ul class='dropdown-menu dropdown-menu-lg dropdown-menu-right'>
                            <!-- User image -->
                            <li class='user-header bg-primary'>
                                <img src='../img/user/1.png' class='img-circle elevation-2' alt='User Image'>
                                <!-- name the user -->
                                <p>
                                    تسجيل الدخول
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class='user-footer'>
                                <a class='btn btn-default btn-flat' data-bs-toggle='modal'
                                    data-bs-target='#templatemo_create_myaccount'>إنشاء حساب</a>
                                <a class='btn btn-default btn-flat float-right ' id="showdialog" data-bs-toggle='modal'
                                    data-bs-target='#templatemo_myaccount'>تسجيل الدخول</a>
                            </li>
                        </ul>
                    </li>





                    <?php
                    }
                    ;
                    ?>
                </ul>








            </div>
            <!--end div the account and search and my sealh-->
        </div>

        </div>
    </nav>



    <!-- div the search form -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="بحث........">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end div the search -->


    <!-- div the mysealh form -->
    <div class="modal fade bg-white" id="templatemo_mysealh" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="بحث........">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- end div the mysealh -->

    <!-- div the myaccount form -->
    <div class="modal fade" id="templatemo_myaccount" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <?php
                    include "login.php";

                    ?>

                </div>

            </div>

        </div>
    </div>
    <!-- end div the myaccount -->


    <!-- div the create myaccount form -->
    <div class="modal fade" id="templatemo_create_myaccount" role="dialog">
        <div class="modal-dialog">

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
    <!-- end div the myaccount -->


    <div class="row text-center m-4 " id="topH">

    </div>