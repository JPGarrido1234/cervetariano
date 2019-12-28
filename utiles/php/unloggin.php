<?php error_reporting(0); session_start(); $adaux = ""; include('iniciar.php');
if($_GET['user'] == "adm"){ unset($_SESSION['user-'.$GLOBALS['userzft']]); setcookie('user-'.$GLOBALS['userzft'], null, -1, '/'); }
header("location: ../../".$GLOBALS['rutadmin']."/index.php"); exit(); ?>