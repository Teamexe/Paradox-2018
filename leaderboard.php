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
echo "yes";
?>
<?php
session_start();
include_once('stylesheets.php'); 
include_once('header.php');
include_once('sessions.php');
//include_once('dbconnect.php');
include_once 'database.php';
//include_once '..api/objects/profile.php';
//include_once '..api/objects/tokens.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

echo '<div class="table-responsive">';
echo '<table class="table table-hover"><tr><b>';
echo "<td>Position</td>";
echo "<td>Name</td>";
echo "<td>Photo</td>";
echo "<td>Score</td></b>";
echo "<td>Level</td></b>";
$cn=0;
   
    $stmt = $profile->leaderboard();
    $num = $stmt->rowCount(); 



if($num>0)
{
     /*$profile_arr=array();
    $profile_arr["records"]=array();
*/ 
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        /*$result = mysqli_query($link,"select * from users order by level desc");
        if(!$result)die ("Database access failed:". mysqli_error($link));
        while($row=mysqli_fetch_array($result))
        */
             $cn++;
?>
            <tr>
            <td><?php echo $cn; ?></td>
            <td><?php echo $row['name']?>"></td>
            <td><img src="<?php echo $row['picture']?>"></td>
            <!--<td><a href="<?php echo $row['score']; ?>" target="_blank"><button class="btn"><?php echo $row['name']?></button></a></td>
            <td><?php echo $row['score']?>"></td>
            <td><?php 
            if($row['level']==12)
            	echo "Completed";
            else
            	echo $row['level'];
            ?></td>
            </tr>
     <?php }} ?>           
                
<?php 
           
           else {
           		echo "No users yet"; 
           }
        echo "</table></div>";
        echo "<center>Registered users : $cn</center><br>";
        include_once('footer.php');
?>
-->
    </body>
</html>
