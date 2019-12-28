
<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick-theme.css" />
<script src="<?php echo $urlppal; ?>plantilla/js/slick.js?<?php echo $ini->aleatorio(); ?>" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).on('ready', function() {
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4
      });
      $(".single-item").slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
      });
    });	
</script>



<section>

	<div class="contenido" style="text-align:center;background:#fff;">

	<?php 
		if(isset($_SESSION['mail_activo'])){ 		unset($_SESSION['mail_activo']); 		echo '<font class="ok">Email activado</font>';  }
		if(isset($_SESSION['mensaje-facebook'])){	unset($_SESSION['mensaje-facebook']);	echo '<font class="ok">Inicio sesión con facebook completado</font>';  }
	?>
		
		<div class="partes-web caja-2 row">
			<div class="zona-banda row">
				<div class="banda">
					<div class="buscar-lupa"><img src="<?php echo $urlppal; ?>imagen/redescabecera/icono-buscar-lupa-banda.png" alt="icono buscar lupa" title="Buscar cervezas en localidades" /></div>
					<div class="titular">Buscar cervezas en localidades</div>
				</div>
				<div class="texto">Tus cervezas favoritas a un solo click</div>
		    </div>
		    <div class="slide row">
				<div class="container">
					<div class="row">
						<section class="regular slider">
						<?php $ids = $ini->selectcampo(29,'opciones','value');
						if($ids != ""){
							$id_localidades = explode(",",$ids);
							foreach($id_localidades as $id){ 
        						$sqldts = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$id."' and lang = '1'"); 
        						$regdts = $ini->fetch_object($sqldts); $titalt = explode("/**/",$regdts->titalt); ?>
							    <div>
							      <img src="<?php echo $regdts->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
							      <div class="titular-zonas"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','32','lang','1')."/".$regdts->url_amg; ?>"><?php echo $regdts->titulo; ?></a></div>
							    </div>
							<?php } 
						} ?>
  						</section>
					</div>
				</div>
		    </div>
		</div>

		<div class="partes-web caja-1 row">
			<div class="zona-banda row">
				<div class="banda">
					<div class="ubicacion"><img src="<?php echo $urlppal; ?>imagen/redescabecera/icono-ubicacion-banda.png" alt="icono ubicacion" title="Los mejores negocios en la ciudad" /></div>
					<div class="titular">Los mejores negocios en la ciudad</div>
				</div>
				<div class="texto">Encuentra los mejores negocios con tus cervezas favoritas</div>
		    </div>
		    <div class="slide row">

		    	<?php
		    		$id1 = $ini->selectcampo(30,'opciones','value');
		    		$id2 = $ini->selectcampo(31,'opciones','value');
		    		$id3 = $ini->selectcampo(32,'opciones','value');
		    		$id4 = $ini->selectcampo(33,'opciones','value');

		    		$sql1 = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$id1."' and lang = '1'"); 
        			$regdts = $ini->fetch_object($sql1); $titalt = explode("/**/",$regdts->titalt);
		    	?>

		    	<div class="imagen categoria-cerveza">
		    		<img src="<?php echo $regdts->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
		    		<div class="imagen-titular"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','33','lang','1')."/".$regdts->url_amg; ?>" class="boton"><?php echo $regdts->titulo; ?></a></div>
		    	</div>

		    	<?php
		    		$sql1 = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$id2."' and lang = '1'"); 
        			$regdts = $ini->fetch_object($sql1); $titalt = explode("/**/",$regdts->titalt);
		    	?>

		    	<div class="imagen categoria-burguer">
		    		<img src="<?php echo $regdts->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
		    		<div class="imagen-titular"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','33','lang','1')."/".$regdts->url_amg; ?>" class="boton"><?php echo $regdts->titulo; ?></a></div>
		    	</div>

		    	<div class="categoria-pizza-cocktails">

		    	<?php
		    		$sql1 = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$id3."' and lang = '1'"); 
        			$regdts = $ini->fetch_object($sql1); $titalt = explode("/**/",$regdts->titalt);
		    	?>

		    		<div class="imagen categoria-pizza">
		    			<img src="<?php echo $regdts->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
		    			<div class="imagen-titular"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','33','lang','1')."/".$regdts->url_amg; ?>" class="boton"><?php echo $regdts->titulo; ?></a></div>
		    		</div>

		    	<?php
		    		$sql1 = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$id4."' and lang = '1'"); 
        			$regdts = $ini->fetch_object($sql1); $titalt = explode("/**/",$regdts->titalt);
		    	?>

		    		<div class="imagen categoria-cocktails">
		    			<img src="<?php echo $regdts->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
		    			<div class="imagen-titular"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','33','lang','1')."/".$regdts->url_amg; ?>" class="boton"><?php echo $regdts->titulo; ?></a></div>
		    		</div>

		    	</div>
		    </div>
		</div>
		<div class="enlace-categorias contenido row"><a class="btn" href="#">Encuentra más negocios</a></div>

		<div class="partes-web caja-3 row">
			<div class="zona-banda row">
				<div class="banda-s">
					<div class="cervezas"><img src="<?php echo $urlppal; ?>imagen/redescabecera/icono-cervezas.png" alt="icono cervezas" title="Top 5 Cervezas" /></div>
					<div class="titular">Top 5 Cervezas</div>
				</div>
		    </div>
		    <div class="slide row">
		    	<section class="single-item">
					<?php $sql1 = $ini->consulta("select url_amg, titulo, contenido, titalt, thumbs from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id inner join cerveza on url_amg_lang.id_url_amg = cerveza.id_cerveza where destacado = '1' and lang = '1'");
					while($reg1 = $ini->fetch_object($sql1)){ $titalt = explode("/**/",$reg1->titalt); ?>
		    		<div>
		    			<div class="caja-cervezas row">
			    			<div class="imagen col-sm-3">
			    				<img src="<?php echo $reg1->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
			    			</div>
			    			<div class="informacion col-sm-9">
			    				<div class="titular"><?php echo $reg1->titulo; ?></div>
			    				<div class="texto">
			    					<?php echo $reg1->contenido; ?>
			    				</div>
			    				<div class="enlaces">
			    					<a class="btn" href="#">Ver Ranking</a> <a class="btn" href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','27','lang','1')."/".$reg1->url_amg; ?>">Ver ficha</a> 
			    				</div>
			    			</div>
		    			</div>
		    		</div>
					<?php } ?>
		    	</section>
		    </div>
		</div>

	</div>
</section>
