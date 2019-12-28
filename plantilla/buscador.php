<div class="contenido caja-buscador-ppal">
	<?php 
		if(isset($_POST) and $_POST['id_url'] != ""){
			/*echo "<br> seccion: ".$_POST['seccion'];
			echo "<br> id_url: ".$_POST['id_url'];
			echo "<br> id_loc: ".$_POST['id_loc'];
			echo "<br> busqueda: ".$_POST['busqueda'];
			echo "<br> localidad: ".$_POST['localidad'];
			*/
			switch($_POST['seccion']){
				// 33: categorias
				case 33:{
					$loc = "";
					if($_POST['localidad_b'] != ""){

						$sqlloc = $ini->consulta("select Id from municipios where id_url_amg = '".$_POST['id_loc']."'");
						$regloc = $ini->fetch_object($sqlloc);
						$loc = " and municipio = '".$regloc->Id."'";

					}
					$sqlb = $ini->consulta("select id from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id inner join union_ngc_ctgr on url_amg.id = union_ngc_ctgr.id_negocio inner join negocio on union_ngc_ctgr.id_negocio = negocio.id_negocio where id_categoria = '".$_POST['id_url']."' and seccion = '28' and lang = '1'".$loc);

					$array_negocios = array();
					while($regb = $ini->fetch_object($sqlb)){
						if(!in_array($regb2->id_negocio, $array_negocios)){
							$array_negocios[] = $regb->id;
						}
					}

				};
				break;
				// 51: servicios
				case 51:{
					$loc = "";
					if($_POST['localidad_b'] != ""){

						$sqlloc = $ini->consulta("select Id from municipios where id_url_amg = '".$_POST['id_loc']."'");
						$regloc = $ini->fetch_object($sqlloc);
						$loc = " and municipio = '".$regloc->Id."'";

					}
					$sqlb = $ini->consulta("select id from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id inner join union_ngc_srvc on url_amg.id = union_ngc_srvc.id_negocio inner join negocio on union_ngc_srvc.id_negocio = negocio.id_negocio where id_servicio = '".$_POST['id_url']."' and seccion = '28' and lang = '1'".$loc);

					$array_negocios = array();
					while($regb = $ini->fetch_object($sqlb)){
						if(!in_array($regb2->id_negocio, $array_negocios)){
							$array_negocios[] = $regb->id;
						}
					}

				};
				break;
				// 23: eventos
				case 23:{
					$sqlb = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id = '".$_POST['id_url']."' and lang = '1'");
					$regb = $ini->fetch_object($sqlb);
					$url = $regb->url_amg;
					$seccion = $ini->busca('url_amg','url_amg_lang','id_url_amg',23,'lang',1)."/";

					$array_negocios = array();
					while($regb = $ini->fetch_object($sqlb)){
						if(!in_array($regb2->id_negocio, $array_negocios)){
							$array_negocios[] = $regb->id;
						}
					}

				};
				break;
				// 3: usuarios
				case 3:{
					$sqlb = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id = '".$_POST['id_url']."' and lang = '1'");
					$regb = $ini->fetch_object($sqlb);
					$url = $regb->url_amg;
					$seccion = $ini->busca('url_amg','url_amg_lang','id_url_amg',3,'lang',1)."/";
				};
				break;
				// 27: cervezas
				case 27:{


					$sqlb = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id = '".$_POST['id_url']."' and lang = '1'");



		            $array_negocios = array();
		           	while($regb=$ini->fetch_object($sqlb)){ 
		           		if($_POST['seccion'] == 27){  
		           			$sqlb2 = $ini->consulta("select id_negocio from union_ngc_crvz where id_cerveza = '".$regb->id."'");
		           			while($regb2 = $ini->fetch_object($sqlb2)){
		           				if(!in_array($regb2->id_negocio, $array_negocios)){
		           					$array_negocios[] = $regb2->id_negocio;
		           				}
		           			}
		           		}
		           	}



					$regb = $ini->fetch_object($sqlb);
					$url = $regb->url_amg;
					$seccion = $ini->busca('url_amg','url_amg_lang','id_url_amg',27,'lang',1)."/";



				};
				break;
				// 28: negocios
				case 28:{
					$sqlb = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where id = '".$_POST['id_url']."' and lang = '1'");
					$regb = $ini->fetch_object($sqlb);
					$url = $regb->url_amg;
					$seccion = $ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/";

					$array_negocios = array();
					while($regb = $ini->fetch_object($sqlb)){
						if(!in_array($regb2->id_negocio, $array_negocios)){
							$array_negocios[] = $regb->id;
						}
					}
					
				};
				break;
				default:{
					$sqlb = $ini->consulta("select url_amg_lang.titulo as titulo, url_amg.id as id, seccion, url_amg_lang.url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '27' and lang = '1'");
				}
			}
			if($_POST['seccion'] == 23 or $_POST['seccion'] == 3 or ($_POST['seccion'] == 27 and $_POST['localidad_b'] == "") or $_POST['seccion'] == 28){
				header('location: '.$urlppal.$seccion.$url);
				exit();
			}
		}else{


			$ssql = $ini->consulta("select seccion, id, match (titulo,metas,contenido) against ('".$_POST['busqueda']."') as relevancia from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where match (titulo,metas,contenido) against ('".$_POST['busqueda']."') order by relevancia limit 5");

			//echo "select id_url_amg, match (titulo,metas,contenido) against ('".$_POST['busqueda']."') as relevancia from url_amg_lang where match (titulo,metas,contenido) against ('".$_POST['busqueda']."') order by relevancia limit 5";

			if($ini->num_rows($ssql) > 0){


				while($rreg = $ini->fetch_object($ssql)){

					switch($rreg->seccion){


						case 33:{

							$loc = "";
							if($_POST['localidad_b'] != ""){

								$sqlloc = $ini->consulta("select Id from municipios where id_url_amg = '".$_POST['id_loc']."'");
								$regloc = $ini->fetch_object($sqlloc);
								$loc = " and municipio = '".$regloc->Id."'";

							}
							$sqlb = $ini->consulta("select id from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id inner join union_ngc_ctgr on url_amg.id = union_ngc_ctgr.id_negocio inner join negocio on union_ngc_ctgr.id_negocio = negocio.id_negocio where id_categoria = '".$rreg->id."' and seccion = '28' and lang = '1'".$loc);

							$array_negocios = array();
							while($regb = $ini->fetch_object($sqlb)){
								if(!in_array($regb2->id_negocio, $array_negocios)){
									$array_negocios[] = $regb->id;
								}
							}

						};
						break;


					}

				}


			}else{


				$sqlb = $ini->consulta("select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '28' and lang = '1' limit 10");
				//echo "select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '28' and lang = '1'";
				$array_negocios = array();
	           	while($regb=$ini->fetch_object($sqlb)){ 
	   				if(!in_array($regb2->id_negocio, $array_negocios)){
	   					$array_negocios[] = $regb->id;
	   				}
	           	}

           }
		}

		//echo var_dump($_POST);

		?><div class="row caja-resultados"><?php

			?><div class="col-sm-5 resultados"><?php

				foreach($array_negocios as $idn){

				

				$sqlb3 = $ini->consulta("select * from url_amg as ur inner join url_amg_lang as ln on ur.id = ln.id_url_amg inner join union_ngc_crvz as uc on ur.id = uc.id_negocio inner join negocio as ne on ur.id = ne.id_negocio where ur.id = '".$idn."'");
				if($ini->num_rows($sqlb3) > 0){
				$regb = $ini->fetch_object($sqlb3);
					$titalt = explode("/**/",$regb->titalt);
					if($regb->thumbs == ""){
						$regb->thumbs = $urlppal."imagen/redescabecera/desconocido.png";
					}


			?>


				<div class="row resultado">
					<div class="col-sm-5 imagen">
						<a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regb->url_amg; ?>">
							<img src="<?php echo $regb->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
						</a>
					</div>
					<div class="col-sm-7 contenido-resultado">
						<div class="titulo"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regb->url_amg; ?>"><?php echo $regb->titulo; ?></a></div>
						<div class="eslogan">
							<?php echo $regb->eslogan; ?>
						</div>
					</div>
				</div>


			<?php

			

			}

			}

		?></div>
		<div class="col-sm-7">




<script>

 function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(36.72338, -4.4522776),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;
           	<?php 
           		foreach($array_negocios as $idn){ 
           		$sqlb3 = $ini->consulta("select * from url_amg as ur inner join url_amg_lang as ln on ur.id = ln.id_url_amg inner join union_ngc_crvz as uc on ur.id = uc.id_negocio inner join negocio as ne on ur.id = ne.id_negocio where ur.id = '".$idn."'"); 
           		$regiconos=$ini->fetch_object($sqlb3);
				$direccion = $regiconos->direccionp;
				if($regiconos->icono != ""){ $iconomap = $regiconos->icono; }else{ $iconomap = $urlppal.'imagen/redescabecera/icono-map2.png'; }
				$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion).'&sensor=false&key=AIzaSyD9D5Znhe6ty7rt8iKzU72gsharvqUuJLE');
				$geo = json_decode($geo, true);
				if ($geo['status'] = 'OK') {
					$latitud = $geo['results'][0]['geometry']['location']['lat'];
					$longitud = $geo['results'][0]['geometry']['location']['lng'];
				}
				 if($direccion != "" and $latitud != "" and $longitud != ""){
				 	$direccp = str_replace(" ", "+", $direccion);
				?>
              	var id = <?php echo $regiconos->id; ?>; var name = '<?php echo $regiconos->titulo; ?>'; var address = '<?php echo $direccion; ?>';
              	var point = new google.maps.LatLng(parseFloat(<?php echo $latitud; ?>),parseFloat(<?php echo $longitud; ?>));
              	var infowincontent<?php echo $regiconos->id; ?> = document.createElement('div');
              	var infowincontent<?php echo $regiconos->id; ?>_1 = document.createElement('div');
              	var infowincontent<?php echo $regiconos->id; ?>_2 = document.createElement('div');
              	var infowincontent<?php echo $regiconos->id; ?>_3 = document.createElement('div');
              	infowincontent<?php echo $regiconos->id; ?>_2.style.textAlign = "center";
              	var strong = document.createElement('strong');
              	strong.textContent = name;
              	infowincontent<?php echo $regiconos->id; ?>_1.appendChild(strong);
              	var text = document.createElement('p');
              	text.textContent = address;
              	infowincontent<?php echo $regiconos->id; ?>_1.appendChild(text);
              	var img = document.createElement("IMG");
              	img.setAttribute("src", "<?php echo $regiconos->thumbs; ?>");
              	img.setAttribute("width", "120");
              	img.setAttribute("alt", "<?php echo $regiconos->titulo; ?>");
              	var imgc = document.createElement("IMG");
              	imgc.setAttribute("src", "<?php echo $urlppal; ?>imagen/redescabecera/icono-como-llegar.png");
              	imgc.setAttribute("width", "40");
              	var	newlink<?php echo $regiconos->id; ?> = document.createElement('a');
				newlink<?php echo $regiconos->id; ?>.setAttribute('class', 'signature');
				newlink<?php echo $regiconos->id; ?>.setAttribute('target','_blank');
				newlink<?php echo $regiconos->id; ?>.setAttribute('href', 'https://maps.google.es/maps?q=<?php echo $direccp; ?>&hl=es&sll=<?php echo $latitud; ?>,<?php echo $longitud; ?>&sspn=0.461566,1.056747&oq=<?php echo $direccp; ?>&hnear=<?php echo $direccp; ?>&t=m&z=17');
				newlink<?php echo $regiconos->id; ?>.appendChild(imgc);
              	infowincontent<?php echo $regiconos->id; ?>_2.appendChild(img);
              	infowincontent<?php echo $regiconos->id; ?>_3.appendChild(newlink<?php echo $regiconos->id; ?>);
              	infowincontent<?php echo $regiconos->id; ?>.appendChild(infowincontent<?php echo $regiconos->id; ?>_1);
              	infowincontent<?php echo $regiconos->id; ?>.appendChild(infowincontent<?php echo $regiconos->id; ?>_2);
              	infowincontent<?php echo $regiconos->id; ?>.appendChild(infowincontent<?php echo $regiconos->id; ?>_3);
	            var icon = {};
	            var image = {
	                url: '<?php echo $iconomap; ?>',
	                size: new google.maps.Size(30, 30),
	                origin: new google.maps.Point(0, 0),
	                anchor: new google.maps.Point(0, 32)
	            };
	            var marker<?php echo $regiconos->id; ?> = new google.maps.Marker({
	                map: map,
	                position: point,
	                icon: image,
	                label: icon.label
	            });
              	marker<?php echo $regiconos->id; ?>.addListener('click', function() {
	                infoWindow.setContent(infowincontent<?php echo $regiconos->id; ?>);
	                infoWindow.open(map, marker<?php echo $regiconos->id; ?>);
              	});
          <?php } } ?>
        }
</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9D5Znhe6ty7rt8iKzU72gsharvqUuJLE&callback=initMap"></script>
	<div class="caja-mapa">
		<div style="height:500px;" id="map"></div>
	</div>
</div>




		</div><?php
	?></div><?php ?>
