<?php
   include_once 'database.php';
   session_start();
   
   $database = new Database();
   $db = $database->getConnection();
   //checking user for sessions
   $user_check = $_SESSION['login_user'];
   //echo $user_check;// to check the google_id of user
   
   //checking in database username
   $ses_sql = mysqli_query($db,"SELECT google_id from profile where google_id = '$user_check' ");
   
   while($row = mysqli_fetch_assoc($ses_sql))
   {
      $session_usr=$row['google_id'];
      //echo $session; to check the username
   }


   if(!isset($_SESSION['login_user'])|| $login_session=='')
   {
      header("Location:index.php");
   }


   if(!isset($_SESSION['login_user'])||$_SESSION['login_user']=='')
   {
      //update later
   }
?>
