<?php
session_start();
session_destroy();
if(isset($_SESSION['phone_number'])&&isset($_SESSION['user_id'])&&isset($_SESSION['user_name'])){
    unset($_SESSION['login']); 
    $_SESSION['login']='login';
    static $user_id;
    $user_id= $_SESSION['user_id'];
    }
    else{
      header('location:index.php');
      unset($_SESSION['login']); 
    }
    
?>
<script>
    window.location(location.reload())
</script>




