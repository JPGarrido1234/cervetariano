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
	    $passwd = md5($_POST['passwd']);
	    $nombre = $ini->real_scape($_POST['name']);
	    $apellido = $ini->real_scape($_POST['apellido']);
	    $descripcion = $ini->real_scape($_POST['des_c']);
	    $eslogan = $ini->real_scape($_POST['eslogan']);
	    $ubicacion = $_POST['ubicacion'];
	    $metas = $ini->real_scape($_POST['mtit'])."/**/".$ini->real_scape($_POST['mdes'])."/**/".$ini->real_scape($_POST['mkey']);
		if($_POST['nueva_pais'] != ""){ 
			$sql = $ini->consulta("insert into pais (pais) value ('".$ini->real_scape($_POST['nueva_pais'])."')"); $id_pais = $ini->ultimoid(); 
		}else{
			$id_pais = $_POST['pais'];
		}

		if($_POST['nueva_provincia'] != ""){
			$provincia = $ini->real_scape($_POST['nueva_provincia']);
			$prov_amg = $ad->cambiaralfn($provincia);
			$sql = $ini->consulta("insert into provincias (id_pais,provincia,url_amg) value ('".$id_pais."','".$provincia."','".$prov_amg."')"); $id_prov = $ini->ultimoid();
		}else{
			$id_prov = $_POST['provincia'];
		}

		if($_POST['nueva_municipio'] != ""){
			$municipio = $ini->real_scape($_POST['nueva_municipio']);
			$mun_amg = $ad->cambiaralfn($municipio);
			$sql = $ini->consulta("insert into municipios (IdProvincia,Nombre,url_amg) value ('".$id_prov."','".$municipio."','".$mun_amg."')"); $id_mun = $ini->ultimoid();
		}else{
			$id_mun = $_POST['municipio'];
		}





		$sql = $ini->consulta("insert into usuarios_web (fecha_i,fecha_u,pass,activo,permiso,clave,confirma,nombre,apellidos,email,descripcion,eslogan,ubicacion,pais,provincia,municipio,thumb,url_amg,metas) values ('".$fecha."','".$fecha."','".$passwd."','".$activo."','".$_POST['permiso']."','','0','".$nombre."','".$apellido."','".$_POST['email']."','".$descripcion."','".$eslogan."','".$ubicacion."','".$id_pais."','".$id_prov."','".$id_mun."','".$imagen."','".$url_amg."','".$metas."')");
		$ultimoid = $ini->ultimoid();

		$sql = $ini->consulta("insert into url_amg (seccion,subsecc,plantilla,fecha,thumbs,activo,usuario) value ('3','0','17','".$fecha."','','1','".$ultimoid."')");
		$ultimoid = $ini->ultimoid();
		$contenido = str_replace("'","\'",$_POST['texto']);
		$sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido,titalt) value ('".$ultimoid."','1','".$url_amg."','".$nombre."','".$metas."','".$contenido."','".$titalt."')");

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
			$imagen = $urlppal."/imagen".$dir.$name;
			$sql = $ini->consulta("update usuarios_web set thumb = '".$imagen."' where id = '".$_POST['id']."'");
		}else{ 
			if($_POST['uimg'] != ""){ 
				$imagen = $_POST['uimg']; 
				$sql = $ini->consulta("update usuarios_web set thumb = '".$imagen."' where id = '".$_POST['id']."'");
			} 
		}
		
		
		$activo = isset($_POST['publicado']) ? 1 : 0;
		$fecha = date("Y-m-d H:i:s");
		$contenido = str_replace("'","\'",$_POST['texto']);
	    $passwd = md5($_POST['passwd']);
	    $nombre = $ini->real_scape($_POST['name']);
	    $apellido = $ini->real_scape($_POST['apellido']);
	    $descripcion = $ini->real_scape($_POST['des_c']);
	    $eslogan = $ini->real_scape($_POST['eslogan']);
	    $ubicacion = $_POST['ubicacion'];
	    $metas = $ini->real_scape($_POST['mtit'])."/**/".$ini->real_scape($_POST['mdes'])."/**/".$ini->real_scape($_POST['mkey']);

		if($_POST['nueva_pais'] != ""){ 
			$sql = $ini->consulta("insert into pais (pais) value ('".$ini->real_scape($_POST['nueva_pais'])."')"); $id_pais = $ini->ultimoid(); 
		}else{
			$id_pais = $_POST['pais'];
		}

		if($_POST['nueva_provincia'] != ""){
			$provincia = $ini->real_scape($_POST['nueva_provincia']);
			$prov_amg = $ad->cambiaralfn($provincia);
			$sql = $ini->consulta("insert into provincias (id_pais,provincia,url_amg) value ('".$id_pais."','".$provincia."','".$prov_amg."')"); $id_prov = $ini->ultimoid();
		}else{
			$id_prov = $_POST['provincia'];
		}

		if($_POST['nueva_municipio'] != ""){
			$municipio = $ini->real_scape($_POST['nueva_municipio']);
			$mun_amg = $ad->cambiaralfn($municipio);
			$sql = $ini->consulta("insert into municipios (IdProvincia,Nombre,url_amg) value ('".$id_prov."','".$municipio."','".$mun_amg."')"); $id_mun = $ini->ultimoid();
		}else{
			$id_mun = $_POST['municipio'];
		}

		$sql = $ini->consulta("update usuarios_web set fecha_u = '".$fecha."', activo = '".$activo."', permiso = '".$_POST['permiso']."', nombre = '".$nombre."', apellidos = '".$apellido."', email = '".$_POST['email']."', descripcion = '".$descripcion."', eslogan = '".$eslogan."', ubicacion = '".$_POST['ubicacion']."', pais = '".$id_pais."', provincia = '".$id_prov."', municipio = '".$id_mun."', url_amg = '".$url_amg."', metas = '".$metas."', facebook = '".$_POST['facebook']."', twitter = '".$_POST['twitter']."', instagram = '".$_POST['instagram']."', pinterest = '".$_POST['pinterest']."', youtube = '".$_POST['youtube']."', linkedin = '".$_POST['linkedin']."' where id = '".$_POST['id']."'");	





		if($_POST['passwd'] != ""){ 
			$pass = md5($_POST['passwd']);
			$sql = $ini->consulta("update usuarios_web set pass = '".$pass."' where id = '".$_POST['id']."'");
		}

		$sql = $ini->consulta("select id from url_amg where usuario = '".$_POST['id']."'");
		$reg = $ini->fetch_object($sql);
		$id_url = $reg->id;

		
		$contenido = str_replace("'","\'",$_POST['texto']);
		$sql = $ini->consulta("update url_amg_lang set url_amg = '".$url_amg."', titulo = '".$nombre."', metas = '".$metas."', contenido = '".$contenido."' where id_url_amg = '".$id_url."' and lang = '1' ");
		
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