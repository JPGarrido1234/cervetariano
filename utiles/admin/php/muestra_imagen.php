<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();

if($_POST['url_img'] != "" and $_POST['carpeta'] != ""){
	$img = str_replace($urlppal, "../../../", $_POST['url_img']);
	unlink($img);
	$_POST['carpetabs'] = $_POST['carpeta'];
	$_POST['elcarpeta'] = "activo";
}

		if(isset($_POST['elcarpeta'])){
			$arbica = array();
			$sql = $ini->consulta("select id, carpeta, nombre_amg from carpetas"); 
			while($reg=$ini->fetch_object($sql)){
				if($reg->id == $_POST['carpetabs'] or $_POST['carpetabs'] == "todas"){
					$arbica[$reg->id] = array($reg->id,$reg->carpeta,$reg->nombre_amg); 
				} 
			} 
		} 

		$c = 0; 
		foreach($arbica as $e=>$val){ 
			foreach(glob("../../../imagen".$arbica[$e][1]."*") as $archivos_carpeta){ 
				if(!is_dir($archivos_carpeta)){ 
					$c++;
					$wh = getimagesize($archivos_carpeta);
					$archivos_carpeta = str_replace("../../../",$urlppal,$archivos_carpeta); ?>
  					<div class="col-sm-6 col-md-3 thumbnail">
    					<a href="<?php echo $archivos_carpeta; ?>" class="thumbnail" target="_blank">
      						<img src="<?php echo $archivos_carpeta; ?>" />
    					</a>
    					<a data-toggle="modal" class="func_ver_url" data-target="#modo_ver_url" id="<?php echo $archivos_carpeta; ?>" href="#">Ver url</a> | 
    					<a data-toggle="modal" class="func_eliminar" data-target="#modo_eliminar" id="<?php echo $archivos_carpeta; ?>" href="#"><i class="fa fa-recycle fa-fw"></i></a>
  					</div>
					<?php 
				} 
			} 
		} 
		 if($c == 0){ ?> - Sin Imágenes - <?php } ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.func_ver_url').click(function(){
			document.getElementById('ver_url_img').value = this.id;
		});
		$('.func_eliminar').click(function(){
			document.getElementById('url_img_form').value = this.id;
			var carpetaselec = document.getElementById('carpetaselec').value;
			document.getElementById('carpeta_form').value = carpetaselec;
		});
		
		$('.confirmar_elm_img').click(function(){
			var url = "../utiles/admin/php/muestra_imagen.php";
			$.ajax({ type: "POST", url: url, data: $('#confirmar_form_img').serialize(), success: function(data){ $('.ver_imagenes').html(data); } });
		});
	});
</script>