<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="307712715810-5gqv439ef8l9hmmod3ggpbdplcc7t7gq.apps.googleusercontent.com">
    <meta name="description" content="Paradox - Team .EXE is the technical team of Computer Science & Engineering Department for technical fest NIMBUS at NIT Hamirpur.">
    <meta name="author" content="Team .EXE">
    <link rel="icon" href="images/head.png">
    <meta name="description" content="Paradox is an online event by Team .EXE which is the technical team of Computer 
      Science & Engineering Department at NIT Hamirpur">
    <meta name="keywords" content="paradox, paradox nith, paradox team .exe, paradox nimbus,  paradox nimbus 2016,
        team .exe, exe, NITH , nit hamirpur, CSED, CSED NITH, team exe, paradox, web-o-magica, nimbus nith
        nimbus 2016, nimbus 2k16, nit hamirpur, nith">
    <meta property="og:title" content="Paradox - Team .EXE">
    <meta property="og:image" content="http://exe.nith.ac.in/images/paradox.jpeg">
    <meta property="og:description" content="Paradox is an online event by Team .EXE which is the technical team of Computer Science & Engineering Department at NIT Hamirpur">
    <title>Paradox - Team .EXE</title>
        <style type="text/css">
.demo-card {
  padding-top: 20px;
  padding-left: 5%;
  padding-right: 5%;
  padding-bottom: 10px;
}
.panel-body img {
    width: 70%;
    float: left;
}
</style>

  </head>

<?php
include_once('stylesheets.php'); 
include_once('header.php');
include_once('sessions.php');
//include_once('database.php');

//echo $session_usr;
if(!isset($_SESSION['login_user']))
   {
      //header("Location:index.php");
      echo "<script type='text/javascript'>window.location.href = 'index.php';</script>";
      exit();
   }

//Checking the user's submitted answer
if(isset($_POST['ans']))    {
    
    //posting user's answer
    $post = [
        'live_token'   => $read_live_token,
        'req_type' => $read_req_type,
        'google_id' => $session_usr,
        'answer' => $_POST['ans'],
        'level' => $_POST['level'],
    ];
    $ch = curl_init($base_url."/api/profile/ans_submit.php");

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $ans_response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);
    //echo $ans_response;
  $ans_decode = json_decode($ans_response);

  ?>
<div class="demo-card">
  <?php
  $tmp = $ans_decode->{'message'};
  if($tmp == "false") {
     echo '<div class="alert alert-danger" role="alert"> Oh! Incorrect Answer. Try again</div>'; 
  }
  elseif($tmp == "true")  {
     echo '<div class="alert alert-success" role="alert"> Congratulations! Correct answer.</div>';  
  }
  else  {
     echo '<div class="alert alert-warning" role="alert"> Some Problem was encountered!Try again.</div>';
  }
?>
</div>
<?php
}

//fetching current level of person
$post = [
    'live_token'   => $read_live_token,
    'req_type' => $read_req_type,
    'google_id' => $session_usr,
];
$ch = curl_init($base_url."/api/profile/read_one.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);
//echo $response;

$records = json_decode($response);
foreach($records as $key => $value) 	{
   	for($i = 0; $i < sizeof($value); $i++)   	{
    	//print_r($value[$i]->name);
		//echo "<br>";    	
         $pic_url = $value[$i]->picture;
         $name = $value[$i]->name;
         $score = $value[$i]->score;
    	 $level = $value[$i]->level;
    }
}


//fetching question image corresponding to user's level
$post = [
    'live_token'   => $read_live_token,
    'req_type' => $read_req_type,
    'level' => $level,
];
$ch = curl_init($base_url."/api/questions/read_level.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response_1 = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);
//echo $response_1;

$records_1 = json_decode($response_1);

foreach($records_1 as $key => $value) 	{
   	for($i = 0; $i < sizeof($value); $i++)   	{
    	$location_img = $value[$i]->url;
    }
}
//echo $location_img;

//Getting the images location and trimming `paradox.php` from the url
$dir = $_SERVER['PHP_SELF'];
$dir = trim($dir,"paradox.php");

?>
                  <div class="demo-card">
                  <div class="panel panel-info">
                  <div class="panel-heading">
                <?php 
                        //echo '<pre>Your Total Attempts - '.$atmpt.'</pre>'; 
                if ($level==13) 
                { 
                  //setting a variable to 1
                  $final = 1;
                  ?>
                  <h3 class="panel-title">Congratulations! <b>Paradox Completed.</b><span style="float: right"><?php echo $name; ?></span></h3>
                <?php
                }
                else
                {
                ?>
                  <h3 class="panel-title">Paradox Level #<?php echo $level; ?><span style="float: right"><?php echo $name; ?></span></h3>
                  <?php 
                }
                  ?>
                  </div>
                  
                  <div class="panel-body">
                
                  <?php echo "<img src=".$dir.$location_img." />"; 
                        echo '<div style="text-align: center">';
                        echo ' <a href="instructions.php"><button class="btn btn-default" > View Paradox - Instructions </button></a>';   
                        echo "<br><br>";
                        echo ' <a href="leaderboard.php"><button class="btn btn-default" > View Paradox - Leaderboard </button></a>';
                        echo "<br><br>";
                        echo ' <a href="hints.php"><button class="btn btn-default" > View Paradox - Hints </button></a></div>';
                ?>
                    </div>
                            <div class="panel-footer">
                                <form action="" method="post">
                                    <input type="text" name="ans" <?php if($final==1) echo "disabled" ?>>
                                    <input type="hidden" value="<?php echo $level ?>" name="level" />
                                    <input name="answ" class="btn btn-primary" type="submit" value="Submit Answer" <?php if($final==1) echo "disabled" ?>>
                                </form>
                            </div>
                        </div>
                    </div> 

<?php
        include_once('footer.php');
?>                        
