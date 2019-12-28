<?php
session_start(); 
$bug = 0; 
if($bug == 0){ 
    error_reporting(0); 
}else{ 
    ini_set('display_error', 1); 
}


include("utiles/php/iniciar.php");
if(isset($_GET['id']) and $_GET['id'] != "" and isset($_GET['clave']) and $_GET['clave'] != "" and isset($_GET['email']) and $_GET['email'] != ""){

    $sqlemail = $ini->consulta("SELECT * FROM negocio WHERE email = '".$_GET['email']."'"); 
    $regmail = $ini->fetch_object($sqlemail);
	if($_GET['id'] == md5($regmail->id_negocio)){
		$sqlup  = $ini->consulta("UPDATE negocio SET activo = '1' WHERE id_negocio = '".$regmail->id_negocio."'");
		$_SESSION['negocio_activo'] = "ok";
		header("location: ".$urlppal);
		exit();
	}

}else{
	header("location: ".$urlppal);
	exit();
}

?>