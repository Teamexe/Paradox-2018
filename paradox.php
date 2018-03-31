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
//include_once('dbconnect.php');

//echo $session_usr;
if(!isset($_SESSION['login_user']))
   {
      //header("Location:index.php");
      echo "<script type='text/javascript'>window.location.href = 'index1.php';</script>";
      exit();
   }

//$ab=mysqli_query($link,"SELECT level,name,attempts from users WHERE google_id='$session_usr'");
//$out=mysqli_fetch_array($ab);
//$l=$out['level'];
//$nam=$out['name'];
//$atmpt=$out['attempts'];
/*
For debugging the code
echo "\n";
echo $l;
echo $nam;
echo $atmpt;
echo "thsfjklsadfjkl";
*/

//fetching current level of person
$goo_id = $session_usr;

$post = [
    'live_token'   => 'PHyQdkcVGU2Q1FBNmolhVJ9NZlhBvtqyMGbHAf6AK88l0L6df1Ry9bQlICduNDcXPnHaxFkvAzj99qvUezB8EQH2cjg7hMW8Y6rJ25V2JDPqjTTrIsNfMAtQXdfT',
    'req_type' => 30,
    'google_id' => $goo_id,
];
$ch = curl_init("http://localhost/api/profile/read_one.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// execute!

$response = curl_exec($ch);
// close the connection, release resources used
curl_close($ch);


//echo $response;

$records = json_decode($response);

foreach($records as $key => $value)
 	{
   	for($i = 0; $i < sizeof($value); $i++)
   	{
    	//print_r($value[$i]->name);
		//echo "<br>";
    	
     $pic_url = $value[$i]->picture;
     $name= $value[$i]->name;
     $score = $value[$i]->score;
	 $level= $value[$i]->level;
		
	 

    }
}


//fetching image corresponding to level of user
$post = [
    'live_token'   => 'PHyQdkcVGU2Q1FBNmolhVJ9NZlhBvtqyMGbHAf6AK88l0L6df1Ry9bQlICduNDcXPnHaxFkvAzj99qvUezB8EQH2cjg7hMW8Y6rJ25V2JDPqjTTrIsNfMAtQXdfT',
    'req_type' => 30,
    'level' => $level,
];
$ch = curl_init("http://localhost/api/questions/read_level.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// execute!

$response_1 = curl_exec($ch);
// close the connection, release resources used
curl_close($ch);


//echo $response_1;

$records_1 = json_decode($response_1);

foreach($records_1 as $key => $value)
 	{
   	for($i = 0; $i < sizeof($value); $i++)
   	{
    	//print_r($value[$i]->name);
		//echo "<br>";
    	
     $location_img = $value[$i]->location;
     	
	 

    }
}



//$bc=mysqli_query($link,"SELECT * from imag WHERE level=$l");
//$out1=mysqli_fetch_array($bc);
//$leve=$out1['location'];



/*if(isset($_POST['ans']))
{
    $answer=$_POST['ans'];
    //convert to lowercase for matching
    $answer=strtolower($answer);
    //echo $answer;
    ++$atmpt;
    //echo $atmpt;

    //fetching answer
    $abc=mysqli_query($link,"SELECT chek from imag WHERE level=$l");    
    $out3=mysqli_fetch_array($abc);
    $ansd=$out3['chek'];

    //checking the answer & no. of attempt
    if ($answer==$ansd) 
    {
        //increase the level no. & the attempt count
        ++$l;
        $abd=mysqli_query($link,"UPDATE users SET level='$l', attempts='$atmpt' WHERE google_id=$session_usr");
        include_once('paradox_right.php');
        echo "<center>Well done! Correct answer</center>";
        include_once('paradox_bottom.php');
        $bc=mysqli_query($link,"SELECT * from imag WHERE level=$l");
        $out1=mysqli_fetch_array($bc);
        $leve=$out1['location'];        
    }
    else
    {
        //increase attempt count only
        $abd=mysqli_query($link,"UPDATE users SET attempts='$atmpt' WHERE google_id=$session_usr");
        
        //checking if message is empty/not
        if ($answer) 
        {
            include_once('paradox_wrong.php');
            echo "<center>Wrong Answer : Try again!</center>";
            include_once('paradox_bottom.php');
        }
        else
        {
            include_once('paradox_wrong.php');
            echo "<center>Submitting answer without entering value is increasing your no. of attempts. It really matters.</center>";
            include_once('paradox_bottom.php');
        }
        
    }

}
          */              
?>

                <div class="demo-card">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                    <h3 class="panel-title">Paradox Level #<?php echo $level; ?><span style="float: right"><?php echo $nam; ?></span>
                                    </h3>
                            </div>
                            <div class="panel-body">
                <?php 
                        //echo '<pre>Your Total Attempts - '.$atmpt.'</pre>'; 
                if ($level==13) 
                {
                    echo "Congratulations, Paradox completed\n";
                }
                else
                {
                    echo "<img src=".$location_img." />"; 
                }
                        echo ' <a href="instructions.php"><button class="btn btn-default" > View Paradox - Instructions </button></a>';   
                        echo "<br><br>";
                        echo ' <a href="leaderboard.php"><button class="btn btn-default" > View Paradox - Leaderboard </button></a>';
                        echo "<br><br>";
                        echo ' <a href="hints.php"><button class="btn btn-default" > View Paradox - Hints </button></a>';                                              
                ?>
                            </div>
                            <div class="panel-footer">
                                <form action="" method="post">
                                    <input type="text" name="ans">
                                    <input class="btn" type="submit" value="Submit Answer">
                                </form>
                            </div>
                        </div>
                    </div> 

<?php

        include_once('footer.php');
?>
