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
    .table-responsive {
        padding:5% 5% 5% 5%;
        text-align: center;
    }
</style>
  </head>

<?php
session_start();
include_once('stylesheets.php'); 
include_once('header.php');
include_once('sessions.php');
//include_once('database.php');

        echo '<div class="table-responsive">';
        echo '<table class="table table-hover"><tr><b>';
        echo "<td>Level</td>";
        echo "<td>Hint 1</td>";
        echo "<td>Hint 2</td>";
        echo "<td>Hint 3</td><tr></b>";

        
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



     //fetching hints corresponding to current level
$post = [
    'live_token'   => $read_live_token,
    'req_type' => $read_req_type,
    'level' => $level,
];
$ch_1 = curl_init($base_url."/api/hints/read.php");

curl_setopt($ch_1, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch_1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_1, CURLOPT_POSTFIELDS, $post);

// execute!
$response_1 = curl_exec($ch_1);

// close the connection, release resources used
curl_close($ch_1);
//echo $response;

$records_1 = json_decode($response_1);
foreach($records_1 as $key => $value) 	{
   	for($i = 0; $i < sizeof($value); $i++)   	{
    	
    	 $hint1 = $value[$i]->hint1;
         $hint2 = $value[$i]->hint2;
         $hint3 = $value[$i]->hint3;
    	}
}
   
        
        
        
?>
            <tr>
            <td><?php echo $level; ?></td>
            <td><?php echo $hint1; ?></td>
            <td><?php echo $hint2; ?></td>
            <td><?php echo $hint3; ?></td>
            </tr>
                
                
<?php       
             echo "</table></div>";
        include_once('footer.php');
?>
