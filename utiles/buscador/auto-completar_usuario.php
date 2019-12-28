<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
//header('Content-Type" => application/json'); 
$adaux = "../php/"; include("../php/iniciar.php"); include('../php/admin.php'); $ad = new admin();
$query = $_POST['q'];
$idioma = $_POST['i'];

 $sql = $ini->consulta("select usuarios_web.id as id, usuarios_web.nombre as usu, apellidos, email from usuarios_web");
 while($reg=$ini->fetch_object($sql)){
 	$arrenvt[] = array("titulo"=>$reg->usu." ".$reg->apellido,"archivo"=>$reg->email,"id"=>$reg->id,"se"=>5,"idioma"=>$idioma,"division"=>"1");
}

echo json_encode($arrenvt);
?>