<?php
session_start();
include "../db.php";
include "auth.php";
include "header.php";
include "message.php";












static $com_id = 0;


if (isset($_GET['com_id'])) {
  $com_id = $_GET['com_id'];

  //static $com_name=$_POST[''];
  static $com_phone;
  static $city;
  static $address;
  static $com_email;
  static $icon;
  static $com_status;
  static $comm_Reg;
  static $contract_accept;
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
  static $com_status_ch;

  $sql_quer_com = "SELECT * FROM `company` WHERE `com_id`='" . $com_id . "';";



  $execution_query_com = mysqli_query($con, $sql_quer_com) or die(mysqli_error($con));
  if (mysqli_num_rows($execution_query_com) > 0) {
    while ($array_com = mysqli_fetch_array($execution_query_com)) {



      $com_name = $array_com['com_name'];
      $com_phone = $array_com['com_phone'];
      $city = $array_com['city'];
      $address = $array_com['address'];
      $com_email = $array_com['com_email'];
      $icon = $array_com['icon'];
      $comm_Reg = $array_com['comm_Reg'];
      $contract_accept = $array_com['contract_accept'];
      $date_modifide = $array_com['date_modifide'];

      $location = $array_com['location'];
      $whatsapp = $array_com['whatsapp'];
      $telegram = $array_com['telegram'];
      $website_company = $array_com['website_company'];
      $instagram = $array_com['instagram'];
      $facebook = $array_com['facebook'];
      $twitter = $array_com['twitter'];

      $linkedin = $array_com['linkedin'];
      $about_company = $array_com['about_company'];
      $messg_comm = $array_com['messg_comm'];

      $com_status = $array_com['com_status'];
      if ($array_com['com_status']) {
        $com_status_ch = "checked";
      } else {
        $com_status_ch = "check";
      }
    }
  }
}


?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid" dir="rtl">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="float: right;">إضافة مراكز تجارية</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right" style="float:left!important;">
            
              <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
              <li class="breadcrumb-item active">إضافة مراكز تجارية</li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


<!-- Main content -->
<section class="content" dir='rtl' align='right'>
  <div class="container-fluid">
    <div class="row">




      <div class="card card-outline card-primary" dir='rtl' align='right'>
        <div class="card-header">

          <div class="card-tools" style="float: left;">
            <button type="button" class="btn btn-tool">
            </button>
          </div>
          <h3 class="card-title" style="float: right;">المراكز </h3>



        </div>
        <!-- /.card-header -->
        <div class="card-body">



          <form action="insert_data_admin.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

            <div class="row" style="width: 100%;">


              <div class="col-md-6">
                <h5>البيانات الرائيسية</h5>



                <div class="form-group">
                  <label for="com_name"> أسم المتجر</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                    <input type="text" class="form-control" name="com_name" id="com_name" required placeholder="الاسم" value="<?php if ($com_id > 0) {
                                                                                                                                echo $com_name;
                                                                                                                              } ?>">
                  </div>
                </div>
                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                <input style="display:none;" type="text" name="com_id" id="com_id" value="<?php if ($com_id > 0) {
                                                                                            echo $com_id;
                                                                                          } ?>">

                <div class="form-group">
                  <label for="com_phone">رقم الهاتف</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input dir='ltr' type="text" id="com_phone" name="com_phone" type="text" value="<?php if ($com_id > 0) {
                                                                                                      echo $com_phone;
                                                                                                    } ?>" class="form-control" data-inputmask='"mask": "999 999 999"' data-mask required>
                  </div>
                  <!-- /.input group -->
                </div>







                <div class="form-group">
                  <div class="input-group">
                    <label for="city">المدينة</label>

                    <select dir='ltr' class="form-control select2bs4"  style="width: 100%;" id="city" name="city">

                      <?php
                      if ($city != "") {
                        echo "<option  selected='selected' value='" . $city . "'>" . $city . "</option>";
                      } else {
                        echo "<option selected='selected' value=''>إختر المدينة</option>";
                      }
                      $query_user_permissions1 = "SELECT DISTINCT `city` FROM `company` WHERE `com_id`!='" . $com_id . "' AND city!='" . $city . "' ;" or die(mysqli_error($con));
                      $run_query_user_permissions2 = mysqli_query($con, $query_user_permissions1) or die(mysqli_error($con));
                      if (mysqli_num_rows($run_query_user_permissions2) > 0) {

                        while ($user_permissions3 = mysqli_fetch_array($run_query_user_permissions2)) {

                          echo "<option value='$user_permissions3[city]'>$user_permissions3[city]</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="picture">شعار المركز</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-image"></i></span>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="picture" name="picture" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                      <label class="custom-file-label" for="picture">إخترالصورة</label>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                  $(document).ready(function() {
                    bsCustomFileInput.init();

                  });
                </script>



              </div>


              <div class="col-md-6">
                <h5>العناوين</h5>


                <div class="form-group">
                  <label for="address"> العنوان</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <input type="text" class="form-control" name="address" id="address" placeholder="العنوان" value="<?php if ($com_id > 0) {
                                                                                                                        echo $address;
                                                                                                                      } ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label for="com_email"> Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" name="com_email" id="com_email" placeholder="Email" value="<?php if ($com_id > 0) {
                                                                                                                          echo $com_email;
                                                                                                                        } ?>" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="location"> الموقع</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-map-marker-alt mr-1"></i></span>
                    </div>
                    <input type="text" class="form-control" name="location" id="location" placeholder="الموقع" value="<?php if ($com_id > 0) {
                                                                                                                        echo $location;
                                                                                                                      } ?>">
                  </div>

                </div>

                <div class="form-group">
                  <label for="com_about_company">وصف المتجر</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <textarea class="form-control" rows="2" name="com_about_company" id="com_about_company" required placeholder="وصف المتجر"><?php if ($com_id > 0) {
                                                                                                                                                echo $about_company;
                                                                                                                                              } ?></textarea>


                  </div>
                </div>

              </div>

            </div>

            <div class="row" style="width: 100%;">

              <div class="col-md-6">
                <h5>بيانات التواصل</h5>

                <div class="form-group">
                  <label for="com_whatsapp"> وتس اب</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-whatsapp fa-lg"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_whatsapp" id="com_whatsapp" placeholder="وتس اب" value="<?php if ($com_id > 0) {
                                                                                                                                echo $whatsapp;
                                                                                                                              } ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label for="com_telegram"> تلجرام</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" for="com_telegram"><i class="fab fa-telegram-plane fa-lg" for="com_telegram"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_telegram" id="com_telegram" placeholder="تلجرام" value="<?php if ($com_id > 0) {
                                                                                                                                echo $telegram;
                                                                                                                              } ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="com_website_company"> رابط الموقع</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-link"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_website_company" id="com_website_company" required placeholder="رابط الموقع" value="<?php if ($com_id > 0) {
                                                                                                                                                            echo $website_company;
                                                                                                                                                          } ?>">
                  </div>

                </div>


                <div class="form-group">
                  <label for="com_messg_comm">رسالة التواصل</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-comments fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_messg_comm" id="com_messg_comm" placeholder="رسالة التواصل" value="<?php if ($com_id > 0) {
                                                                                                                                            echo $messg_comm;
                                                                                                                                          } ?>">
                  </div>

                </div>





              </div>


              <div class="col-md-6">
                <h5> التواصل الاجتماعي</h5>

                <div class="form-group">
                  <label for="com_instagram"> انستجرام</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-instagram fa-lg fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_instagram" id="com_instagram" placeholder="انستجرام" value="<?php if ($com_id > 0) {
                                                                                                                                    echo $instagram;
                                                                                                                                  } ?>">
                  </div>
                </div>


                <div class="form-group">
                  <label for="com_facebook">فيسبوك</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-facebook-f fa-lg fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_facebook" id="com_facebook" placeholder="فيسبوك" value="<?php if ($com_id > 0) {
                                                                                                                                echo $facebook;
                                                                                                                              } ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="com_twitter"> تويتر</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-twitter fa-lg fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_twitter" id="com_twitter" placeholder="تويتر" value="<?php if ($com_id > 0) {
                                                                                                                              echo $twitter;
                                                                                                                            } ?>">
                  </div>

                </div>


                <div class="form-group">
                  <label for="com_linkedin">لينكد ان</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-linkedin fa-lg fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="com_linkedin" id="com_linkedin" placeholder="لينكد ان" value="<?php if ($com_id > 0) {
                                                                                                                                  echo $linkedin;
                                                                                                                                } ?>">
                  </div>
                </div>


              </div>


              <?php if ($com_id > 0) { ?>
                <!-- this input for take user id and send in to page insert data for up data or delet and return user id for use chang data for new data for user -->

                <div class="form-group ">

                  <label for="com_status">حالة المركز</label>
                  <div class="input-group">
                    <input type="checkbox" class="form-control" id="com_status" name="com_status" value="<?php if ($com_id > 0) {
                                                                                                            echo $com_status;
                                                                                                          } ?>" <?php if ($com_id > 0) {
                                                        echo $com_status_ch;
                                                      } ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                  </div>

                </div>

                <script>
                  $(document).ready(function() {
                    //alert($('#com_status').val());
                    $('#com_status').on('switchChange.bootstrapSwitch', function(event,
                      state) {

                      if (state) {

                        $(this).val('1');

                      } else {
                        $(this).val('0');

                      }

                      // alert($('#com_status').val());
                    });
                  });
                </script>
              <?php } ?>




            </div>


            <!-- /.card-body -->
            
              <button class="btn btn-block btn-info" id="btn_add_or_change_company" type="submit" name="btn_add_or_change_company">حفظ
                <span data-feather="save"></span>
             





          </form>


        </div>
      </div>
    </div>
  </div>
</section>





<?php
include "footer.php";
?>