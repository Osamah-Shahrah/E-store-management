<?php
include "header.php";


    static $depart_id_pup;
  // static $product_query;
    static $product_query = "SELECT DISTINCT `product_id`,`product_image`,`price`,`product_title`,`product_cat` FROM product,company,department_com WHERE product.com_id=company.com_id AND product.id_depart_com=department_com.id_depart_com AND company.com_status!=0 AND product.status_pro!=0 AND department_com.depart_state_com!=0";
   static $selec_send= "SELECT DISTINCT `product_id`,`product_image`,`price`,`product_title`,`product_cat` FROM product,company,department_com WHERE product.com_id=company.com_id AND product.id_depart_com=department_com.id_depart_com AND company.com_status!=0 AND product.status_pro!=0 AND department_com.depart_state_com!=0 AND product.product_cat= ";
    if (isset($_GET['depart_id_pup'])) {

        $depart_id_pup = $_GET['depart_id_pup'];
    }

    if (isset($_GET['product_query'])) {

        $product_query= $_GET['product_query'];
    }
?>




<!-- Start div the department-filter- ptodect -->
<div class="container py-5" style="max-width: 98%;">
                <!--div order the dives  -->
                <div class="row">

                    <!-- Start div the department -->
                    <div class="col-lg-2">
                        <!-- titel div department-->
                        <h1 class="h2 pb-4" > <a class="navbar-brand h2 pb-4" aria-current="page" href="index.php?"> قائمة
                                الاقسام</a></h1>
                        <!-- list to order the all department and catogoures -->
                        <ul class="list-unstyled templatemo-accordion">
                            <?php
                        
                        //$product_query = "SELECT DISTINCT department_com.deprat_id,name_depart_com FROM department_com WHERE department_com.com_id=$cate_iid";
                        $depart_query = "SELECT DISTINCT `deprat_id`,`name_depart_com` FROM `department_com`,`company`  WHERE company.com_id=department_com.com_id  AND company.com_status!=0  AND `depart_state_com`!=0 "or die(mysqli_error($con));
                        $run_query = mysqli_query($con, $depart_query);
                        if (mysqli_num_rows($run_query) > 0) {

                            while ($row = mysqli_fetch_array($run_query)) {
                                $deprat_id = $row['deprat_id'];
                                $name_depart_com = $row['name_depart_com'];

                                echo "
                                        <!-- item one department -->
                                        <li class='pb-3'>
                                            <!-- titel the department and url -->
                                            <a class='collapsed d-flex justify-content-between h3 text-decoration-none'  href='index.php?depart_id_pup=$deprat_id'>$name_depart_com
                                                <i class='fa fa-fw fa-chevron-circle-down mt-1'></i>
                                            </a>
                                            <!-- list to item catogures -->
                                            <ul class='collapse show list-unstyled pl-3'>

                                            ";
                    $catgi_company_query = "SELECT `cat_id`,`cat_title` FROM `categories` WHERE  `depart_id`= '$deprat_id' and `state_cat`!=0";
                    $run_query2 = mysqli_query($con, $catgi_company_query);
                    if (mysqli_num_rows($run_query2) > 0) {

                        while ($row = mysqli_fetch_array($run_query2)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "
                                     <!-- item catogures -->
                                     <li><a class='text-decoration-none'  href='index.php?product_query= $selec_send $cat_id & depart_id_pup=$deprat_id'>$cat_title</a></li>
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
                    <div class="col-lg-10">

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
                            <a class='h3 text-dark text-decoration-none mr-3'  href='index.php?product_query=$selec_send $cat_id & depart_id_pup=$depart_id_pup'> $cat_title</a>
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
                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 overflow-auto">

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
                                            <a class='stretched-link' href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat&titel=$pro_title'>
                                            <div class='card rounded-0'>
                                                <img class='bd-placeholder-img card-img-top'  width='100%' height='280px' src='../img/product_images/$pro_imag' >
                                                <!--div the boutton in the show imag -->
                                                
                                                <!-- div for shadw in the image when select imag -->
                                                <div class='card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center' >

                                                </div>
                                                <!--end div the boutton in the show imag -->
                                            </div>
                                            </a>
                                            <!--end  div pictur-->

                                            <!--start div the name and price to product -->
                                            <div class='card-body'>
                                                <!--url & name product  -->
                                                <a  href='shop-single.php?prod_id=$pro_id & product_cat=$product_cat & titel=$pro_title' class='h4 text-decoration-none' > $pro_title</a>
                                                <!-- price the product  -->
                                                <p class='h4 text-center mb-0'>
                                                <span class=' text-danger h4 '> ر.ي <strong class=' text-primary'> $pro_price</strong></span>
                                                
                                               </p>
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
        <!--
$(document).ready(function() {
  $("#pro_depart").click(function() {
    var depart_id = $(this).val();
    $("#ddd").val(depart_id);
    $.get("process.php", { depart_id: depart_id },
      function(data, status) {
        $("#pro_cat").html(data);
      });
  });
});
-->
                        </div>
                        <!-- end dive products -->

                    </div>
                    <!-- end the div filter and product -->


                </div>
                <!-- end dive order dives -->

            </div>
            <!-- End div the department-filter-product -->



            <!-- Start Footer -->

            <?php
include"footer.php";

?>