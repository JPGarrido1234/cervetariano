<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } if($_POST){ include('iniciar.php'); 
	if($_POST['formu'] == 'logg'){ $sql = $ini->consulta("select * from usuarios"); $encuentra = false;
		while($reg = $ini->fetch_object($sql)){ if($reg->usu == $_POST['usu'] && $reg->pass == md5($_POST['pass'])){ $encuentra = true; $id = $reg->id; } }
		if($encuentra){ if($_POST['remember'] == "si"){ setcookie('user-'.$GLOBALS['userzft'], $id, time() + 365 * 24 * 60 * 60,"/");  }else{	$_SESSION['user-'.$GLOBALS['userzft']] = $id; } 
		header("location: ../../".$rutadmin."/admin.php"); exit();
		}else{ header("location: ../../".$rutadmin."/index.php?error=1113"); exit(); }
	}elseif($_POST['formu'] == 'pass'){ $sql = $ini->consulta("select id, usu, email from usuarios where email = '".$_POST['email']."'");
		if($ini->num_rows($sql) > 0){ $reg = $ini->fetch_object($sql);
			$headers = "From: ".$reg->email."\r\n"; $headers .= "MIME-Version: 1.0\r\n"; $headers .= "Content-type: text/plain; charset=UTF-8\r\n";
			$asunto = "Recuperar contraseña"; $newpass = md5(rand().time()); $cuerpo = "Hola ".$reg->usu.".\r\n Su nueva contraseña es: ".$newpass;
			mail($reg->email,'=?UTF-8?B?'.base64_encode($asunto).'?=',$cuerpo,$headers);
			$ssql = $ini->consulta("update usuarios set pass = '".md5($newpass)."' where id = '".$reg->id."'"); header("location: ../../".$rutadmin."/index.php?env=pass"); exit();
		} header("location: ../../".$rutadmin."/index.php?error=1112"); exit(); }else{ header("location: ../../".$rutadmin."/index.php?error=1113"); exit(); }
}else{ header("location: ../../".$rutadmin."/index.php?error=1111"); exit(); }
?>