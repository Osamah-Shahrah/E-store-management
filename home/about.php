<?php
include"header.php";

echo "
";
?>

<!-- start the div Banner -->
<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-8 text-white">
                <h1><?php echo$name_system?></h1>
                <p>
                <?php echo $about_system?>
                </p>
            </div>
            <div class="col-md-4">
                <img src="assets/img/about-hero.svg" alt="About Hero">
            </div>
        </div>
    </div>
</section>

<!-- end the div Banner -->

<!-- Start Section -->
<section class="container py-5">
    <div class="row text-center pt-5 pb-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">توصل معنا</h1>
        </div>
    </div>
    <div class="row">



        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="mailto:<?php echo$Email?>">
                    <div class="h1 text-success text-center"><i class="fa fa-envelope"></i></div>
                </a>

                <h2 class="h5 mt-4 text-center">البريد الإلكتروني</h2>
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="tel:<?php echo$phon_number?>">
                    <div class="h1 text-success text-center"><i class="fas fa-phone"></i></div>
                </a>
                <h2 class="h5 mt-4 text-center">اتصل بنا</h2>
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
            <a class="text-decoration-none" href="https://api.whatsapp.com/send?phone=<?php echo$whatsapp?>&text=Hello asssomat">
                <div class="h1 text-success text-center"><i class="fab fa-whatsapp"></i></div>
                </a>

                <h2 class="h5 mt-4 text-center">واتس أب</h2>
            
            </div>
        </div>
        

        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
            <a class="text-decoration" href="https://t.me/<?php echo$telegram?>">
                <div class="h1 text-success text-center"><i class="fab fa-telegram-plane"></i></div>
                </a>
                <h2 class="h5 mt-4 text-center">تليجرام</h2>
           
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="<?php echo$address?>">
                    <div class="h1 text-success text-center"><i class="fas fa-map-marker-alt fa-fw"></i></div>
                </a>

                <h2 class="h5 mt-4 text-center"> العنوان</h2>
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="<?php echo$facebook?>">
                    <div class="h1 text-success text-center"><i class="fab fa-facebook-f fa-lg fa-fw"></i></div>
                </a>
                <h2 class="h5 mt-4 text-center">Facebook</h2>
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="<?php echo$instagram?>">
                    <div class="h1 text-success text-center"><i class="fab fa-instagram fa-lg fa-fw"></i></div>
                </a>

                <h2 class="h5 mt-4 text-center"> Instagram</h2>
            </div>
        </div>


        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="<?php echo$twitter?>">
                    <div class="h1 text-success text-center"><i class="fab fa-twitter fa-lg fa-fw"></i></div>
                </a>
                <h2 class="h5 mt-4 text-center">twitter</h2>
            </div>
        </div>

        
        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <a class="text-decoration-none" href="<?php echo$linkedin?>">
                    <div class="h1 text-success text-center"><i class="fab fa-linkedin fa-lg fa-fw"></i></div>
                </a>
                <h2 class="h5 mt-4 text-center">linkedin</h2>
            </div>
        </div>





    </div>
</section>
<!-- End Section -->




<?php
include"footer.php";
?>