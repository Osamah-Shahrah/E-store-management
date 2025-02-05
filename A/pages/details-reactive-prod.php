<?php

include 'header.php';


static $details_prod_id;
static $reactiv_id;
static $counnt_messg;
static $count_like;
static $product_cat;

if (isset($_GET['details_prod_id'])) {
  $details_prod_id = $_GET['details_prod_id'];
}



//post form for add product to basket

if (isset($_POST['add_basket'])) {

  $add_basket = $_POST['add_basket'];

  $query_serch1 = mysqli_query($con, "SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=" . $_SESSION['user_id'] . " and `product_id` =" . $details_prod_id . "") or die(mysqli_error($con));

  if (mysqli_num_rows($query_serch1) > 0) {
    $row = mysqli_fetch_array($query_serch1);
    $reactiv_id = $row['reactive_product_id'];

    $query = mysqli_query($con, "SELECT * FROM `reactive_product` where `user_id`=" . $_SESSION['user_id'] . " and `product_id` =" . $details_prod_id . " and `cart_status`=$add_basket") or die(mysqli_error($con));

    if (mysqli_num_rows($query) > 0) {

      Msg_Sucess();
    } else {
      $query_updata1 = mysqli_query($con, "UPDATE `reactive_product` SET `cart_status`=$add_basket  WHERE `reactive_product_id`=$reactiv_id") or die(mysqli_error($con));
      if ($query_updata1) {
        Msg_Sucess();
      } else {
        Msg_Error1();
      }
    }
  } else {
    $query_inser1 = mysqli_query($con, "INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('" . $details_prod_id . "','" . $_SESSION['user_id'] . "',0,$add_basket,'') ") or die(mysqli_error($con));
    if ($query_inser1) {
      Msg_Sucess();
    } else {
      Msg_Error1();
    }
  }
}



//post form for add like to product 

if (isset($_POST['like'])) {


  $like = $_POST['like'];
  //query to search the user
  $query_serch2 = mysqli_query($con, "SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=" . $_SESSION['user_id'] . " and `product_id` =" . $details_prod_id . "") or die(mysqli_error($con));
  //if true updata data only or no insert the data
  if (mysqli_num_rows($query_serch2) > 0) {
    //tak the id to the reactiv to updata
    $row = mysqli_fetch_array($query_serch2);
    $reactiv_id = $row['reactive_product_id'];
    //query to find and tak the number lik
    $query = mysqli_query($con, "SELECT DISTINCT `user_like` FROM `reactive_product` where `user_id`=" . $_SESSION['user_id'] . " and `product_id` =" . $details_prod_id . " ") or die(mysqli_error($con));
    //if true  the select and tak the lik number to chang
    if (mysqli_num_rows($query) > 0) {
      //tak the data
      $row = mysqli_fetch_array($query);
      $lik_num = $row['user_like'];
      //if uper 0 cahnd to 0
      if ($lik_num > 0) {
        $like = 0;
      } else {
        $like = 1;
      }
      //updata the data
      $query_updata2 = mysqli_query($con, "UPDATE `reactive_product` SET `user_like`=$like  WHERE `reactive_product_id`=$reactiv_id") or die(mysqli_error($con));
      if ($query_updata2) {
        //qurey to messg 
        if ($like > 0) {
          Msg_Sucess2();
        } else {
          Msg_Error_like();
        }
      } else {
        Msg_Error_like();
      }
    }
  } else {
    $query_inser2 = mysqli_query($con, "INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('" . $details_prod_id . "','" . $_SESSION['user_id'] . "',$like,0,'') ") or die(mysqli_error($con));
    if ($query_inser2) {
      Msg_Sucess2();
    } else {
      Msg_Error_like();
    }
  }
}





//post form to add comment for product 

if (isset($_POST['send_comment'])) {

  $comment = $_POST['comment'];

  $query_serch3 = mysqli_query($con, "SELECT DISTINCT `reactive_product_id` FROM `reactive_product` where `user_id`=" . $_SESSION['user_id'] . " and `product_id` =" . $details_prod_id . "") or die(mysqli_error($con));

  if (mysqli_num_rows($query_serch3) > 0) {
    $row = mysqli_fetch_array($query_serch3);
    $reactiv_id = $row['reactive_product_id'];

    $query_updata3 = mysqli_query($con, "UPDATE `reactive_product` SET `comment`='$comment'  WHERE `reactive_product_id`=$reactiv_id") or die(mysqli_error($con));
    if ($query_updata3) {
      Msg_Sucess();
    } else {
      Msg_Error1();
    }
  } else {
    $query_inser3 = mysqli_query($con, "INSERT INTO `reactive_product`(`product_id`, `user_id`, `user_like`, `cart_status`, `comment`) VALUES ('" . $details_prod_id . "','" . $_SESSION['user_id'] . "',0,0,'$comment') ") or die(mysqli_error($con));
    if ($query_inser3) {
      Msg_Sucess();
    } else {
      Msg_Error1();
    }
  }
}

//cod for count like for the product
$cont_like_query = "SELECT COUNT(`user_like`)as'count_like' FROM `reactive_product` where `product_id`='" . $details_prod_id . "' and `user_like`!='0'";
$run_query4 = mysqli_query($con, $cont_like_query) or die(mysqli_error($con));
if ($run_query4) {
  $row = mysqli_fetch_array($run_query4);
  $count_like = $row['count_like'];
}

//cod for count commend for the product
$cont_messg_query = "SELECT COUNT(`comment`)as'count' FROM `reactive_product` where `product_id`='" . $details_prod_id . "' AND `comment`!=''";
$run_query3 = mysqli_query($con, $cont_messg_query) or die(mysqli_error($con));
if ($run_query3) {
  $row = mysqli_fetch_array($run_query3);
  $counnt_messg = $row['count'];
}


// if data is posted, set value to 1, else to 0




//get all data for the prodect
$company_query = "SELECT `product_id`,`com_id`,`id_depart_com`,`product_title`,`product_cat`,`QR_number`,`product_image`,`price`,`opponent`,`product_desc`,`notice`,price-opponent as fin_price FROM `product` WHERE `product_id`='" . $details_prod_id . " '" or die(mysqli_error($con));

$run_query2 = mysqli_query($con, $company_query) or die(mysqli_error($con));
if (mysqli_num_rows($run_query2) > 0) {
  while ($row = mysqli_fetch_array($run_query2)) {
    $product_id = $row['product_id'];
    $com_id = $row['com_id'];
    $id_depart_com = $row['id_depart_com'];
    $product_title = $row['product_title'];
    $product_cat = $row['product_cat'];
    $QR_number = $row['QR_number'];
    $product_image = $row['product_image'];
    $price = $row['fin_price'];
    $opponent = $row['opponent'];
    $product_desc = $row['product_desc'];
    $notice = $row['notice'];
  }
}










?>









<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid" dir="rtl">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 style="float: right;">بيانات المنتج</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="float:left!important;">

          <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
          <li class="breadcrumb-item active">بيانات المنتج</li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>




<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row" dir="rtl">
      <!-- hear write the code -->

      <div class="col-12">

        <div class="card card-solid">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">
                  <?php echo $product_title; ?>
                </h3>
                <div class="col-12">
                  <img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>" style="width: 100%;height: 480px;">
                </div>
                <div class="col-12 product-image-thumbs">
                  <div class="product-image-thumb active"><img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>">
                  </div>
                  <div class="product-image-thumb"><img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></div>
                  <div class="product-image-thumb"><img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></div>
                  <div class="product-image-thumb"><img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></div>
                  <div class="product-image-thumb"><img src="../../img/product_images/<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></div>
                </div>
              </div>
              <div class="col-12 col-sm-6">
                <h3 class="my-3">
                  <?php echo $product_title; ?>
                </h3>
                <p>
                  <?php echo $product_desc; ?>
                </p>





                <?php
                $size_product_query = "SELECT `name_size`,`details_size` FROM `product`,size_product WHERE  product.product_id=size_product.fk_id_pro AND size_product.size_status=1 AND   `product_id`='" . $details_prod_id . " '" or die(mysqli_error($con));

                $run_query_size = mysqli_query($con, $size_product_query) or die(mysqli_error($con));
                if (mysqli_num_rows($run_query_size) > 0) {
                  echo "
                    <!-- start div for size the product -->
                    <h4 class='mt-3'>الاحجام <small>يرجاء تحديد الحجم</small></h4>
                            <div class='btn-group btn-group-toggle' data-toggle='buttons'>";
                  while ($row = mysqli_fetch_array($run_query_size)) {

                    $name_size = $row['name_size'];
                    $size_details = $row['details_size'];

                    echo "
                                            <!--one the slider for size -->
                                            
                                               <label id='custom-tabs-two-$name_size-tab' data-toggle='pill' href='#custom-tabs-two-$name_size' role='tab'
                                                aria-controls='custom-tabs-two-$name_size' aria-selected='false' class='btn btn-default text-center'>
                                                    <input type='radio' name='color_option' autocomplete='off'>
                                                    <span class='text-xl'>$name_size</span>
                                                    <br>
                                                    $name_size
                                                </label>


                                                    
          
                                           
                                            <!--end one slider-->
                                                       
                                                        ";
                  }

                  echo "

                    </div>
                           
                    <!--end the div for slider size -->

                    <!--start div ditels for size -->

                    <div class='card-body'>
                        <div class='tab-content' id='custom-tabs-two-tabContent'>

                           ";
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
                  echo "

                        </div>
                    </div>
                    <!--end div ditels for size-->
                
                <!-- end div for size the product -->
";
                }
                ?>






                <div class="bg-gray py-2 px-3 mt-4">
                  <h2 class="mb-0">
                    <?php echo $price ?>
                  </h2>
                  <h4 class="mt-0">
                    <small>Ex Tax:
                      <?php echo $opponent ?>
                    </small>
                  </h4>
                </div>
                <form action='' method='POST'>
                  <div class="mt-4">
                    <button type='submit' class="btn btn-block btn-outline-info toastr Default Success" name='add_basket' value='1'>

                      <i class="fas fa-bookmark mr-2 "></i>
                      حفظ المنتج

                    </button>
                    <button type='submit' class="btn btn-default btn-lg danger   btn-outline-info toastr " name='like' value='1'>

                      <i class="fas fa-heart fa-lg mr-2"></i>
                      اعجبني <span class='fb-like'>
                        <?php echo $count_like ?>
                      </span>



                    </button>
                  </div>
                </form>

                <div class="mt-4 product-share">
                  <a href="#" class="text-gray">
                    <i class="fab fa-facebook-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fab fa-twitter-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-envelope-square fa-2x"></i>
                  </a>
                  <a href="#" class="text-gray">
                    <i class="fas fa-rss-square fa-2x"></i>
                  </a>
                </div>

              </div>
            </div>

            <div class="row mt-4">
              <nav class="w-100">
                <div class="nav nav-tabs" id="product-tab" role="tablist">
                  <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                  <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">أراء العملاء <span class="info-box-icon badge badge-success " data-toggle='tooltip' title='3 '>
                      <?php echo "$counnt_messg" ?><i class="fas fa-comments"></i>
                    </span></a>
                  <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                </div>
              </nav>
              <div class="tab-content p-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                  <?php echo $product_desc; ?>
                </div>


                <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">




                  <?php

                  $realctiv_query = "SELECT DISTINCT icon,user_name,comment FROM
                                    `reactive_product`,user,product WHERE reactive_product.user_id=user.user_id AND reactive_product.product_id='" . $details_prod_id . "' and comment!='' " or die(mysqli_error($con));
                  $run_qusel = mysqli_query($con, $realctiv_query) or die(mysqli_error($con));
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
                          <span class='direct-chat-name float-right'>
                            <?php echo $user_name ?>
                          </span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class='direct-chat-img' src='../../img/user/<?php echo $icon ?>' alt='<?php echo $user_name ?>'>
                        <!-- direct-chat-img -->
                        <div class='h3 direct-chat-text' style='background: #fff; color: #000;'>
                          <?php echo $comment ?>
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                  <?php
                    };
                  }
                  ?>

                  <!-- card footer for comment this div for write the comment and button for send -->
                  <div class='footer'>
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
                <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                  Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea
                  dictumst. Aenean
                  elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada
                  scelerisque. Praesent
                  vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod
                  neque, non
                  bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh
                  rhoncus ut. Aliquam
                  efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam
                  metus odio,
                  malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at
                  accumsan urna
                  vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus,
                  at mollis nisi orci
                  et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa
                  at semper
                  posuere. Integer finibus orci vitae vehicula placerat. </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->










      </div>



    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->







<?php

include 'footer.php';

?>