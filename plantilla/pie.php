<footer>
	

	<div class="footer">
		<div class="contenido row">
			
			<div class="col-sm-3">
				<div class="menu-footer-1">
					<b>Menú</b>
					<p><a href="<?php echo $urlppal; ?>">Inicio</a></p>
					<p><a href="<?php echo $urlppal; ?>">Rankings</a></p>
					<p><a href="<?php echo $urlppal; ?>">Eventos</a></p>
					<p><a href="<?php echo $urlppal; ?>">Planes de precios</a></p>
					<p><a href="<?php echo $urlppal; ?>">Tiendas</a></p>
					<p><a href="<?php echo $urlppal; ?>">Blog</a></p>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="menu-footer-2">
					<b>Entradas recientes</b>
					<?php $sqlf = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '26' and activo = '1' limit 6");
					while($regf = $ini->fetch_object($sqlf)){
						?><p><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',26,'lang',1)."/".$regf->url_amg; ?>"><?php echo $regf->titulo; ?></a></p><?php
					} ?>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="menu-footer-3">
					<b>Negocios</b>
					<?php $sqln = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '28' and activo = '1' limit 6");
					while($regn = $ini->fetch_object($sqln)){
						?><p><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regn->url_amg; ?>"><?php echo $regn->titulo; ?></a></p><?php
					} ?>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="menu-footer-4">
					<b>Hablemos en Facebook</b>
					<p>Timeline de Facebook</p>
				</div>
			</div>

		</div>
	</div>

	<div class="sub-footer">
		<div class="contenido row">
			
			<div class="col-sm-6">

				<div class="row">

					<div class="col-sm-3 logo-footer">
						<img src="<?php echo $ini->selectcampo(34,'opciones','value'); ?>" title="Logotipo Cervezas Málaga" alt="Logotipo Cervezas Málaga" />
					</div>

					<div class="col-sm-9">

						<div class="titulo-redes">
							Síguenos
						</div>

						<div class="enlaces-redes">
						<?php foreach($redes as $id_redes=>$red){ $img_red = $ini->selectcampo($id_redes,'opciones','value'); ?>
						    <?php if($img_red != ""){ ?>
								<div class="icono-redes"><a target="_blank" href="<?php echo $img_red; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/".$red.".png" ?>" alt="<?php echo $red." ".$titzft; ?>" title="<?php echo $red." ".$titzft; ?>" /></a></div>
							<?php } ?>
						<?php } ?>
						</div>

					</div>

				</div>

			</div>

			<div class="col-sm-6 condiciones">



				<?php
				$sql = $ini->consulta("select url_amg_lang.url_amg, url_amg_lang.titulo, url_amg.subsecc, url_amg.id as ids, menu.id as idm from menu inner join url_amg on menu.url_amg = url_amg.id inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id where url_amg_lang.lang = '".$ini->lang."' and menu.tipo = '2' order by menu.orden asc");
				$ultimo = $ini->num_rows($sql); $i = 1;
				while($reg = $ini->fetch_object($sql)){ ?>
					
						<a title="<?php echo $reg->titulo; ?>" href="<?php echo $urlppal.$reg->url_amg; ?>"><?php echo $reg->titulo; ?></a><?php if($i != $ultimo){ echo ' <font class="bull">·</font> '; }  ?>

				<?php $i++; } ?>


				
			</div>

		</div>
	</div>


</footer>