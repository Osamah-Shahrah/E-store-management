<?php
include"header.php";

static $titel="المنتجات";
if ((isset($_GET['titel']))) {

    $titel = $_GET['titel'];
}

echo"
<title> $titel </title>
";

static $prod_id;
static $reactiv_id;
static $counnt_messg;
static $count_like;
static $product_cat;

if (isset($_GET['prod_id'])) {
        $prod_id = $_GET['prod_id'];
}


if ((isset($_GET['product_cat']))) {

    $product_cat = $_GET['product_cat'];
   
}



//post form for add product to basket

if(isset($_POST['add_basket']))
{
    if(isset($_SESSION['login']))
    { 
        
    $add_basket=$_POST['add_basket'];

    $query_serch1=mysqli_query($con,"SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=".$user_id." and `product_id` =".$prod_id."")or die(mysqli_error($con));

    if(mysqli_num_rows($query_serch1) > 0)
    {
        $row = mysqli_fetch_array($query_serch1);
        $reactiv_id=$row['reactive_product_id'];

        $query=mysqli_query($con,"SELECT * FROM `reactive_product` where `user_id`=".$user_id." and `product_id` =".$prod_id." and `cart_status`=$add_basket")or die(mysqli_error($con));

        if(mysqli_num_rows($query) > 0)
            {
              
              Msg_Sucess();

            }
        else
            {
                $query_updata1=mysqli_query($con,"UPDATE `reactive_product` SET `cart_status`=$add_basket  WHERE `reactive_product_id`=$reactiv_id")or die(mysqli_error($con));
                if($query_updata1)
                        {
                            Msg_Sucess();

                        }
                else
                    {
                            Msg_Error1();
                    }

            }
    }

    else
        {
            $query_inser1=mysqli_query($con,"INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('".$prod_id."','".$user_id."',0,$add_basket,'') ")or die(mysqli_error($con));
            if($query_inser1)
                {
                    Msg_Sucess();
                    
 
                }
            else
                {
                    Msg_Error1();
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



//post form for add like to product 

if(isset($_POST['like']))
{
    if(isset($_SESSION['login']))
    { 
        
    $like=$_POST['like'];
    //query to search the user
    $query_serch2=mysqli_query($con,"SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=".$user_id." and `product_id` =".$prod_id."")or die(mysqli_error($con));
    //if true updata data only or no insert the data
    if(mysqli_num_rows($query_serch2) > 0)
    {
        //tak the id to the reactiv to updata
        $row = mysqli_fetch_array($query_serch2);
        $reactiv_id=$row['reactive_product_id'];
    //query to find and tak the number lik
        $query=mysqli_query($con,"SELECT DISTINCT `user_like` FROM `reactive_product` where `user_id`=".$user_id." and `product_id` =".$prod_id." ")or die(mysqli_error($con));
    //if true  the select and tak the lik number to chang
        if(mysqli_num_rows($query) > 0)
            {
                //tak the data
                $row = mysqli_fetch_array($query);
                $lik_num=$row['user_like'];
                //if uper 0 cahnd to 0
                if($lik_num>0)
                {
                    $like=0;
                }
                else
                {
                    $like=1;
                }
                //updata the data
                $query_updata2=mysqli_query($con,"UPDATE `reactive_product` SET `user_like`=$like  WHERE `reactive_product_id`=$reactiv_id")or die(mysqli_error($con));
                if($query_updata2)
                        {
                            //qurey to messg 
                            if($like>0)
                            {  
                                Msg_Sucess2();
                            }
                            else
                            {
                                Msg_Error_like();
                            }
                        }
                else
                    {
                        Msg_Error_like();
                    }

            }

    }

    else
        {
            $query_inser2=mysqli_query($con,"INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('".$prod_id."','".$user_id."',$like,0,'') ")or die(mysqli_error($con));
            if($query_inser2)
                {
                    Msg_Sucess2();
                }
            else
                {
                    Msg_Error_like();
                }
        }

    }
    else
        {
            //code if the user click like his do'n sgin in show the short sgin in in the screan
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

    $query_serch3=mysqli_query($con,"SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=".$user_id." and `product_id` =".$prod_id."")or die(mysqli_error($con));

    if(mysqli_num_rows($query_serch3) > 0)
    {
        $row = mysqli_fetch_array($query_serch3);
        $reactiv_id=$row['reactive_product_id'];

                $query_updata3=mysqli_query($con,"UPDATE `reactive_product` SET `comment`='$comment'  WHERE `reactive_product_id`=$reactiv_id")or die(mysqli_error($con));
                if($query_updata3)
                        {
                            Msg_Sucess();
                        }
                else
                    {
                        Msg_Error1();
                    }

            
    }

    else
        {
            $query_inser3=mysqli_query($con,"INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('".$prod_id."','".$user_id."',0,0,'$comment') ")or die(mysqli_error($con));
            if($query_inser3)
                {
                    Msg_Sucess();
                }
            else
                {
                    Msg_Error1();
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

//cod for count like for the product
    $cont_like_query = "SELECT COUNT(`user_like`)as'count_like' FROM `reactive_product` where `product_id`=".$prod_id." and `user_like`!='0'";
    $run_query4 = mysqli_query($con, $cont_like_query)or die(mysqli_error($con));
    if($run_query4)
    {
    $row = mysqli_fetch_array($run_query4);
    $count_like=$row['count_like'];
    }

//cod for count commend for the product
    $cont_messg_query = "SELECT COUNT(`comment`)as'count' FROM `reactive_product` where `product_id`=".$prod_id." AND `comment`!=''";
    $run_query3 = mysqli_query($con, $cont_messg_query)or die(mysqli_error($con));
    if($run_query3)
    {
    $row = mysqli_fetch_array($run_query3);
    $counnt_messg=$row['count'];
    }

 
    // if data is posted, set value to 1, else to 0




//get all data for the prodect
$company_query = "SELECT `product_id`,`com_id`,`id_depart_com`,`product_title`,`product_cat`,`QR_number`,`product_image`,`price`,`opponent`,`product_desc`,`notice` FROM `product` WHERE `product_id`='".$prod_id." '"or die(mysqli_error($con));

$run_query2 = mysqli_query($con, $company_query)or die(mysqli_error($con));
if (mysqli_num_rows($run_query2) > 0) {
        while ($row = mysqli_fetch_array($run_query2)) {
            $product_id = $row['product_id'];
            $com_id = $row['com_id'];
            $id_depart_com = $row['id_depart_com'];
            $product_title = $row['product_title'];
            $product_cat=$row['product_cat'];
            $QR_number=$row['QR_number'];
            $product_image = $row['product_image'];
            $price = $row['price'];
            $opponent = $row['opponent'];
            $product_desc=$row['product_desc'];
            $notice= $row['notice'];
        }
    }
       
?>




<!-- start the section for the page-->

<section class='bg-light '>

    <div class='container' style="max-width: 100%;">

        <!--start the dive puctur and ditels-->
        <div class='row'>


            <div class="col-md-6 mb-2 themed-grid-col">

                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>

                    <?php echo"
                        <div class='carousel-inner'  >
                            <div class='carousel-item active'>
                                <img  src='../img/product_images/$product_image'alt='$product_title' class='w-100'>
                            </div>

                            <div class='carousel-item'>
                                <img src='../img/product_images/$product_image'alt='$product_title' class=' w-100' >
                            </div>

                            <div class='carousel-item'>
                                <img src='../img/product_images/$product_image'alt='$product_title' class=' w-100'>
                            </div>
                        </div>
                                     ";?>
                    <button class="carousel-control-prev btn-transparent" type="button"
                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev"
                        style="background-color: transparent; border: none;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next" style="background-color: transparent; border: none;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>


            <!--start div the ditels for product-->
            <div class="col-md-6 mb-2 themed-grid-col">


                <!-- div card ditels -->
                <div>
                    <!-- start div for name and price the product -->
                    <div>
                        <strong class="text-primary h2"><?php echo$product_title ?></strong>
                        <p><?php echo$product_desc?></p>
                        <strong class="h3">السعر: <strong class="h2 text-danger"><?php echo$price?></strong></strong>
                    </div>
                    <strong class="h3">المقاسات المتوفرة للمنتج</strong>

                    <!-- start div for size the product -->

                    <div class="card card-primary card-outline card-tabs">
                        <!--div for slider -->
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <!--list the slider -->
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <?php
                  $size_product_query = "SELECT `name_size`,`details_size` FROM `product`,size_product WHERE  product.product_id=size_product.fk_id_pro AND size_product.size_status=1 AND   `product_id`='" . $prod_id . " '" or die(mysqli_error($con));

                  $run_query_size = mysqli_query($con, $size_product_query) or die(mysqli_error($con));
                  if (mysqli_num_rows($run_query_size) > 0) {
                    while ($row = mysqli_fetch_array($run_query_size)) {
                      
                      $name_size = $row['name_size'];
                      $size_details = $row['details_size'];

                      echo "
                                                    


                                            <!--one the slider for size -->
                                            <li class='nav-item'>
                                                <a class='nav-link' id='custom-tabs-two-$name_size-tab'
                                                    data-toggle='pill' href='#custom-tabs-two-$name_size' role='tab'
                                                    aria-controls='custom-tabs-two-$name_size' aria-selected='false'>$name_size</a>
                                            </li>
                                            <!--end one slider-->
                                                       
                                                        ";
                    }
                  }
                  ?>




                            </ul>


                        </div>
                        <!--end the div for slider -->

                        <!--start div ditels -->

                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">

                                <?php
                  $run_query_size = mysqli_query($con, $size_product_query) or die(mysqli_error($con));
                  if (mysqli_num_rows($run_query_size) > 0) {
                    while ($row = mysqli_fetch_array($run_query_size)) {
                     
                      $name_size = $row['name_size'];
                      $size_details = $row['details_size'];
                      echo "
                                            <!--one ditels for one slider  -->

                                            <div class='tab-pane fade' id='custom-tabs-two-$name_size'
                                                role='tabpanel' aria-labelledby='custom-tabs-two-$name_size-tab'>
                                                $size_details
                                            </div>
                                            <!--end one ditels-->
                                                        ";
                    }
                  }
                  ?>

                            </div>
                        </div>
                        <!--end div ditels-->
                    </div>
                    <!-- end div for size the product -->
                    <form action='' method='POST'>
                        <button type='submit' class='btn btn-block btn-outline-info toastrDefaultSuccess'
                            name='add_basket' value='1'>
                            <i class='fas fa-bookmark mr-2'></i>
                            حفظ المنتج
                        </button>

                        <button type='submit' class='btn btn-block btn-outline-danger swalDefaultSuccess' name='like'
                            value='1'>
                            <span class='fb-like'><?php echo$count_like?></span>

                            <i class='fas fa-heartfas fa-heart fa-lg mr-2'></i> اعجبني
                        </button>


                    </form>


                </div>


            </div>


            <br><br>

            <!-- DIRECT CHAT comments -->
            <!--    collapsed-card      -->
            <div class='card direct-chat direct-chat-success '>

                <div class='card-header' data-card-widget='collapse'>

                    <h3 class='card-title' style='float: right;'>أراء العملاء</h3>
                    <!-- count comment -->
                    <span class="info-box-icon badge badge-success " data-toggle='tooltip'
                        title='3 '><?php echo"$counnt_messg"?><i class="fas fa-comments"></i></span>

                    <div class='card-tools' style='float: left;'>




                        <!-- button open chat for comment -->
                        <button type='button' class='btn btn-tool' data-card-widget='collapse'><i
                                class='fas fa-plus'></i>
                        </button>

                        <!-- button close the div chat for comment -->
                        <button type='button' class='btn btn-tool' data-card-widget='remove'><i
                                class='fas fa-times'></i>
                        </button>



                    </div>

                </div>

                <!-- insid the div for comment  -->
                <div class='card-body'>
                    <!-- Conversations are loaded here -->
                    <div class='direct-chat-messages'>
                        <?php

                                    $realctiv_query = "SELECT DISTINCT icon,user_name,comment FROM
                                    `reactive_product`,user,product WHERE reactive_product.user_id=user.user_id AND
                                    reactive_product.product_id='".$prod_id."' and comment!='' "or die(mysqli_error($con));
                                    $run_qusel = mysqli_query($con, $realctiv_query)or die(mysqli_error($con));
                                    if (mysqli_num_rows($run_qusel) > 0) {
                                    while ($row = mysqli_fetch_array($run_qusel)) {
                                    $user_name = $row['user_name'];
                                    $comment = $row['comment'];
                                    $icon = $row['icon'];
                                    ?>
                        <!-- comment the pepol on the product -->
                        <div class='direct-chat-msg right'>
                            <!--name the user -->
                            <div class='direct-chat-infos clearfix'>
                                <span class='direct-chat-name float-right'><?php echo$user_name?></span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class='direct-chat-img' src='../img/user/<?php echo$icon?>'
                                alt='<?php echo$user_name?>'>
                            <!-- direct-chat-img -->
                            <div class='h3 direct-chat-text' style='background: #fff; color: #000;'>
                                <?php echo$comment?> </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <?php 
                                            };
                                             }
                                                ?>
                    </div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- card footer for comment this div for write the comment and button for send -->
                <div class='card-footer'>
                    <form action='#' method='post'>
                        <div class='input-group'>
                            <input type='text' name='comment' placeholder='اكتيب التعليق.....' class='form-control'>
                            <span class='input-group-append'>
                                <button type='submit' name='send_comment' class='btn badge-success '>إرسال</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->


            </div>
            <!--/.direct-chat -->





        </div>
    </div>
</section>




<!--start dive the mor product from same tha categories -->
<footer class="container " style="max-width: 100%;">


    <h1 class='h3'> اخرى </h1>
    <?php


    echo "

        <!-- name the department-->

            <div class='row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 overflow-auto ' style='height:680px;width:100% '>

            ";

             $catgoris_query = "SELECT `product_id`,`product_title`,`product_image`,`price`,`opponent`,product_cat FROM `product` where product_cat=$product_cat and `product_id`!=".$prod_id." "or die(mysqli_error($con));
             $run_query = mysqli_query($con, $catgoris_query)or die(mysqli_error($con));
                if (mysqli_num_rows($run_query) > 0) {

                      while ($row = mysqli_fetch_array($run_query)) {
                         $product_id = $row['product_id'];
                         $product_title = $row['product_title'];
                         $product_image = $row['product_image'];
                         $price = $row['price'];
                         $opponent = $row['opponent'];
                         $product_cat = $row['product_cat'];

                         echo "
      
            <!--start div to one product-->
            <div >
                <!--start div to order the div card -->
                <div class='card mb-4 product-wap rounded-0'>
                    <!--start  div pictur-->
                    <div class='card rounded-0'>
                        <img class='bd-placeholder-img card-img-top'  width='100%' height='240px' src='../img/product_images/$product_image' >
                        <!--div the boutton in the show imag -->
                        <a class='stretched-link' href='shop-single.php?prod_id=$product_id & product_cat=$product_cat & titel=$product_title'></a>
                        <!-- div for shadw in the image when select imag -->
                        <div class='card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center' >





                                                
                                                </div>
                        <!--end div the boutton in the show imag -->

                    </div>
                    <!--end  div pictur-->

                    <!--start div the name and price to product -->
                    <div class='card-body'>
                        <!--url & name product  -->
                        <a href='shop-single.php?prod_id=$product_id & product_cat=$product_cat & titel=$product_title' class='h4 text-decoration-none'>$product_title</a>
                        <!-- price the product  -->
                        <p class='h4 text-center mb-0'>
                        <span class=' text-danger h4 '> ر.ي <strong class=' text-primary'> $price</strong></span>
                    </div>
                    <!--end div the name and price to product -->

                </div>
                <!--end dive the order card-->
            </div>
            <!--end div to one product-->
      




                    ";
                  };
           }



          echo "


            </div>
                            ";


     ?>




</footer>
<!--end  dive the more product and center -->



<?php include('footer.php');?>