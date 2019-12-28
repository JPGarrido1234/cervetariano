<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } session_start();
$ruta = "../../utiles/php/"; include("../../utiles/php/iniciar.php"); include("../../utiles/php/admin.php"); $ad = new admin();
$limite = 1; if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: ../index.php?error=3333"); exit(); }
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($permiso != 1 and $permiso != 3){ header("location: ../index.php?error=3333"); exit(); } $idenv = "";

switch($_POST['modo']){
	case 'crear' :{

		if($_POST['url'] != ""){ $url_amg = $_POST['url']; }else{ $url_amg = $_POST['name']; }  $url_amg = $ad->cambiaralfn($url_amg); $long = strlen($url_amg); 
		if($long > 95){ $url_amg = substr($url_amg,0,95);  $pos = strripos($url_amg,"-"); $url_amg = substr($url_amg,0,$pos); }
		$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amg."' and seccion = '27'"); 
		$url_amgfn = $url_amg; $i=1; 
		while($ini->num_rows($sqlurlamg) > 0){
			$url_amgfn = $url_amg.$i; $i++; 
			$sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg_lang = '".$url_amgfn."' and seccion = '27'"); 
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
		$destacado = isset($_POST['destacado']) ? 1 : 0;
		$fecha = date("Y-m-d H:i:s");
		$contenido = str_replace("'","\'",$_POST['texto']);
	
		
		$sql = $ini->consulta("insert into url_amg (seccion,subsecc,plantilla,fecha,thumbs,activo) values ('27','0','8','".$fecha."','".$imagen."','".$activo."')");
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
			$imagen = $urlppal."/imagen".$dir.$name;
			$titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i];
		}else{ if($_POST['uimg'.$i] != ""){ $imagen = $_POST['uimg'.$i]; $titalt = $_POST['tit'.$i]."/**/".$_POST['alt'.$i]; } }
		$i++;
			$ssql = $ini->consulta("insert into slide (tipo,url) value ('".$ultimoid."','".$imagen."')");
			$idslide = $ini->ultimoid();
			$ssql = $ini->consulta("insert into slide_lang (id_slide,id_lang,titalt) value ('".$idslide."','".$_POST['idioma']."','".$titalt."')");
		}



		$marca = "";
		if($_POST['nueva_marca'] != ""){ 
			$sql = $ini->consulta("insert into cz_marca (titulo_es) value ('".$_POST['nueva_marca']."')");
			$marca = $ini->ultimoid();
		}elseif($_POST['marca'] != ""){
			$marca = $_POST['marca'];
		}

		$denominacion = $ini->real_scape($_POST['denominacion']);

		$pais = "";
		if($_POST['nueva_pais'] != ""){  
			$sql = $ini->consulta("insert into pais (pais) value ('".$_POST['nueva_pais']."')");
			$pais = $ini->ultimoid();
		}elseif($_POST['pais'] != ""){
			$pais = $_POST['pais'];
		}



		$provincia = "";
		if($_POST['nueva_provincia'] != ""){  
			$sql = $ini->consulta("insert into provincias (id_pais,provincia) value ('".$pais."',".$_POST['nueva_provincia']."')");
			$provincia = $ini->ultimoid();
		}elseif($_POST['provincia'] != ""){
			$provincia = $_POST['provincia'];
		}


		$municipio = "";
		if($_POST['nueva_municipio'] != ""){  
			$sql = $ini->consulta("insert into municipios (IdProvincia,Nombre) value ('".$provincia."',".$_POST['nueva_municipio']."')");
			$municipio = $ini->ultimoid();
		}elseif($_POST['municipio'] != ""){
			$municipio = $_POST['municipio'];
		}



		$productor = "";
		if($_POST['nueva_productor'] != ""){ 
			$sql = $ini->consulta("insert into cz_productor (titulo_es) value ('".$_POST['nueva_productor']."')");
			$productor = $ini->ultimoid();
		}elseif($_POST['productor'] != ""){
			$productor = $_POST['productor'];
		}

		$tipo = "";
		if($_POST['nueva_tipo'] != ""){ 
			$sql = $ini->consulta("insert into cz_tipo (titulo_es) value ('".$_POST['nueva_tipo']."')");
			$tipo = $ini->ultimoid();
		}elseif($_POST['tipo'] != ""){
			$tipo = $_POST['tipo'];
		}


		$capacidad = "";
		if($_POST['nueva_capacidad'] != ""){ 
			$sql = $ini->consulta("insert into cz_capacidad (titulo_es) value ('".$_POST['nueva_capacidad']."')");
			$capacidad = $ini->ultimoid();
		}elseif($_POST['capacidad'] != ""){
			$capacidad = $_POST['capacidad'];
		}


		$alcohol = $ini->real_scape($_POST['alcohol']);

		$color = "";
		if($_POST['nueva_color'] != ""){ 
			$sql = $ini->consulta("insert into cz_color (titulo_es) value ('".$_POST['nueva_color']."')");
			$color = $ini->ultimoid();
		}elseif($_POST['color'] != ""){
			$color = $_POST['color'];
		}

		$ibus = $ini->real_scape($_POST['ibus']);

		$ebc = "";
		if($_POST['nueva_ebc'] != ""){ 
			$sql = $ini->consulta("insert into cz_ebc (titulo_es) value ('".$_POST['nueva_ebc']."')");
			$ebc = $ini->ultimoid();
		}elseif($_POST['ebc'] != ""){
			$ebc = $_POST['ebc'];
		}

		$fermentacion = "";
		if($_POST['nueva_fermentacion'] != ""){ 
			$sql = $ini->consulta("insert into cz_fermentacion (titulo_es) value ('".$_POST['nueva_fermentacion']."')");
			$fermentacion = $ini->ultimoid();
		}elseif($_POST['fermentacion'] != ""){
			$fermentacion = $_POST['fermentacion'];
		}

		$consumo = $ini->real_scape($_POST['consumo']);




		$ssql = $ini->consulta("insert into cerveza (id_cerveza,marca,denominacion,pais,provincia,municipio,productor,tipo,capacidad,alcohol,color,ibus,ebc,fermentacion,consumo,adicional,destacado) value ('".$ultimoid."','".$marca."','".$denominacion."','".$pais."','".$provincia."','".$municipio."','".$productor."','".$tipo."','".$capacidad."','".$alcohol."','".$color."','".$ibus."','".$ebc."','".$fermentacion."','".$consumo."','".$_POST['adicional']."','".$destacado."')");



		$i = 1;





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

		$i = 1;




		$ssql = $ini->consulta("insert into redes_es (id,titf,desf,imgf,titt,dest,imgt) value ('".$ultimoid."','".$ini->real_scape($_POST['titf'])."','".$ini->real_scape($_POST['desf'])."','".$imgf."','".$ini->real_scape($_POST['titt'])."','".$ini->real_scape($_POST['dest'])."','".$imgt."')");


		$ssql = $ini->consulta("select * from url_amg where seccion = '28'");
		while($rreg = $ini->fetch_object($ssql)){
			$sqk = $ini->consulta("select * from union_ngc_crvz where id_negocio = '".$rreg->id."' and id_cerveza = '".$ultimoid."'");
			if($_POST['ngc'.$rreg->id] == 1){
				if($ini->num_rows($sqk) == 0){
					$sqlinsert = $ini->consulta("insert into union_ngc_crvz (id_cerveza,id_negocio) value ('".$ultimoid."','".$rreg->id."')");
				}
			}else{
				if($ini->num_rows($sqk) > 0){
					$sqlinsert = $ini->consulta("delete from union_ngc_crvz where id_negocio = '".$rreg->id."' and id_cerveza = '".$ultimoid."'");
				}
			}
		}


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
			$imagen = $urlppal."/imagen".$dir.$name;
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
		$destacado = isset($_POST['destacado']) ? 1 : 0;

			$sql = $ini->consulta("select * from url_amg_lang where id_url_amg = '".$_POST['id']."' and lang = '".$_POST['idioma']."'"); if($ini->num_rows($sql) > 0){ 
			$sql = $ini->consulta("update url_amg_lang set url_amg = '".$url_amg."', titulo = '".$_POST['name']."', metas = '".$_POST['mtit']."/**/".$_POST['mdes']."/**/".$_POST['mkey']."', contenido = '".$contenido."', titalt = '".$titalt."' where id_url_amg = '".$_POST['id']."' and lang = '".$_POST['idioma']."'");	
		}else{
			$sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido) value ('".$_POST['id']."','".$_POST['idioma']."','".$url_amg."','".$_POST['name']."','".$_POST['mtit']."/**/".$_POST['mdes']."/**/".$_POST['mkey']."','".$_POST['texto']."')");
		}
		$sql = $ini->consulta("update url_amg set activo = '".$activo."' where id = '".$_POST['id']."'");
		


		

		$marca = "";
		if($_POST['nueva_marca'] != ""){ 
			$sql = $ini->consulta("insert into cz_marca (titulo_es) value ('".$_POST['nueva_marca']."')");
			$marca = $ini->ultimoid();
		}elseif($_POST['marca'] != ""){
			$marca = $_POST['marca'];
		}

		$denominacion = $ini->real_scape($_POST['denominacion']);

		$pais = "";
		if($_POST['nueva_pais'] != ""){  
			$sql = $ini->consulta("insert into pais (pais) value ('".$_POST['nueva_pais']."')");
			$pais = $ini->ultimoid();
		}elseif($_POST['pais'] != ""){
			$pais = $_POST['pais'];
		}



		$provincia = "";
		if($_POST['nueva_provincia'] != ""){  
			$sql = $ini->consulta("insert into provincias (id_pais,provincia) value ('".$pais."',".$_POST['nueva_provincia']."')");
			$provincia = $ini->ultimoid();
		}elseif($_POST['provincia'] != ""){
			$provincia = $_POST['provincia'];
		}


		$municipio = "";
		if($_POST['nueva_municipio'] != ""){  
			$sql = $ini->consulta("insert into municipios (IdProvincia,Nombre) value ('".$provincia."',".$_POST['nueva_municipio']."')");
			$municipio = $ini->ultimoid();
		}elseif($_POST['municipio'] != ""){
			$municipio = $_POST['municipio'];
		}



		$productor = "";
		if($_POST['nueva_productor'] != ""){ 
			$sql = $ini->consulta("insert into cz_productor (titulo_es) value ('".$_POST['nueva_productor']."')");
			$productor = $ini->ultimoid();
		}elseif($_POST['productor'] != ""){
			$productor = $_POST['productor'];
		}

		$tipo = "";
		if($_POST['nueva_tipo'] != ""){ 
			$sql = $ini->consulta("insert into cz_tipo (titulo_es) value ('".$_POST['nueva_tipo']."')");
			$tipo = $ini->ultimoid();
		}elseif($_POST['tipo'] != ""){
			$tipo = $_POST['tipo'];
		}


		$capacidad = "";
		if($_POST['nueva_capacidad'] != ""){ 
			$sql = $ini->consulta("insert into cz_capacidad (titulo_es) value ('".$_POST['nueva_capacidad']."')");
			$capacidad = $ini->ultimoid();
		}elseif($_POST['capacidad'] != ""){
			$capacidad = $_POST['capacidad'];
		}


		$alcohol = $ini->real_scape($_POST['alcohol']);

		$color = "";
		if($_POST['nueva_color'] != ""){ 
			$sql = $ini->consulta("insert into cz_color (titulo_es) value ('".$_POST['nueva_color']."')");
			$color = $ini->ultimoid();
		}elseif($_POST['color'] != ""){
			$color = $_POST['color'];
		}

		$ibus = $ini->real_scape($_POST['ibus']);

		$ebc = "";
		if($_POST['nueva_ebc'] != ""){ 
			$sql = $ini->consulta("insert into cz_ebc (titulo_es) value ('".$_POST['nueva_ebc']."')");
			$ebc = $ini->ultimoid();
		}elseif($_POST['ebc'] != ""){
			$ebc = $_POST['ebc'];
		}

		$fermentacion = "";
		if($_POST['nueva_fermentacion'] != ""){ 
			$sql = $ini->consulta("insert into cz_fermentacion (titulo_es) value ('".$_POST['nueva_fermentacion']."')");
			$fermentacion = $ini->ultimoid();
		}elseif($_POST['fermentacion'] != ""){
			$fermentacion = $_POST['fermentacion'];
		}

		$consumo = $ini->real_scape($_POST['consumo']);





			$sql = $ini->consulta("update cerveza set marca = '".$marca."', denominacion = '".$denominacion."', pais = '".$pais."', provincia = '".$provincia."', municipio = '".$municipio."', productor = '".$productor."', tipo = '".$tipo."', capacidad = '".$capacidad."', alcohol = '".$alcohol."', color = '".$color."', ibus = '".$ibus."', ebc = '".$ebc."', fermentacion = '".$fermentacion."', consumo = '".$consumo."', adicional = '".$_POST['adicional']."', destacado = '".$destacado."' where id_cerveza = '".$_POST['id']."'");





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
				$imagen = $urlppal."/imagen".$dir.$name;
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


		$ssql = $ini->consulta("select * from url_amg where seccion = '28'");
		while($rreg = $ini->fetch_object($ssql)){
			$sqk = $ini->consulta("select * from union_ngc_crvz where id_negocio = '".$rreg->id."' and id_cerveza = '".$_POST['id']."'");
			if($_POST['ngc'.$rreg->id] == 1){
				if($ini->num_rows($sqk) == 0){
					$sqlinsert = $ini->consulta("insert into union_ngc_crvz (id_cerveza,id_negocio) value ('".$_POST['id']."','".$rreg->id."')");
				}
			}else{
				if($ini->num_rows($sqk) > 0){
					$sqlinsert = $ini->consulta("delete from union_ngc_crvz where id_negocio = '".$rreg->id."' and id_cerveza = '".$_POST['id']."'");
				}
			}
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