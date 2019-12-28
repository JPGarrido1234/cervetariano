<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
header('expires: access 1 week'); header("Content-Type: text/html;charset=utf-8");
if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){ ob_start("ob_gzhandler"); }else{ ob_start(); } include("utiles/php/iniciar.php"); 
if(file_exists("plantilla/funciones/".$ini->archivo.".php")){ include("plantilla/funciones/".$ini->archivo.".php"); } include("plantilla/index.php"); ?>