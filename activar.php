<?php
session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("utiles/php/iniciar.php");
if(isset($_GET['id']) and $_GET['id'] != "" and isset($_GET['clave']) and $_GET['clave'] != "" and isset($_GET['email']) and $_GET['email'] != ""){

	$sqlemail = $ini->consulta("select * from usuarios_web where email = '".$_GET['email']."'"); $regmail = $ini->fetch_object($sqlemail);
	if($_GET['clave'] == md5($regmail->fecha_i) and $_GET['id'] == md5($regmail->id_usuario)){
		$sqlup  = $ini->consulta("update set activo = '1' where id_usuario = '".$regmail->id_usuario."'");
		$_SESSION['mail_activo'] = "ok";
		header("location: ".$urlppal);
		exit();
	}

}else{
	header("location: ".$urlppal);
	exit();
}

?>