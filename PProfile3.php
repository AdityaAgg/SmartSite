<?
//Name: Aditya Aggarwal
//File:PProfile3.php
//Purpose:Logout functionality.
?>
<?php
echo '<center> Logging Out </center>';
session_start();
$_SESSION['var']='true';
unset ($_SESSION['edit']);
header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile2.php");
?>