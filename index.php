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
</head>
</html>
<?php

session_start(); //session start

require_once ('libraries/Google/autoload.php');
include_once('stylesheets.php'); 
include_once('header.php');
//include_once('database.php');

//$database = new Database();
//$db = $database->getConnection();
//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '307712715810-5gqv439ef8l9hmmod3ggpbdplcc7t7gq.apps.googleusercontent.com'; 
$client_secret = 'yvXrJI4PIvIEtJr4G-DBd44N';
$redirect_uri = 'http://localhost/paradox_2018/index.php';


$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$service = new Google_Service_Oauth2($client);




/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.*/
  
  if (isset($_GET['code'])) 
{
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

  /************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
  
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) 
{
  $client->setAccessToken($_SESSION['access_token']);
} 
else 
{
  $authUrl = $client->createAuthUrl();
}
  
//echo $authUrl;  

//Display user info or display login url as per the info we have.
echo '<div class="container">';
$da=date("d/m/Y - H:i:s");


  
include_once('footer.php');
?>

