<?php

ob_start(); //turns on output buffering
$timezone = date_default_timezone_set("Asia/Kolkata");
$sqlcon = mysqli_connect("localhost","root","","financepeer") or die("oops! Cannot connect to the server..");

?>