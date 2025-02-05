<?php
session_start();
include "insert_data_admin.php";
include "../db.php";
include "header.php";













static $product_active = "active";

static $depart_active;

static $cat_active;





static $id_cat_com = 0;


if (isset($_GET['id_cat_com'])) {

    $product_active = "";

    $depart_active = "";

    $cat_active = "active";


    $id_cat_com = $_GET['id_cat_com'];
}






static $id_depart_com = 0;


if (isset($_GET['id_depart_com'])) {

    $product_active = "";

    $depart_active = "active";

    $cat_active = "";

    $id_depart_com = $_GET['id_depart_com'];
}





global $com_id;


static $count_Reactive_Company_like=0;
static $count_Reactive_Company_follow=0;
static $count_Reactive_Company_comment=0;



if (isset($_GET['com_id'])) {

    $com_id = $_GET['com_id'];

    static $com_name;
    static $com_phone;
    static $city;
    static $address;
    static $com_email;
    static $icon;
    static $com_status;
    static $comm_Reg;
    static $contract_accept;
    static $date_added;
    static $date_modifide;
    static $location;
    static $whatsapp;
    static $telegram;
    static $website_company;
    static $instagram;
    static $facebook;
    static $twitter;
    static $linkedin;
    static $about_company;
    static $messg_comm;

    $sql_quer_comany = "SELECT * FROM `company` WHERE `com_id`='" . $com_id . "' ;";



    $execution_query_company = mysqli_query($con, $sql_quer_comany) or die(mysqli_error($con));
    if (mysqli_num_rows($execution_query_company) > 0) {
        $array_combany = mysqli_fetch_array($execution_query_company);


        $com_name = $array_combany['com_name'];
        $com_phone = $array_combany['com_phone'];
        $city = $array_combany['city'];
        $address = $array_combany['address'];
        $com_email = $array_combany['com_email'];
        $icon = $array_combany['icon'];
        $comm_Reg = $array_combany['comm_Reg'];
        $contract_accept = $array_combany['contract_accept'];
        $date_added = $array_combany['date_added'];
        $date_modifide = $array_combany['date_modifide'];
        $location = $array_combany['location'];
        $whatsapp = $array_combany['whatsapp'];
        $telegram = $array_combany['telegram'];
        $website_company = $array_combany['website_company'];
        $instagram = $array_combany['instagram'];
        $facebook = $array_combany['facebook'];
        $twitter = $array_combany['twitter'];
        $linkedin = $array_combany['linkedin'];
        $about_company = $array_combany['about_company'];
        $messg_comm = $array_combany['messg_comm'];
        $com_status = $array_combany['com_status'];





        if ($array_combany['com_status'] == 1) {
            $company_state_sc = "checked";
        } else {
            $company_state_sc = "check";
        }






////////////////////////Reactive Company
//All Reactive Company like
$sql_count_Reactive_Company_like = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `user_like`=1 AND `com_id`='".$com_id."' ;");
$count_Reactive_Company_like = mysqli_fetch_array($sql_count_Reactive_Company_like);
//All Reactive Company follow
$sql_count_Reactive_Company_follow = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `follow`=1 AND `com_id`='".$com_id."' ;");
$count_Reactive_Company_follow = mysqli_fetch_array($sql_count_Reactive_Company_follow);
//All Reactive Company comment
$sql_count_Reactive_Company_comment = mysqli_query($con, "SELECT COUNT(`id_reac_com_user`) reactive_company FROM `reactive_company` WHERE `comment`!='' AND `com_id`='".$com_id."' ;");
$count_Reactive_Company_comment = mysqli_fetch_array($sql_count_Reactive_Company_comment);








    }
}

?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إدارة <?php echo $com_name; ?></h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>




<section class="content" dir='rtl' align="right">
    <div class="container-fluid" dir='rtl'>
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="../../img/imag_comb/<?php echo $icon; ?>" alt="<?php echo $com_name; ?>">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $com_name; ?></h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>المتابعين :</b> <?php echo $count_Reactive_Company_follow['reactive_company']; ?>
                            </li>
                            <li class="list-group-item">
                                <b>الاعجابات :</b> <?php echo $count_Reactive_Company_like['reactive_company']; ?>
                            </li>
                            <li class="list-group-item">
                             <b>التعليقات:</b> <?php echo $count_Reactive_Company_comment['reactive_company']; ?> 
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">حول المركز التجاري</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> الوصف</strong>

                        <p class="text-muted">
                            <?php echo $about_company; ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> العنوان</strong>

                        <p class="text-muted"><?php echo $city; ?>,<?php echo $address; ?></p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> بيانات المركز</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">phone:<?php echo $com_phone; ?></span>
                            <span class="tag tag-success">Email:<?php echo $com_email; ?></span>
                            <span class="tag tag-info"><?php echo $com_name; ?></span>
                            <span class="tag tag-warning"><?php echo $com_name; ?></span>
                            <span class="tag tag-primary"><?php echo $com_name; ?></span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link  <?php echo $product_active; ?>" href="#activity"
                                    data-toggle="tab">إدارة المنتجات</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $depart_active; ?>" href="#department"
                                    data-toggle="tab">إدارة الاقسام</a>
                            </li>
                            <li class="nav-item"><a class="nav-link <?php echo $cat_active; ?>" href="#categories"
                                    data-toggle="tab">إدارة الاصناف</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="<?php echo $product_active; ?>  tab-pane" id="activity">
                                <?php include "products_company.php"; ?>

                            </div>




                            <!-- /.tab-pane -->
                            <div class="<?php echo $depart_active; ?>  tab-pane" id="department">
                                <!-- The timeline -->

                                <?php include "mane_depart_one_com.php"; ?>

                            </div>
                            <!-- /.tab-pane -->


                            <div class="<?php echo $cat_active; ?>  tab-pane" id="categories">

                                <?php include "manage_cat_one_com.php"; ?>


                            </div>
                            <!-- /.tab-pane -->



                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

</section>







<?php

include "footer.php";
?>