<?php
include "header.php";

static $titel="تجاري";
if ((isset($_GET['titel']))) {

    $titel = $_GET['titel'];

}

echo"
<title>مركز $titel</title>

";

static $flow;
static $count_product;
static $like;

    static $center_id;
    static $depart_id_pup;
   static $product_query;


    
  if ((isset($_GET['center_id']))) {

    $center_id = $_GET['center_id'];
    
        }
   
     $center_query = "SELECT * FROM `company` WHERE com_id=$center_id AND `contract_accept`!=0 AND `com_status`!=0"or die(mysqli_error($con));
     $product_query = "SELECT DISTINCT product_id,product.com_id,product_title,product_image,price,product_desc,product.opponent FROM `product` JOIN department_com on product.id_depart_com=department_com.id_depart_com where department_com.depart_state_com!=0 and product.com_id=$center_id"or die(mysqli_error($con));
     $selec_send= "SELECT DISTINCT `product_id`,`product_image`,`price`,`product_title`,`com_id` FROM `product`,categories WHERE  `com_id`=$center_id AND product.product_cat= "or die(mysqli_error($con));
     $linke="center_about.php?center_id=$center_id & titel=$titel";

   if (isset($_GET['depart_id_pup'])) {

        $depart_id_pup = $_GET['depart_id_pup'];
    }

    if (isset($_GET['product_query'])) {

        $product_query= $_GET['product_query'];
    }





    
//post form following the center

if(isset($_POST['following']))
{
    if(isset($_SESSION['login']))
    { 
        
    $following=$_POST['following'];
//query to search the user
    $query_serch1=mysqli_query($con,"SELECT DISTINCT `id_reac_com_user` FROM `reactive_company` where `user_id`=$user_id and `com_id`=$center_id")or die(mysqli_error($con));
//if true updata data only or no insert the data
    if(mysqli_num_rows($query_serch1) > 0)
    {
        //tak the id to the reactiv to updata
        $row = mysqli_fetch_array($query_serch1);
        $reactiv_id=$row['id_reac_com_user'];
//query to find and tak the number lik
        $query=mysqli_query($con,"SELECT DISTINCT `follow` FROM `reactive_company` where `user_id`=$user_id and  `com_id`=$center_id")or die(mysqli_error($con));
//if true  the select and tak the lik number to chang
        if(mysqli_num_rows($query) > 0)
            {
                //tak the data
                $row = mysqli_fetch_array($query);
                $follow=$row['follow'];
                //if uper 0 cahnd to 0
                if($follow>0)
                {
                    $following=0;
                }
                else
                {
                    $following=1;
                }
//updata the data
                $query_updata1=mysqli_query($con,"UPDATE `reactive_company` SET `follow`=$following  WHERE `id_reac_com_user`=$reactiv_id");
                if($query_updata1)
                        {
                            //qurey to messg 
                            if($following>0)
                            {  
                                Msg_Sucess();
                            }
                            else
                            {
                                Msg_Error();
                            }
                        }
                else
                    {
                        Msg_Error();
                    }

            }
            

    }

    else
        {
            $query_inser1=mysqli_query($con,"INSERT INTO `reactive_company`(`com_id`, `user_id`, `follow`, `comment`, `user_like`) VALUES ('$center_id','$user_id',$following,'',0) ")or die(mysqli_error($con));
            if($query_inser1)
                {
                    Msg_Sucess();
                }
            else
                {
                    Msg_Error();
                    
                }
        }
    }
    else
        {
            echo "<script>



            
            $(document).ready(function()
            {
                var btn_login=$('#showdialog');
            
               // alert(btn_login.html())
            document.getElementById('showdialog').click()
            })
            
            
            </script>";
            
        }

    }




//post form to add like to center 

if(isset($_POST['like_center']))
{
    if(isset($_SESSION['login']))
    { 
    $like_center=$_POST['like_center'];
//query to search the user
    $query_serch2=mysqli_query($con,"SELECT DISTINCT `id_reac_com_user` FROM `reactive_company` where `user_id`=$user_id and `com_id` =$center_id")or die(mysqli_error($con));
//if true updata data only or no insert the data
    if(mysqli_num_rows($query_serch2) > 0)
    {
        //tak the id to the reactiv to updata
        $row = mysqli_fetch_array($query_serch2);
        $reactiv_id=$row['id_reac_com_user'];
//query to find and tak the number lik
        $query=mysqli_query($con,"SELECT DISTINCT `user_like` FROM `reactive_company` where `user_id`=$user_id and  `com_id` =$center_id")or die(mysqli_error($con));
//if true  the select and tak the lik number to chang
        if(mysqli_num_rows($query) > 0)
            {
                //tak the data
                $row = mysqli_fetch_array($query);
                $lik_num=$row['user_like'];
                //if uper 0 cahnd to 0
                if($lik_num>0)
                {
                    $like_center=0;
                }
                else
                {
                    $like_center=1;
                }
//updata the data
                $query_updata2=mysqli_query($con,"UPDATE `reactive_company` SET `user_like`=$like_center  WHERE `id_reac_com_user`=$reactiv_id");
                if($query_updata2)
                        {
                            //qurey to messg 
                            if($like_center>0)
                            {  
                                Msg_Sucess();
                            }
                            else
                            {
                                Msg_Error();
                            }
                        }
                else
                    {
                        Msg_Error();
                    }

            }

    }

    else
        {
            $query_inser2=mysqli_query($con,"INSERT INTO `reactive_company`(`com_id`, `user_id`, `follow`, `comment`, `user_like`) VALUES ('$center_id','$user_id',0,'',$like_center) ")or die(mysqli_error($con));
            if($query_inser2)
                {
                    Msg_Sucess();
                }
            else
                {
                    Msg_Error();
                }
        }

    }
    else
        {
            echo "<script>



            
            $(document).ready(function()
            {
                var btn_login=$('#showdialog');
            
               // alert(btn_login.html())
            document.getElementById('showdialog').click()
            })
            
            
            </script>";
            
        }
    }




    
//post form to add comment for product 

if(isset($_POST['send_comment']))
{
    if(isset($_SESSION['login']))
    { 
    $comment=$_POST['comment'];
   
    $query_serch3=mysqli_query($con,"SELECT DISTINCT `id_reac_com_user` FROM `reactive_company` where `user_id`=$user_id and `com_id`=$center_id")or die(mysqli_error($con));

    if(mysqli_num_rows($query_serch3) > 0)
    {
        $row = mysqli_fetch_array($query_serch3);
        $reactiv_id=$row['id_reac_com_user'];

                $query_updata3=mysqli_query($con,"UPDATE `reactive_company` SET `comment`='$comment'  WHERE `id_reac_com_user`=$reactiv_id")or die(mysqli_error($con));
                if($query_updata3)
                        {
                            echo "<script>alert(' تم إضافة التعليق بنجاح');</script>";
                        }
                else
                    {
                        Msg_Error();
                    }

            
    }

    else
        {
            $query_inser3=mysqli_query($con,"INSERT INTO `reactive_company`(`com_id`, `user_id`, `follow`, `comment`, `user_like`) VALUES ('$center_id','$user_id',0,'$comment',0) ")or die(mysqli_error($con));
            if($query_inser3)
                {
                    Msg_Sucess();
                }
            else
                {
                    Msg_Error();
                }
        }
    }
    else
        {
            echo "<script>



            
            $(document).ready(function()
            {
                var btn_login=$('#showdialog');
            
               // alert(btn_login.html())
            document.getElementById('showdialog').click()
            })
            
            
            </script>";
            
        }
}





//   count the like for center ";
$center_query_count_like="SELECT count(reactive_company.user_like)as'like'  FROM company JOIN reactive_company on company.com_id=reactive_company.com_id WHERE company.com_id=$center_id and reactive_company.user_like!=0"or die(mysqli_error($con));
$run_query5 = mysqli_query($con, $center_query_count_like);
if (mysqli_num_rows($run_query5) > 0) {

    while ($row = mysqli_fetch_array($run_query5)) {
        $like    = $row['like'];

    };
}





//  count the product for center ";
$center_query_count_prod="SELECT COUNT(product.product_id)as 'count_product' FROM `company` join product on company.com_id=product.com_id WHERE company.com_id=$center_id"or die(mysqli_error($con));
$run_query6 = mysqli_query($con, $center_query_count_prod);
if (mysqli_num_rows($run_query6) > 0) {

    while ($row = mysqli_fetch_array($run_query6)) {
        $count_product    = $row['count_product'];

    };
}


//   count the flowiing to the center ";
$center_query_count_following="SELECT count(reactive_company.follow)as'flow' FROM company JOIN reactive_company on company.com_id=reactive_company.com_id WHERE company.com_id=$center_id and reactive_company.follow!=0"or die(mysqli_error($con));
$run_query7 = mysqli_query($con, $center_query_count_following);
if (mysqli_num_rows($run_query7) > 0) {

    while ($row = mysqli_fetch_array($run_query7)) {
        $flow    = $row['flow'];

    };
}



//   propurtis the center` ";
//$center_query78 = "SELECT * FROM `company` WHERE com_id=$center_id AND `contract_accept`!=0 AND `com_status`!=0"or die(mysqli_error($con));
$run_query8 = mysqli_query($con, $center_query);
if (mysqli_num_rows($run_query8) > 0) {

    while ($row = mysqli_fetch_array($run_query8)) {
        $com_name    = $row['com_name'];
        $com_phone   = $row['com_phone'];
        $city = $row['city'];
        $address = $row['address'];
        $com_email = $row['com_email'];
        $icon    = $row['icon'];
        $location   = $row['location'];
    };
}


?>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- star div pbplic-->
        <div>



            <!-- star div the profail center and ditels-->
            <div>

                <div>
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"
                            style="background: url('../img/imag_comb/<?php echo$icon ?>')">
                        </div>
                        <div class="widget-user-image img-fluid">
                            <img class="img-circle" src="../img/imag_comb/<?php echo$icon ?>" alt="<?php echo$com_name ?>">
                        </div>
                        
                        <div class="card-footer">
                            <div class="row">
                                <h3 class="widget text-center"><?php echo$com_name ?> </h3>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo$flow ?></h5>
                                        <span class="description-text">المتابعين</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo$like ?></h5>
                                        <span class="description-text">الاعجابات</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header"><?php echo$count_product ?></h5>
                                        <span class="description-text">المنتجات</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!--      ----------------------------------------------                 -->

                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <strong><i class="fas fa-pencil-alt mr-1"></i></strong>
                                        <span class="description-text">Email-:<?php echo$com_email ?> /
                                            Tel/<?php echo$com_phone ?> </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <strong>
                                            <i class="fas fa-map-marker-alt mr-1">

                                            </i></strong>
                                        <span class="description-text">العنوان /
                                            <?php echo$city ?>/<?php echo$address ?>/<a href="$location"> <strong>
                                                    <i class="fas fa-map-marker-alt mr-1">

                                                    </i></strong></a> </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->







                            </div>
                            <!-- /.row -->
                            <form action='' method='POST'>
                                <button type='submit' class='btn btn-block btn-outline-info btn-flat' name='following'
                                    value='1'>
                                    <i class='fas fa-cart-plus fa-lg mr-2'></i>
                                    متابعة
                                </button>

                                <button type='submit' class='btn btn-block btn-outline-info btn-flat' name='like_center'
                                    value='1'>
                                    <i class='fas fa-heart'></i> اعجبني
                                </button>


                            </form>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>





            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->













        <!-- star div the comment-->
        <div class="md-7 ">
            <div class="card">

                <div class="card-body">
                    <div class="tab-content">

                        <!-- end div the profile and ditels -->
                        <?php $realctiv_query = "SELECT DISTINCT user.icon,user_name,comment FROM `reactive_company`,user,company WHERE reactive_company.user_id=user.user_id AND reactive_company.com_id=$center_id and comment!='' "or die(mysqli_error($con));
            $run_qusel = mysqli_query($con, $realctiv_query)or die(mysqli_error($con));
            if (mysqli_num_rows($run_qusel) > 0) {
                    while ($row = mysqli_fetch_array($run_qusel)) {
                        $user_name = $row['user_name'];
                        $comment = $row['comment'];
                        $icon = $row['icon'];
                        
                        
  
                        ?>
                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <!-- imag the user-->

                                <!-- name the user-->
                                <span class="username">
                                    <a href="#"><?php echo$user_name?></a>

                                    <a href="#" class="float-right btn-tool">
                                        <img class="img-circle img-bordered-sm" src=" ../img/user/<?php echo$icon ?>"
                                            alt="User Image">
                                    </a>
                                </span>
                            </div>
                            <!-- /.user-comment -->
                            <p>
                                <?php echo$comment ?>
                            </p>


                        </div>
                        <!-- /.post -->
                        <?php };}?>
                        <div class='card-footer'>
                            <form action='#' method='post'>
                                <div class='input-group'>
                                    <input type='text' name='comment' placeholder='اكتيب التعليق.....' class='form-control'>
                                    <span class='input-group-append'>
                                        <button type='submit' name='send_comment' class='btn btn-warning'>إرسال</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->


                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->


        </div>
        <!-- /.col -->












        <!-- star div the product-->
        <div class="md-7 ">

            <div class="container py-5" style="max-width: 98%;">
                <!--div order the dives  -->
                <div class="row">

                    <!-- Start div the department -->
                    <div class="col-lg-3">
                        <!-- titel div department-->
                        <h1 class="h2 pb-4"><a class="navbar-brand h2 pb-4" aria-current="page" href="<?php echo$linke?>"> قائمة
                                الاقسام</a></h1>
                        <!-- list to order the all department and catogoures -->
                        <ul class="list-unstyled templatemo-accordion">
                            <?php
                        
                        //$product_query = "SELECT DISTINCT department_com.deprat_id,name_depart_com FROM department_com WHERE department_com.com_id=$cate_iid";
                        $depart_query = "SELECT DISTINCT `deprat_id`,`name_depart_com` FROM `department_com` WHERE com_id='$center_id' and `depart_state_com`!=0 ";
                        $run_query = mysqli_query($con, $depart_query);
                        if (mysqli_num_rows($run_query) > 0) {

                            while ($row = mysqli_fetch_array($run_query)) {
                                $deprat_id = $row['deprat_id'];
                                $name_depart_com = $row['name_depart_com'];

                                echo "
                                        <!-- item one department -->
                                        <li class='pb-3'>
                                            <!-- titel the department and url -->
                                            <a class='collapsed d-flex justify-content-between h3 text-decoration-none' href='center_about.php?depart_id_pup=$deprat_id & center_id=$center_id '>$name_depart_com

                                                <i class='fa fa-fw fa-chevron-circle-down mt-1'></i>
                                            </a>
                                            <!-- list to item catogures -->
                                            <ul class='collapse show list-unstyled pl-3'>

                                            ";
                    $catgi_company_query = "SELECT `cat_id`,`cat_title` FROM `categories` WHERE `depart_id`= '$deprat_id' and `state_cat`!=0";
                    $run_query2 = mysqli_query($con, $catgi_company_query);
                    if (mysqli_num_rows($run_query2) > 0) {

                        while ($row = mysqli_fetch_array($run_query2)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "
                                     <!-- item catogures -->
                                     <li><a class='text-decoration-none' href='center_about.php?product_query= $selec_send $cat_id & depart_id_pup=$deprat_id &  center_id=$center_id'>$cat_title</a></li>
                                     ";
                                 };
                             }
                             echo "
                                 </ul>
                                 <!--end list to item catogures -->
                             </li>
                             <!--end item one department -->
                                     ";
                                 };
                             }
                             ?>
                        </ul>

                    </div>
                    <!-- end div the department -->

                    <!--start div the filter and product -->
                    <div class="col-lg-9">

                        <!-- Start div the filter to product -->
                        <div class="row">
                            <!--start div type filter -->
                            <div class="col-md-6">
                                <!-- list item to filter -->
                                <ul class="list-inline shop-top-menu pb-3 pt-1">
                                    <!-- item one filter -->
                                    <?php 
                        $catgi_company_query = "SELECT `cat_id`,`cat_title` FROM `categories` WHERE `depart_id`= '$depart_id_pup' and `state_cat`!=0";
                       // $catgi_company_query=$product_query;
                    $run_query2 = mysqli_query($con, $catgi_company_query);
                    if (mysqli_num_rows($run_query2) > 0) {

                        while ($row = mysqli_fetch_array($run_query2)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "
                        <li class='list-inline-item'>
                            <a class='h3 text-dark text-decoration-none mr-3' href='center_about.php?product_query=$selec_send $cat_id & depart_id_pup=$depart_id_pup & center_id=$center_id'> $cat_title</a>
                        </li>
                        <!--end  item one filter -->
                        ";
                    };
                    }

                        ?>
                                </ul>
                            </div>
                            <!--end the div type filter -->

                            
                        </div>
                        <!-- end div the filter to product -->


                        <!-- start dive products -->
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-5 g-2 overflow-auto">

                            <?php
                            
                         //   $product_query = "SELECT * FROM `product` ";
                            $run_query = mysqli_query($con, $product_query);
                            if (mysqli_num_rows($run_query) > 0) {

                                while ($row = mysqli_fetch_array($run_query)) {
                                    $pro_id    = $row['product_id'];
                                    //$pro_cat   = $row['product_cat'];
                                    $pro_title = $row['product_title'];
                                    $pro_price = $row['price'];
                                    $pro_imag = $row['product_image'];
                                    $product_cat=$row['product_cat'];
                                    echo "
                                    <!--start div to one product-->
                                    <div >
                                        <!--start div to order the div card -->
                                        <div class='card mb-4 product-wap rounded-0'>
                                            <!--start  div pictur-->
                                            <div class='card rounded-0'>
                                                <img class='bd-placeholder-img card-img-top'  width='100%' height='280px' src='../img/product_images/$pro_imag' >
                                                <!--div the boutton in the show imag -->
                                                <div
                                                    class='card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center'>
                                                    <!--list to order the button in imag -->
                                                    <ul class='list-unstyled'>
                                                        <!-- one item to button in the imag show -->
                                                        <li><a class='btn btn-success text-white' href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat&titel=$pro_title'><i
                                                                    class='far fa-heart'></i></a></li>
                                                        <li><a class='btn btn-success text-white mt-2' href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat&titel=$pro_title'><i
                                                                    class='far fa-eye'></i></a></li>
                                                        <li><a class='btn btn-success text-white mt-2' href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat&titel=$pro_title'><i
                                                                    class='fas fa-cart-plus'></i></a></li>
                                                    </ul>
                                                    <!--end list the button -->

                                                </div>
                                                <!--end div the boutton in the show imag -->

                                            </div>
                                            <!--end  div pictur-->

                                            <!--start div the name and price to product -->
                                            <div class='card-body'>
                                                <!--url & name product  -->
                                                <a href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat&titel=$pro_title' class='h5 text-decoration-none'>$pro_title</a>
                                                <!-- price the product  -->
                                                <p class='h4 text-center mb-0'>$pro_price</p>
                                            </div>
                                            <!--end div the name and price to product -->

                                        </div>
                                        <!--end dive the order card-->
                                    </div>
                                    <!--end div to one product-->
                                    ";
            };
        }
        ?>

                        </div>
                        <!-- end dive products -->

                    </div>
                    <!-- end the div filter and product -->


                </div>
                <!-- end dive order dives -->

            </div>
            <!-- End div the department-filter-product -->



        </div> 
        <!--end div the product -->












        <!-- end dive the cooment-->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->




<div class="col-md-6">

</div>


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
    $('.show-theme-options').delay(200).trigger('click');
});
</script>




<?php include('footer.php');?>