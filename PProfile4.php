<?
//Name: Aditya Aggarwal
//File:PProfile4.php
//Purpose:Save Edit functionality of profile information.
?>

<?php

session_start();
if (isset($_SESSION['edit'])) {
unset($_SESSION['edit']);
} else {
    $_SESSION['edit']=true;
}


header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile2.php");
?>