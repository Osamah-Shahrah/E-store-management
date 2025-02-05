<?php 


if  ($_SESSION['logged_in_admin']) {
if(!isset($_SESSION['admin_id']) && isset($_SESSION['admin_name'])!="")
{
  
  header('Location:lockscreen.php');
  exit;
}

  }
  else
  {
    // User is already logged in, redirect to dashboard
    header('location:../index.php');
    exit;
  }





// Set the inactivity timeout in seconds (e.g., 5 minutes)
$inactivity_timeout = 800;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_timeout)) {
  // User has been inactive for too long, log them out
  //session_unset();
  //session_destroy();
  unset($_SESSION['admin_id']);
//unset($_SESSION['logged_in']);
  header('Location:lockscreen.php');
   //header('Location:home.php');
  exit;
}



?>