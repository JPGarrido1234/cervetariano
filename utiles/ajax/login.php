<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php");
$login = false;
$sql = $ini->consulta("select id from usuarios_web where email = '".$ini->real_scape($_POST['email'])."' and pass = '".md5($_POST['passwd'])."'");
if($ini->num_rows($sql) > 0){
	$login = true;
	$reg = $ini->fetch_object($sql); $id = $ini->encriptar($reg->id,$baz);
	if(isset($_POST['cookie'])){ setcookie('user-web-'.$userzft, $id, time() + 365 * 24 * 60 * 60,"/"); }else{ $_SESSION['user-web-'.$GLOBALS['userzft']] = $id; }
}
if($login){  ?>

	<script>
		
		
		$('#insertar-usuario').removeAttr("data-target");
		$('#insertar-usuario').removeAttr("data-toggle");
		$('#insertar-usuario').addClass("mostrar-menu-usu");
		$('.cerrar-modal-login').click();
		//$('#loginModal').modal('hide');
	</script>

<?php } ?>