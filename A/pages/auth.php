<?php 


if  ($_SESSION['logged_in']) {
if(!isset($_SESSION['user_id']) && isset($_SESSION['username'])!="")
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
$inactivity_timeout = 8000;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_timeout)) {
  // User has been inactive for too long, log them out
  //session_unset();
  //session_destroy();
  unset($_SESSION['user_id']);
//unset($_SESSION['logged_in']);
  header('Location:lockscreen.php');
   //header('Location:home.php');
  exit;
}



?>