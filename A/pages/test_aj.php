<?php
include "../db.php";

// تحقق من صحة الاتصال بقاعدة البيانات
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// استخراج الرقم المدخل من قبل المستخدم
$studentu = mysqli_real_escape_string($con, $_POST['student_id']);

// استخدام prepared statements لتجنب هجمات SQL injection
$stmt = mysqli_prepare($con, "SELECT `product_title`,`price` FROM `product` WHERE `product_id` = ?");
mysqli_stmt_bind_param($stmt, "i", $studentu);
mysqli_stmt_execute($stmt);
$sel_pro_pric = mysqli_stmt_get_result($stmt);

// تحقق من وجود بيانات المنتج وإرجاعها في صيغة JSON
if (mysqli_num_rows($sel_pro_pric) > 0) {
  $sel_pri = mysqli_fetch_array($sel_pro_pric);
  $data = array(
    "name" => $sel_pri['product_title'],
    "phone" => $sel_pri['price']
  );
  echo json_encode($data);


  // إغلاق الاتصال بقاعدة البيانات
mysqli_stmt_close($stmt);
mysqli_close($con);

} else {
  echo "product not found";

  // إغلاق الاتصال بقاعدة البيانات
mysqli_stmt_close($stmt);
mysqli_close($con);
}




























?>