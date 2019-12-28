<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php");

if($ini->conectado){

$sql = $ini->consulta("select id_usuario from valoracion_sr where id_url_amg = '".$_POST['id_usu_amg']."' and id_usuario = '".$ini->desencriptar($_POST['id_usuario'],$baz)."'");

$comentario=str_replace("\r\n","<br>",$_POST['comentario']);
$comentario = $ini->real_scape($comentario);

if($ini->num_rows($sql) > 0){
	$sql = $ini->consulta("update valoracion_sr set comentario = '".$comentario."', voto1 = '".$_POST['cerveza']."', voto2 = '".$_POST['artesanales']."', voto3 = '".$_POST['malaga']."', voto4 = '".$_POST['local']."' where id_url_amg = '".$_POST['id_usu_amg']."' and id_usuario = '".$ini->desencriptar($_POST['id_usuario'],$baz)."'");
}else{
	$sql = $ini->consulta("insert into valoracion_sr (id_url_amg,id_usuario,comentario,voto1,voto2,voto3,voto4) value ('".$_POST['id_usu_amg']."','".$ini->desencriptar($_POST['id_usuario'],$baz)."','".$comentario."','".$_POST['cerveza']."','".$_POST['artesanales']."','".$_POST['malaga']."','".$_POST['local']."')");
}
?>
				<div class="caja-borde comentario">
				<div class="contenido-caja">
					<div class="row">
						<div class="col-sm-5">
							<div class="titulo"><span class="icono"><i class="fa fa-thumbs-o-up fa-fw"></i></span> <span class="texto">Usuario valorado</span></div>
							<div class="row zona-votar">
								<div class="col-sm-6">
									<div class="votar-cerveza">
										<p>Variedad de<br />cervezas</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['cerveza']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="cerveza" id="cerveza" />
									</div>
									<div class="votar-malaga">
										<p>Variedad de<br />Cervezas Málaga</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['malaga']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="malaga" id="malaga" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="votar-artesanales">
										<p>Variedades de<br />Artesanales</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['artesanales']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="artesanales" id="artesanales" />
									</div>
									<div class="votar-local">
										<p>Experiencia<br />en el Local</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['local']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="local" id="local" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="titulo"><span class="icono"><i class="la la-comments"></i></span> <span class="texto">Tu comentario</span></div>
							<div class="row">
								<div class="col-sm-12 comentado"><?php echo $comentario; ?></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
<?php }else{ ?>

No se ha conectado, necesita conectarse para poder hacer una valoración

<?php } ?>

