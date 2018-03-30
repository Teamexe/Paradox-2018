<?php

$link = new mysqli('localhost','root','root','paradox_2018');

if($link->connect_errno)
{
echo $link->connect_error;
}
?>
