<?php 
session_start(); 
$bug = 0; 
if($bug == 0){ 
    error_reporting(0); 
}else{ 
    ini_set('display_error', 1); 
} 
include("../php/iniciar.php");

$userBusness = false;
$sql = $ini->consulta("SELECT id_negocio FROM negocio WHERE email = '".$ini->real_scape($_POST['email'])."' AND pass = '".md5($_POST['passwd'])."'");
$sqlActive = $ini->consulta("SELECT activo FROM negocio WHERE email = '".$ini->real_scape($_POST['email'])."'");
$regActive = $ini->fetch_object($sqlActive);

if($ini->num_rows($sql) > 0){
    if($regActive->activo == '1'){
        $userBusness = true;
        $reg = $ini->fetch_object($sql); 
        $id_negocio = $ini->encriptar($reg->id_negocio,$baz);
        if(isset($_POST['cookie'])){ 
            setcookie('user-web-'.$userzb, $id_negocio, time() + 365 * 24 * 60 * 60,"/"); 
        }else{ 
            $_SESSION['user-web-'.$GLOBALS['userzb']] = $id_negocio; 
        }
    }else{
        echo "El negocio no está activo. Revise su correo para la activación.";
    }
}else{
    echo "No existe negocio con esos datos..";
}

if($userBusness){
?>
    <script>
		$('#insertar-negocio').removeAttr("data-target");
		$('#insertar-negocio').removeAttr("data-toggle");
		$('#insertar-negocio').addClass("mostrar-menu-negocio");
		$('.cerrar-modal-negocio').click();
    </script>
<?php
}

?>