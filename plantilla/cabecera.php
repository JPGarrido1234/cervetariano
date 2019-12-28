<?php $redes = array(23=>"facebook",24=>"instagram",25=>"linkedin",26=>"pinterest",27=>"twitter",28=>"youtube"); ?>
<link href="<?php echo $urlppal; ?>/utiles/css/jquery.typeahead.css" rel="stylesheet">
<script src="<?php echo $urlppal; ?>/utiles/js/jquery.typeahead.js"></script>
<header>
	<div class="row">
		<div class="redes">
			<div class="iconos">
				<div class="contenido">

					<div class="enlaces-redes">
					<?php foreach($redes as $id_redes=>$red){ $img_red = $ini->selectcampo($id_redes,'opciones','value'); ?>
					    <?php if($img_red != ""){ ?>
							<div class="icono-redes"><a target="_blank" href="<?php echo $img_red; ?>"><img src="<?php echo $urlppal."imagen/redescabecera/".$red.".png" ?>" alt="<?php echo $red." ".$titzft; ?>" title="<?php echo $red." ".$titzft; ?>" /></a></div>
						<?php } ?>
					<?php } ?>
					</div>
					
					<div class="entradas">

						<div class="mensaje-logeado"></div>

						<div class="entrada usuario"><a id="insertar-usuario"<?php if($ini->conectado){ ?> class="mostrar-menu-usu"<?php } ?><?php if(!$ini->conectado){ ?> data-target="#loginModal" data-toggle="modal"<?php } ?> href="#"><img src="<?php echo $urlppal."imagen/redescabecera/insertar-usuario.png"; ?>" alt="entrada usuarios" title="entrada usuarios cervezas málaga" /></a> 
							<div class="menu-usu"> 
								<a class="mi-cuenta" href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',245,'lang',1); ?>">Mi cuenta</a>
								<a class="cerrar-sesion" href="#">Cerrar Sesión</a>
						 	</div> </div>
						<div class="entrada negocio">
							<a id="insertar-negocio" 
							<?php if($ini->connectNeg){?>class="mostrar-menu-negocio"<?php } ?><?php if(!$ini->connectNeg){ ?>data-target="#busnessModal" data-toggle="modal"<?php } ?> href="#">
								<img src="<?php echo $urlppal."imagen/redescabecera/insertar-negocio.png"; ?>" alt="entrada usuarios" title="entrada usuarios cervezas málaga" />
							</a>
							<div class="menu-negocio"> 
								<a class="mi-cuenta" href="<?php ?>">Mi negocio</a>
								<a class="cerrar-sesion-negocio" href="#">Cerrar Sesión</a>
						 	</div>
						</div>
					</div>					
					<?php if($ini->conectado){ ?> <div class="nombre-usuario"><?php echo $ini->selectcampo($ini->desencriptar($ini->id_conectado,$baz),'usuarios_web','nombre'); ?></div> <?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="contenido">
		
		<div class="row">
			<div class="logotipo"><a href="<?php echo $urlppal; ?>"><img src="<?php echo $ini->selectcampo(1,'opciones','value'); ?>" title="Logotipo Cervezas Málaga" alt="Logotipo Cervezas Málaga" /></a></div>    
			<div class="menu">
				<ul>
				<?php
				$sql = $ini->consulta("select url_amg_lang.url_amg, url_amg_lang.titulo, url_amg.subsecc, url_amg.id as ids, menu.id as idm from menu inner join url_amg on menu.url_amg = url_amg.id inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id where url_amg_lang.lang = '".$ini->lang."' and menu.tipo = '1' order by menu.orden asc");
				while($reg = $ini->fetch_object($sql)){
					$activo = false; ?>
					<li class="botones<?php if($reg->subsecc == $ini->subsecc and $reg->ids == $ini->id_url_amg or $reg->subsecc == $ini->seccion and $reg->seccion == 0 and $reg->subsecc != 0){ echo " activo"; } ?>">
						<a title="<?php echo $reg->titulo; ?>" href="<?php echo $urlppal.$reg->url_amg; ?>"><?php echo $reg->titulo; ?></a>
					</li>
				<?php } ?>
				</ul>
			</div>
			<div class="menu-movil">
				<i class="fa fa-bars fa-fw"></i>
			</div>
		</div>
		<form id="buscador_form" method="post" action="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',249); ?>">
		<input type="hidden" name="seccion" value="" id="buscador_se" />
		<input type="hidden" name="id_url" value="" id="buscador_id" />
		<input type="hidden" name="id_loc" value="" id="buscador_loc" />
		
		<div class="row buscador">
			<div class="caja-buscador">
				<div class="elemento-buscador"><label for="busca"><?php echo $lanes['label_buscar']; ?></label></div>
				<div class="elemento-buscador">

				   <div class="typeahead__container">
				        <div class="typeahead__field">
				            <span class="typeahead__query input-ppal">
				                <div id="input-ppal" class="input-ppalcls">
				                    <div id="contenido_buscar" class="input-group stylish-input-group">
				                        <input type="text" id="quebusca" autocomplete="off" class="form-control js-typeahead" name="busqueda" placeholder="Buscar" style="margin-bottom: -7px;" />
				                    </div>
				                </div>
				            </span>
				        </div>
				    </div>

				</div>
				<div class="elemento-buscador"><label for="ubicacion"><?php echo $lanes['label_ubicacion']; ?></label></div>
				<div class="elemento-buscador">

				   <div class="typeahead__container">
				        <div class="typeahead__field">
				            <span class="typeahead__query input-ppal">
				                <div id="input-ppal" class="input-ppalcls">
				                    <div id="contenido_buscar" class="input-group stylish-input-group">
				                        <input type="text" id="quebusca2" autocomplete="nope" class="form-control js-typeaheadl" name="localidad_b" placeholder="Buscar" style="margin-bottom: -7px;" />
				                    </div>
				                </div>
				            </span>
				        </div>
				    </div>


				</div>
				<div class="elemento-buscador"><a class="submit_form_buscador" href="#"><img src="<?php echo $urlppal."imagen/redescabecera/icono-lupa.png"; ?>" alt="Buscar en Cervezas Málaga" title="Buscar en Cervezas Málaga" /></a></div>
			</div>
		</div>
		</form>
	</div>

</header>


<style>





<?php 
$e = 1;


$sqlslide = $ini->consulta("select * from slide inner join slide_lang on slide.id = slide_lang.id_slide where tipo = '".$ini->id_url_amg."' and id_lang = '".$ini->lang."'"); 
if($ini->num_rows($sqlslide) > 0){ 
  while($regslide = $ini->fetch_object($sqlslide)){
    
  ?>


.cb-slideshow li:nth-child(<?php echo $e; ?>) span { 
    background-image: url(<?php echo $regslide->url; ?>);
}


  <?php
 $e++; }
}else{





 for($i=17;$i<=22;$i++){ ?>

.cb-slideshow li:nth-child(<?php echo $e; ?>) span { 
    background-image: url(<?php echo $ini->selectcampo($i,'opciones','value'); ?>);
}

<?php $e++; } 

}
?>

</style>



<div class="row">
<section class="cabecera_inicio cb-slideshow">

<?php for ($di=1;$di<=$e;$di++) {  ?>
<li><div></div><span></span></li>
<?php } ?>


<div class="seccion"><div class="bloque_bienvenida">Cervezas Málaga</div></div>
</section>
</div>

<script>

function prepara_buscador(id,se){
	$('#buscador_id').val(id);
	$('#buscador_se').val(se);
}

function prepara_loc(id,se){
	$('#buscador_loc').val(id);
}

    typeof $.typeahead === 'function' && $.typeahead({
        input: ".js-typeahead", minLength: 0, maxItem: 9, dynamic: true, delay: 500, order: "asc", href: "javascript: prepara_buscador('{{id}}','{{se}}');", hint: true,
        searchOnFocus: false, accent:{ from: 'áéíóúàèìòù', to: 'aeiouaeiou'},
        emptyTemplate: 'No hay coincidencias',
        display: ["titulo"], correlativeTemplate: true,
        template: '<span>' + '<span class="name"><i class="{{division}}"></i>  {{titulo}}</span>' + '</span>',
        source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar.php", dataType: "json",
        data: { q: "{{query}}", i: "{{<?php echo $ini->lang; ?>}}" } } }, callback: { done: function (data) { return data; } } }
    });

    typeof $.typeahead === 'function' && $.typeahead({
        input: ".js-typeaheadl", minLength: 0, maxItem: 9, dynamic: true, delay: 500, order: "asc", href: "javascript: prepara_loc('{{id}}','{{se}}');", hint: true,
        searchOnFocus: false, accent:{ from: 'áéíóúàèìòù', to: 'aeiouaeiou'},
        emptyTemplate: 'No hay coincidencias',
        display: ["titulo"], correlativeTemplate: true,
        template: '<span>' + '<span class="name"><i class="{{division}}"></i>  {{titulo}}</span>' + '</span>',
        source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar_localidades.php", dataType: "json",
        data: { q: "{{query}}", i: "{{<?php echo $ini->lang; ?>}}" } } }, callback: { done: function (data) { return data; } } }
    });
</script>