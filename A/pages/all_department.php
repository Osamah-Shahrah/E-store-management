<?php
include "header.php";




$comid = $_SESSION['comid'];

static $id_depart_com = 0;


if (isset($_GET['id_depart_com'])) {


  $id_depart_com = $_GET['id_depart_com'];

  static $name_depart_com;
  static $about_depart_com;
  static $icon_depart_com;
  static $depart_state_com;

  $sql_quer_department = "SELECT * FROM `department_com` WHERE `id_depart_com`=" . $id_depart_com . ";";



  $execution_query_department = mysqli_query($con, $sql_quer_department) or die(mysqli_error($con));
  if (mysqli_num_rows($execution_query_department) > 0) {
    while ($array_department = mysqli_fetch_array($execution_query_department)) {


      $id_depart_com = $array_department['id_depart_com'];
      $name_depart_com = $array_department['name_depart_com'];
      $about_depart_com = $array_department['about_depart_com'];
      $icon_depart_com = $array_department['icon_depart_com'];
      $depart_state_com = $array_department['depart_state_com'];
      if ($array_department['depart_state_com'] == 1) {
        $depart_state_com_sc = "checked";
      } else {
        $depart_state_com_sc = "check";
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
        <h1 style="float: right;">إدارة الاقسام</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right" style="float:left!important;">

          <li class="breadcrumb-item"><a href="home.php">الرائيسية</a></li>
          <li class="breadcrumb-item active">إدارة الاقسام</li>

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
            <h3 class="card-title" style="float: right;"> إضافة اقسام الى المتجر</h3>
          </div>
          <?php
          ?>
          <!-- /.card-header -->
          <div class="card-body">


            <table id="public_department_com_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>اسم القسم</th>
                  <th>وصف القسم</th>
                  <th>حالة القسم</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count_row = 0;
                $sql = mysqli_query($con, "SELECT * FROM department where department.depart_state<=2 AND department.deprat_id not in(SELECT department_com.deprat_id from department_com WHERE department_com.com_id='" . $comid . "')");

                if (mysqli_num_rows($sql) == 0) {
                  echo "<h6 class='text-center'>لا يوجد أقسام</h6>";
                } else {
                  while ($r = mysqli_fetch_array($sql)) {

                ?>

                    <tr>
                      <td><?php echo $count_row += 1; ?></td>
                      <td>
                        <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_depart/<?php echo $r['icon_depart']; ?>" alt="<?php echo $r['name_depart']; ?>">



                        <?php echo $r['name_depart'] ?>

                      </td>
                      <td><?php echo $r['about_depart'] ?>
                      </td>

                      </td>
                      <td>            <?php
              if ($r['depart_state'] > 1) {
                echo "<span class='float-right badge bg-danger'>موقف بالكامل من ادارة الموقع</span>";
                
            } else {
              echo "<span class='float-right badge bg-success'>فعال</span>";
            }
            ?>
                      </td>




                      <td>

                        <p class='h5'><a href='insert_data.php?add_depart_for_com&deprat_id=<?php echo $r['deprat_id'] ?>'><span class='badge bg-success'>إضافة</span></a></span>
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
            <?php if ($id_depart_com > 0) {
            ?>
              <h5> تعديل بيانات القسم</h5>
            <?php } else {
            ?>
              <h5> إضافة قسم</h5>

            <?php
            }
            ?>
          </div>
          <div class="card-body">
            <form action="insert_data.php" id="" class="text-start g-3 needs-validation row" method="POST" type="form" name="" enctype="multipart/form-data">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="name_depart_com"> أسم القسم</label>
                  <div class="input-group">

                    <input type="text" class="form-control" name="name_depart_com" id="name_depart_com" required placeholder="اسم القسم" value="<?php if ($id_depart_com > 0) {
                                                                                                                                                  echo $name_depart_com;
                                                                                                                                                } ?>">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text">@</i></span>
                    </div>

                  </div>
                </div>
                <!-- input disble for send id_company if this oprition ubdate or null that is new company to insert  -->
                <input style="display:none;" type="text" name="id_depart_com" id="id_depart_com" value="<?php if ($id_depart_com > 0) {
                                                                                                          echo $id_depart_com;
                                                                                                        } ?>">

                <input style="display:none;" type="text" name="com_id_depart_com" id="com_id_depart_com" value=" <?php echo $comid; ?>"></input>
                <div class="form-group">
                  <label for="imgpro"> صورة القسم</label>
                  <div class="input-group">
                    <input type="file" name="picture" id="imgpro" accept=".png, .jpg,.gif,.jpeg,jpe,.ico">
                    <img id="proimg" src="<?php if ($id_depart_com > 0) {
                                            echo "../../img/imag_depart/$icon_depart_com";
                                          } ?>" width='100px' height='100px' class='img-fluid rounded' <?php if ($id_depart_com == 0) {
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
                  <label for="about_depart_com">وصف القسم</label>
                  <div class="input-group">
                    <textarea name="about_depart_com" id="about_depart_com" class="form-control m-1" rows="3" tabindex="4" placeholder="وصف القسم" style="height: 80px;"><?php if ($id_depart_com > 0) {
                                                                                                                                                                            echo $about_depart_com;
                                                                                                                                                                          } ?></textarea>

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-monay">&</i></span>
                    </div>
                  </div>
                </div>

                <?php if ($id_depart_com > 0) {
                ?>
                  <button class="btn btn-block btn-warning" id="add_department_or_updata_com" type="submit" name="add_department_or_updata_com">تعديل
                    <span data-feather="save"></span>
                  <?php } else {
                  ?>
                    <button class="btn btn-block btn-info" id="add_department_or_updata_com" type="submit" name="add_department_or_updata_com">إضافة
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
            <h5> الاقسام</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-sm-12 table-responsive p-0">

              <table id="department_com_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>اسم القسم</th>
                    <th>وصف القسم</th>
                    <th>حالة القسم</th>
                    <th>الوصول للقسم</th>
                    <th>#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count_row = 0;
                  $sql = "SELECT * FROM `department_com` WHERE `com_id`= " . $comid . "  ;";
                  $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                  while ($r = mysqli_fetch_array($result)) {
                  ?>

                    <tr>
                      <td><?php echo $count_row += 1; ?></td>
                      <td>
                        <img width='50px' height='50px' class='img-fluid rounded' src="../../img/imag_depart/<?php echo $r['icon_depart_com']; ?>" alt="<?php echo $r['name_depart_com']; ?>">



                        <?php echo $r['name_depart_com'] ?>

                        <input style="display:none;" type="text" name="id_depart_com" id='id_depart_com' value=" <?php echo $r['id_depart_com']; ?>"></input>

                      </td>
                      <td><?php echo $r['about_depart_com'] ?>
                      </td>


                      <td>
                        <?php

                        if ($r['depart_state_com'] == 5) {

                          $depart_state_com_sc = "check";
                        } else {
                          $depart_state_com_sc = "checked";
                        }
                        if ($r['depart_state_com'] == 3) {

                          $depart_state_com_sc = "check";
                          echo "<span class='float-right badge bg-warning'>موقف من قبل ادارة الموقع</span>";
                        } else { ?>
                          <div class="input-group">
                            <input type="checkbox" class="form-control" id="depart_state_com1" name="depart_state_com1" value="<?php echo $r['depart_state_com']; ?>" <?php echo $depart_state_com_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                          </div>
                        <?php
                        }
                        ?>

                      </td>
                      <td>
                        <?php
                        if ($r['depart_state_com'] == 1) {
                          $depart_state_com_sc = "checked";
                        } else {
                          $depart_state_com_sc = "check";
                        }
                        if ($r['depart_state_com'] == 2) {

                          $depart_state_com_sc = "check";
                          echo "<span class='float-right badge bg-info'>موقف من قبل ادارة الموقع</span>";
                        } else { ?>
                          <div class="input-group">
                            <input type="checkbox" class="form-control" id="depart_state_com2" name="depart_state_com2" value="<?php echo $r['depart_state_com']; ?>" <?php echo $depart_state_com_sc; ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" />
                          </div>
                        <?php
                        }
                        ?>

                      </td>
                      <td>

                        <a title="تعديل البيانات" class="btn btn-info btn-sm " href="all_department.php?id_depart_com=<?php echo $r['id_depart_com'] ?> " role=" button"> <i class="fas fa-edit"></i></a>
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