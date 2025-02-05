<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../index2.html"><b>Admin</b>LTE</a>
  </div>
  <?php if(isset($_SESSION['admin_phon'])!=""){  ?>
  <!-- User name -->
  <div class="lockscreen-name"><?php echo $_SESSION['admin_name']; ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      
    </div>
    <?php }
    else{
      echo"  <!-- User name -->
  <div class='lockscreen-name'>John Doe</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class='lockscreen-item'>
    <!-- lockscreen image -->
    <div class='lockscreen-image'>
      <img src='../dist/img/user1-128x128.jpg' alt='User Image'>
    </div>";
    }
    
    
    ?>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="../index.php">
    <div class="input-group">
       <input type="email" name="user_n_or_phon" id="user_n_or_phon" readonly value="<?php echo$_SESSION['admin_name'] ?>">
       <div class="input-group-append">
       </div>
      </div>
    <div class="input-group">

        <input type="password" class="form-control" placeholder="password" name="password" id="password">

        <div class="input-group-append">
          <button type="button" class="btn" name="login" id="login"><i class="fas fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    ادخل كلمة المرور لاستعادة الجلسة السابقة
  </div>
  <div class="text-center">
    <a href="../index.php?chang_user=1">او استخدام حساب اخر</a>
  </div>

</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
