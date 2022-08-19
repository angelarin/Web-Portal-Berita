<?php
session_start();
include("admin/include/config.php");
$_SESSION['login']=="";
session_unset();
session_destroy();
echo "<script language='javascript'>document.location='index.php';</script>";
?>

