<?php
$sql1 = $ini->consulta("select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id inner join cerveza on url_amg_lang.id_url_amg = cerveza.id_cerveza where id_url_amg = '".$ini->id_url_amg."' and lang = '1'");
$reg1 = $ini->fetch_object($sql1);
$titalt = explode("/**/",$reg1->titalt); 
?>

<div class="contenido contenido-cerveza" style="background: #fff;">
	<div class="partes-web caja-3 row">
		<div class="zona-banda row">
			<div class="banda-s">
				<div class="cervezas"><img src="<?php echo $urlppal; ?>imagen/redescabecera/icono-cervezas.png" alt="icono cervezas" title="Top 5 Cervezas" /></div>
				<div class="titular"><?php echo $ini->titulo; ?></div>
			</div>
	    </div>
	    <div class="slide row">
	    	<section class="single-item">
	    		<div>
	    			<div class="caja-cervezas row">
		    			<div class="imagen col-sm-3">
		    				<img src="<?php echo $reg1->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
		    			</div>
		    			<div class="informacion col-sm-9">
		    				<div class="texto">
		    					<p><b>Marca:</b> <?php echo $ini->selectcampo($reg1->marca,"cz_marca","titulo_es"); ?></p>
		    					<p class="no-margin"><b>Descripción:</b></p>
		    					<?php echo $reg1->contenido; ?>
				    			<div class="row">
				    				<div class="col-sm-5 columnas-cervezas">
					    				<p><b>Denominación de Origen:</b> <?php echo $reg1->denominacion; ?></p>
					    				<p><b>País:</b> </p>
					    				<p><b>Municipio:</b> </p>
					    				<p><b>Productor:</b> <?php echo $ini->selectcampo($reg1->productor,"cz_productor","titulo_es"); ?></p>
					    				<p><b>EBC:</b> <?php echo $ini->selectcampo($reg1->ebc,"cz_ebc","titulo_es"); ?></p>
					    				<p><b>IBUS:</b> <?php echo $reg1->ibus; ?></p>
				    				</div>
				    				<div class="col-sm-4 columnas-cervezas">
					    				<p><b>Tipo:</b> <?php echo $ini->selectcampo($reg1->tipo,"cz_tipo","titulo_es"); ?></p>
					    				<p><b>Capacidad:</b> <?php echo $ini->selectcampo($reg1->capacidad,"cz_capacidad","titulo_es"); ?></p>
					    				<p><b>Alcohol:</b> <?php echo $reg1->alcohol; ?></p>
					    				<p><b>Color:</b> <?php echo $ini->selectcampo($reg1->color,"cz_color","titulo_es"); ?></p>
					    				<p><b>Fermentación:</b> <?php echo $ini->selectcampo($reg1->fermentacion,"cz_fermentacion","titulo_es"); ?></p>
					    				<p><b>Temperatura ideal:</b> </p>
				    				</div>
				    				<div class="col-sm-3 columnas-cervezas">
				    					<p><b>Información adicional:</b></p>
				    					<?php echo $reg1->adicional; ?>
				    				</div>
				    			</div>
			    			</div>
		    			</div>
	    			</div>
	    		</div>
	    	</section>
	    </div>
	</div>



<script>

 function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(36.72338, -4.4522776),
          zoom: 12
        });

        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          
           // var markers = xml.documentElement.getElementsByTagName('marker');
            
            <?php $sqliconos = $ini->consulta("select * from url_amg as ur inner join url_amg_lang as ln on ur.id = ln.id_url_amg inner join union_ngc_crvz as uc on ur.id = uc.id_negocio inner join negocio as ne on ur.id = ne.id_negocio  where uc.id_cerveza = '".$ini->id_url_amg."'"); 




            ?>


            <?php while($regiconos=$ini->fetch_object($sqliconos)){ ?>
				<?php
				            $direccion = $regiconos->direccionp;
				  if($regiconos->icono != ""){
				  	$iconomap = $regiconos->icono;
				  }else{
				  	$iconomap = $urlppal.'imagen/redescabecera/icono-map2.png';
				  }
				 
				// Obtener los resultados JSON de la peticion.
				$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion).'&sensor=false&key=AIzaSyD9D5Znhe6ty7rt8iKzU72gsharvqUuJLE');
				 
				//alert('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($direccion).'&sensor=false');

				// Convertir el JSON en array.
				$geo = json_decode($geo, true);
				 
				// Si todo esta bien
				if ($geo['status'] = 'OK') {
					// Obtener los valores
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
              
              var linknegociourl = '<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regiconos->url_amg; ?>';
              var linknegocio = document.createElement('a');
              linknegocio.setAttribute('href',linknegociourl);
              var linknegocio2 = document.createElement('a');
              linknegocio2.setAttribute('href',linknegociourl);

              strong.appendChild(linknegocio);
              linknegocio.textContent = name;
              infowincontent<?php echo $regiconos->id; ?>_1.appendChild(strong);
              

              var text = document.createElement('p');
              text.textContent = address;
              infowincontent<?php echo $regiconos->id; ?>_1.appendChild(text);


              var img = document.createElement("IMG");
              img.setAttribute("src", "<?php echo $regiconos->thumbs; ?>");
              img.setAttribute("width", "120");
              //img.setAttribute("height", "228");
              img.setAttribute("alt", "<?php echo $regiconos->titulo; ?>");

              var imgc = document.createElement("IMG");
              imgc.setAttribute("src", "<?php echo $urlppal; ?>imagen/redescabecera/icono-como-llegar.png");
              imgc.setAttribute("width", "40");
              //img.setAttribute("height", "228");
              //img.setAttribute("alt", "<?php echo $regiconos->titulo; ?>");

              //https://maps.google.es/maps?q=Calle+San+Vicente+de+Paul,+Valencia&hl=es&sll=39.407785,-0.361511&sspn=0.461566,1.056747&oq=Calle+San+vicente&hnear=Calle+San+Vicente+de+Paul,+46019+Valencia&t=m&z=17


              	var	newlink<?php echo $regiconos->id; ?> = document.createElement('a');
				newlink<?php echo $regiconos->id; ?>.setAttribute('class', 'signature');
				newlink<?php echo $regiconos->id; ?>.setAttribute('target','_blank');
				newlink<?php echo $regiconos->id; ?>.setAttribute('href', 'https://maps.google.es/maps?q=<?php echo $direccp; ?>&hl=es&sll=<?php echo $latitud; ?>,<?php echo $longitud; ?>&sspn=0.461566,1.056747&oq=<?php echo $direccp; ?>&hnear=<?php echo $direccp; ?>&t=m&z=17');



				newlink<?php echo $regiconos->id; ?>.appendChild(imgc);

			 linknegocio2.appendChild(img);

              infowincontent<?php echo $regiconos->id; ?>_2.appendChild(linknegocio2);
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

      function downloadUrl( callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        //request.open('GET', url, true);
       // request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9D5Znhe6ty7rt8iKzU72gsharvqUuJLE&callback=initMap"></script>



	<div class="caja-mapa">
		<div id="map"></div>
	</div>


</div>