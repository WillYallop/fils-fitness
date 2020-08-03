<?php
session_start();

if (isset($_SESSION['usersId'])) {
  $usersId = $_SESSION['usersId'];
} elseif (isset($_SESSION['cookieId'])) {
  $usersId = $_SESSION['cookieId'];
}

if(isset($_COOKIE["identity"]) || isset($_COOKIE["validate"])) {

     $usersCookieIdentity = $_COOKIE["identity"];
     $usersCookieValidate = $_COOKIE["validate"];

     $null = null;

     require 'dbh.inc.php';

     $sql = "UPDATE ft_users SET usersCookieHash = NULL, usersCookieValidate = NULL WHERE id='$usersId'";
     mysqli_query($conn, $sql);

     setcookie("identity",'',time()-7000000,'/');
     setcookie("validate",'',time()-7000000,'/');
}

session_unset();
session_destroy();

header("Location: ../index");
