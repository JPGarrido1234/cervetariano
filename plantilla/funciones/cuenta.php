<?php
if($_POST['modo'] == "modificar"){
	include("utiles/php/admin.php"); $ad = new admin(); $imagen = ""; $_SESSION['mensaje'] = "ok";
	if($_FILES['archivo']['tmp_name'] != ""){
		$dir = "/usuarios/"; $arralta = explode("/",$_FILES['archivo']['type']); $ext = strtolower($arralta[1]);
		if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
			$_SESSION['mensaje'] = "Error al insertar la extensión del archivo, extensiones permitidas: gif, jpg y png";
		}
		$name = $ad->cambiaralfn($_FILES['archivo']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
		while($sigue){ $sigue = false;
			foreach(glob("imagen".$dir."*") as $archivos_carpeta){
				if("imagen".$dir.$name == $archivos_carpeta){ $name = $namec; $sigue = true; $name = $e.$name; $e++; }
			}
		}
		if($_SESSION['mensaje'] == "ok"){
			if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"imagen".$dir.$name)){	
				$_SESSION['mensaje'] = "Error al insertar la imagen, error de servidor, intentelo dentro de unos minutos o contacte con el equipo de Cervezas Málaga.";
			}
		}
		$imagen = getimagesize("imagen".$dir.$name); $ai = $imagen[0]; $ali = $imagen[1];
		if($ai > 3000 and $ali > 3000){
			 unlink("imagen".$dir.$name); 
			 $_SESSION['mensaje'] = "Error en las dimensiones de la imagen, no son admitidas las imágenes con dimensiones mayores de 3000 píxeles.";
		}
		if($_SESSION['mensaje'] == "ok"){
			$imagen = $urlppal."imagen".$dir.$name; $sql = $ini->consulta("update usuarios_web set thumb = '".$imagen."' where id = '".$_POST['id']."'");
		}
	}
	$fecha = date("Y-m-d H:i:s"); $id_pais = $_POST['pais'] ? $_POST['pais'] : 0;
	$id_prov = $_POST['provincia'] ? $_POST['provincia'] : 0; $id_mun = $_POST['municipio'] ? $_POST['municipio'] : 0;
	$sql = $ini->consulta("update usuarios_web set fecha_u = '".$fecha."', nombre = '".$ini->real_scape($_POST['name'])."', apellidos = '".$ini->real_scape($_POST['apellido'])."', email = '".$ini->real_scape($_POST['email'])."', descripcion = '".$ini->real_scape($_POST['des_c'])."', eslogan = '".$ini->real_scape($_POST['eslogan'])."', ubicacion = '".$ini->real_scape($_POST['ubicacion'])."', pais = '".$id_pais."', provincia = '".$id_prov."', municipio = '".$id_mun."', facebook = '".$ini->real_scape($_POST['facebook'])."', twitter = '".$ini->real_scape($_POST['twitter'])."', instagram = '".$ini->real_scape($_POST['instagram'])."', pinterest = '".$ini->real_scape($_POST['pinterest'])."', youtube = '".$ini->real_scape($_POST['youtube'])."', linkedin = '".$ini->real_scape($_POST['linkedin'])."' where id = '".$_POST['id']."'");
	if($_POST['passwd'] != ""){ 
		$pass = md5($_POST['passwd']); $sql = $ini->consulta("update usuarios_web set pass = '".$pass."' where id = '".$_POST['id']."'");
	}
	$sql = $ini->consulta("select id from url_amg where usuario = '".$_POST['id']."'"); $reg = $ini->fetch_object($sql); $id_url = $reg->id;
	$sql = $ini->consulta("update url_amg_lang set titulo = '".$nombre."' where id_url_amg = '".$id_url."' and lang = '1'");
	header("location: ".$urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',245,'lang',1));
	exit();
} ?>