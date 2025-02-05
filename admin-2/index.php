<?php
session_start();
include 'db.php';



if (isset($_SESSION['logged_in_admin'])) {
  if (isset($_SESSION['admin_id']) && isset($_SESSION['admin_name']) != "") {

      header('location:pages/home.php');
      exit;
  }

  
} 




if (isset($_GET['chang_user'])) {
  session_unset();
  session_destroy();

  //unset($_SESSION['logged_in']);
}



static $id_check_user;
?>

<?php


// Maximum number of login attempts
$max_attempts = 3;
// Lockout period in seconds (e.g., 5 minutes)
$lockout_period = 5;

if (isset($_POST['login'])) {
  // Check if the user is currently locked out
  if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
    $lockout_message = 'لقد تجاوزت الحد المسموح . حاول بعد قليل';
  } else {

    // Check username and password
    $user_n_or_phon = $_POST['user_n_or_phon'];
    $pass = md5($_POST['password']);



    $sql_user = mysqli_query($con, "SELECT * FROM `admin_info` WHERE `admin_password`='" . $pass . "' AND (`admin_phon`='" . $user_n_or_phon . "'  OR `admin_email`='" . $user_n_or_phon . "') AND `admin_state`!=0;") or die(mysqli_error($con));

    if (mysqli_num_rows($sql_user) > 0) {

      $query_user = mysqli_fetch_array($sql_user);

      $_SESSION['admin_id'] = $query_user['admin_id'];
      $_SESSION['admin_name'] = $query_user['admin_name'];
      $_SESSION['admin_phon'] = $query_user['admin_phon'];
      $_SESSION['admin_email'] = $query_user['admin_email'];

      $id_check_user = 1;



      if ($id_check_user == 1) {
        $_SESSION['logged_in_admin'] = true;

        // Reset the login attempts and lockout time on successful login
        unset($_SESSION['login_attempts']);
        unset($_SESSION['lockout_time']);

        //if user his user_type same 1 he is staff for company we get data company and open layout company  
        header("location:pages/home.php");
        exit;
      }
    } else {
      $lockout_message = 'هاذا الحساب غير موجود';
      // Increment the login attempts counter on failed login
      if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
      } else {
        $_SESSION['login_attempts']++;
      }
      // Check if the user has exceeded the maximum number of login attempts
      if ($_SESSION['login_attempts'] >= $max_attempts) {
        // Set the lockout time
        $_SESSION['lockout_time'] = time() + $lockout_period;
        $lockout_message = 'لقد تجاوزت الحد المسموح . حاول بعد قليل.';
      } else {
        $lockout_message = 'اسم المستخدم او كلمة المرور خطاء';
      }
    }
  }
}

if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
  // User is currently locked out, display the remaining lockout time
  $remaining_lockout_time = $_SESSION['lockout_time'] - time();
  $minutes = floor($remaining_lockout_time / 300);
  $seconds = $remaining_lockout_time % 300;
  $lockout_message = 'لقد تجاوزت الحد المسموح . حاول بعد  ' . $minutes . ' دقائق و  ' . $seconds . ' ثواني.';
}

if (isset($_SESSION['logged_in_admin'])) {
  // User is already logged in, redirect to dashboard
  header('Location:pages/home.php');
  exit;
}
?>


<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>لوحة التحكم</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="../Design/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">






    <!-- DataTables -->
    <link rel="stylesheet" href="../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">







    <!-- Font Awesome -->
    <link rel="stylesheet" href="../Design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../Design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->



    <!-- daterange picker -->
    <link rel="stylesheet" href="../Design/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../Design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../Design/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../Design/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../Design/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">










    <!-- css for message -->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../Design/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../Design/plugins/toastr/toastr.min.css">



    <!-- mystyle for them my website -->
    <link rel="stylesheet" href="mystyle.css">


    <!-- Select2 important for select  -->
    <link rel="stylesheet" href="../Design/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../Design/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <script src="../Design/pages/assets/js/jquery-3.6.0.min.js"></script>
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href=""><b>تسجيل</b> الدخول</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">تسجيل الدخول</p>

        <form method="POST">






          <div class="input-group mb-3">
            <input type="user_n_or_phon" name="user_n_or_phon" class="form-control" id="floatingInput" placeholder="name@example.com">

            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>



          <div class="input-group mb-3">

            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="icheck-primary">

            <input type="checkbox" value="remember-me" id="remember">
            <label for="remember"> تذكر
            </label>
          </div>
          <?php if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) { ?>
            <button class="btn btn-block btn-primary" type="submit" name="login" disabled>الدخول</button>
          <?php } else { ?>
            <button class="btn btn-block btn-primary" type="submit" name="login">الدخول</button>
          <?php } ?>



          <?php if (isset($lockout_message)) { ?>
            <p>
              <?php echo $lockout_message; ?>
            </p>
          <?php } ?>
          <div class="social-auth-links text-center mb-3">
            <p>- او -</p>
          </div>

          <p class="mb-1">
            <a href="pages/forgot-password.php">نسيت كلمة المرور</a>
          </p>
          <p class="mb-0">
            <a href="pages/register.php" class="text-center">تسجيل حساب جديد</a>
          </p>
        </form>
      </div>
    </div>
  </div>

  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>