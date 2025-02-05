<?php

include "header.php";

unset($_SESSION['user_id']);


$q1 = mysqli_query($con, "select count(*) AS C from user where com_id='" . $_SESSION['comid'] . "'");
$countUser = mysqli_fetch_array($q1);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="float: right;">إدارة الموظفين</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="float:left!important;">

                    <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
                    <li class="breadcrumb-item active">إدارة الموظفين</li>

                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
    
        <div class="card-body pb-0">
            
        <a style="margin-bottom: 10px;" class="btn btn-block bg-gradient-success btn-lg" href="user_data_chang.php">
                  <i class="fas fa-plus"></i> إضافة موظفين
                </a>
            <div class="row d-flex align-items-stretch ">

                <?php

                $sql_user = "SELECT * FROM `user` WHERE com_id=" . $_SESSION['comid'] . " AND user_type='1'";
                $res_user = mysqli_query($con, $sql_user);
                while ($users_data = mysqli_fetch_array($res_user)) {


                    $qu_us_and_permis = mysqli_query($con, "SELECT DISTINCT `id_user_permissions`,`name_user_permissions` FROM `user_permissions` JOIN `user` ON user_permissions.id_user_permissions =user.fk_permissions WHERE `status_user_permissions`!=0 AND user.user_id='" . $users_data['user_id'] . "' ;") or die(mysqli_error($con));
                    if (mysqli_num_rows($qu_us_and_permis) > 0) {
                        $data_us_permis = mysqli_fetch_array($qu_us_and_permis);
                    }
                    ?>


                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">

                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>
                                            <?php echo $users_data['user_name']; ?>
                                        </b></h2>
                                    <p class="text-muted text-sm"><b>About: </b>
                                        <?php echo $data_us_permis['name_user_permissions']; ?>
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span> Address:
                                            <?php echo $users_data['country']; ?>
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #:
                                            <?php echo $users_data['phone_number']; ?>
                                        </li>

                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-map-marker-alt mr-1"></i></span> Map #:
                                            <?php echo $users_data['city']; ?>
                                        </li>
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-trash-alt"></i></span> statue :
                                            <?php if ($users_data['user_state'] > 0) {
                                                    echo " <span class=' badge bg-success'>مفعل</span>";
                                                } else
                                                    echo "<span class=' badge bg-danger'>موقف</span>";
                                                ?>
                                        </li>
                                    </ul>
                                </div>
                                <div  class="col-5 text-center">
                                    <img src="../../img/user/<?php echo $users_data['icon']; ?>"
                                        alt="<?php echo $users_data['user_name']; ?>" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a  class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                    
                                <a href="user_data_chang.php?id_user_edit=<?php echo $users_data['user_id']; ?>"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> عرض البيانات
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php }
                ?>




            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>














<?php
include "footer.php";
?>



