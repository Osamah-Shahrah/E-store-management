<?php
session_start();
unset($_SESSION['user_id']);
//unset($_SESSION['logged_in']);

  //session_unset();
  //session_destroy();

header('Location:home.php');
exit;
?>