<?php
include "header.php";




$comid = $_SESSION['comid'];

static $id_delivery = 0;


if (isset($_GET['id_delivery'])) {


  $id_delivery = $_GET['id_delivery'];

  static $delivery_name;
  static $delivery_phone;
  static $delivery_icon;
  static $delivery_statue;
  static $delivery_address;
  static $delivery_email;
  static $delivery_fk_com;
  static $delivery_type;
  static $delivery_details;
  static $fk_id_delivery_form;
  
  $sql_quer_delivery = "SELECT * FROM `delivery_com` WHERE `id_delivery`=" . $id_delivery . ";";



  $execution_query_delivery = mysqli_query($con, $sql_quer_delivery) or die(mysqli_error($con));
  if (mysqli_num_rows($execution_query_delivery) > 0) {
    while ($array_delivery = mysqli_fetch_array($execution_query_delivery)) {


      $id_delivery = $array_delivery['id_delivery'];
      $delivery_name = $array_delivery['delivery_name'];
      $delivery_phone = $array_delivery['delivery_phone'];
      $delivery_icon = $array_delivery['delivery_icon'];
      $delivery_statue = $array_delivery['delivery_statue'];
      $delivery_address = $array_delivery['delivery_address'];
      $delivery_email = $array_delivery['delivery_email'];
      $delivery_fk_com = $array_delivery['delivery_fk_com'];
      $delivery_type = $array_delivery['delivery_type'];
      $delivery_details = $array_delivery['delivery_details'];
      $fk_id_delivery_form = $array_delivery['fk_id_delivery_form'];
      if ($array_delivery['delivery_statue'] == 1) {
        $delivery_statue_sc = "checked";
      } else {
        $delivery_statue_sc = "check";
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
        <h1 style="float: right;"> شركات التوصيل</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="float:left!important;">

          <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
          <li class="breadcrumb-item active"> شركات التوصيل</li>

        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>






<section class="content" dir='rtl' align="right">
  <div class="container-fluid" dir='rtl'>
    <div class="row" dir="rtl">
      <!-- hear write the code -->

      <div class="col-12">

        <!-- div for departement add for your center  -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="float: right;"> إضافة شركات توصيل الى المتجر</h3>
          </div>
          <?php
          ?>
          <!-- /.card-header -->
          <div class="card-body">


            <table id="public_delivery_com_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>البيانات</th>
                    <th>العنوان</th>
                    <th>رقم الهاتف</th>
                    <th>Email</th>
                    <th>النوع</th>
                  <th>الوصف </th>
                  <th>الحالة </th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php


                $count_row = 0;
                $sql = mysqli_query($con, "SELECT * FROM delivery_form where delivery_form.delivery_statue_form<=2 AND delivery_form.id_delivery_form not in
                (SELECT delivery_com.fk_id_delivery_form from delivery_com WHERE delivery_com.delivery_fk_com='" . $comid . "')");

                if (mysqli_num_rows($sql) == 0) {
                  echo "<h6 class='text-center'>لا يوجد شركات</h6>";
                } else {
                  while ($r = mysqli_fetch_array($sql)) {

                ?>

                    <tr>
                      <td><?php echo $count_row += 1; ?></td>
                      <td>
                        <img width='50px' height='50px' class='img-fluid rounded' src="../../img/delivery_com/<?php echo $r['delivery_icon_form']; ?>" alt="<?php echo $r['delivery_name_form']; ?>">



                        <?php echo $r['delivery_name_form'] ?>

                      </td>
                      <td><?php echo $r['delivery_address_form'] ?>
                      </td>
                      <td><?php echo $r['delivery_phone_form'] ?>
                      </td>

                      <td><?php echo $r['delivery_email_form'] ?>
                      </td>


                      <td><?php echo $r['delivery_type_form'] ?>
                      </td>



                      <td><?php echo $r['delivery_details_form'] ?>
                      </td>

                      </td>
                      <td>            <?php
              if ($r['delivery_statue_form'] > 1) {
                echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة الموقع</span>";
                
            } else {
              echo "<span class='float-right badge bg-success'>فعال</span>";
            }
            ?>
                      </td>




                      <td>

                        <p class='h5'><a href='insert_data.php?add_Delivery_comapny_for_com&Delivery_company_form_id=<?php echo $r['id_delivery_form'] ?>'><span class='badge bg-success'>إضافة</span></a></span>
                      </td>


                    </tr>
                <?php

                  }
                }
                ?>

              </tbody>

            </table>


          </div>

        </div>

        <div class="card card-success">
          <div class="card-header">
            <?php if ($id_delivery > 0) {
            ?>
              <h5> تعديل  مزود التوصيل</h5>
            <?php } else {
            ?>
              <h5> إضافة مزود التوصيل</h5>

            <?php
            }
            ?>
          </div>
          <div class="card-body">
            <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="delivery_name"> الاسم</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="delivery_name" id="delivery_name" required placeholder="اسم شركة التوصيل" value="<?php if ($id_delivery > 0) {
                                                                                                                                                  echo $delivery_name;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>


                <div class="form-group">
                  <label for="delivery_phone">رقم الهاتف</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="delivery_phone" id="delivery_phone" required placeholder="+967_________"  value="<?php if ($id_delivery > 0) {
                                                                                                                                                  echo $delivery_phone;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>


                <div class="form-group">
                  <label for="delivery_address"> العنوان</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="delivery_address" id="delivery_address" required placeholder="المدينه-الشارع-الحي" value="<?php if ($id_delivery > 0) {
                                                                                                                                                  echo $delivery_address;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>


                <div class="form-group">
                  <label for="delivery_email"> Email</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="delivery_email" id="delivery_email" required placeholder="examp@gmail.com" value="<?php if ($id_delivery > 0) {
                                                                                                                                                  echo $delivery_email;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>


                <div class="form-group">
                  <label for="delivery_type"> نوع شركة التوصيل</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="delivery_type" id="delivery_type" required placeholder="شركه -شخص" value="<?php if ($id_delivery > 0) {
                                                                                                                                                  echo $delivery_type;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>





                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                <input style="display:none;" type="text" name="id_delivery" id="id_delivery" value="<?php if ($id_delivery > 0) {
                                                                                                          echo $id_delivery;
                                                                                                        } ?>">

                <input style="display:none;" type="text" name="com_id_delivery" id="com_id_delivery" value=" <?php echo $comid; ?>"></input>
                <div class="form-group">
                  <label for="imgpro"> الصورة</label>
                  <div class="input-group">
                    <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                    <img id="proimg" src="<?php if ($id_delivery > 0) {
                                            echo "../../img/delivery_com/$delivery_icon";
                                          } ?>" width='100px' height='100px' class='img-fluid rounded' <?php if ($id_delivery == 0) {
                                                                                                          echo "style='display: none;'";
                                                                                                        } ?>>

                    <script>
                      function openfile() {
                        document.getElementById('imgpro').click();
                      }
                      $(document).ready(function() {
                        var proimg = $("#proimg");

                        $("#imgpro").change(function(e) {
                          var tmppath = URL.createObjectURL(e.target.files[0]);

                          proimg.fadeIn("fast").attr('src', tmppath)

                        })
                      })
                    </script>

                  </div>
                </div>

                <div class="form-group">
                  <label for="delivery_details">الوصف</label>
                  <div class="input-group">
                    <textarea name="delivery_details" id="delivery_details" class="form-control m-1" rows="3" tabindex="4"  style="height: 80px;"><?php if ($id_delivery > 0) {
                                                                                                                                                                            echo $delivery_details;
                                                                                                                                                                          } ?></textarea>

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                    </div>
                  </div>
                </div>

                <?php if ($id_delivery > 0) {
                ?>
                  <button class="btn btn-block btn-warning" id="add_delivery_or_updata_com" type="submit" name="add_delivery_or_updata_com">تعديل
                    <span data-feather="save"></span>
                  <?php } else {
                  ?>
                    <button class="btn btn-block btn-info" id="add_delivery_or_updata_com" type="submit" name="add_delivery_or_updata_com">إضافة
                      <span data-feather="save"></span>

                    <?php
                  }
                    ?>
              </div>

            </form>
          </div>
        </div>




        <div class="card card-secondary">

          <div class="card-header">
            <h5> شركات او عملاء التوصيل</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-sm-12 table-responsive p-0">

              <table id="delivery_com_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>البيانات</th>
                    <th>العنوان</th>
                    <th>رقم الهاتف</th>
                    <th>Email</th>
                    <th>النوع</th>
                    <th>الحالة </th>
                    <th>الوصول </th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count_row = 0;
                  $sql = "SELECT * FROM `delivery_com` WHERE `delivery_fk_com`= " . $comid . "  ;";
                  $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                  while ($r = mysqli_fetch_array($result)) {
                  ?>

                    <tr>
                      <td><?php echo $count_row += 1; ?></td>
                      <td>
                        <img width='50px' height='50px' class='img-fluid rounded' src="../../img/delivery_com/<?php echo $r['delivery_icon']; ?>" alt="<?php echo $r['delivery_name']; ?>">



                        <?php echo $r['delivery_name'] ?>

                        <input style="display:none;" type="text" name="id_delivery" id='id_delivery' value=" <?php echo $r['id_delivery']; ?>"></input>

                      </td>
                      <td><?php echo $r['delivery_address'] ?>
                      </td>


                      <td><?php echo $r['delivery_phone'] ?>
                      </td>
                      <td><?php echo $r['delivery_email'] ?>
                      </td>
                      <td><?php echo $r['delivery_type'] ?>
                      </td>

                      <td>
                        <?php

                        if ($r['delivery_statue'] == 5) {

                          $delivery_statue_sc = "check";
                        } else {
                          $delivery_statue_sc = "checked";
                        }
                        if ($r['delivery_statue'] == 3) {

                          $delivery_statue_sc = "check";
                          echo "<span class='float-right badge bg-warning'>موقف من قبل ادارة الموقع</span>";
                        } else { ?>
                          <div class="input-group">
                            <input type="checkbox" class="form-control" id="delivery_statue1" name="delivery_statue1" value="<?php echo $r['delivery_statue']; ?>" <?php echo $delivery_statue_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                          </div>
                        <?php
                        }
                        ?>

                      </td>
                      <td>
                        <?php
                        if ($r['delivery_statue'] == 1) {
                          $delivery_statue_sc = "checked";
                        } else {
                          $delivery_statue_sc = "check";
                        }
                        if ($r['delivery_statue'] == 2) {

                          $delivery_statue_sc = "check";
                          echo "<span class='float-right badge bg-info'>موقف من قبل ادارة الموقع</span>";
                        } else { ?>
                          <div class="input-group">
                            <input type="checkbox" class="form-control" id="delivery_statue2" name="delivery_statue2" value="<?php echo $r['delivery_statue']; ?>" <?php echo $delivery_statue_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                          </div>
                        <?php
                        }
                        ?>

                      </td>
                      <td>

                        <a title="تعديل البيانات" class="btn btn-info btn-sm " href="delivery_com.php?id_delivery=<?php echo $r['id_delivery'] ?> " role=" button"> <i class="fas fa-edit"></i></a>
                      </td>


                    </tr>
                  <?php

                  }

                  ?>

                </tbody>

              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


<?php
include "footer.php";
?>