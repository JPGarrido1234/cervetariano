<?php if($permiso == 1 or $permiso == 2 or $permiso == 3){ ?>
<?php if($_GET['se'] == 1){ ?>


<div class="modal fade" id="modo_eliminar" tabindex="-1" role="dialog" aria-labelledby="modo_eliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿ Seguro que quieres eliminar esta imagen ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary confirmar_elm_img" data-dismiss="modal">Eliminar</button>
        <form id="confirmar_form_img" action="" method="post">
            <input type="hidden" name="url_img" value="" id="url_img_form">
            <input type="hidden" name="carpeta" value="" id="carpeta_form">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modo_ver_url" tabindex="-1" role="dialog" aria-labelledby="modo_ver_urlLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Url imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="ver_url_img" value="" name="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


	<div class="panel panel-warning">
		<div class="panel-heading">Ver Imágenes</div>
		<div class="panel-body">
		<?php 
		$arbica = array(); 
		$sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
		while($regcr=$ini->fetch_object($sqlcr)){ 
			$arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); 
		} 
		?>
		<form action="" method="post">
			<input type="hidden" name="elcarpeta" value="activo" />
			<p>Mostrar carpeta: 
			<select name="carpetabs" id="carpetaselec" onchange="this.form.submit()">
				<option value="todas">todas</option>
				<?php foreach($arbica as $e=>$val){ ?>
					<option value="<?php echo $arbica[$e][0]; ?>"<?php if(isset($_POST['carpetabs']) and $_POST['carpetabs'] == $arbica[$e][0]){ ?> selected="selected"<?php } ?>><?php echo $arbica[$e][2]; ?></option>
				<?php } ?>
			</select>
			</p>
		</form>
		<?php 
		if(isset($_POST['elcarpeta'])){ 
			$arbica = array();
			$sql = $ini->consulta("select id, carpeta, nombre_amg from carpetas"); 
			while($reg=$ini->fetch_object($sql)){
				if($reg->id == $_POST['carpetabs'] or $_POST['carpetabs'] == "todas"){ 
					$arbica[$reg->id] = array($reg->id,$reg->carpeta,$reg->nombre_amg); 
				} 
			} 
		} ?>
		<div class="row ver_imagenes">
		<?php 
		$c = 0; 
		foreach($arbica as $e=>$val){ 
			foreach(glob("../imagen".$arbica[$e][1]."*") as $archivos_carpeta){ 
				if(!is_dir($archivos_carpeta)){ 
					$c++;
					$wh = getimagesize($archivos_carpeta);
					$archivos_carpeta = str_replace("../",$urlppal,$archivos_carpeta); ?>
  					<div class="col-sm-6 col-md-3 thumbnail">
    					<a href="<?php echo $archivos_carpeta; ?>" class="thumbnail" target="_blank">
      						<img src="<?php echo $archivos_carpeta; ?>" />
    					</a>
    					<a data-toggle="modal" class="func_ver_url" data-target="#modo_ver_url" id="<?php echo $archivos_carpeta; ?>" href="#">Ver url</a> | 
    					<a data-toggle="modal" class="func_eliminar" data-target="#modo_eliminar" id="<?php echo $archivos_carpeta; ?>" href="#"><i class="fa fa-recycle fa-fw"></i></a>
  					</div>
					<?php 
				} 
			} 
		} ?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.func_ver_url').click(function(){
			document.getElementById('ver_url_img').value = this.id;
		});
		$('.func_eliminar').click(function(){
			document.getElementById('url_img_form').value = this.id;
			var carpetaselec = document.getElementById('carpetaselec').value;
			document.getElementById('carpeta_form').value = carpetaselec;
		});
		
		$('.confirmar_elm_img').click(function(){
			var url = "../utiles/admin/php/muestra_imagen.php";
			$.ajax({ type: "POST", url: url, data: $('#confirmar_form_img').serialize(), success: function(data){ $('.ver_imagenes').html(data); } });
		});
	});
</script>
		</div>
	</div>
</div>



<?php if($c == 0){ ?> - Sin Imágenes - <?php } ?>

<?php } ?>


<?php if($_GET['se'] == 2){ ?>
 <script>
	var i = 1;

	$(document).ready(function () {

	    $('.insertfila').click(function(){
	        i++; 
	        var elmPPAL = document.getElementById('mas-img'); 
	        var elmDivPpal = document.createElement('div'); 

	        elmDivPpal.className = 'form-group row';
	        
	        var elmDivCI = document.createElement('div');
	        elmDivCI.className = 'col-sm-3';
	        
	        var elmDivCD = document.createElement('div');
	        elmDivCD.className = 'col-sm-6';

	        var elmLabel = document.createElement('label');
	        elmLabel.textContent = 'Imagen '+i;
	        	        
	        var elmInput = document.createElement('input');
	        elmInput.type = 'file';
	        elmInput.name = 'img'+i;
	        elmInput.className = 'form-control';

	        elmDivPpal.appendChild(elmDivCI);
	        elmDivPpal.appendChild(elmDivCD);
	        elmDivCI.appendChild(elmLabel);
	        elmDivCD.appendChild(elmInput);
	        elmPPAL.insertBefore(elmDivPpal,elmPPAL.childNodes[0]);
	        return false;
	    });

    });
	
</script>
<div class="panel panel-warning"><div class="panel-heading">Insertar</div><div class="panel-body">
<?php $arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); } ?>
		<form role="form" method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
    	<input type="hidden" name="modo" value="crear" />
        <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    	<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    	<input type="hidden" name="idioma" value="<?php echo $_GET['idioma']; ?>">

    	
		    <div class="form-group row">
		    <div class="input__row uploader">
		      <div id="inputval" class="input-value"></div>
		      <label for="file_1"></label>
		      <input id="file_1" name="img1" class="upload" type="file" />
		    </div>
		    </div>

		    <div class="form-group row">
		    <div class="box">
		        <select class="form-control" id="carpeta" name="carpeta">
		            <option value="0">Selecciona carpeta</option>
		            <?php foreach($arbica as $e=>$val){ ?>
		                <option value="<?php echo $arbica[$e][0]; ?>"><?php echo $arbica[$e][2]; ?></option>
		            <?php } ?>
		        </select>
		    </div>
		    </div>

		    <div class="form-group row">
		        <input class="form-control" id="nueva" type="text" name="nueva" value="" />
		        <label for="nueva">¿Añadir Nueva carpeta?</label>
		    </div>


			<div class="form-group row"><input type="submit" class="btn btn-warning" value="Insertar" /></div>
		</form>
</div></div>
<?php } ?>
<?php }else{ ?>
Lo sentimos, no tiene permisos para acceder a esta zona.
<?php } ?>
