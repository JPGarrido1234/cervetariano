<?php $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
//header('Content-Type" => application/json'); 
$adaux = "../php/"; include("../php/iniciar.php"); include('../php/admin.php'); $ad = new admin();
$query = $_POST['q'];
$idioma = $_POST['i'];

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '33' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$sqlseccion = $ini->consulta("select url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id_url_amg = '28' and lang = '1'");
 	$regseccion = $ini->fetch_object($sqlseccion);
 	$seccion = $regseccion->url_amg; 	
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>33,"idioma"=>$idioma,"division"=>"fa fa-tags");
}

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '27' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$sqlseccion = $ini->consulta("select url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id_url_amg = '27' and lang = '1'");
 	$regseccion = $ini->fetch_object($sqlseccion);
 	$seccion = $regseccion->url_amg; 	
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>27,"idioma"=>$idioma,"division"=>"fa fa-beer");
}

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '3' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$sqlseccion = $ini->consulta("select url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id_url_amg = '3' and lang = '1'");
 	$regseccion = $ini->fetch_object($sqlseccion);
 	$seccion = $regseccion->url_amg;
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>3,"idioma"=>$idioma,"division"=>"la la-user");
}

 /*
 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '32' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>5,"idioma"=>$idioma,"division"=>"1");
}
*/

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '28' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$sqlseccion = $ini->consulta("select url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id_url_amg = '28' and lang = '1'");
 	$regseccion = $ini->fetch_object($sqlseccion);
 	$seccion = $regseccion->url_amg;
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>28,"idioma"=>$idioma,"division"=>"la la-cutlery");
}

 $sql = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '51' and lang = '1'");
 while($reg=$ini->fetch_object($sql)){
 	$sqlseccion = $ini->consulta("select url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id_url_amg = '51' and lang = '1'");
 	$regseccion = $ini->fetch_object($sqlseccion);
 	$seccion = $regseccion->url_amg; 	
 	$arrenvt[] = array("titulo"=>$reg->titulo,"archivo"=>$reg->archivo,"id"=>$reg->id,"se"=>51,"idioma"=>$idioma,"division"=>"fa fa-folder-open");
}


echo json_encode($arrenvt);
?>