<?php
$active_user = $_COOKIE["user_name"];
session_start();
session_destroy();
header ("location: index.php");
?>