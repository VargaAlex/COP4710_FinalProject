<?php
   include('config.php');
   include('header.php');
   
   session_start();
   
   $user_check = $_SESSION['u_id'];
   
   $ses_sql = mysqli_query($db,"select u_id from users where u_id = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $u_id = $row['u_id'];
   
   if(!isset($_SESSION['u_id'])){
      header("location:index.php");
      die();
   }
?>
