<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } session_start();
$ruta = "../../utiles/php/"; include("../../utiles/php/iniciar.php"); include("../../utiles/php/admin.php"); $ad = new admin();
$limite = 1; if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: ../index.php?error=3333"); exit(); }
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($permiso != 1){ header("location: ../index.php?error=3333"); exit(); } $idenv = "";

switch($_POST['modo']){	 
	case 'modificar1' :{

		$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'");
		while($reg=$ini->fetch_object($sql)){ 
			$sqlu = $ini->consulta("update menu set blank = '".$_POST[$reg->id.'-'.$reg->orden]."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
			$sqlu = $ini->consulta("update menu set orden = '".$_POST[$reg->id.','.$reg->orden]."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
		}
		$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'");
		while($reg=$ini->fetch_object($sql)){
			if($_POST['e'.$reg->id.','.$reg->orden] == "Eliminar"){
				$sqlu = $ini->consulta("delete from menu where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
			}
		}
		$i = 1; $sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."' order by orden asc");
		while($reg=$ini->fetch_object($sql)){
			$sqlu = $ini->consulta("update menu set orden = '".$i."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'"); $i++;
		}
		if($_POST['menu1'] != ""){
			$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'"); $orden = $ini->num_rows($sql)+1;
			if($_POST['menu1'] != "-9"){
				$sql = $ini->consulta("insert into menu (tipo,sub,orden,url_amg) values ('".$_POST['idmenu']."','0','".$orden."','".$_POST['menu1']."')");
			}else{
				$sql = $ini->consulta("insert into menu (tipo,sub,orden,url_amg,blank,url_ext,url,titulo) values ('".$_POST['idmenu']."','0','".$orden."','0','1','1','".$_POST['urln']."','".$_POST['titurln']."')");
			}
		}

	};
	break;	

	case 'modificar2' :{

		$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'");
		while($reg=$ini->fetch_object($sql)){ 
			$sqlu = $ini->consulta("update menu set blank = '".$_POST[$reg->id.'-'.$reg->orden]."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
			$sqlu = $ini->consulta("update menu set orden = '".$_POST[$reg->id.','.$reg->orden]."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
		}
		$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'");
		while($reg=$ini->fetch_object($sql)){
			if($_POST['e'.$reg->id.','.$reg->orden] == "Eliminar"){
				$sqlu = $ini->consulta("delete from menu where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'");
			}
		}
		$i = 1; $sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."' order by orden asc");
		while($reg=$ini->fetch_object($sql)){
			$sqlu = $ini->consulta("update menu set orden = '".$i."' where id='".$reg->id."' and tipo = '".$reg->tipo."' and orden = '".$reg->orden."'"); $i++;
		}
		if($_POST['menu2'] != ""){
			$sql = $ini->consulta("select * from menu where tipo = '".$_POST['idmenu']."'"); $orden = $ini->num_rows($sql)+1;
			if($_POST['menu2'] != "-9"){
				$sql = $ini->consulta("insert into menu (tipo,sub,orden,url_amg) values ('".$_POST['idmenu']."','0','".$orden."','".$_POST['menu2']."')");
			}else{
				$sql = $ini->consulta("insert into menu (tipo,sub,orden,url_amg,blank,url_ext,url,titulo) values ('".$_POST['idmenu']."','0','".$orden."','0','1','1','".$_POST['urln']."','".$_POST['titurln']."')");
			}
		}

	};
	break;	

	default:{ header("location: ../admin.php?op=".$_POST['op']."&se=".$_POST['se']."&msj=1015"); exit(); }
} header("location: ../admin.php?op=".$_POST['op']."&se=".$_POST['se']."&msj=0001"); exit(); ?>