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
    <title>Paradox leaderboard - Team .EXE</title>
<style type="text/css">
    .table-responsive {
        padding:5% 5% 5% 5%;
        text-align: center;
    }
    .table-responsive td img{
        width: 25%;
    }
    @media screen and (max-width: 768px)
{
    .table-responsive td img{
        width: 100%;
    }
}
</style>
  </head>
<body>


<?php
session_start();
include_once('stylesheets.php'); 
include_once('header.php');
include_once('sessions.php');



echo '<div class="table-responsive">';
echo '<table class="table table-hover"><tr><b>';
echo "<td>Position</td>";
echo "<td>Name</td>";
echo "<td>Photo</td>";
echo "<td>Score</td>";
echo "<td>Level</td></b>";

$post = [
    'live_token'   => $read_live_token,
    'req_type' => $read_req_type,
];
$ch = curl_init("http://localhost/api/profile/read.php");

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// execute!

$response = curl_exec($ch);
// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
$records = json_decode($response);
$cn=0;

foreach($records as $key => $value)
    {
    for($i = 0; $i < sizeof($value); $i++)
    {
        //print_r($value[$i]->name);
        //echo "<br>";
        $cn++;
        $pic_url = $value[$i]->picture;
        

 ?>
            
            <tr>
            <td><?php echo $cn; ?></td>
            <td><?php print_r($value[$i]->name);?></td>
            <td><img src="<?php echo $pic_url; ?>"></td>
            <td><?php print_r($value[$i]->score);?></td>
            <td><?php 
            if($value[$i]->level == 13)
                echo "Completed";
            else
                print_r($value[$i]->level);
           }
           } ?></td>
            </tr>
           
 

</body>
</html>
