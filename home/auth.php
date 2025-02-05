<?php 
if(isset($_SESSION['email'])&&isset($_SESSION['user_id'])&&isset($_SESSION['user_name'])){
  unset($_SESSION['login']); 
  $_SESSION['login']='login';
  static $user_id;
  $user_id= $_SESSION['user_id'];
  }
  else{
    $_SESSION['login']=null; 
   
  }

?>