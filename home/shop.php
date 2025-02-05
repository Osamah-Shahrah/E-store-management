<?php
include"header.php";

echo"
<title>$name_system</title>
";
?>




<!-- Start Top Nav -->

<!-- Close Top Nav -->



<!-- Start the slid Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <!--start the slid-->
    <div class="carousel-inner">



        <!-- start one the slid -->
        <div class="carousel-item active">
            <!-- contery to div-->
            <div class="container">
                <!-- div to row -->
                <div class="row p-5">
                    <!-- div the imag -->
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" width='100%' height='240px' src="../img/system/<?php echo$icon_system?>"
                            alt="<?php echo$name_system?>">
                    </div>
                    <!--end imag dive -->

                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <!-- titel-->
                            <h1 class="h1 text-success"><b><?php echo$name_system?></b></h1>
                            <!-- secandli titel -->
                            <h3 class="h2">هنا تجد كل ماتحتاجة </h3>
                            <p>
                                <!-- TEXT -->
                                
                            </p>
                        </div>
                    </div>

                </div>
                <!-- end row -->
            </div>
            <!-- end contery to div-->
        </div>
        <!-- end one the slid -->

        <?php
                            
       $product_query = "SELECT `product_id`, `product_title`, `product_image`, `price`, `opponent`, `product_desc`, `notice` FROM `product` where product_id";
       $run_query = mysqli_query($con, $product_query);
       if (mysqli_num_rows($run_query)  > 0){
           while ($row = mysqli_fetch_array($run_query)) {
               $pro_id    = $row['product_id'];
               $pro_title = $row['product_title'];
               $pro_imag = $row['product_image'];
               $pro_price = $row['price'];
               $opponent = $row['opponent'];
               $product_desc = $row['product_desc'];
               $notice = $row['notice'];

   ?>

        <!-- start one the slid -->
        <div class="carousel-item">
            <!-- contery to div-->
            <div class="container">
                <!-- div to row -->
                <div class="row p-5">
                    <!-- div the imag -->
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" width='100%' height='150px' src="../img/product_images/<?php echo$pro_imag?>"
                            alt="<?php echo$pro_title?>">
                    </div>
                    <!--end imag dive -->
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <!-- titel-->
                            <h1 class="h1 text-success"><b><?php echo$pro_price?></b> <?php echo$pro_title?></h1>
                            <!-- secandli titel -->
                            <h3 class="h2"><?php echo$product_desc?></h3>
                            <p>
                                <!-- TEXT -->
                                <?php echo$notice?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end contery to div-->
        </div>
        <!-- end one the slid -->
        
        <?php
           };
        }
 ?>
    </div>
    <!-- button scrol the imag -->
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <!--end button scrol the imag -->
    <!-- button scrol the imag -->
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
    <!--end button scrol the imag -->
</div>

<!-- End the slid Banner Hero -->


<!-- Start the div viwe all ceters    -->
<section class="container" style="max-width: 100%;">

<div class="row">
   

<div class="col-md-12 text-center">
    
        <div class="col-lg-6 m-auto">
            <h1 class="h1">المراكز التجارية </h1>
            <p>
                هاذه مجموعه من المراكز التجارية التي تم التعامل معها بغرض اعلان عن منتجاتهاء
            </p>
        </div>
    

    <!-- div card compartive -->


            <div class='direct-chat-messages text-center row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-2 '
                style='width:100%;height: 540px;'>


                <?php 
                            
                            
                                $compartive_query = "SELECT  com_id,com_name,icon,city FROM company WHERE `com_status`!=0 "or die(mysqli_error($con));

                                $run_query5 = mysqli_query($con, $compartive_query)or die(mysqli_error($con));
                                if (mysqli_num_rows($run_query5) > 0) {
                                    while ($row = mysqli_fetch_array($run_query5)) {
                                     $com_id = $row['com_id'];
                                     $com_name = $row['com_name'];
                                     $icon = $row['icon'];
                                     $city = $row['city'];

                                     $linke="center_about.php?center_id=$com_id & titel=$com_name";
                                        ?>


                <div>

               
                    <a href='<?php echo$linke ?> '><img src='../img/imag_comb/<?php echo$icon?>'
                    style='width:auto;height: 200px;' class='rounded-circle img-fluid border-black   w-4 ' ></a>
                    <h5 class='text-center mt-3 mb-3'><?php echo$com_nam?></h5>
                    <p class='text-center'><a href='<?php echo$linke ?> '
                            class='btn btn-success'><?php echo$com_name?></a></p>
                </div>

                <?php
                                    };
                                    ?>
  
    </div>

    </div>
    </div>
    <!-- end div the compartive -->
    <?php
                                }
                    ?>



</section>
<!-- End the product Categories of the dive -->





<!-- Start Footer -->

<?php
include "footer.php";

?>