<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../utiles/php/"; include("../../utiles/php/iniciar.php"); include('../../utiles/php/admin.php'); $ad = new admin();
if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: ../index.php?error=3333"); exit(); }
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($permiso != 1){ header("location: ../index.php?error=3333"); exit(); } $idenv = "";
switch($_POST['modo']){
	case 'seo' :{

		$sql = $ini->consulta("update opciones set value = '".$_POST['lytics']."' where id = '2'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['manager']."' where id = '3'");
		
	};
	break;	
	case 'redes' :{

		$sql = $ini->consulta("update opciones set value = '".$_POST['facebook']."' where id = '23'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['instagram']."' where id = '24'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['linkedin']."' where id = '25'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['pinterest']."' where id = '26'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['twitter']."' where id = '27'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['youtube']."' where id = '28'");	

	};
	break;
	case 'categorias' :{

		$sql = $ini->consulta("select * from categoria where tipo = '1'"); while($reg = $ini->fetch_object($sql)){

			$ssql = $ini->consulta("select * from lang"); while($rreg = $ini->fetch_object($ssql)){

				$sqql = $ini->consulta("select * from cat_lang where id_categoria = '".$reg->id."' and lang = '".$rreg->id_categoria."'"); if($ini->num_rows($sqql) > 0){

					$slug = $ad->cambiaralfn($_POST[$reg->id."-".$rreg->id_categoria]);
					$sqll = $ini->consulta("update cat_lang set categoria = '".$_POST[$reg->id."-".$rreg->id]."', categoria_amg = '".$slug."' where id_categoria = '".$reg->id."' and lang = '".$rreg->id."'");

				}else{

					$slug = $ad->cambiaralfn($_POST[$reg->id."-".$rreg->id_categoria]);
					$sqll = $ini->consulta("insert into cat_lang (id_categoria,lang,categoria,categoria_amg) value ('".$reg->id."','".$rreg->id."','".$_POST[$reg->id."-".$rreg->id_categoria]."','".$slug."')");

				}

			}

		}

	};
	break;
	case 'textos' :{

		$siglas = $ini->selectcampo($_POST['idioma'],'lang','siglas');
		$lanen = include("../../utiles/lang/".$siglas.".php");
		$gestor = fopen("../../utiles/lang/".$siglas.".php", "w");
		$contenido = "<?php \n\n return array(";
		foreach($lanen as $cl=>$vl){
			if($cl == 'copyr'){
				$inn = str_replace("'","\'",$_POST['copyr']);
			}else{
				$inn = str_replace("'","\'",$vl);
			}
			$contenido .= " \n '".$cl."'=>'".$inn."',";
		}
		$contenido = substr($contenido,0,strlen($contenido)-1);
		$contenido .= "\n ); ?>";
		fwrite($gestor, $contenido);
		fclose($gestor);

	};
	break;
	case 'secciones' :{


		$sql = $ini->consulta("update opciones set value = '".$_POST['inicio']."' where id = '6'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['404']."' where id = '7'");
		$sql = $ini->consulta("update opciones set value = '".$_POST['tienda']."' where id = '8'");


	};
	break;
	case 'logo' :{

		$carpeta = ""; if($_POST['nueva'] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva']);  mkdir('../../imagen/'.$carpeta); $sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva']."')"); }
		if($_FILES['archivo']['tmp_name'] != ""){
			$arralta = explode("/",$_FILES['archivo']['type']);
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
 				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{
			$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta']."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
			$imagen = $ad->cambiaralfn($_FILES['archivo']['name'],'no');
			$namec = $imagen;
			$sigue = true;
			$i = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$imagen = $namec;
						$sigue = true;
						$imagen = $i.$imagen;
						$i++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"../../imagen".$dir.$imagen)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit();
			}
			$imagent = getimagesize("../../imagen".$dir.$imagen); 
			$ai = $imagent[0]; 
			$ali = $imagent[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$imagen); 
				 header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$imagen = $urlppal."imagen".$dir.$imagen;
			$sql = $ini->consulta("update opciones set value = '".$imagen."' where id = '1'");
		}elseif($_POST['archivo_url'] != ""){
			$sql = $ini->consulta("update opciones set value = '".$_POST['archivo_url']."' where id = '1'");
		}
		$titalt = $_POST['tit']."/**/".$_POST['alt'];
		$sql = $ini->consulta("update opciones_lang set value = '".$titalt."' where id = '1' and lang = '".$_POST['idioma']."'");

	};
	break;

	case 'logo-footer' :{

		$carpeta = ""; if($_POST['nueva'] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva']);  mkdir('../../imagen/'.$carpeta); $sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$_POST['nueva']."')"); }
		if($_FILES['archivo']['tmp_name'] != ""){
			$arralta = explode("/",$_FILES['archivo']['type']);
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
 				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{
			$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta']."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
			$imagen = $ad->cambiaralfn($_FILES['archivo']['name'],'no');
			$namec = $imagen;
			$sigue = true;
			$i = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$imagen = $namec;
						$sigue = true;
						$imagen = $i.$imagen;
						$i++;
					}
				}
			}
			if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"../../imagen".$dir.$imagen)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit();
			}
			$imagent = getimagesize("../../imagen".$dir.$imagen); 
			$ai = $imagent[0]; 
			$ali = $imagent[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$imagen); 
				 header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			$imagen = $urlppal."imagen".$dir.$imagen;
			$sql = $ini->consulta("update opciones set value = '".$imagen."' where id = '34'");
		}elseif($_POST['archivo_url'] != ""){
			$sql = $ini->consulta("update opciones set value = '".$_POST['archivo_url']."' where id = '34'");
		}
		$titalt = $_POST['tit']."/**/".$_POST['alt'];
		$sql = $ini->consulta("update opciones_lang set value = '".$titalt."' where id = '6' and lang = '".$_POST['idioma']."'");

	};
	break;

	case 'inicio_localidades' :{
		$insertar = "";
		$sqla = $ini->consulta("select url_amg.id as id, url_amg_lang.titulo as titulo from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '32' and lang = '".$_POST['idioma']."' order by titulo asc"); 
		while($rega = $ini->fetch_object($sqla)){
			if($_POST['lcldds'.$rega->id] == 1){
				$insertar .= $rega->id.",";
			}
		}
		$insertar = substr($insertar, 0, -1);
		$sql = $ini->consulta("update opciones set value = '".$insertar."' where id = '29'");
	};
	break;
	case 'inicio_categorias' :{
		for($i=30;$i<=33;$i++){
			$sqla = $ini->consulta("select url_amg.id as id, url_amg_lang.titulo as titulo from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '33' and lang = '".$_POST['idioma']."' order by titulo asc"); 
			while($rega = $ini->fetch_object($sqla)){
				if($_POST['ctgr'.$rega->id.'-'.$i] == 1){
					$sql = $ini->consulta("update opciones set value = '".$rega->id."' where id = '".$i."'");
				}
			}
		}
	};
	break;	
	case 'slide' :{

		for($i=17;$i<=22;$i++){


		$carpeta = ""; if($_POST['nueva'.$i] != ""){  $carpeta = $ad->cambiaralfn($_POST['nueva'.$i]);  mkdir('../../imagen/'.$carpeta); $sql = $ini->consulta("insert into carpetas (carpeta,nombre_amg) value ('/".$carpeta."/','".$ini->real_scape($_POST['nueva'.$i])."')"); }

		if($_FILES['archivo'.$i]['tmp_name'] != ""){
			$arralta = explode("/",$_FILES['archivo'.$i]['type']);
			$ext = strtolower($arralta[1]);
			if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
 				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1001"); exit(); 
			}
			if($carpeta != ""){ $dir = "/".$carpeta."/"; }else{
			$sql = $ini->consulta("select carpeta from carpetas where id = '".$_POST['carpeta'.$i]."'"); $reg = $ini->fetch_object($sql); $dir = $reg->carpeta; }
			$imagen = $ad->cambiaralfn($_FILES['archivo'.$i]['name'],'no');
			$namec = $imagen;
			$sigue = true;
			$p = 1;
			while($sigue){
				$sigue = false;
				foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
					if("../../imagen".$dir.$name == $archivos_carpeta){
						$imagen = $namec;
						$sigue = true;
						$imagen = $p.$imagen;
						$p++;
					}
				}
			}
			
			if(!move_uploaded_file($_FILES['archivo'.$i]['tmp_name'],"../../imagen".$dir.$imagen)){	
				header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1002"); exit();
			}
			$imagent = getimagesize("../../imagen".$dir.$imagen); 
			$ai = $imagent[0]; 
			$ali = $imagent[1];
			if($ai > 3000 and $ali > 3000){
				 unlink("../../imagen".$dir.$imagen); 
				 header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se']."&msj=1003"); exit(); 
			}
			$imagen = $urlppal."imagen".$dir.$imagen;
			
			$sql = $ini->consulta("update opciones set value = '".$imagen."' where id = '".$i."'");
		}elseif($_POST['archivo_url'.$i] != ""){
			$sql = $ini->consulta("update opciones set value = '".$_POST['archivo_url'.$i]."' where id = '".$i."'");
		}




		}

	};
	break;		
	default:{ header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se'].$idenv."&msj=1015"); exit(); }
} header("location: ../admin.php?idioma=".$_POST['idioma']."&op=".$_POST['op']."&se=".$_POST['se'].$idenv."&msj=0001"); exit(); ?>