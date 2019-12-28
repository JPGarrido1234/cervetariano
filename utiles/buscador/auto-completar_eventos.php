<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
//header('Content-Type" => application/json'); 
$adaux = "../php/"; include("../php/iniciar.php"); include('../php/admin.php'); $ad = new admin();
$query = $_POST['q'];
$idioma = $_POST['i'];

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '23'");
 while($reg=$ini->fetch_object($sql)){
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>5,"idioma"=>$idioma,"division"=>"1");
 }



echo json_encode($arrenvt);
?>