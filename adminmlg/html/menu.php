<?php if($permiso == 1){ 
if($_GET['se'] == 1){ $titulo_menu = array(1=>"Cabecera",2=>"Sub footer");
	for($f=1;$f<=2;$f++){ ?>
		<div class="panel panel-default">
		<div class="panel-heading"><h3 class="panel-title">Menú <?php echo $titulo_menu[$f]; ?></h3></div>
		  	<div class="panel-body">
				<ul>
					<?php $ssql = $ini->consulta("select url_amg from menu where tipo = '".$f."' order by orden asc"); $i = 1;	while($rreg = $ini->fetch_object($ssql)){ ?>
						<li><?php echo $ini->busca("titulo","url_amg_lang","id_url_amg",$rreg->url_amg,'lang','1'); ?></li> 
					<?php } ?>	
		    	</ul>
			</div>
		</div>
<?php } 
} ?>

<?php if($_GET['se'] == 2){ ?>
<?php $titulos = array(1=>"Menú Cabecera",2=>"Menú Footer"); ?>
<?php for($f=1;$f<=2;$f++){ ?>
<script>
	$(document).ready(function () {
		$('#menuc<?php echo $f; ?>').change(function(){
			if(this.value == -9){
				$('#completar').show();
			}else{
				$('#completar').hide();
			}
		});
	});
</script>
<div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title"><?php echo $titulos[$f]; ?></h3></div>
  <div class="panel-body">
	<form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
	<input type="hidden" name="modo" value="modificar<?php echo $f; ?>" />
	<input type="hidden" name="idmenu" value="<?php echo $f; ?>" /> 
	<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
	<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
	<?php $ssql = $ini->consulta("select * from menu where tipo = '".$f."' order by orden asc"); $i = 1;
	while($rreg = $ini->fetch_object($ssql)){ ?>
		<div class="form-group row">
			<div class="col-sm-2"><?php if($rreg->url_ext == 1){ echo $rreg->titulo; }else{ echo $ini->busca("titulo","url_amg_lang","id_url_amg",$rreg->url_amg,"lang","1"); } ?> </div>
			<div class="col-sm-1"><input class="form-control" id="<?php echo $i; ?>" type="text" name="<?php echo $rreg->id.",".$rreg->orden; ?>" value="<?php echo $rreg->orden; ?>" /></div>
			<div class="col-sm-2"><input type="checkbox" name="<?php echo $rreg->id."-".$rreg->orden; ?>" value="1"<?php if($rreg->blank == 1){ ?> checked="checked"<?php } ?>> ¿Target blank?</div>
			<?php if($rreg->url_ext == 1){ ?>
			<div class="col-sm-3"><input class="form-control" type="text" name="url" value="<?php echo $rreg->url; ?>"></div>
			<div class="col-sm-2"><input class="form-control" type="text" name="titurl" value="<?php echo $rreg->titulo; ?>"></div>
			<?php } ?>
			<div class="col-sm-2"><input type="submit" name="e<?php echo $rreg->id.",".$rreg->orden; ?>" value="Eliminar" onclick="this.form.submit()" class="btn btn-danger" /></div>
		</div> 
	<?php } ?>
	<div class="form-group row">
	<div class="col-sm-3"><label for="menuc<?php echo $f; ?>">Insertar página</label></div>
    <div class="col-sm-3"><select id="menuc<?php echo $f; ?>" name="menu<?php echo $f; ?>"><option value="">Seleccionar página</option> <option value="-9"> - PÁGINA EXTERIOR - </option>
    	<?php $sql = $ini->consulta("select titulo, id_url_amg from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where lang = '1' and seccion = '0'"); while($reg=$ini->fetch_object($sql)){ ?>
    		<option value="<?php echo $reg->id_url_amg; ?>"><?php echo $reg->titulo; ?></option>
    	<?php } ?>
    </select></div>
    </div>
    <div class="form-group row" id="completar" style="display: none;">
    	<div class="col-sm-1">Título</div><div class="col-sm-3"><input type="text" name="titurln" class="form-control"></div><div class="col-sm-1">Url</div><div class="col-sm-3"><input type="text" name="urln" class="form-control"></div>
    </div>
    <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Guardar Cambios" /></div>
	</form>
  </div>
</div>
<?php } ?>

<?php } ?>


<?php }else{ ?>Lo sentimos, no tiene permisos para acceder a esta zona.<?php } ?>