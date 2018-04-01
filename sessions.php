<?php
   include_once 'database.php';
   session_start();
   
   $database = new Database();
   $db = $database->getConnection();
   //checking user for sessions
   $user_check = $_SESSION['login_user'];
   //echo "echoed from sessions.php<br>";
   //echo $user_check;// to check the google_id of user
   
   //checking in database username
   //THIS NEEDS TO BE UPDATED
   //WILL BE DONE USING API
   //$ses_sql = mysqli_query($db,"SELECT google_id from profile where google_id = '$user_check'");
   /*
   while($row = mysqli_fetch_assoc($ses_sql))
   {
      $session_usr=$row['google_id'];
      //echo $session; //to check the username
   }
   */
   
   $post = [
    'live_token'   => $read_live_token,
    'req_type' => $read_req_type,
    'google_id' => $user_check,
];
$ch = curl_init("http://localhost/api/users/check_session.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// execute!

$response = curl_exec($ch);
// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
$records = json_decode($response);
$tmp = $records->{'message'};   
   //Temporary solution, can backfire under certain conditions
   //$session_usr = $user_check;
	
   if($tmp)	{
   		$session_usr = $user_check;
   }
   else	{
   	 header("Location:index.php");
   	 }
?>
