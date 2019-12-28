<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../utiles/php/"; include("../../utiles/php/iniciar.php"); include('../../utiles/php/admin.php'); $ad = new admin();
if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: ../index.php?error=3333"); exit(); }
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($permiso != 1 and $permiso != 2 and $permiso != 3){ header("location: ../index.php?error=3333"); exit(); } $idenv = "";
switch($_POST['modo']){	
	
	case 'crear' :{
		$carpeta = ""; if($_POST['nueva'] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva']);  mkdir('../../imagen/'.$carpeta); $sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva']."')"); }
		if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{
			$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta']."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
		$i = 1;
		while($_FILES['img'.$i]['tmp_name'] != ""){
			$arralta = explode("/",$_FILES['img'.$i]['type']);
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
 				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}

			$name = $ad->cambiaralfn($_FILES['img'.$i]['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; $sigue = true; $name = $e.$name; $e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['img'.$i]['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$i++;
		}
		$_POST['se'] = 1;

	};
	break;	
	case 'eliminar' :{
		$img = str_replace($urlppal, "../../", $_POST['img']);		
		unlink($img);
		$_POST['se'] = 1;
	};
	break;
	default:{ header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se'].$idenv."&msj=1015"); exit(); }
} header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se'].$idenv."&msj=0001"); exit();  ?>