<?php

include "../db.php";




$product_id = 0;

?>
<div class="card" id="product_add" id="C" dir='rtl' align="right">







  <form action="insert_data.php" method="post" type="form" name="insert_product_or_updata" enctype="multipart/form-data" role="form" novalidate="novalidate">



    <div class="row card-body">

      <!-- div input imag the product -->
      <div class="col-md-12">

        <label for="images">يجب ان لايزيد عددالصور على 4 والحجم اقل من 5 ميجابايت:</label>
        <input type="file" id="images" name="images[]" accept="image/*" multiple required><br><br>

      </div>

      <input type="text" name="product_id" id='product_id' style='display: none;' value=" <?php if ($product_id > 0) {
                                                                                            echo $product_id;
                                                                                          } ?>"></input>


      <input type="text" name="com_id" id='com_id' style='display: none;' value=" <?php echo $com_id; ?>"></input>


      <!--div input details for product -->
      <div class="col-md-6">
        <div class="form-group">
          <label for="proname">اسم المنتج</label>
          <div class="input-group">

            <input type="text" name="proname" id="proname" class="form-control" placeholder="اسم المنتج" value=" <?php if ($product_id > 0) {
                                                                                                                    echo $product_id;
                                                                                                                  } ?>" required>
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>





        <div class="form-group">
          <label for="price_product">سعر المنتج</label>
          <div class="input-group">
            <input type="text" name="price_product" id="price_product" class="form-control" placeholder="2500" value=" <?php if ($product_id > 0) {
                                                                                                                          echo $product_id;
                                                                                                                        } ?>">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>

        <!-- div group for right the input -->
        <div class="form-group">
          <label for="pro_depart">الاقسام</label>

          <select name="pro_depart" id="pro_depart" class="form-control select2bs4"  style="width: 100%;" required >
            <option>أختر احد الاقسام</option>
            <?php

            $result = mysqli_query($con, "SELECT  * FROM department_com WHERE    com_id='" . $com_id . "' AND (depart_state_com=1 or depart_state_com=4) ") or die(mysqli_error($con));
            if (mysqli_num_rows($result) == 0) {
              echo "<option>لا يوجد أقسام</option>";
            }
            while ($r = mysqli_fetch_array($result)) {
            ?>

              <option value="<?php echo $r['id_depart_com'] ?>">


                <?php echo $r['name_depart_com'] ?>

              </option>
              <!-- cod for take the cate on select the department -->

            <?php
            }

            ?>
          </select>

        </div>

        <div class="form-group">
          <label for="opponent">السعر بعد الخصم</label>
          <div class="input-group">
            <input type="text" name="opponent" id="opponent" class="form-control" placeholder="السعر بعد الخصم" value=" <?php if ($product_id > 0) {
                                                                                                                          echo $product_id;
                                                                                                                        } ?>">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>
      </div>
      <!--div input details  for product tow -->
      <div class="col-md-6">



        <div class="form-group">
          <label for="pro_cat">الاصناف</label>

          <select id="pro_cat" required aria-label="اختر اي من الاصناف" name="pro_cat" class="form-control select2bs4"  style="width: 100%;">
            <option>إختر صنف</option>
          </select>

        </div>

        <div class="form-group">
          <label for="items">فئة المنتج</label>

          <select class="select2 select2-hidden-accessible" multiple name="items[]" id="items" data-dropdown-css-class="select2-purple" style="width: 100%;" aria-hidden="true" require>
            <option>لايوجد فئات</option>
          </select>

        </div>

        <div class="form-group">
          <label for="pro_desc">وصف المنتج</label>
          <div class="input-group">
            <input type="text" name="pro_desc" id="pro_desc" class="form-control" require placeholder="وصف المنتج" value=" <?php if ($product_id > 0) {
                                                                                                                              echo $product_id;
                                                                                                                            } ?>">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="form_size">الاحجام</label>

          <select class="form-control select2bs4"  style="width: 100%;" id="form_size" name="form_size" aria-label="اختر اي من الاحجام">
            <option>إختر الحجم</option>
          </select>

        </div>


        <div class="form-group">
          <label for="pro_barcode">رقم الباركود</label>
          <div class="input-group">
            <input type="text" name="pro_barcode" id="pro_barcode" class="form-control" placeholder="باركود" value=" <?php if ($product_id > 0) {
                                                                                                                        echo $product_id;
                                                                                                                      } ?>">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>


      </div>
      <div class="col-sm-12">
        <ul class="col-sm-12 " id='sizeFields'>
          <!-- Size options fetched from the "for_size" table -->

          <?php

          if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
          }

          // Fetch size options from the "for_size" table
          $sql = "SELECT * FROM `form_size`  WHERE `form_state`=1;";
          $result = $con->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $sizeId = $row['id_form'];
              $sizeName = $row['size'];
              $details = $row['details'];

          ?>
              <li style="direction: ltr;">

                <span> <?php echo $sizeName; ?></span>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <input type="checkbox" name="<?php echo $sizeId; ?>">
                    </span>
                  </div>
                  <textarea class="form-control" name="<?php echo $sizeId; ?>"><?php echo $details; ?></textarea>
                </div>
                <!-- /input-group -->




              </li>
          <?php
            }
          }

          ?>
        </ul>
        <div class="card-footer clearfix">
          <button type="button" class="btn btn-warning btn-sm" onclick="addSizeField()"><i class="fas fa-plus"></i> إضافة حجم</button>

        </div>

      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="notice">الملاحضات</label>
          <div class="input-group">
            <input type="text" name="notice" id="notice" class="form-control" placeholder="الملاحظات" value=" <?php if ($product_id > 0) {
                                                                                                                echo $product_id;
                                                                                                              } ?>">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-text">@</i></span>
            </div>
          </div>
        </div>
      </div>




    </div>

    <div class="card-footer">
      <button type="submit" id="insert_product_or_updata" name="insert_product_or_updata" required class="btn btn-info float-lift">إضافة
        المنتج</button>
      <button type="submit" id="btn_edit" name="btn_edit" required class="btn btn-info float-lift">تعديل</button>

    </div>

  </form>

</div>


<script>
  $(document).ready(function() {
    $('input[type="file"]').change(function(e) {
      var files = e.target.files;
      $('#preview').empty();

      if (files.length > 4) {
        alert("يرجاء تحديد 4 صور فقط");
        return;
      }

      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if (file.size > 5 * 1024 * 1024) {
          alert("يرجاء التاكد ان الحجم اقل من5 ميجا");
          return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
          var img = document.createElement("img");
          img.src = e.target.result;
          img.style.width = "100px";
          img.style.height = "100px";
          $('#preview').append(img);
        }
        reader.readAsDataURL(file);
      }
    });
  });






  function addSizeField() {
    var sizeFields = document.getElementById("sizeFields");
    var li = document.createElement("li");
    var input = document.createElement("input");
    input.type = "checkbox";
    input.name = "sizes[]";
    li.appendChild(input);

    //sizeFields.appendChild(document.createElement("li"));

    var inputName = document.createElement("input");
    inputName.type = "text";
    inputName.name = "sizeNames[]";
    inputName.placeholder = "اسم الحجم";
    li.appendChild(inputName);
    // sizeFields.appendChild(inputName);
    // li.appendChild(document.addSizeField("&nspar"));

    var inputDetails = document.createElement("input");
    inputDetails.type = "text";
    inputDetails.name = "sizeDetails[]";
    inputDetails.placeholder = "وصف الحجم";
    li.appendChild(inputDetails);
    // sizeFields.appendChild(inputDetails);
    //sizeFields.appendChild(document.createElement("br"));
    sizeFields.appendChild(li);
  }
</script>