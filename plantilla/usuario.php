<?php
$img_desconocida = $urlppal."imagen/redescabecera/desconocido.png";
$sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg inner join usuarios_web on url_amg.usuario = usuarios_web.id where url_amg.id = '".$ini->id_url_amg."'");
$reg = $ini->fetch_object($sql);
$titalt = explode("/**/",$reg->titalt); 
$nota = array(0=>"Muy Mala",1=>"Muy Mala",2=>"Mala",3=>"Regular",4=>"No está mal",5=>"Está bien",6=>"",7=>"Buena",8=>"Muy buena",9=>"Excelente",10=>"Perfecto");
$cerveza = 0;
$artesanales = 0;
$malaga = 0;
$local = 0;
$media = 0;
$clasificacion = "Sin calificar";

$sql = $ini->consulta("select * from valoracion_sr where id_url_amg = '".$ini->id_url_amg."'");

$num_valoraciones = $ini->num_rows($sql);
if($num_valoraciones > 0){
	while($reg2=$ini->fetch_object($sql)){
		$cerveza += $reg2->voto1;
		$artesanales += $reg2->voto2;
		$malaga += $reg2->voto3;
		$local += $reg2->voto4;
	}
$cerveza = ceil(($cerveza/$num_valoraciones)*2);
$artesanales = ceil(($artesanales/$num_valoraciones)*2);
$malaga = ceil(($malaga/$num_valoraciones)*2);
$local = ceil(($local/$num_valoraciones)*2);
$media = ceil(($cerveza+$artesanales+$malaga+$local)/4);
$clasificacion = $nota[$media];
}

$num_cervezas = 0;
$arr_cervezas = array();
$sqlsn = $ini->consulta("select id_negocio from union_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
while($regsu=$ini->fetch_object($sqlsn)){
	$sqlsc = $ini->consulta("select id_cerveza from union_ngc_crvz where id_negocio = '".$regsu->id_negocio."'");
	while($regsc = $ini->fetch_object($sqlsc)){
		$sqldts = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$regsc->id_cerveza."' and lang = '1'"); 
		$regdts = $ini->fetch_object($sqldts); $titalt = explode("/**/",$regdts->titalt); 

			$arr_cervezas[$num_cervezas]['thumbs'] = $regdts->thumbs;
			$arr_cervezas[$num_cervezas]['tit_img'] = $titalt[0];
			$arr_cervezas[$num_cervezas]['alt_img'] = $titalt[1];
			$arr_cervezas[$num_cervezas]['url'] = $regdts->url_amg;
			$arr_cervezas[$num_cervezas]['titulo'] = $regdts->titulo;
			$num_cervezas++;
     } 
 }

$num_locales = 0;
$arr_locales = array();
$sqlseguidos = $ini->consulta("select id_negocio from seguir_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
while($regseguidos = $ini->fetch_object($sqlseguidos)){
	$sqlslide = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$regseguidos->id_negocio."'"); 
	if($ini->num_rows($sqlslide) > 0){ 
		while($regslide = $ini->fetch_object($sqlslide)){
			$titalt = explode("/**/", $regslide->titalt);
			$arr_locales[$num_locales]['thumbs'] = $regslide->thumbs;
			$arr_locales[$num_locales]['img_tit'] = $titalt[0];
			$arr_locales[$num_locales]['img_alt'] = $titalt[1];
			$num_locales++;
		}
	}
}

$sql_seguidos = $ini->consulta("select id_seguido from seguir_sr_sr where id_seguidor = '".$ini->id_url_amg."'");
$num_seguidos = $ini->num_rows($sql_seguidos);
$sql_seg = $ini->consulta("select id_seguidor from seguir_sr_sr where id_seguido = '".$ini->id_url_amg."'");
$num_seguidores = $ini->num_rows($sql_seg);
$sql_recomen = $ini->consulta("select id_negocio from recomendar_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
$num_recomendaciones = $ini->num_rows($sql_recomen);
?>

<link rel="stylesheet" href="<?php echo $urlppal."plantilla/css/"; ?>jquery-pseudo-ripple.css" />
<link rel="stylesheet" href="<?php echo $urlppal."plantilla/css/"; ?>jquery-nao-calendar.css" />
<script src="<?php echo $urlppal."plantilla/js/"; ?>jquery-pseudo-ripple.js?v211112"></script>
<script src="<?php echo $urlppal."plantilla/js/"; ?>jquery-nao-calendar.js?v211112"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick-theme.css" />
<script src="<?php echo $urlppal; ?>plantilla/js/slick.js?<?php echo $ini->aleatorio(); ?>" type="text/javascript" charset="utf-8"></script>
<script>

    $('.myCalendar').calendar({
  		date: new Date(),
  		autoSelect: false, // false by default
  		select: function(date){
    		console.log('SELECT', date)
  		},
  		toggle: function(y, m) {
    		console.log('TOGGLE', y, m)
  		}
	});


    $(document).on('ready', function() {

   		<?php 
   		$sqle = $ini->consulta("select eventos.fecha, titulo from url_amg_lang inner join eventos on url_amg_lang.id_url_amg = eventos.id_evento inner join union_ngc_vnt on url_amg_lang.id_url_amg = union_ngc_vnt.id_evento where union_ngc_vnt.id_negocio = '".$ini->id_url_amg."'"); 
   		while($rege=$ini->fetch_object($sqle)){ if($rege->fecha != ""){ $date = explode("-",$rege->fecha); $fecha = $date[2]."-".$date[1]."-".$date[0];  ?>
   			$('#<?php echo $fecha; ?>').addClass("evento");
   			$('#<?php echo $fecha; ?>').attr("title","<?php echo $rege->titulo; ?>");
			$( "#<?php echo $fecha; ?>" ).click(function() {
		  		$( "#<?php echo $fecha; ?>-caja" ).toggle( "slow", function() { });
			});
		<?php } } ?>

		if(window.matchMedia('(max-width: 630px)').matches){

	      $(".regular").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 1,
	        slidesToScroll: 1
	      });

	      $(".regular2").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 1,
	        slidesToScroll: 1
	      });
	      $(".regular3").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 1,
	        slidesToScroll: 1
	      });
	      $(".regular4").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 1,
	        slidesToScroll: 1
	      });

		}else{

	      $(".regular").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 4,
	        slidesToScroll: 4
	      });
	      $(".regular2").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 3,
	        slidesToScroll: 3
	      });
	      $(".regular3").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 3,
	        slidesToScroll: 3
	      });
	      $(".regular4").slick({
	        dots: true,
	        infinite: true,
	        slidesToShow: 2,
	        slidesToScroll: 2
	      });
		}

      $('.ir_a.registradas').click(function(e){ 
      	e.preventDefault();
      		$('#ver-registradas').css("display","block");
      		$('#ver-votos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-locales').css("display","none");
      		$('#ver-fotos').css("display","none");
      		$('#ver-video').css("display","none");
      });
      $('.ir_a.valoraciones').click(function(e){ 
      	e.preventDefault();
      		$('#ver-registradas').css("display","none");
      		$('#ver-votos').css("display","none");
      		$('#ver-valoraciones').css("display","block");
      		$('#ver-locales').css("display","none");
      		$('#ver-fotos').css("display","none");
      		$('#ver-video').css("display","none");
      });
      $('.ir_a.locales').click(function(e){ 
      	e.preventDefault();
      		$('#ver-registradas').css("display","none");
      		$('#ver-votos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-locales').css("display","block");
      		$('#ver-fotos').css("display","none");
      		$('#ver-video').css("display","none");
      });
      $('.ir_a.fotos').click(function(e){
      	e.preventDefault();
      		$('#ver-registradas').css("display","none");
      		$('#ver-votos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-locales').css("display","none");
      		$('#ver-fotos').css("display","block");
      		$('#ver-video').css("display","none");
      });
      $('.ir_a.video').click(function(e){
      	e.preventDefault();
      		$('#ver-registradas').css("display","none");
      		$('#ver-votos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-locales').css("display","none");
      		$('#ver-fotos').css("display","none");
      		$('#ver-video').css("display","block");
      }); 

      $('.btn-enviar').click(function(event){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/valorar-usuario.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-valoracion-usuario').serialize(), success: function(data){ $('#ver-valoraciones').html(data); } });
      });
      $('.btn-reenviar').click(function(event){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/revalorar-usuario.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-valoracion-usuario').serialize(), success: function(data){ $('#ver-valoraciones').html(data); } });
      });

    $('.btn-compartir-caja').click(function(event){ 
      event.preventDefault();
      if($('.menu-compartir').css('opacity') == 1){
        $('.menu-compartir').css('opacity','0');
      }else{
        $('.menu-compartir').css('opacity','1');
      }
    });

      $('.btn-seguir').click(function(event){
      	event.preventDefault();

      	var url = "<?php echo $urlppal; ?>/utiles/ajax/seguir-usuario.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-id-usuario').serialize(), success: function(data){ $('.ajax').html(data); $('#btn-seguir').html('<i class="fa fa-thumbs-o-up fa-fw"></i> Siguiendo'); $('#btn-seguir').removeClass('btn-seguir'); $('#btn-seguir').addClass('btn-siguiendo') } });
      });
    });	

function votar(valor,donde){	
	var barra = document.getElementById('barra'+donde);
	var inputhi = document.getElementById(donde);
	var enviar;
	inputhi.value = valor;
	if(valor == 1){ enviar = 30; }
	if(valor == 2){ enviar = 60; }
	if(valor == 3){ enviar = 90; }
	if(valor == 4){ enviar = 120; }
	if(valor == 5){ enviar = 150; }
	barra.style.width = enviar+'px';
}

</script>

<form id="enviar-id-usuario" method="post"><input type="hidden" name="id_usuario" value="<?php echo $ini->id_url_amg; ?>" /></form>

<div class="ficha-usuario contenido">
	<div class="row usuario-cabecera">
		<div class="col-sm-6">
			<div class="row info-ppal">
				<div class="col-sm-3 logo-usuario">
					<?php if($reg->thumb != ""){ $img = $reg->thumb; }else{ $img = $img_desconocida; } ?>
					<img class="img-circle" src="<?php echo $img; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
				</div>
				<div class="col-sm-9 titulares">
					<div class="titulo-usuario"><?php echo $reg->nombre; ?> <?php echo $reg->apellidos; ?></div>
					<div class="eslogan-usuario"><?php echo $reg->contenido; ?></div>
					<div class="redes-negocio"> 
						<?php if($reg->facebook != ""){ ?> <a href="<?php echo $reg->facebook; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/facebook-gris.png" ?>" alt="visita nuestro facebook" title="Visita nuestro Facebook" /></a> <?php } ?>
						<?php if($reg->twitter != ""){ ?> <a href="<?php echo $reg->twitter; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/twitter-gris.png" ?>" alt="visita nuestro twitter" title="Visita nuestro twitter" /></a> <?php } ?>
						<?php if($reg->instagram != ""){ ?> <a href="<?php echo $reg->instagram; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/instagram-gris.png" ?>" alt="visita nuestro instagram" title="Visita nuestro instagram" /></a> <?php } ?>
						<?php if($reg->pinterest != ""){ ?> <a href="<?php echo $reg->pinterest; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/pinterest-gris.png" ?>" alt="visita nuestro pinterest" title="Visita nuestro pinterest" /></a> <?php } ?>
						<?php if($reg->youtube != ""){ ?> <a href="<?php echo $reg->youtube; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/youtube-gris.png" ?>" alt="visita nuestro youtube" title="Visita nuestro youtube" /></a> <?php } ?>
						<?php if($reg->linkedin != ""){ ?> <a href="<?php echo $reg->linkedin; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/linkedin-gris.png" ?>" alt="visita nuestro linkedin" title="Visita nuestro linkedin" /></a> <?php } ?>
						<?php $sqlid = $ini->consulta("select id from url_amg where usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'"); $regid = $ini->fetch_object($sqlid); $id_amg_usu = $regid->id;
						 $siguiendo = false; if(isset($ini->id_conectado)){ $sqls = $ini->consulta("select id_seguido from seguir_sr_sr where id_seguido = '".$ini->id_url_amg."' and id_seguidor = '".$id_amg_usu."'");
						 if($ini->num_rows($sqls) > 0){ $siguiendo = true; } } ?>
						<a id="btn-seguir" class="menu-btn<?php if(!$siguiendo){ ?> btn-seguir<?php }else{ ?> btn-siguiendo<?php } ?>" href="#">
							<?php if(!$siguiendo){ ?><i class="fa fa-arrow-right fa-fw"></i> Seguir<?php }else{ ?><i class="fa fa-thumbs-o-up fa-fw"></i> Siguiendo<?php } ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="col-sm-7">
					<div class="row caja-emblemas">
						<div class="col-sm-6 izquierda">
							<img src="<?php echo $urlppal; ?>imagen/emblemas/emblema1.jpg" />
						</div>
						<div class="col-sm-6 derecha">
							<img src="<?php echo $urlppal; ?>imagen/emblemas/emblema2.jpg" />
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="cualificado">Maestro cervecero</p>
						</div>
					</div>
				</div>
				<div class="col-sm-5 puntos">
					<p><b>Valoraciones</b> <?php echo $num_valoraciones; ?></p>
					<p><b>Recomendaciones</b> <?php echo $num_recomendaciones; ?></p>
					<p><b>Seguidores</b> <?php echo $num_seguidores; ?></p>
					<p><b>Seguidos</b> <?php echo $num_seguidos; ?></p>
					<p><b>Cervezas Registradas</b> <?php echo $num_cervezas; ?></p>
					<p><b>Registros en Locales</b> <?php echo $num_locales; ?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="menu-usuario">
		<a class="ir_a registradas" href="#ver-registradas"><i class="fa fa-glass fa-fw"></i><i class="fa fa-beer fa-fw"></i> Cervezas registradas</a>
		<a class="ir_a valoraciones" href="#ver-valoraciones"><i class="fa fa-star-o fa-fw"></i> Valoraciones</a>
		<a class="ir_a locales" href="#ver-locales"><i class="fa fa-edit fa-fw"></i> Registro en Locales</a>
		<a class="ir_a fotos" href="#ver-fotos"><i class="fa fa-image fa-fw"></i> Fotos</a>
		<a class="ir_a video" href="#ver-video"><i class="fa fa-play-circle-o fa-fw"></i> Videos</a>
	</div>

	<hr />

	<div class="row contenido-usuario">
		<div class="col-sm-8 parte-izquierda">

			<div id="ver-registradas" class="caja-borde ver-cervezas">
				<div class="titulo"><span class="icono"><i class="fa fa-beer fa-fw"></i></span> <span class="texto">Cervezas</span></div>
				<div class="contenido-caja">
					<section class="regular slider">
					<?php foreach($arr_cervezas as $dato){  ?>
					    <div>
					      <?php if($dato['thumbs'] != ""){ $img = $dato['thumbs']; }else{ $img = $img_desconocida; } ?>
					      <img src="<?php echo $img; ?>" alt="<?php echo $dato['alt_img']; ?>" title="<?php echo $dato['tit_img']; ?>" />
					      <div class="titular-zonas"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','32','lang','1')."/".$dato['url']; ?>"><?php echo $dato['titulo']; ?></a></div>
					    </div>
					<?php } ?>
					</section>
				</div>
			</div>

			<div id="ver-votos" class="caja-borde ver-valoraciones">
				<div class="titulo"><span class="icono"><i class="fa fa-star-o fa-fw"></i></span> 		<span class="texto">Valoraciones</span></div>
				<div class="contenido-caja">
					<div class="valoraciones row">
						<div class="caja media">
							<div class="datos">
								<div class="valor-media"><?php echo $media; ?></div>
								<div class="valor-titulo"><div class="arriba">/10</div><div class="abajo"><?php echo $clasificacion; ?></div></div>
							</div>
						</div>
						<div class="caja cerveza">
							<div class="datos"><div class="titulo">Variedad de<br />Cervezas</div><div class="valor"><?php echo $cerveza; ?></div></div>
						</div>
						<div class="caja artesanales">
							<div class="datos"><div class="titulo">Variedad de<br />Artesanales</div><div class="valor"><?php echo $artesanales; ?></div></div>
						</div>
						<div class="caja malaga">
							<div class="datos"><div class="titulo">Variedad de<br />Cervezas Málaga</div><div class="valor"><?php echo $malaga; ?></div></div>
						</div>
						<div class="caja local">
							<div class="datos"><div class="titulo">Experiencia<br />en el Local</div><div class="valor"><?php echo $local; ?></div></div>
						</div>
					</div>
				</div>
			</div>

			<div id="ver-locales" class="caja-borde ver-eventos">
				<div class="titulo"><span class="icono"><i class="fa fa-ticket fa-fw"></i></span> 		<span class="texto">Registro en Locales</span></div>
				<div class="contenido-caja">
					<section class="regular4 slider">
		           <?php foreach($arr_locales as $dato){ ?>
		           		<?php if($dato['thumbs'] != ""){ $img = $dato['thumbs']; }else{ $img = $img_desconocida; } ?>
						<div><img src="<?php echo $img; ?>" alt="<?php echo $dato['img_alt']; ?>" title="<?php echo $dato['img_tit']; ?>" /></div>
		            <?php } ?>
            		</section>
				</div>
			</div>

			<div id="ver-fotos" class="caja-borde ver-fotos">
				<div class="titulo"><span class="icono"><i class="fa fa-picture-o fa-fw"></i></span> 	<span class="texto">Fotos</span></div>
				<div class="contenido-caja">
					<section class="regular2 slider">
			           <?php 
			           $sqlsn = $ini->consulta("select id_negocio from union_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
			           while($regsu=$ini->fetch_object($sqlsn)){
			           $sqlslide = $ini->consulta("select * from slide inner join slide_lang on slide.id = slide_lang.id_slide where tipo = '".$regsu->id_negocio."' and id_lang = '".$ini->lang."'"); 
			            if($ini->num_rows($sqlslide) > 0){ 
			            	while($regslide = $ini->fetch_object($sqlslide)){
			            		$titalt = explode("/**/", $regslide->titalt);
			            	?>
							    <div>
							      <?php if($regslide->url != ""){ $img = $regslide->url; }else{ $img = $img_desconocida; } ?>
							      <img src="<?php echo $img; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
							    </div>
			            	<?php
			            	}
			            }
			        	}
			            ?>
            		</section>
				</div>
			</div>

			<div id="ver-video" class="caja-borde ver-videos">
				<div class="titulo"><span class="icono"><i class="la la-play-circle-o"></i></span> <span class="texto">Vídeos</span></div>
				<div class="contenido-caja">
				<div class="contenido-caja">
					<section class="regular3 slider">
			           <?php $sqlsn = $ini->consulta("select id_negocio from union_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
			           	while($regsu=$ini->fetch_object($sqlsn)){
			           		$sqlslide = $ini->consulta("select * from video_ngc where id_negocio = '".$regsu->id_negocio."'"); 
			            	if($ini->num_rows($sqlslide) > 0){ while($regslide = $ini->fetch_object($sqlslide)){ ?><div><?php echo $regslide->video; ?></div><?php } }
			        	} ?>
            		</section>
				</div>
				</div>
			</div>
			<div id="ver-valoraciones">
			<?php  $valorado = false; 
				$sqlm = $ini->consulta("select * from valoracion_sr where id_url_amg = '".$ini->id_url_amg."' and id_usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'");
				if($ini->num_rows($sqlm) > 0){ $valorado = true;  } ?>
			<?php if(!$valorado){ ?>
			<form id="enviar-valoracion-usuario" method="post">
			<input type="hidden" name="id_usuario" value="<?php echo $ini->id_conectado; ?>" />	
			<input type="hidden" name="id_usu_amg" value="<?php echo $ini->id_url_amg; ?>" />
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
									<bottom class="btn-enviar">Enviar</bottom>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
				<?php }else{ ?>
			<form id="enviar-valoracion-usuario" method="post">
			<input type="hidden" name="id_usuario" value="<?php echo $ini->id_url_amg; ?>" />
			</form>
				<?php $regm = $ini->fetch_object($sqlm); ?>
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
												<div class="valoracion"><?php $ttp = ($regm->voto1*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->voto2*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->voto3*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->voto4*100)/5; $wdt = ($ttp*150)/100; ?>
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
								<div class="col-sm-12 comentado"><?php echo $regm->comentario; ?></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<bottom class="btn-reenviar">Reenviar</bottom>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="col-sm-4 parte-derecha">
			<div class="caja-borde">
				<div class="row">
					<div class="col-sm-12"><p class="titular">Compartir perfil</p></div>
					<div class="col-sm-12 compartir">
						<div class="redes-negocio"> 
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI']; ?>" class="sbtn facebook" target="_blank" rel="nofollow"><img src="<?php echo $urlppal."imagen/redescabecera/facebook-gris.png" ?>" alt="visita nuestro facebook" title="Visita nuestro Facebook" /></a> 
							<a href="https://twitter.com/intent/tweet?url=<?php echo $_SERVER['REQUEST_URI']; ?>&text=<?php echo $ini->titulo; ?>" class="sbtn twitter" target="_blank" rel="nofollow"><img src="<?php echo $urlppal."imagen/redescabecera/twitter-gris.png" ?>" alt="visita nuestro twitter" title="Visita nuestro twitter" /></a> 
							<a href="https://pinterest.com/pin/create/button/?url=<<?php echo $_SERVER['REQUEST_URI']; ?>&media=<?php echo $ini->selectcampo(1,'opciones','value'); ?>" class="sbtn pinterest" target="_blank" rel="nofollow"><img src="<?php echo $urlppal."imagen/redescabecera/instagram-gris.png" ?>" alt="visita nuestro instagram" title="Visita nuestro instagram" /></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><p class="titular mg2">Seguidores</p></div>
					<?php 
					while($reg_seg=$ini->fetch_object($sql_seg)){ 
						$sql_datos = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg inner join usuarios_web on url_amg.usuario = usuarios_web.id where url_amg.id = '".$reg_seg->id_seguidor."'");
						$reg_datos = $ini->fetch_object($sql_datos);
						$titalt = explode("/**/",$reg_datos->titalt);
						?>
							<div class="col-sm-6">
								<?php if($reg_datos->thumb != ""){ $img = $reg_datos->thumb; }else{ $img = $img_desconocida; } ?>
								<div class="imagen"><img src="<?php echo $img; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" /></div>
								<div class="nombre"><?php echo $reg_datos->titulo; ?></div>
							</div>
						<?php
					}
					?>
				</div>
				<div class="row">
					<div class="col-sm-12"><p class="titular mg2">Seguidos</p></div>
					<?php
					while($sql_seguidos=$ini->fetch_object($sql_seg)){
						$sql_datos = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg inner join usuarios_web on url_amg.usuario = usuarios_web.id where url_amg.id = '".$reg_seg->id_seguido."'");
						$reg_datos = $ini->fetch_object($sql_datos);
						$titalt = explode("/**/",$reg_datos->titalt);
						?>
							<div class="col-sm-6">
								<?php if($reg_datos->thumb != ""){ $img = $reg_datos->thumb; }else{ $img = $img_desconocida; } ?>
								<div class="imagen"><img src="<?php echo $img; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" /></div>
								<div class="nombre"><?php echo $reg_datos->titulo; ?></div>
							</div>
						<?php
					}
					?>
				</div>
				<div class="row">
					<div class="col-sm-12"><p class="titular mg2">Eventos</p></div>
		           <?php 
		            $sqlnegocios = $ini->consulta("select id_negocio from seguir_ngc_sr where id_usuario = '".$ini->id_url_amg."'");
		            while($regseguidosnegocios = $ini->fetch_object($sqlnegocios)){
		            	$sqleventos = $ini->consulta("select id_evento from union_ngc_vnt where id_negocio = '".$regseguidosnegocios->id_negocio."'");
		            	while($regeventos = $ini->fetch_object($sqleventos)){
		           			$sqlslide = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$regeventos->id_evento."'");
		            		if($ini->num_rows($sqlslide) > 0){ 
		            			while($regslide = $ini->fetch_object($sqlslide)){
		            				$titalt = explode("/**/", $regslide->titalt);
		            				?>
									<div class="col-sm-6">
										<?php if($regslide->thumbs != ""){ $img = $regslide->thumbs; }else{ $img = $img_desconocida; } ?>
										<div class="imagen"><img src="<?php echo $img; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" /></div>
										<div class="nombre"><?php echo $regslide->titulo; ?></div>
									</div>
		            				<?php
		            			}
		            		}
		            	}
		        	}
		            ?>
				</div>
				<div class="row">
					<div class="col-sm-12"><p class="titular mg2">Recomendaciones</p></div>
					<?php
					while($reg_seg=$ini->fetch_object($sql_recomen)){
						$sql_datos = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where url_amg.id = '".$reg_seg->id_negocio."'");
						$reg_datos = $ini->fetch_object($sql_datos);
						$titalt = explode("/**/",$reg_datos->titalt);
						?>
							<div class="col-sm-6">
								<div class="imagen">
									<?php if($reg_datos->thumbs != ""){ $img = $reg_datos->thumbs; }else{ $img = $img_desconocida; } ?>
									<img src="<?php echo $img; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" /></div>
								<div class="nombre"><?php echo $reg_datos->titulo; ?></div>
							</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="thumbModal" tabindex="-1" role="dialog" aria-labelledby="thumbModalLabel" aria-hidden="true">
  <form id="reclamarnegocio" action="" method="post">
  <input type="hidden" name="id_negocio" value="<?php echo $ini->id_url_amg; ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> ¿ <?php echo $reg->titulo; ?> es tu negocio ? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿ Quieres tener acceso a los datos de tu negocio para mejorar tu posicionamiento ?
        <div class="row email-nombre-reclama">
        	<div class="col-sm-6">
        		<input type="email" class="form-control" name="email_reclama" value="" placeholder="Email" required="required" />
        	</div>
        	<div class="col-sm-6">
        		<input type="text" class="form-control" name="nombre_reclama" value="" placeholder="Nombre" required="required" />
        	</div>
        </div>
        <div class="row">
        	<div class="col-sm-12 comentario-reclama">
        		<textarea name="comentario_reclama" class="form-control" placeholder="Explicanos todo lo que necesites"></textarea>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary enviarreclamar">Enviar</button>
      </div>
    </div>
  </div>
  </form>
</div>
