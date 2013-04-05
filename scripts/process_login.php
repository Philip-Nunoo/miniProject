<?php
include '../bin/db_connect.php';
include '../bin/functions.php';

sec_session_start(); // Our custom secure way of starting a php session. 
$email = $_POST['email'];
$password = $_POST['password']; // The hashed password.
$redirect = NULL;
if($_POST['location'] != '') {
    $redirect = $_POST['location'];
}

if(isset($email, $password) && $email!="" && $password!="") { 
   if(login($email, $password, $conn) == true) {
       if($redirect) {
           header("Location:".$redirect);
       }
      // Login succes
      exit();
      #header("Location: http://localhost/miniproject/modules/redirect.php");
   } else {
      // Login failed
       $url = "http://localhost/miniproject/index.php?error=1";
       if (isset($redirect)){
           $url .= '&location='.urlencode($redirect);
       }
      header('Location:' . $url);
      exit();
   }
} else { 
   // The correct POST variables were not sent to this page.
    $url = "http://localhost/miniproject/index.php?error=2";
    if (isset($redirect)){
        $url .= '&location=' .urlencode($redirect);
    }
   header('Location:' . $url);
   exit();
}


?>
