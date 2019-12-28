<?php 
session_start(); 
include('../php/config.php'); 
unset($_SESSION['user-web-'.$userzb]); 
setcookie('user-web-'.$userzb, null, -1, '/'); 
header('location: '.$urlppal); exit(); 
?>