<?
//Name: Aditya Aggarwal
//File:PProfile.php
//Purpose: To Login to account.
?>
<html>
<head>
    <link rel="stylesheet" href="ProfileDesign12">
</head>
<div class="starter">
    <div class="body">
<body>

<!--Login-->
<center>

    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
    <br><br>
    <br>
    <form action="PProfile.php" method="POST">
Email:
    <br> <input name="email" type="text" />
   <br>
Password:
    <br>
    <input name="passwords" type="password"/>
    <br>
<input type="submit">
</form>
</center>


<!--Login Connect-->
<?php

if (isset($_POST['passwords'])&& isset($_POST['email'])) {

$hostname = "mysql7.000webhost.com";
$database = "a4691985_SmartS";
$username = "a4691985_SmartS";
$password = "ObaObaOba12";
$connector = new mysqli($hostname,$username,$password,$database);


if (mysqli_connect_errno())
    die (mysqli_connect_error());


$passwords=$_POST['passwords'];
$email=$_POST['email'];
$queried=$connector->query("CALL ConnectProfileInfo ('$email', '$passwords')");
$row = $queried->fetch_assoc();
if (!isset($row ['FirstName'])) {
    echo'<center> Account Not Found Try Again </center>';
} else {
session_start();
    $_SESSION['passwords']=$_POST['passwords'];
    $_SESSION['email']=$_POST['email'];
    header("Location: http://appdevclubshs.com/SmartsiteProfile/PProfile2.php");
}
}
?>

<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br><br>
<br>
<br>


</body>
    </div>
</div>
</html>