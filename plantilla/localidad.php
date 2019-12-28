<div class="contenido localidad">
	<?php echo $ini->contenido; ?>
	<div class="row caja-resultados">
		<div class="col-sm-9 resultados">
		<?php $idm = $ini->busca('Id','municipios','id_url_amg',$ini->id_url_amg);
			$sqlp = $ini->consulta("select * from url_amg as ur inner join url_amg_lang as ul on ur.id = ul.id_url_amg inner join negocio as ne on ur.id = ne.id_negocio where municipio = '".$idm."'");
			while($regb = $ini->fetch_object($sqlp)){ ?>
				<div class="row resultado">
					<div class="col-sm-3 imagen">
						<a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regb->url_amg; ?>">
							<img src="<?php echo $regb->thumbs; ?>" title="<?php echo $titalt[0]; ?>" alt="<?php echo $titalt[1]; ?>" />
						</a>
					</div>
					<div class="col-sm-9 contenido-resultado">
						<div class="titulo"><a href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regb->url_amg; ?>"><?php echo $regb->titulo; ?></a></div>
						<div class="eslogan">
							<?php echo $regb->eslogan; ?>
						</div>
						<div class="descripcion">
							<?php echo $regb->contenido; ?>
						</div>
						<div class="leer-mas">
							<a class="btn" href="<?php echo $urlppal.$ini->busca('url_amg','url_amg_lang','id_url_amg',28,'lang',1)."/".$regb->url_amg; ?>">Leer más</a> 
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="col-sm-3"></div>
	</div>



<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(36.72338, -4.4522776),
      zoom: 12
    });
	var infoWindow = new google.maps.InfoWindow;
   	<?php $sqlp = $ini->consulta("select * from url_amg as ur inner join url_amg_lang as ul on ur.id = ul.id_url_amg inner join negocio as ne on ur.id = ne.id_negocio where municipio = '".$idm."'");
    while($regiconos=$ini->fetch_object($sqlp)){
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
    var newlink<?php echo $regiconos->id; ?> = document.createElement('a');
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
	<div class="caja-mapa"><div style="height:500px;" id="map"></div></div>
</div>