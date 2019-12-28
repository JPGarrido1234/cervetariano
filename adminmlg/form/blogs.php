<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } session_start();
$ruta = "../../utiles/php/"; include("../../utiles/php/iniciar.php"); include("../../utiles/php/admin.php"); $ad = new admin();
$limite = 1; if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: ../index.php?error=3333"); exit(); }
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($permiso != 1 and $permiso != 3){ header("location: ../index.php?error=3333"); exit(); } $idenv = "";

switch($_POST['modo']){
	case 'crear' :{

		if($_POST['url'] != ""){ $url_amg = $_POST['url']; }else{ $url_amg = $_POST['name']; }  $url_amg = $ad->cambiaralfn($url_amg); $long = strlen($url_amg); 
		if($long > 95){ $url_amg = substr($url_amg,0,95);  $pos = strripos($url_amg,"-"); $url_amg = substr($url_amg,0,$pos); }
		$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amg."' and seccion = '".$secc."'"); 
		$url_amgfn = $url_amg; $i=1; 
		while($ini->num_rows($sqlurlamg) > 0){
			$url_amgfn = $url_amg.$i; $i++; 
			$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg_lang = '".$url_amgfn."' and seccion = '".$secc."'"); 
		} 
		$url_amg = $url_amgfn;
		$imagen = "";
		$titalt = "";
		if($_FILES['archivo']['tmp_name'] != ""){
			$carpeta = ""; 
			if($_POST['nueva'] != ""){  
				$carpeta = $ad->cambiaralfn($_POST['nueva']);  
				mkdir('../../imagen/'.$carpeta); 
				$ssql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva']."')"); 
			}
			if($carpeta != ""){ 
				$dir = "/".$carpeta."/"; 
			}else{ 
				$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta']."'"); 
				$reg = $ini->fetch_object($sql); 
				$dir = $reg->carpeta; 
			}
			$arralta = explode("/",$_FILES['archivo']['type']); 
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['archivo']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; 
						$sigue = true; 
						$name = $e.$name; 
						$e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); 
				 header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imagen = $urlppal."imagen".$dir.$name;
			$titalt = $_POST['timg']."/**/".$_POST['aimg'];
		}else{ 
			if($_POST['uimg'] != ""){ 
				$imagen = $_POST['uimg']; 
				$titalt = $_POST['timg']."/**/".$_POST['aimg']; 
			} 
		}
		$activo = isset($_POST['publicado']) ? 1 : 0;
		$fecha = date("Y-m-d H:i:s");
		$contenido = str_replace("'","\'",$_POST['texto']);
		$sql = $ini->consulta("insert into url_amg (seccion,subsecc,plantilla,fecha,thumbs,activo) values ('26','0','4','".$fecha."','".$imagen."','".$activo."')");
		$ultimoid = $ini->ultimoid();
		$sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido,titalt) values ('".$ultimoid."','".$_POST['idioma']."','".$url_amg."','".$_POST['name']."','".$_POST['mtit']."/**/".$_POST['mdes']."/**/".$_POST['mkey']."','".$contenido."','".$titalt."')");
 		/*Slide*/
		$i = 1;
		$carpeta = ""; 
		if($_POST['nueva1'] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva1']); mkdir('../../imagen/'.$carpeta); 
		$sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva1']."')"); $carpetainser = $_POST['nueva1']; }
		if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{ $sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta1']."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
		while($_FILES['img'.$i]['tmp_name'] != "" or $_POST['uimg'.$i] != ""){
		if($_FILES['img'.$i]['tmp_name'] != ""){
			$arralta = explode("/",$_FILES['img'.$i]['type']); $ext = strtolower($arralta[1]);
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
			$imagen = $urlppal."imagen".$dir.$name;
			$titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i];
		}else{ if($_POST['uimg'.$i] != ""){ $imagen = $_POST['uimg'.$i]; $titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i]; } }
		$i++;
			$ssql = $ini->consulta("insert into slide (tipo,url) value ('".$ultimoid."','".$imagen."')");
			$idslide = $ini->ultimoid();
			$ssql = $ini->consulta("insert into slide_lang (id_slide,id_lang,titalt) value ('".$idslide."','".$_POST['idioma']."','".$titalt."')");
		}
		if($_FILES['imgf']['tmp_name'] != ""){
			$dir = "/facebook/";
			$arralta = explode("/",$_FILES['imgf']['type']); $ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['imgf']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; $sigue = true; $name = $e.$name; $e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['imgf']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imgf = $urlppal."imagen".$dir.$name;
		}elseif($_POST['urlf'] != ""){
			$imgf = $_POST['urlf'];
		}
		if($_FILES['imgt']['tmp_name'] != ""){
			$dir = "/facebook/";
			$arralta = explode("/",$_FILES['imgt']['type']); $ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['imgt']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; $sigue = true; $name = $e.$name; $e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['imgt']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imgt = $urlppal."imagen".$dir.$name;
		}elseif($_POST['urlt'] != ""){
			$imgt = $_POST['urlt'];
		}
		$ssql = $ini->consulta("insert into redes_es (id,titf,desf,imgf,titt,dest,imgt) value ('".$ultimoid."','".$ini->real_scape($_POST['titf'])."','".$ini->real_scape($_POST['desf'])."','".$imgf."','".$ini->real_scape($_POST['titt'])."','".$ini->real_scape($_POST['dest'])."','".$imgt."')");
		$i = 1;
		$se = 5; 
		$idg = "&id=".$ultimoid;
	};
	break;	
	case 'modificar' :{

		if($_POST['url'] != "" or $_POST['id'] == 1){ 
			$url_amg = $_POST['url']; }else{ $url_amg = $_POST['name']; 
		} 
		$url_amg = $ad->cambiaralfn($url_amg); 
		$long = strlen($url_amg); 
		if($long > 95){ 
			$url_amg = substr($url_amg,0,95); 
			$pos = strripos($url_amg,"-"); 
			$url_amg = substr($url_amg,0,$pos); 
		}
		$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amg."' where id_url_amg <> '".$_POST['id']."'"); 
		$url_amgfn = $url_amg; 
		$i=1; 
		while($ini->num_rows($sqlurlamg) > 0){
			$url_amgfn = $url_amg.$i; $i++; 
			$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amgfn."' where id_url_amg <> '".$_POST['id']."'"); 
		} 
		$url_amg = $url_amgfn;
		if($_FILES['archivo']['tmp_name'] != ""){
			$carpeta = ""; 
			if($_POST['nueva'] != ""){  
				$carpeta = $ad->cambiaralfn($_POST['nueva']);  
				mkdir('../../imagen/'.$carpeta); 
				$ssql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva']."')"); 
			}
			if($carpeta != ""){ 
				$dir = "/".$carpeta."/"; 
			}else{ 
				$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta']."'"); 
				$reg = $ini->fetch_object($sql); 
				$dir = $reg->carpeta; 
			}
			$arralta = explode("/",$_FILES['archivo']['type']); 
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['archivo']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; 
						$sigue = true; 
						$name = $e.$name; 
						$e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); 
				 header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imagen = $urlppal."imagen".$dir.$name;
			$sql = $ini->consulta("update url_amg set thumbs = '".$imagen."' where id = '".$_POST['id']."'");
		}else{ 
			if($_POST['uimg'] != ""){ 
				$imagen = $_POST['uimg']; 
				$sql = $ini->consulta("update url_amg set thumbs = '".$imagen."' where id = '".$_POST['id']."'");
			} 
		}
		$titalt = $_POST['timg']."/**/".$_POST['aimg'];
		$contenido = str_replace("'","\'",$_POST['texto']);
		$activo = isset($_POST['publicado']) ? 1 : 0;
			$sql = $ini->consulta("select * from url_amg_lang where id_url_amg = '".$_POST['id']."' and lang = '".$_POST['idioma']."'"); if($ini->num_rows($sql) > 0){ 
			$sql = $ini->consulta("update url_amg_lang set url_amg = '".$url_amg."', titulo = '".$_POST['name']."', metas = '".$_POST['mtit']."/**/".$_POST['mdes']."/**/".$_POST['mkey']."', contenido = '".$contenido."', titalt = '".$titalt."' where id_url_amg = '".$_POST['id']."' and lang = '".$_POST['idioma']."'");	
		}else{
			$sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido,titalt) value ('".$_POST['id']."','".$_POST['idioma']."','".$url_amg."','".$_POST['name']."','".$_POST['mtit']."/**/".$_POST['mdes']."/**/".$_POST['mkey']."','".$_POST['texto']."','".$titalt."')");
		}
		$sql = $ini->consulta("update url_amg set activo = '".$activo."' where id = '".$_POST['id']."'");
			if($_POST['nueva1'] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva1']); mkdir('../../imagen/'.$carpeta); 
			$sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva1']."')"); $carpetainser = $_POST['nueva1']; }
			if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{ $sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta1']."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
			$i = 1;
			while($_FILES['img'.$i]['tmp_name'] != "" or $_POST['uimg'.$i] != ""){
			if($_FILES['img'.$i]['tmp_name'] != ""){
				$arralta = explode("/",$_FILES['img'.$i]['type']); $ext = strtolower($arralta[1]);
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
				$imagen = $urlppal."imagen".$dir.$name;
				$titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i];
			}else{ if($_POST['uimg'.$i] != ""){ $imagen = $_POST['uimg'.$i]; $titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i]; } }
			$i++;
				$ssql = $ini->consulta("insert into slide (tipo,url) value ('".$_POST['id']."','".$imagen."')");
				$idslide = $ini->ultimoid();
				$ssql = $ini->consulta("insert into slide_lang (id_slide,id_lang,titalt) value ('".$idslide."','".$_POST['idioma']."','".$titalt."')");
			}
		$imgf = $ini->selectcampo($_POST['id'],"redes_es","imgf");
		if($_FILES['imgf']['tmp_name'] != ""){
			$dir = "/facebook/";
			$arralta = explode("/",$_FILES['imgf']['type']); $ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['imgf']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; $sigue = true; $name = $e.$name; $e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['imgf']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imgf = $urlppal."imagen".$dir.$name;
		}elseif($_POST['urlf'] != ""){
			$imgf = $_POST['urlf'];
		}
		$imgt = $ini->selectcampo($_POST['id'],"redes_es","imgt");
		if($_FILES['imgt']['tmp_name'] != ""){
			$dir = "/facebook/";
			$arralta = explode("/",$_FILES['imgt']['type']); $ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$name = $ad->cambiaralfn($_FILES['imgt']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$name = $namec; $sigue = true; $name = $e.$name; $e++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['imgt']['tmp_name'],"../../imagen".$dir.$name)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagen = getimagesize("../../imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$name); header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imgt = $urlppal."imagen".$dir.$name;
		}elseif($_POST['urlt'] != ""){
			$imgt = $_POST['urlt'];
		}
			$ssql = $ini->consulta("select * from redes_es where id = '".$_POST['id']."'");
			if($ini->num_rows($ssql) > 0){
				$sqql = $ini->consulta("update redes_es set titf = '".$ini->real_scape($_POST['titf'])."', desf = '".$ini->real_scape($_POST['desf'])."', imgf = '".$imgf."', titt = '".$ini->real_scape($_POST['titt'])."', dest = '".$ini->real_scape($_POST['dest'])."', imgt = '".$imgt."' where id = '".$_POST['id']."'");
			}else{
				$sqql = $ini->consulta("insert into redes_es (id,titf,desf,imgf,titt,dest,imgt) value ('".$_POST['id']."','".$ini->real_scape($_POST['titf'])."','".$ini->real_scape($_POST['desf'])."','".$imgf."','".$ini->real_scape($_POST['titt'])."','".$ini->real_scape($_POST['dest'])."','".$imgt."')");
			}
		$se = $_POST['se'];
		$idg = "&id=".$_POST['id'];
	};
	break;
	case 'ver' :{

		switch($_POST['admin_lis_usu_php_op']){
			case 1:{ $sql = $ini->consulta("select * from url_amg");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
			 		 $ssql = $ini->consulta("update url_amg set activo = '1' where id = '".$reg->id."'"); } } }; break;
			case 2:{ $sql = $ini->consulta("select * from url_amg");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
					 $ssql = $ini->consulta("update url_amg set activo = '0' where id = '".$reg->id."'"); } } }; break;
			case 3:{ $sql = $ini->consulta("select * from url_amg");  while($reg = $ini->fetch_object($sql)){
					 if(isset($_POST['chusu'.$reg->id])){ $ssql = $ini->consulta("delete from url_amg where id = '".$reg->id."'"); $ssql = $ini->consulta("delete from url_amg_lang where id_url_amg = '".$reg->id."'");  } } }; break;
			case 4:{ $ssql = $ini->consulta("update url_amg set activo = '1' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
			case 5:{ $ssql = $ini->consulta("update url_amg set activo = '0' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
			case 6:{ $ssql = $ini->consulta("delete from url_amg where id = '".$_POST['admin_lis_usu_php_id']."'"); $ssql = $ini->consulta("delete from url_amg_lang where id_url_amg = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
		}
		$se = 2;

	};
	break;	
	default:{ header("location: ../admin.php?op=".$_POST['op']."&msj=1015"); exit(); }
} header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$se.$idg."&msj=0001"); exit(); ?>