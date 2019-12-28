<script>
$(document).ready(function () {
    $('.form-control').focusout(function() {
        if($(this).val() == ""){
            $(this).removeClass("relleno");
        }else{
            $(this).addClass("relleno");
        }
    });
});
</script>
<?php if($permiso == 1){ ?>
<ul class="nav nav-pills">
  <li<?php if($_GET['se'] == 1){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=1">Imagenes en la web</a></li>
  <li<?php if($_GET['se'] == 2){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=2">Partes sueltas</a></li>
  <li<?php if($_GET['se'] == 3){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=3">Redes sociales</a></li>
  <li<?php if($_GET['se'] == 4){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=4">SEO</a></li>
  <li<?php if($_GET['se'] == 5){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=5">Categorías</a></li>
  <li<?php if($_GET['se'] == 6){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=6">Secciones pricipales</a></li>
  <li<?php if($_GET['se'] == 7){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=7">Slide Cabecera Home</a></li>
</ul>
<br><br>

<?php
$lanes = include("../utiles/lang/".$ini->selectcampo($idioma,'lang','siglas').".php");
$arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); }
?>

<?php if($_GET['se'] == 1){ ?>
<div class="panel panel-warning">
  <div class="panel-heading">Logotipo</div>
  <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
	  <input type="hidden" name="modo" value="logo" />
	  <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    <input type="hidden" name="idioma" value="<?php echo $idioma ?>" />
    <?php $titalt = $ini->busca('value','opciones_lang','id','1','lang',$idioma); $titalt = explode("/**/",$titalt); ?>
    <p class="help-block"><?php echo $ini->selectcampo(1,'opciones','value'); ?></p>
    <div class="form-group row">
      <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail ccc">
          <img src="<?php echo $ini->selectcampo(1,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
        </a>
      </div>
    </div>
    <div class="form-group row">
      <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
        <label for="file_1"></label>
        <input type="file" class="upload" id="file_1" name="archivo" />
      </div>
    </div>
    <div class="form-group row">
      <div class="box">
        <select class="form-control" id="carpeta" name="carpeta">
          <?php foreach($arbica as $e=>$val){ ?>
            <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <input class="form-control" id="nueva" type="text" name="nueva" value="" />
      <label for="nueva">¿Añadir Nueva carpeta?</label>
    </div>
    <div class="form-group row">
      <input type="text" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" id="idtimg" name="tit" value="<?php echo $titalt[0]; ?>" />
      <label for="idtimg">Título</label>
    </div>
    <div class="form-group row">
      <input type="text" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" id="idaimg" name="alt" value="<?php echo $titalt[1]; ?>" />
      <label for="idaimg">Alt</label>
    </div>
	  <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
  </form>
  </div>
</div>

<div class="panel panel-warning">
  <div class="panel-heading">Logotipo footer</div>
  <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
    <input type="hidden" name="modo" value="logo-footer" />
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    <input type="hidden" name="idioma" value="<?php echo $idioma ?>">
    <?php $titalt = $ini->busca('value','opciones_lang','id','6','lang',$idioma); $titalt = explode("/**/",$titalt); ?>
    <p class="help-block"><?php echo $ini->selectcampo(34,'opciones','value'); ?></p>
    <div class="form-group row">
      <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail ccc">
          <img src="<?php echo $ini->selectcampo(34,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
        </a>
      </div>
    </div>
    <div class="form-group row">
      <div class="input__row uploader">
        <div id="inputval" class="input-value"></div>
        <label for="file_1-footer"></label>
        <input type="file" class="upload" id="file_1-footer" name="archivo" />
      </div>
    </div>
    <div class="form-group row">
      <div class="box">
        <select class="form-control" id="carpeta-footer" name="carpeta">
          <?php foreach($arbica as $e=>$val){ ?>
            <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <input class="form-control" id="nueva-footer" type="text" name="nueva" value="" />
      <label for="nueva-footer">¿Añadir Nueva carpeta?</label>
    </div>
    <div class="form-group row">
      <input type="text" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" id="idtimg-footer" name="tit" value="<?php echo $titalt[0]; ?>" />
      <label for="idtimg-footer">Título</label>
    </div>
    <div class="form-group row">
      <input type="text" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" id="idaimg-footer" name="alt" value="<?php echo $titalt[1]; ?>" />
      <label for="idaimg-footer">Alt</label>
    </div>
    <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
  </form>
  </div>
</div>

<?php } ?>



<?php if($_GET['se'] == 2){ ?>

<script>
  function isertar_localidad(id,se,op){
    var id_caja = parseInt(document.getElementById("count_ser").value);
    var new_id_caja = parseInt(id_caja) + 1;
    document.getElementById("count_ser").value = new_id_caja;
    document.getElementById("eis_id").value = id;
    var url = "../utiles/admin/php/insertar_localidad.php";
    $.ajax({ type: "POST", url: url, data: $('#insertar_localidad').serialize(), success: function(data){ $('#insertar_localidad_'+id_caja).html(data); } });
  }
  function insertar_categoria(id,se,op,caja){
    var id_caja = parseInt(document.getElementById("count_serc").value);
    var new_id_caja = parseInt(id_caja) + 1;
    document.getElementById("count_serc").value = caja;
    document.getElementById("eis_idc").value = id;
    var url = "../utiles/admin/php/insertar_categoria.php";
    $.ajax({ type: "POST", url: url, data: $('#insertar_categoria').serialize(), success: function(data){ $('#insertar_categoria_'+caja).html(data); $('#antiguo_'+caja).html(''); } });
  }
</script>
<link href="<?php echo $urlppal; ?>/utiles/css/jquery.typeahead.css" rel="stylesheet">
<script src="<?php echo $urlppal; ?>/utiles/js/jquery.typeahead.js"></script>
<form id="insertar_localidad">
    <input type="hidden" id="count_ser" name="count_ser" value="0" />
    <input type="hidden" id="eis_id" name="localidad" value="" />
</form>

<form id="insertar_categoria">
    <input type="hidden" id="count_serc" name="count_ser" value="0" />
    <input type="hidden" id="eis_idc" name="categoria" value="" />
</form>

<div class="panel panel-warning">
  <div class="panel-heading">Textos Generales</div>
  <div class="panel-body">
   	  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
	        <input type="hidden" name="modo" value="textos" />
          <input type="hidden" name="idioma" value="<?php echo $idioma; ?>" />
	        <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
          <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
          
          <div class="form-group row">
            <input class="form-control<?php if($lanes['copyr'] != ""){ echo " relleno"; } ?>" id="idcab2" type="text" name="copyr" value="<?php echo $lanes['copyr']; ?>" />
            <label for="idcab2">Copyright:</label>
          </div>
	        <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

	   </form>
  </div>
</div>

<div class="panel panel-warning">
  <div class="panel-heading">Localidades Inicio</div><div class="panel-body">
    <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
    <input type="hidden" name="modo" value="inicio_localidades" />
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    <input type="hidden" name="idioma" value="1" />

<?php $ids = $ini->selectcampo(29,'opciones','value');

if($ids != ""){
$id_localidades = explode(",",$ids);

foreach($id_localidades as $id){ 

        $sqldts = $ini->consulta("select titulo from url_amg_lang where id_url_amg = '".$id."' and lang = '1'"); $regdts = $ini->fetch_object($sqldts); $hentrado = true; ?>
         <div class="input-group">
          <span class="input-group-addon">
            <input type="checkbox" checked="checked" name="lcldds<?php echo $id; ?>" value="1" aria-label="...">
          </span>
          <input type="text" class="form-control" disabled="disabled" value="<?php echo $regdts->titulo; ?>" aria-label="...">
        </div>


<?php } } ?>

<?php if($hentrado){ ?><div style="height:35px;"></div><?php } ?>

<div class="panel panel-warning">
<div class="panel-heading">Localidades destacadas</div><div class="panel-body">


    <div class="typeahead__container">
        <div class="typeahead__field">
            <span class="typeahead__query input-ppal">
                <div id="input-ppal" class="input-ppalcls">
                    <div id="contenido_buscar" class="input-group stylish-input-group">
                        <input type="text" id="quebusca" autocomplete="off" class="form-control js-typeahead" name="busqueda" placeholder="Buscar" />
                        <span class="input-group-addon"><button type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                    </div>
                </div>
            </span>
        </div>
    </div>

    <div id="insertar_localidad_0"></div>


</div>
</div>

<script>
    typeof $.typeahead === 'function' && $.typeahead({
        input: ".js-typeahead", minLength: 0, maxItem: 9, dynamic: true, delay: 500, order: "asc", href: "javascript: isertar_localidad('{{id}}','{{se}}','{{division}}');", hint: true,
        searchOnFocus: false, accent:{ from: 'áéíóúàèìòù', to: 'aeiouaeiou'},
        emptyTemplate: 'No se encuentran cervezas con este texto',
        display: ["titulo"], correlativeTemplate: true,
        template: '<span>' + '<span class="name">{{titulo}}</span>' + '</span>',
        source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar_localidades.php", dataType: "json",
        data: { q: "{{query}}", i: "{{<?php echo $idioma; ?>}}" } } }, callback: { done: function (data) { return data; } } }
    });
</script>      



    <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

   </form>




  </div>
</div>











<div class="panel panel-warning">
  <div class="panel-heading">Categorías Inicio</div><div class="panel-body">
    <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
    <input type="hidden" name="modo" value="inicio_categorias" />
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    <input type="hidden" name="idioma" value="1" />

<?php 

            



$e = 1;

for($i=30;$i<=33;$i++){ 
        $id = $ini->selectcampo($i,'opciones','value');
        $sqldts = $ini->consulta("select titulo from url_amg_lang where id_url_amg = '".$id."' and lang = '1'"); $regdts = $ini->fetch_object($sqldts); ?>


         <div id="antiguo_<?php echo $i; ?>"> 
         <div class="input-group">
          <span class="input-group-addon">
            <input type="checkbox" checked="checked" name="ctgr<?php echo $id; ?>-<?php echo $i; ?>" value="1" aria-label="...">
          </span>
          <input type="text" class="form-control" disabled="disabled" value="<?php echo $regdts->titulo; ?>" aria-label="...">
        </div>
        </div>



<div style="height:35px;"></div>

<div class="panel panel-warning">
<div class="panel-heading">Categoría destacada <?php echo $e; ?></div><div class="panel-body">


    <div class="typeahead__container">
        <div class="typeahead__field">
            <span class="typeahead__query input-ppal">
                <div id="input-ppal" class="input-ppalcls">
                    <div id="contenido_buscar" class="input-group stylish-input-group">
                        <input type="text" id="quebusca" autocomplete="off" class="form-control js-typeahead<?php echo $i; ?>" name="busqueda" placeholder="Buscar" />
                        <span class="input-group-addon"><button type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                    </div>
                </div>
            </span>
        </div>
    </div>

    <div id="insertar_categoria_<?php echo $i; ?>"></div>


</div>
</div>

<script>
    typeof $.typeahead === 'function' && $.typeahead({
        input: ".js-typeahead<?php echo $i; ?>", minLength: 0, maxItem: 9, dynamic: true, delay: 500, order: "asc", href: "javascript: insertar_categoria('{{id}}','{{se}}','{{division}}','<?php echo $i; ?>');", hint: true,
        searchOnFocus: false, accent:{ from: 'áéíóúàèìòù', to: 'aeiouaeiou'},
        emptyTemplate: 'No se encuentran categorías con este texto',
        display: ["titulo"], correlativeTemplate: true,
        template: '<span>' + '<span class="name">{{titulo}}</span>' + '</span>',
        source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar_categoria.php", dataType: "json",
        data: { q: "{{query}}", i: "{{<?php echo $idioma; ?>}}" } } }, callback: { done: function (data) { return data; } } }
    });
</script>      

<?php $e++; } ?>

    <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

   </form>




  </div>
</div>












<div class="panel panel-warning">
  <div class="panel-heading">Textos blog</div><div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
  <input type="hidden" name="modo" value="textos_blg" />
  <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
  <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />

    <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

  </form>
  </div>
</div>

<?php } ?>

<?php if($_GET['se'] == 3){ ?>

<div class="panel panel-warning">
  <div class="panel-heading">Modificar urls de redes sociales</div>
  <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
	<input type="hidden" name="modo" value="redes" />
	<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
  <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />

    <?php $facebook = $ini->selectcampo(23,'opciones','value'); ?>
    <?php $instagram = $ini->selectcampo(24,'opciones','value'); ?>
    <?php $linkedin = $ini->selectcampo(25,'opciones','value'); ?>
    <?php $pinterest = $ini->selectcampo(26,'opciones','value'); ?>
    <?php $twitter = $ini->selectcampo(27,'opciones','value'); ?>
    <?php $youtube = $ini->selectcampo(28,'opciones','value'); ?>

    <div class="form-group row">
      <input class="form-control<?php if($facebook != ""){ echo " relleno"; } ?>" id="idfacebook" type="text" name="facebook" value="<?php echo $facebook; ?>" />
      <label for="idfacebook">Facebook</label>
    </div>

    <div class="form-group row">
      <input class="form-control<?php if($instagram != ""){ echo " relleno"; } ?>" id="idinstagram" type="text" name="instagram" value="<?php echo $instagram; ?>" />
      <label for="idinstagram">Instagram</label>
    </div>

    <div class="form-group row">
      <input class="form-control<?php if($linkedin != ""){ echo " relleno"; } ?>" id="idlinkedin" type="text" name="linkedin" value="<?php echo $linkedin; ?>" />
      <label for="idlinkedin">Linkedin</label>
    </div>    

    <div class="form-group row">
      <input class="form-control<?php if($pinterest != ""){ echo " relleno"; } ?>" id="idpinterest" type="text" name="pinterest" value="<?php echo $pinterest; ?>" />
      <label for="idpinterest">Pinterest</label>
    </div>

    <div class="form-group row">
      <input class="form-control<?php if($twitter != ""){ echo " relleno"; } ?>" id="idtwitter" type="text" name="twitter" value="<?php echo $twitter; ?>" />
      <label for="idtwitter">Twitter</label>
    </div>

    <div class="form-group row">
      <input class="form-control<?php if($youtube != ""){ echo " relleno"; } ?>" id="idyoutube" type="text" name="youtube" value="<?php echo $youtube; ?>" />
      <label for="idyoutube">Youtube</label>
    </div>

	  <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

	</form>
	</div>
</div>

<?php } ?>

<?php if($_GET['se'] == 4){ ?>

<div class="panel panel-warning">
  <div class="panel-heading">Códigos de seguimiento</div>
  <div class="panel-body">
 	<form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
	<input type="hidden" name="modo" value="seo" />
	<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
	<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />

    <?php $analytics = $ini->selectcampo(2,'opciones','value'); ?>
    <?php $manager = $ini->selectcampo(3,'opciones','value'); ?>  

    <div class="form-group row">
      <input class="form-control" id="idlytics" type="text" name="lytics" value="<?php echo $analytics; ?>" />
      <label for="idlytics">Google analytics:</label>
    </div>

    <div class="form-group row">
      <input class="form-control" id="idmanager" type="text" name="manager" value="<?php echo $manager; ?>" />
      <label for="idmanager">Google Tag manager:</label>
    </div>

	  <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
   	
  </form>
  </div>
</div>

<?php } ?>


<?php if($_GET['se'] == 5){ ?>

<div class="panel panel-warning">
  <div class="panel-heading">Categorías</div>
  <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
  <input type="hidden" name="modo" value="categorias" />
  <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
  <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
  <input type="hidden" name="idioma" value="<?php echo $_GET['idioma'] ?>">

  <?php $sql = $ini->consulta("select * from categoria where tipo = '1'"); while($reg = $ini->fetch_object($sql)){ ?>

  <?php $ssql = $ini->consulta("select * from lang"); while($rreg = $ini->fetch_object($ssql)){ ?>

    <div class="form-group row">
    <div class="col-sm-3">
      <label for="id<?php echo $reg->id."-".$rreg->id; ?>">
        <img width="18" height="14" src="<?php echo $urlppal."utiles/lang/imagen/".$rreg->siglas.".png" ?>" /> 
        <?php if($ini->busca("categoria","cat_lang","id_categoria",$reg->id,"lang",$rreg->id) != ""){ 
          echo $ini->busca("categoria","cat_lang","id_categoria",$reg->id,"lang",$rreg->id); }else{ echo "Sin traducción"; } ?>:
      </label>
    </div> 
    <div class="col-sm-6">
      <input class="form-control" id="id<?php echo $reg->id."-".$rreg->id; ?>" type="text" name="<?php echo $reg->id."-".$rreg->id; ?>" value="<?php echo $ini->busca("categoria","cat_lang","id_categoria",$reg->id,"lang",$rreg->id); ?>" />
    </div>
    </div>

  <?php } ?>

  <?php } ?>

   <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>

   </form>
   </div>
 </div>

<?php } ?>
<?php if($_GET['se'] == 6){ ?>

  <div class="panel panel-warning"><div class="panel-heading">Secciones principales</div> <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
  <input type="hidden" name="modo" value="secciones" />
  <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
  <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
  <input type="hidden" name="idioma" value="<?php echo $_GET['idioma'] ?>">
  
    <div class="form-group row">
    <div class="col-sm-3">
      <label for="inicio">
        Página Inicio:
      </label>
    </div> 
    <div class="col-sm-6">
      <select class="form-control" name="inicio" id="inicio">
        <?php $sql = $ini->consulta("select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and lang = '1'"); 
              while($reg = $ini->fetch_object($sql)){ ?>
              <option<?php if($reg->id == $ini->selectcampo(6,'opciones','value')){ ?> selected="selected"<?php } ?> value="<?php echo $reg->id; ?>"><?php echo $reg->titulo; ?></option>
        <?php } ?>
      </select>
    </div>
    </div>

    <div class="form-group row">
    <div class="col-sm-3">
      <label for="tienda">
        Página Tienda:
      </label>
    </div> 
    <div class="col-sm-6">
      <select class="form-control" name="tienda" id="tienda">
        <?php $sql = $ini->consulta("select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and lang = '1'"); 
              while($reg = $ini->fetch_object($sql)){ ?>
              <option<?php if($reg->id == $ini->selectcampo(8,'opciones','value')){ ?> selected="selected"<?php } ?> value="<?php echo $reg->id; ?>"><?php echo $reg->titulo; ?></option>
        <?php } ?>
      </select>
    </div>
    </div>
    <div class="form-group row">
    <div class="col-sm-3">
      <label for="404">
        Página 404:
      </label>
    </div> 
    <div class="col-sm-6">
      <select class="form-control" name="404" id="404">
        <?php $sql = $ini->consulta("select * from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and lang = '1'"); 
              while($reg = $ini->fetch_object($sql)){ ?>
              <option<?php if($reg->id == $ini->selectcampo(7,'opciones','value')){ ?> selected="selected"<?php } ?> value="<?php echo $reg->id; ?>"><?php echo $reg->titulo; ?></option>
        <?php } ?>
      </select>
    </div>
    </div>
  <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
  </form>
  </div> </div>
<?php } ?>
<?php if($_GET['se'] == 7){ ?>

<div class="panel panel-warning">
  <div class="panel-heading">Slide</div>
  <div class="panel-body">
  <form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
  <input type="hidden" name="modo" value="slide" />
  <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
  <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
  <input type="hidden" name="idioma" value="<?php echo $idioma ?>">
  

    


    <?php $titalt = $ini->busca('value','opciones_lang','id','17','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(17,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(17,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_17"></label>
      <input id="file_17" name="archivo17" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg17" class="form-control" name="archivo_url17" />
      <label for="idimg17">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta17" name="carpeta17">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva17" type="text" name="nueva17" value="" />
      <label for="nueva17">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg17" id="idtimg17" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg17">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg17" id="idaimg17" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg17">Alt</label>
    </div>












    <?php $titalt = $ini->busca('value','opciones_lang','id','18','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(18,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(18,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_18"></label>
      <input id="file_18" name="archivo18" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg18" class="form-control" name="archivo_url18" />
      <label for="idimg18">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta18" name="carpeta18">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva18" type="text" name="nueva18" value="" />
      <label for="nueva18">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg18" id="idtimg18" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg18">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg18" id="idaimg18" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg18">Alt</label>
    </div>








    <?php $titalt = $ini->busca('value','opciones_lang','id','19','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(19,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(19,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_19"></label>
      <input id="file_19" name="archivo19" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg19" class="form-control" name="archivo_url19" />
      <label for="idimg19">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta19" name="carpeta19">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva19" type="text" name="nueva19" value="" />
      <label for="nueva19">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg19" id="idtimg19" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg19">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg19" id="idaimg19" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg19">Alt</label>
    </div>






    <?php $titalt = $ini->busca('value','opciones_lang','id','20','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(20,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(20,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_20"></label>
      <input id="file_20" name="archivo20" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg20" class="form-control" name="archivo_url20" />
      <label for="idimg20">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta20" name="carpeta18">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva20" type="text" name="nueva20" value="" />
      <label for="nueva20">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg20" id="idtimg20" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg20">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg20" id="idaimg20" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg20">Alt</label>
    </div>









    <?php $titalt = $ini->busca('value','opciones_lang','id','21','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(21,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(21,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_21"></label>
      <input id="file_21" name="archivo21" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg21" class="form-control" name="archivo_url21" />
      <label for="idimg21">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta21" name="carpeta21">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva21" type="text" name="nueva21" value="" />
      <label for="nueva21">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg21" id="idtimg21" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg21">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg21" id="idaimg21" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg21">Alt</label>
    </div>







    <?php $titalt = $ini->busca('value','opciones_lang','id','22','lang',$idioma); $titalt = explode("/**/",$titalt); ?>

    <p class="help-block"><?php echo $ini->selectcampo(22,'opciones','value'); ?></p>
    <div class="form-group row">
        <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail ccc">
              <img src="<?php echo $ini->selectcampo(22,'opciones','value'); ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
            </a>
        </div>
        
    </div>
    
    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_1"></label>
      <input id="file_1" name="archivo18" class="upload" type="file" />
    </div>
    </div>

    <div class="form-group row">
      <input type="text" id="idimg22" class="form-control" name="archivo_url22" />
      <label for="idimg1">¿Añadir a traves de una url?</label>
    </div>

    <div class="form-group row">
    <div class="box">
        <select class="form-control" id="carpeta22" name="carpeta22">
            <?php foreach($arbica as $e=>$val){ ?>
                <option<?php if($arbica[$e][0] == 1){ ?> selected="selected"<?php } ?> value="<?php echo $arbica[$e][0]; ?>">Carpeta: <?php echo $arbica[$e][2]; ?></option>
            <?php } ?>
        </select>
    </div>
    </div>

    <div class="form-group row">
      <input class="form-control" id="nueva22" type="text" name="nueva22" value="" />
      <label for="nueva17">¿Añadir Nueva carpeta?</label>
    </div>

    <div class="form-group row">
      <input type="text" name="timg22" id="idtimg22" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
      <label for="idtimg22">Título</label>
    </div>

    <div class="form-group row">
      <input type="text" name="aimg22" id="idaimg22" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
      <label for="idaimg22">Alt</label>
    </div>






  <div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
  
  </form>
  </div>
</div>

<?php } ?>
<?php }else{ ?>
    Lo sentimos, no tiene permisos para acceder a esta zona.
<?php } ?>