<?php
$sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg inner join negocio on url_amg.id = negocio.id_negocio where url_amg.id = '".$ini->id_url_amg."'");
$reg = $ini->fetch_object($sql);
$titalt = explode("/**/",$reg->titalt); 
$nota = array(0=>"Muy Mala",1=>"Mala",2=>"Está bien",3=>"Muy buena",4=>"Excelente",5=>"Perfecto");
$cerveza = 0;
$artesanales = 0;
$malaga = 0;
$local = 0;
$media = 0;
$clasificacion = "Sin calificar";

$sql = $ini->consulta("select * from valoracion_ngc where id_negocio = '".$ini->id_url_amg."'");
$num_valoraciones = $ini->num_rows($sql);
while($reg2=$ini->fetch_object($sql)){
	$cerveza += $reg2->cervezas;
	$artesanales += $reg2->artesanales;
	$malaga += $reg2->malaga;
	$local += $reg2->local;
$cerveza = ceil($cerveza/$num_valoraciones);
$artesanales = ceil($artesanales/$num_valoraciones);
$malaga = ceil($malaga/$num_valoraciones);
$local = ceil($local/$num_valoraciones);
$media = ceil(($cerveza+$artesanales+$malaga+$local)/4);
$clasificacion = $nota[$media];
}



?>

<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>plantilla/css/slick-theme.css" />
<script src="<?php echo $urlppal; ?>plantilla/js/slick.js?<?php echo $ini->aleatorio(); ?>" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).on('ready', function() {
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

        $('#idpaisp').on('change', function() {
            $('#paisaenviar').val(this.value);
            var url = "<?php echo $urlppal; ?>utiles/ajax/muestra_provincias_p.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarpais').serialize(), success: function(data){ $('#idprvp').html(data); } }); 
        });

        $('#idprvp').on('change', function() {
            $('#paisaenviar').val(this.value);
            var url = "<?php echo $urlppal; ?>utiles/ajax/muestra_municipios_p.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarpais').serialize(), success: function(data){ $('#idmunp').html(data); } }); 
        });




      $(".enviarreclamar").click(function(){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/reclamar-negocio.php";
      	$.ajax({ type: "POST", url: url, data: $('#reclamarnegocio').serialize(), success: function(data){ $('#reclamarnegocio').html(data); } });
      });

      $(".enviar-reg-cer").click(function(){


      	var url = "<?php echo $urlppal; ?>/utiles/ajax/registrar-cerveza.php";

      	var data = new FormData();

      	$.each($('#archivo-foto')[0].files, function(i, file){ data.append('archivo-foto-'+i, file); });
      	data.append('name',$('#name-crvz').val());
      	data.append('contenido',$('#contenido-crvz').val());
      	data.append('marca',$('#idmarca').val());
      	data.append('nueva_marca',$('#nueva_marca').val());
      	data.append('productor',$('#idproductor').val());
      	data.append('nueva_productor',$('#idnproductor').val());
      	data.append('tipo',$('#idtipo').val());
      	data.append('nueva_tipo',$('#idntipo').val());
      	data.append('capacidad',$('#idcapacidad').val());
      	data.append('nueva_capacidad',$('#idncapacidad').val());
      	data.append('color',$('#idcolor').val());
      	data.append('nueva_color',$('#idncolor').val());
      	data.append('ebc',$('#idebc').val());
      	data.append('nueva_ebc',$('#idnebc').val());
      	data.append('fermentacion',$('#idfermentacion').val());
      	data.append('nueva_fermentacion',$('#idnfermentacion').val());
      	data.append('ibus',$('#idibus').val());
      	data.append('consumo',$('#idconsumo').val()); /**/
      	data.append('alcohol',$('#idalcohol').val());
      	data.append('denominacion',$('#iddenominacion').val());
      	data.append('pais',$('#idpaisp').val());
      	data.append('provincia',$('#idprvp').val());
      	data.append('municipio',$('#idmunp').val());
      	data.append('id_negocio',$('#id_negocio').val());
            data.append('cerveza_existente',$('#cerveza_existente').val());

      	$.ajax({ url: url, data: data, cache: false, contentType:false, processData:false,method:'POST', type: 'POST', success: function(data){ $('#registro-cerveza').html(data); } });


      }); 

      $('.ir_a.inicio').click(function(e){ 
      	e.preventDefault();
      		$('#ver-inicio').css("display","block");
      		$('#ver-descripcion').css("display","block");
      		$('#ver-cervezas').css("display","block");
      		$('#ver-servicios').css("display","block");
      		$('#ver-eventos').css("display","block");
      		$('#ver-valoraciones').css("display","block");
      		$('#ver-videos').css("display","block");
      		$('#ver-fotos').css("display","block");
      });
      $('.ir_a.descripcion').click(function(e){ 
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","block");
      		$('#ver-cervezas').css("display","none");
      		$('#ver-servicios').css("display","none");
      		$('#ver-eventos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-videos').css("display","none");
      		$('#ver-fotos').css("display","none");
      });
      $('.ir_a.cervezas').click(function(e){ 
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","none");
      		$('#ver-cervezas').css("display","block");
      		$('#ver-servicios').css("display","none");
      		$('#ver-eventos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-videos').css("display","none");
      		$('#ver-fotos').css("display","none");
      });
      $('.ir_a.servicios').click(function(e){
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","none");
      		$('#ver-cervezas').css("display","none");
      		$('#ver-servicios').css("display","block");
      		$('#ver-eventos').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-videos').css("display","none");
      		$('#ver-fotos').css("display","none");
      });
      $('.ir_a.valoraciones').click(function(e){
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","none");
      		$('#ver-cervezas').css("display","none");
      		$('#ver-eventos').css("display","none");
      		$('#ver-servicios').css("display","none");
      		$('#ver-valoraciones').css("display","block");
      		$('#ver-videos').css("display","none");
      		$('#ver-fotos').css("display","none");
      }); 
      $('.ir_a.videos').click(function(e){
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","none");
      		$('#ver-cervezas').css("display","none");
      		$('#ver-eventos').css("display","none");
      		$('#ver-servicios').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-videos').css("display","block");
      		$('#ver-fotos').css("display","none");
      }); 
      $('.ir_a.fotos').click(function(e){
      	e.preventDefault();
      		$('#ver-inicio').css("display","none");
      		$('#ver-descripcion').css("display","none");
      		$('#ver-cervezas').css("display","none");
      		$('#ver-eventos').css("display","none");
      		$('#ver-servicios').css("display","none");
      		$('#ver-valoraciones').css("display","none");
      		$('#ver-videos').css("display","none");
      		$('#ver-fotos').css("display","block");
      });
      $('.btn-enviar').click(function(event){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/valorar-negocio.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-valoracion-negocio').serialize(), success: function(data){ $('#ver-valoraciones').html(data); } });
      });
      $('.btn-reenviar').click(function(event){
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/revalorar-negocio.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-valoracion-negocio').serialize(), success: function(data){ $('#ver-valoraciones').html(data); } });
      });

    $('.btn-compartir-caja').click(function(event){ 
      event.preventDefault();
      if($('.menu-compartir').css('opacity') == 1){
        $('.menu-compartir').css('opacity','0');
      }else{
        $('.menu-compartir').css('opacity','1');
      }
    });

    $('#archivo-foto').change(function(event){

    	var doc = $(this).val().split("\\");

    	$('.label-foto').html(doc[2]);

    });

      $('.btn-seguir').click(function(event){
      	event.preventDefault();
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/seguir-negocio.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-id-negocio').serialize(), success: function(data){ $('.ajax').html(data); $('#btn-seguir').html('<i class="fa fa-thumbs-o-up fa-fw"></i> Siguiendo'); $('#btn-seguir').removeClass('btn-seguir'); $('#btn-seguir').addClass('btn-siguiendo') } });
      });

      $('.btn-recomendar').click(function(event){
      	event.preventDefault();
      	var url = "<?php echo $urlppal; ?>/utiles/ajax/recomendar-negocio.php";
      	$.ajax({ type: "POST", url: url, data: $('#enviar-id-negocio').serialize(), success: function(data){ $('.ajax').html(data); $('#btn-recomendar').html('<i class="fa fa-thumbs-o-up fa-fw"></i> Recomendado'); $('#btn-recomendar').removeClass('btn-recomendar'); $('#btn-recomendar').addClass('btn-recomendado') } });
      });

      $('#cerveza_existente').change(function(){



      	if($(this).val() == 'nueva'){
      		$('.fdh').css('visibility','visible');
      	}else{
      		$('.fdh').css('visibility','hidden');
      	}

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

			<form id="enviar-id-negocio" method="post">
			<input type="hidden" name="id_negocio" value="<?php echo $ini->id_url_amg; ?>" />
			</form>

<div class="ficha-negocio contenido">
	<div class="row negocio-cabecera">
		<div class="col-sm-7">
			<div class="row info-ppal">
				<div class="col-sm-3 logo-negocio">
					<img class="img-circle" src="<?php echo $reg->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
				</div>
				<div class="col-sm-9 titulares">
					<div class="titulo-negocio"><?php echo $reg->titulo; ?></div>
					<div class="eslogan-negocio"><?php echo $reg->eslogan; ?></div>
				</div>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="botones">


				<?php
				 $sqlid = $ini->consulta("select id from url_amg where usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'"); $regid = $ini->fetch_object($sqlid); $id_amg_usu = $regid->id;

				 $recomendado = false; if(isset($ini->id_conectado)){ $sqls = $ini->consulta("select id_negocio from recomendar_ngc_sr where id_negocio = '".$ini->id_url_amg."' and id_usuario = '".$id_amg_usu."'");
				 if($ini->num_rows($sqls) > 0){ $recomendado = true; } }

				 $siguiendo = false; if(isset($ini->id_conectado)){ $sqls = $ini->consulta("select id_negocio from seguir_ngc_sr where id_negocio = '".$ini->id_url_amg."' and id_usuario = '".$id_amg_usu."'");
				 if($ini->num_rows($sqls) > 0){ $siguiendo = true; } }

				?>
				<div class="menu-btn"> <a id="btn-recomendar" class="<?php if(!$recomendado){ ?>btn-recomendar<?php }else{ ?>btn-recomendado<?php } ?>" href="#"><?php if(!$recomendado){ ?><i class="fa fa-star fa-fw"></i> Recomendar<?php }else{ ?><i class="fa fa-thumbs-o-up fa-fw"></i> Recomendado<?php } ?></a> </div>

				<div class="menu-btn"> <a id="btn-seguir" class="<?php if(!$siguiendo){ ?>btn-seguir<?php }else{ ?>btn-siguiendo<?php } ?>" href="#">
					<?php if(!$siguiendo){ ?><i class="fa fa-arrow-right fa-fw"></i> Seguir<?php }else{ ?><i class="fa fa-thumbs-o-up fa-fw"></i> Siguiendo<?php } ?></a> </div>
				
				<div class="menu-btn"> <a class="btn-compartir btn-compartir-caja" href="#"><i class="fa fa-share-alt fa-fw"></i> Compartir</a> 
						<div class="menu-compartir">
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['REQUEST_URI']; ?>" class="sbtn facebook" target="_blank" rel="nofollow"><i class="fa fa-facebook-square fa-fw"></i></a>
							<a href="https://twitter.com/intent/tweet?url=<?php echo $_SERVER['REQUEST_URI']; ?>&text=<?php echo $ini->titulo; ?>" class="sbtn twitter" target="_blank" rel="nofollow"><i class="fa fa-twitter-square fa-fw"></i></a>
							<a href="whatsapp://send?text=<?php echo $ini->titulo; ?> - <?php echo $_SERVER['REQUEST_URI']; ?>" class="sbtn whatsapp" target="_blank" rel="nofollow"><i class="fa fa-whatsapp fa-fw"></i></a>
							<a href="https://pinterest.com/pin/create/button/?url=<<?php echo $_SERVER['REQUEST_URI']; ?>&media=<?php echo $ini->selectcampo(1,'opciones','value'); ?>" class="sbtn pinterest" target="_blank" rel="nofollow"><i class="fa fa-pinterest-square fa-fw"></i></a>
						</div>
				</div>
				
				<div class="menu-btn"> <a class="btn-reportar" data-target="#thumbModal" data-toggle="modal" href="#"><i class="fa fa-bullhorn fa-fw"></i> Reclamar</a> </div>  

			</div>
		</div>
	</div>

	<hr />

	<div class="menu-negocio">
		<a class="ir_a inicio" href="#ver-inicio">Inicio</a>
		<a class="ir_a descripcion" href="#ver-descripcion">Descripción</a>
		<a class="ir_a cervezas" href="#ver-cervezas">Cervezas</a>
		<a class="ir_a servicios" href="#ver-servicios">Servicios</a>
		<a class="ir_a valoraciones" href="#ver-valoraciones">Valorar</a>
		<a class="ir_a add" href="#ver-add">Añadir a favoritos</a>
		<a class="ir_a fotos" href="#ver-fotos">Fotos</a>
		<a class="ir_a videos" href="#ver-videos">Videos</a>
	</div>

	<div class="row contenido-negocio">
		<div class="col-sm-8 parte-izquierda">
			<div id="ver-inicio" class="caja-borde ver-valoraciones">
				<div class="titulo"><span class="icono"><i class="fa fa-star-o fa-fw"></i></span> 		<span class="texto">Valoraciones</span></div>
				<div class="contenido-caja">
					<div class="valoraciones row">
						<div class="caja media">
							<div class="datos">
								<div class="valor-media"><?php echo $media; ?></div>
								<div class="valor-titulo">
									<div class="arriba">/5</div>
									<div class="abajo"><?php echo $clasificacion; ?></div>
								</div>
							</div>
						</div>
						<div class="caja cerveza">
							<div class="datos">
								<div class="titulo">Variedad de<br />Cervezas</div>
								<div class="valor"><?php echo $cerveza; ?></div>
							</div>
						</div>
						<div class="caja artesanales">
							<div class="datos">
								<div class="titulo">Variedad de<br />Artesanales</div>
								<div class="valor"><?php echo $artesanales; ?></div>
							</div>
						</div>
						<div class="caja malaga">
							<div class="datos">
								<div class="titulo">Variedad de<br />Cervezas Málaga</div>
								<div class="valor"><?php echo $malaga; ?></div>
							</div>
						</div>
						<div class="caja local">
							<div class="datos">
								<div class="titulo">Experiencia<br />en el Local</div>
								<div class="valor"><?php echo $local; ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="ver-descripcion" class="caja-borde ver-descripcion">
				<div class="titulo"><span class="icono"><i class="fa fa-file-text-o fa-fw"></i></span> 	<span class="texto">Descripción</span></div>
				<div class="contenido-caja"><?php echo $reg->contenido; ?></div>
			</div>

			<div id="ver-cervezas" class="caja-borde ver-cervezas">
				<div class="titulo"><span class="icono"><i class="fa fa-beer fa-fw"></i></span> 		<span class="texto">Cervezas</span></div>
				<div class="contenido-caja">
					<section class="regular slider">
					<?php
						$sqls = $ini->consulta("select id_cerveza from union_ngc_crvz inner join url_amg on union_ngc_crvz.id_cerveza = url_amg.id where activo = '1' and id_negocio = '".$ini->id_url_amg."'");
						while($regs=$ini->fetch_object($sqls)){ 
    						$sqldts = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id_url_amg = '".$regs->id_cerveza."' and lang = '1'"); 
    						$regdts = $ini->fetch_object($sqldts); $titalt = explode("/**/",$regdts->titalt); ?>
						    <div>
						      <a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','27','lang','1')."/".$regdts->url_amg; ?>"><img src="<?php echo $regdts->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" /></a>
						      <div class="titular-zonas"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg','27','lang','1')."/".$regdts->url_amg; ?>"><?php echo $regdts->titulo; ?></a></div>
						    </div> 
					<?php } ?>
					</section>
				</div>

				<div class="row"> 
					<div class="registra-cerveza">  
						<a class="btn-reportar" data-target="#registroModal" data-toggle="modal" href="#">Registrar cerveza</a>  
					</div> 
				</div>

			</div>

			<div id="ver-servicios" class="caja-borde ver-servicios">
				<div class="titulo"><span class="icono"><i class="la la-list-alt"></i></span> 			<span class="texto">Servicios</span></div>
				<div class="contenido-caja">
					<ul>
						<?php $sql = $ini->consulta("select id_servicio from union_ngc_srvc where id_negocio = '".$ini->id_url_amg."'"); 
						while($regs=$ini->fetch_object($sql)){ 
							$icono = $ini->busca("icono","servicio","id_servicio",$regs->id_servicio); ?>
							<li> <i class="fa <?php echo $icono; ?> fa-fw"></i> <?php echo $ini->busca("titulo","url_amg_lang","id_url_amg",$regs->id_servicio); ?> </li>
						<?php } ?>
					</ul>
				</div>
			</div>

			<div id="ver-eventos" class="caja-borde ver-eventos">
				<div class="titulo"><span class="icono"><i class="fa fa-ticket fa-fw"></i></span> 		<span class="texto">Eventos con Entradas</span></div>
				<div class="contenido-caja">
					<section class="regular4 slider">
		           <?php 
		           $sqlslide = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg inner join union_ngc_vnt on url_amg_lang.id_url_amg = union_ngc_vnt.id_evento where id_negocio = '".$ini->id_url_amg."'"); 
		            if($ini->num_rows($sqlslide) > 0){ 
		            	while($regslide = $ini->fetch_object($sqlslide)){
		            		$titalt = explode("/**/", $regslide->titalt);
		            	?>
						    <div>
						    	<a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',23)."/".$regslide->url_amg; ?>">
							      <img src="<?php echo $regslide->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
							    </a>
						    </div>
		            	<?php
		            	}
		            }
		            ?>
            		</section>
				</div>
			</div>

			<div id="ver-fotos" class="caja-borde ver-fotos">
				<div class="titulo"><span class="icono"><i class="fa fa-picture-o fa-fw"></i></span> 	<span class="texto">Fotos</span></div>
				<div class="contenido-caja">
					<section class="regular2 slider">
		           <?php 
		           $sqlslide = $ini->consulta("select * from slide inner join slide_lang on slide.id = slide_lang.id_slide where tipo = '".$ini->id_url_amg."' and id_lang = '".$ini->lang."'"); 
		            if($ini->num_rows($sqlslide) > 0){ 
		            	while($regslide = $ini->fetch_object($sqlslide)){
		            		$titalt = explode("/**/", $regslide->titalt);
		            	?>
						    <div>
						      <img src="<?php echo $regslide->url; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
						    </div>
		            	<?php
		            	}
		            }
		            ?>
            		</section>
				</div>
			</div>

			<div id="ver-videos" class="caja-borde ver-videos">
				<div class="titulo"><span class="icono"><i class="la la-play-circle-o"></i></span> 		<span class="texto">Vídeos</span></div>
				<div class="contenido-caja">
				<div class="contenido-caja">
					<section class="regular3 slider">
		           <?php 
		           $sqlslide = $ini->consulta("select * from video_ngc where id_negocio = '".$ini->id_url_amg."'"); 
		            if($ini->num_rows($sqlslide) > 0){ 
		            	while($regslide = $ini->fetch_object($sqlslide)){
		            	?>
						    <div>
						      <?php echo $regslide->video; ?>
						    </div>
		            	<?php
		            	}
		            }
		            ?>
            		</section>
				</div>
				</div>
			</div>
			
			<div id="ver-valoraciones">

			<?php 
				$valorado = false; 
				$sqlm = $ini->consulta("select * from valoracion_ngc where id_negocio = '".$ini->id_url_amg."' and id_usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'");
				//echo "select id_negocio from valoracion_ngc where id_negocio = '".$ini->id_url_amg."' and id_usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'";
				if($ini->num_rows($sqlm) > 0){ $valorado = true; }
				
			?>
			<?php if(!$valorado){ ?>
			<form id="enviar-valoracion-negocio" method="post">
			<input type="hidden" name="id_usuario" value="<?php echo $ini->id_conectado; ?>" />	
			<input type="hidden" name="id_negocio" value="<?php echo $ini->id_url_amg; ?>" />
			<div class="caja-borde comentario">
				<div class="contenido-caja">
					<div class="row">
						<div class="col-sm-6">
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
						<div class="col-sm-6">
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
			<form id="enviar-valoracion-negocio" method="post">
			<input type="hidden" name="id_negocio" value="<?php echo $ini->id_url_amg; ?>" />
			</form>
				<?php $regm = $ini->fetch_object($sqlm); ?>
				<div class="caja-borde comentario">
				<div class="contenido-caja">
					<div class="row">
						<div class="col-sm-6">
							<div class="titulo"><span class="icono"><i class="fa fa-thumbs-o-up fa-fw"></i></span> <span class="texto">Negocio valorado</span></div>
							<div class="row zona-votar">
								<div class="col-sm-6">
									<div class="votar-cerveza">
										<p>Variedad de<br />cervezas</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($regm->cervezas*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->malaga*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->artesanales*100)/5; $wdt = ($ttp*150)/100; ?>
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
												<div class="valoracion"><?php $ttp = ($regm->local*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="local" id="local" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
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
				<p class="titular">Contacto</p>
				<div class="texto-contacto">
					<?php if($reg->telefonop != ""){ ?>
						<i class="fa fa-phone fa-fw"></i> <b>Teléfono</b>
						<p><?php echo $reg->telefonop; ?></p>
					<?php } ?>
					<?php if($reg->emailp != ""){ ?>
						<i class="fa fa-envelope-o fa-fw"></i> <b>Email</b>
						<p><?php echo $reg->emailp; ?></p>
					<?php } ?>
					<?php if($reg->direccionp != ""){ ?>
						<i class="fa fa-map-marker fa-fw"></i> <b>Dirección</b>
						<p><?php echo $reg->direccionp; ?></p>
					<?php } ?>
					<?php if($reg->horariop != ""){ ?>
						<i class="fa fa-clock-o fa-fw"></i> <b>Horario</b>
						<p><?php echo $reg->horariop; ?></p>
					<?php } ?>
				</div>
				<?php if($reg->facebook != "" or $reg->twitter != "" or $reg->instagram != "" or $reg->pinterest != "" or $reg->youtube != "" or $reg->linkedin != "" or $reg->google != ""){ ?>
				<p class="titular">Síguenos</p>
				<div class="redes-negocio"> 
					<?php if($reg->facebook != ""){ ?> <a target="_blank" href="<?php echo $reg->facebook; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/facebook-naranja.png" ?>" alt="visita nuestro facebook" title="Visita nuestro Facebook" /></a> <?php } ?>
					<?php if($reg->twitter != ""){ ?> <a target="_blank" href="<?php echo $reg->twitter; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/twitter-naranja.png" ?>" alt="visita nuestro twitter" title="Visita nuestro twitter" /></a> <?php } ?>
					<?php if($reg->instagram != ""){ ?> <a target="_blank" href="<?php echo $reg->instagram; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/instagram-naranja.png" ?>" alt="visita nuestro instagram" title="Visita nuestro instagram" /></a> <?php } ?>
					<?php if($reg->pinterest != ""){ ?> <a target="_blank" href="<?php echo $reg->pinterest; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/pinterest-naranja.png" ?>" alt="visita nuestro pinterest" title="Visita nuestro pinterest" /></a> <?php } ?>
					<?php if($reg->youtube != ""){ ?> <a target="_blank" href="<?php echo $reg->youtube; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/youtube-naranja.png" ?>" alt="visita nuestro youtube" title="Visita nuestro youtube" /></a> <?php } ?>
					<?php if($reg->linkedin != ""){ ?> <a target="_blank" href="<?php echo $reg->linkedin; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/linkedin-naranja.png" ?>" alt="visita nuestro linkedin" title="Visita nuestro linkedin" /></a> <?php } ?>
					<?php if($reg->google != ""){ ?> <a target="_blank" href="<?php echo $reg->google; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/google-naranja.png" ?>" alt="visita nuestro Google Business" title="Visita nuestro Google Business" /></a> <?php } ?>
				</div>
				<?php } ?>

				<div class="mapa-negocio"><?php echo $reg->mapa; ?></div>

				<p class="titular">Reservas</p>


					<div class="calendario">
						<div class="myCalendar"></div>
					</div>

			   		<?php 
			   		$sqle = $ini->consulta("select eventos.fecha, titulo from url_amg_lang inner join eventos on url_amg_lang.id_url_amg = eventos.id_evento inner join union_ngc_vnt on url_amg_lang.id_url_amg = union_ngc_vnt.id_evento where union_ngc_vnt.id_negocio = '".$ini->id_url_amg."'"); 
			   		while($rege=$ini->fetch_object($sqle)){ if($rege->fecha != ""){ $date = explode("-",$rege->fecha); $fecha = $date[2]."-".$date[1]."-".$date[0];  ?>

								<div id="<?php echo $fecha; ?>-caja" style="display: none;">
									<?php echo $rege->titulo; ?>
								</div>

					<?php } } ?>




				<p class="titular">Eventos</p>
				<div class="row">
					<?php $sqlev = $ini->consulta("select id_evento from union_ngc_vnt where id_negocio");
					 while($regev = $ini->fetch_object($sqlev)){ 
						$sqldev = $ini->consulta("select thumbs, titulo, url_amg, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$regev->id_evento."'");
						$regdev = $ini->fetch_object($sqldev); 
						$titalt = explode("/**/",$regdev->titalt); ?>
						<div class="col-sm-6">
							<div class="imagen">
								<a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',23)."/".$regdev->url_amg; ?>">
									<img src="<?php echo $regdev->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
								</a>
							</div>
							<div class="titulo">
								<a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',23)."/".$regdev->url_amg; ?>">
									<?php echo $regdev->titulo; ?>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>

			</div>
		</div>
	</div>
</div>
  <link rel="stylesheet" href="<?php echo $urlppal."plantilla/css/"; ?>jquery-pseudo-ripple.css" />
  <link rel="stylesheet" href="<?php echo $urlppal."plantilla/css/"; ?>jquery-nao-calendar.css" />
  <script src="<?php echo $urlppal."plantilla/js/"; ?>jquery-pseudo-ripple.js?v211112"></script>
  <script src="<?php echo $urlppal."plantilla/js/"; ?>jquery-nao-calendar.js?v211112"></script>

 <script>
    $('.myCalendar').calendar({
  date: new Date(),
  autoSelect: false, // false by default
  select: function(date) {
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
   });


</script>





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



<?php $id_cat = $ini->busca('id_categoria','union_ngc_ctgr','id_negocio',$ini->id_url_amg); ?>


                             <?php if($id_cat == 207){ ?>

                                   <style>
                                         #cerveza_existente{visibility:hidden;}
                                         .fdh{visibility:visible;}

                                   </style>


                              <?php } ?>

<div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="registroModalLabel" aria-hidden="true">
  <form id="registro-cerveza" action="" method="post" enctype="multipart/form-data">
  <input type="hidden" id="id_negocio" name="id_negocio" value="<?php echo $ini->id_url_amg; ?>">
  <input type="hidden" name="id_cat" value="<?php echo $id_cat; ?>" />
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Registrar cerveza en <?php echo $ini->titulo; ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

      	<div class="row">
      		<div class="col-sm-12">
      			<select class="form-control js-example-basic-single" id="cerveza_existente" name="cerveza_existente" required="required">
      				<option value="">Selecciona cerveza</option>
      				<option value="nueva">Nueva cerveza</option>

                              
                              


                              <?php $sqlcrvz = $ini->consulta("select id, titulo from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '27' order by titulo"); ?>



      				<?php while($regcrvz = $ini->fetch_object($sqlcrvz)){ ?>

      					<option value="<?php echo $regcrvz->id; ?>"><?php echo $regcrvz->titulo; ?></option>

      				<?php } ?>

      			</select>
      		</div>
      	</div>


        <p class="fdh">Rellena el siguiente formulario para registrar una cerveza</p>

        <div class="row campos">
        	<div class="col-sm-6">
        		<input id="name-crvz" type="text" class="form-control fdh" name="name" value="" placeholder="Nombre cerveza" required="required" />
        	</div>
        	<div class="col-sm-6">
        		<input id="archivo-foto" style="display:none;" type="file" class="form-control fdh" name="archivo" value="" placeholder="Foto cerveza" />
        		<label class="label-foto fdh" for="archivo-foto">Foto cerveza</label>

        	</div>
        </div>
        <div class="row campos">
        	<div class="col-sm-12 campos2">
        		<textarea id="contenido-crvz" name="contenido" class="form-control fdh" placeholder="Escribe sobre la cerveza"></textarea>
        	</div>
        </div>


<?php if($id_cat != 207){ ?>
        <div class="row campos">
        	<div class="col-sm-6">
			<?php  
			if($id_cat == 207){
				$sql_cer = $ini->consulta('select marca from cerveza inner join union_ngc_crvz on cerveza.id_cerveza = union_ngc_crvz.id_cerveza where id_negocio = "'.$ini->id_url_amg.'"');
				$arr_marcas = array();
				while($reg_cer = $ini->fetch_object($sql_cer)){
					$arr_marcas[] = $reg_cer->marca;
				}
			} ?>
            <select name="marca" id="idmarca" class="form-control fdh">
                <option value="0">Selecciona marca</option>
                <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_marca order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
                    <?php if(in_array($rega->id, $arr_marcas) or $id_cat != 207){ ?>
                    	<option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        	</div>
        	<div class="col-sm-6">
        		<input type="text" class="form-control fdh" id="nueva_marca" name="nueva_marca" value="" placeholder="¿Añadir nueva marca?" />
        	</div>
        </div>
<?php } ?>

        <div class="row campos">
        	<div class="col-sm-6">
        		
	        <select name="productor fdh" id="idproductor" class="form-control fdh">
	            <option value="0">Selecciona productor</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_productor order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>


        	</div>
        	<div class="col-sm-6">
        		
        		<input type="text" class="form-control fdh" id="idnproductor" name="nueva_productor" placeholder="¿Añadir nuevo productor?" value="" />

        	</div>
        </div>



        <div class="row campos">
        	<div class="col-sm-6">


	         <select class="form-control fdh" id="idtipo" name="tipo">
	            <option value="0">Selecciona Tipo</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_tipo order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>       		


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idntipo" name="nueva_tipo" value="" placeholder="¿Añadir nuevo tipo?" />


        	</div>
        </div>




        <div class="row campos">
        	<div class="col-sm-6">


	        <select class="form-control fdh" id="idcapacidad" name="capacidad">
	            <option value="0">Selecciona Capacidad</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_capacidad order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>      		


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idncapacidad" name="nueva_capacidad" value="" placeholder="¿Añadir nueva capacidad?" />


        	</div>
        </div>




        <div class="row campos">
        	<div class="col-sm-6">


	        <select class="form-control fdh" id="idcolor" name="color">
	            <option value="0">Selecciona color</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_color order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idncolor" name="nueva_color" placeholder="¿Añadir nuevo color?" />


        	</div>
        </div>



        <div class="row campos">
        	<div class="col-sm-6">


	        <select id="idebc" class="form-control fdh" name="ebc">
	            <option value="0">Selecciona EBC</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_ebc order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idnebc" name="nueva_ebc" placeholder="¿Añadir nuevo EBC?" />


        	</div>
        </div>




        <div class="row campos">
        	<div class="col-sm-6">


	        <select id="idfermentacion" class="form-control fdh" name="fermentacion">
	            <option value="0">Selecciona Fermentación</option>
	            <?php $sqla = $ini->consulta("select id, titulo_es as titulo from cz_fermentacion order by titulo_es asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                <option value="<?php echo $rega->id; ?>"><?php echo $rega->titulo; ?></option>
	            <?php } ?>
	        </select>


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idnfermentacion" name="nueva_fermentacion" value="" placeholder="¿Añadir nueva fermentación?" />


        	</div>
        </div>



        <div class="row campos">
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idibus" name="ibus" value="" placeholder="IBUS" />


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idconsumo" name="consumo" value="" placeholder="Consumo" />


        	</div>
        </div>



        <div class="row campos">
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="iddenominacion" name="denominacion" value="" placeholder="Denominación" />


        	</div>
        	<div class="col-sm-6">


        		<input type="text" class="form-control fdh" id="idalcohol" name="alcohol" value="" placeholder="Alcohol" />



	            

        	</div>
        </div>


<?php if($id_cat != 207){ ?>

        <div class="row campos">
        	<div class="col-sm-6">



	            <select name="pais" id="idpaisp" class="form-control fdh">
	                <option value="0">Selecciona país</option>
	                <?php $sqla = $ini->consulta("select * from pais order by pais asc"); while($rega = $ini->fetch_object($sqla)){ ?>
	                    <option value="<?php echo $rega->id; ?>"><?php echo $rega->pais; ?></option>
	                <?php } ?>
	            </select>



        	</div>
        	<div class="col-sm-6">


	            <select name="provincia" id="idprvp" class="form-control fdh">
	                <option value="0">Selecciona Provincia</option>
	                <option value="0">Selecciona primero país</option>
	            </select>



        	</div>
        </div>



        <div class="row campos">
        	<div class="col-sm-6">



	            <select name="municipio" id="idmunp" class="form-control fdh">
	                <option value="0">Selecciona Municipio</option>
	                <option value="0">Selecciona primero provincia</option>
	            </select>



        	</div>
        	<div class="col-sm-6">




        	</div>
        </div>

<?php } ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary enviar-reg-cer">Enviar</button>
      </div>
    </div>
  </div>
  </form>
  <form id="enviarpais" method="post"> <input type="hidden" id="paisaenviar" name="pais" value="" /> </form>
</div>



