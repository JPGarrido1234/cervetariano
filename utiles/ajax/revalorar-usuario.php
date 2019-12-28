<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php"); ?>
			<form id="enviar-valoracion-usuario" method="post">
			<input type="hidden" name="id_usuario" value="<?php echo $ini->id_conectado; ?>" />	
			<input type="hidden" name="id_usu_amg" value="<?php echo $_POST['id_usuario']; ?>" />
			<div class="caja-borde comentario">
				<div class="contenido-caja">
					<div class="row">
						<div class="col-sm-5">
							<div class="titulo"><span class="icono"><i class="fa fa-star-o fa-fw"></i></span> <span class="texto">Valorar</span></div>
							<div class="row zona-votar">
								<div class="col-sm-6">
									<div class="votar-cerveza">
										<p>Variedad de<br />cervezas</p>
										<div class="margb">
											<div>
												<ul class="votacion" style="width:150px;">
													<li id="barracerveza" class="barra" style="width:0px;">Currently 3.68/5</li>
													<li><a onclick="votar(1,'cerveza');" class="voto1">1</a></li>
													<li><a onclick="votar(2,'cerveza');" class="voto2">2</a></li>
													<li><a onclick="votar(3,'cerveza');" class="voto3">3</a></li>
													<li><a onclick="votar(4,'cerveza');" class="voto4">4</a></li>
													<li><a onclick="votar(5,'cerveza');" class="voto5">5</a></li>
												</ul>
											</div>
										</div>
										<input type="hidden" value="0" name="cerveza" id="cerveza" />
									</div>
									<div class="votar-malaga">
										<p>Variedad de<br />Cervezas Málaga</p>
										<div class="margb">
											<div>
												<ul class="votacion" style="width:150px;">
													<li id="barramalaga" class="barra" style="width:0px;">Currently 3.68/5</li>
													<li><a onclick="votar(1,'malaga');" class="voto1">1</a></li>
													<li><a onclick="votar(2,'malaga');" class="voto2">2</a></li>
													<li><a onclick="votar(3,'malaga');" class="voto3">3</a></li>
													<li><a onclick="votar(4,'malaga');" class="voto4">4</a></li>
													<li><a onclick="votar(5,'malaga');" class="voto5">5</a></li>
												</ul>
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
												<ul class="votacion" style="width:150px;">
													<li id="barraartesanales" class="barra" style="width:0px;">Currently 3.68/5</li>
													<li><a onclick="votar(1,'artesanales');" class="voto1">1</a></li>
													<li><a onclick="votar(2,'artesanales');" class="voto2">2</a></li>
													<li><a onclick="votar(3,'artesanales');" class="voto3">3</a></li>
													<li><a onclick="votar(4,'artesanales');" class="voto4">4</a></li>
													<li><a onclick="votar(5,'artesanales');" class="voto5">5</a></li>
												</ul>
											</div>
										</div>
										<input type="hidden" value="0" name="artesanales" id="artesanales" />
									</div>
									<div class="votar-local">
										<p>Experiencia<br />en el Local</p>
										<div class="margb">
											<div>
												<ul class="votacion" style="width:150px;">
													<li id="barralocal" class="barra" style="width:0px;">Currently 3.68/5</li>
													<li><a onclick="votar(1,'local');" class="voto1">1</a></li>
													<li><a onclick="votar(2,'local');" class="voto2">2</a></li>
													<li><a onclick="votar(3,'local');" class="voto3">3</a></li>
													<li><a onclick="votar(4,'local');" class="voto4">4</a></li>
													<li><a onclick="votar(5,'local');" class="voto5">5</a></li>
												</ul>
											</div>
										</div>
										<input type="hidden" value="0" name="local" id="local" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="titulo"><span class="icono"><i class="la la-comments"></i></span> <span class="texto">Comentarios</span></div>
							<div class="row">
								<div class="col-sm-12"><textarea class="form-control" name="comentario" placeholder="Comentario" rows="5"></textarea></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<bottom onclick="enviardatos()" class="btn-enviar enviardenuevo">Enviar</bottom>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
<script>

	  function enviardatos(){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/valorar-usuario.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-valoracion-usuario').serialize(), success: function(data){ $('#ver-valoraciones').html(data); } });
      }

</script>
