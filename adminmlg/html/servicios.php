<?php if($permiso == 1 or $permiso == 3){ ?>
<?php if($_GET['se'] == 1){ ?>
<?php $arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); } ?>
<script src="../utiles/caja_texto/iniciar/editor.js"></script>
<script src="../utiles/caja_texto/iniciar/gestor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.form-control').focusout(function() {
            if($(this).val() == ""){
                $(this).removeClass("relleno");
            }else{
                $(this).addClass("relleno");
            }
        });

         $('#content').liveEdit({
            height: 350,
            css: ['../utiles/css/bootstrap.min.css','../utiles/css/font-awesome.min.css'],
            groups: [
                    ["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat","Strikethrough"]],
                    ["group2", "", ["Bullets", "Numbering", "Indent", "Outdent"]],
                    ["group3", "", ["Paragraph", "FontSize", "FontDialog", "TextDialog"]],
                    ["group4", "", ["ImageDialog", "TableDialog", "Emoticons", "Snippets"]],
                    ["group5", "", ["Undo", "Redo", "SourceDialog"]]
                    ] 
        });
        $('#content').data('liveEdit').startedit();

    });
    function save() {
        var sHtml = $('#content').data('liveEdit').getXHTMLBody(); 
        alert(sHtml);
    }
</script>
<form role="form" method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
<input type="hidden" name="modo" value="crear" />
<input type="hidden" name="idioma" value="<?php echo $idioma; ?>">

<div class="panel panel-warning">
<div class="panel-heading"> <i class="fa fa-file-text-o fa-fw"></i> Contenido</div>
    <div class="panel-body">

        <div class="form-group row">
            <input class="form-control" id="idname" type="text" name="name" value="" required="required" />
            <label for="idname">Título:</label>
        </div>
        <div class="form-group row">
            <label for="elmn">Texto:</label>
            <textarea name="texto" id="content" rows="4" cols="30"></textarea>
        </div>

    </div>
</div>

<div class="panel panel-warning">
<div class="panel-heading"> <i class="fa fa-rss fa-fw"></i> SEO</div>
    <div class="panel-body">

        <h3>General</h3>
        <div class="form-group row">
            <input class="form-control" id="idurl" type="text" name="url" value="" />
            <label for="idurl">Url amigable</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idmtit" type="text" name="mtit" value="" />
            <label for="idmtit">Meta título</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idmdes" type="text" name="mdes" value="" />
            <label for="idmdes">Meta descripción</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idmkey" type="text" name="mkey" value="" />
            <label for="idmkey">Meta keywords</label>
        </div>
        <div class="form-group row">
        <label for="idpublicado" class="si si-switcher">
          <input type="checkbox" id="idpublicado" name="publicado" value="si" />
          <span class="si-label">Publicado</span>
        </label>
        </div>
        
        <hr />
        <h3>Facebook</h3>
        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1f"></label>
              <input id="file_1f" name="imgf" class="upload" type="file" />
            </div>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idurlf" type="text" name="urlf" value="" />
            <label for="idurlf">Url imagen</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idtitf" type="text" name="titf" value="" />
            <label for="idtitf">Título</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="iddesf" type="text" name="desf" value="" />
            <label for="iddesf">Descripción</label>
        </div>
        
        <hr />
        <h3>Twitter</h3>
        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1t"></label>
              <input id="file_1t" name="imgt" class="upload" type="file" />
            </div>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idurlt" type="text" name="urlt" value="" />
            <label for="idurlt">Url imagen</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idtitt" type="text" name="titt" value="" />
            <label for="idtitt">Título</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="iddest" type="text" name="dest" value="" />
            <label for="iddest">Descripción</label>
        </div>

    </div>
</div>

<div class="panel panel-warning">
    <div class="panel-heading">Icono destacado <a target="_blank" href="admin.php?op=13">ver lista</a> (solo con fa, no la)</div>
    <div class="panel-body">
            <input class="form-control" id="idicono" type="text" name="icono" value="" />
            <label for="idicono">Icono</label>
    </div>
</div>

<div class="panel panel-warning">
    <div class="panel-heading">Imagen destacada</div>
    <div class="panel-body">

        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1"></label>
              <input id="file_1" name="archivo" class="upload" type="file" />
            </div>
        </div>

        <div class="form-group row">
            <input type="text" class="form-control" id="idimg" name="uimg" />
            <label for="idimg">¿Añadir a traves de una url?</label>
        </div>

        <div class="form-group row">
            <input type="text" name="timg" id="idtimg" class="form-control">
            <label for="idtimg">Título</label>
        </div>

        <div class="form-group row">
            <input type="text" name="aimg" id="idaimg" class="form-control">
            <label for="idaimg">Alt</label>
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
        
    </div>
</div>

<div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Insertar" /></div>
</form>
<?php } ?>

<?php if($_GET['se'] == 2){ ?>

<?php $depaset = array(); $sqldep = $ini->consulta("select * from archivo"); while($regdep = $ini->fetch_object($sqldep)){ $depaset[$regdep->id] = $regdep->nombre; } ?>

<?php $sql = $ini->consulta("select * from url_amg where seccion = '51'"); if($ini->num_rows($sql) > 0){ ?>

<link href="<?php echo $urlppal; ?>/utiles/css/jquery.typeahead.css" rel="stylesheet">
<script src="<?php echo $urlppal; ?>/utiles/js/jquery.typeahead.js"></script>

<?php if(isset($_GET['npagt'])){ $paginar = $_GET['npagt']; }else{ $paginar = 10; } $desde = 0;
if($_GET['pagina'] != ""){ $desde = ($_GET['pagina']-1)*$paginar; } $hasta = $paginar; 

$sql = $ini->consulta("select * from url_amg where seccion = '51' order by fecha desc"); $contador = $ini->num_rows($sql); ?>

<script>
function buscador(id,se,op){
        document.getElementById("admin_lis_usu_php_op").value = ''; 
        document.getElementById("admin_lis_usu_php_id").value = '';
    if(op == 1){
        document.getElementById('idformbusca').value = id;
        document.getElementById('seformbusca').value = se;
        document.getElementById('enviousuid').submit(); 
    }else{
        document.getElementById('encuentra').value = '1';
        document.getElementById('idencuentra').value = id;

        var url = "../utiles/admin/php/muestra_filas_servicios.php"; 
        $.ajax({ type: "POST", url: url, data: $('#listausuor2').serialize(), success: function(data){ 
            $('#muestra_filas').html(data); 
            $('.pagination').css('display','none');
            $('.resulporpag').css('display','none');
            document.getElementById('encuentra').value = ''; 
            document.getElementById('idencuentra').value = ''; 
        } 
        }); 
    }
}

function ajaorden(op){ 
        document.getElementById("admin_lis_usu_php_op").value = ''; 
        document.getElementById("admin_lis_usu_php_id").value = '';
    document.getElementById("tipoorden").value = op; 
    document.getElementById("tipoordeno").value = op; 
    if(document.getElementById("orden"+op).value == "1"){ 
        document.getElementById("orden"+op).value = "0"; 
        document.getElementById("ordeno"+op).value = "0"; 
    }else{
        document.getElementById("orden"+op).value = "1"; 
        document.getElementById("ordeno"+op).value = "1"; 
    } 
    var url = "../utiles/admin/php/muestra_filas_servicios.php"; 
    $.ajax({ type: "POST", url: url, data: $('#admin_lis_usu_php').serialize(), success: function(data){ $('#muestra_filas').html(data); } }); 
}


function marcartodos(){ 
    if(document.getElementById("seltodos").checked == true){ 
        <?php $sql = $ini->consulta("select * from url_amg where seccion = '51' order by fecha desc limit ".$desde.",".$hasta);  while($reg = $ini->fetch_object($sql)){ ?>
            document.getElementById("chusu<?php echo $reg->id; ?>").checked = true; 
        <?php } ?> 
    } 
    if(document.getElementById("seltodos").checked == false){
        <?php $sql = $ini->consulta("select * from url_amg where seccion = '51' order by fecha desc limit ".$desde.",".$hasta); while($reg = $ini->fetch_object($sql)){ ?> 
            document.getElementById("chusu<?php echo $reg->id; ?>").checked = false; 
        <?php } ?> 
    } 
}

function mostrarresulsearch(){ 
    document.getElementById('buscador').value = document.getElementById('quebusca').value; 
    var url = "../utiles/admin/php/muestra_filas_servicios.php";
    $.ajax({ type: "POST", url: url, data: $('#listausuor2').serialize(), success: function(data){ $('#muestra_filas').html(data); } }); 
}

function submitconfirm(){
        var url = "../utiles/admin/php/muestra_filas_servicios.php";
        $.ajax({ type: "POST", url: url, data: $('#admin_lis_usu_php').serialize(), success: function(data){ $('#muestra_filas').html(data); document.getElementById("admin_lis_usu_php_op").value = ''; document.getElementById("admin_lis_usu_php_id").value = '';  } });
}

$(document).ready(function () {
    $('.cancel_session').click(function(){
        var url = "../utiles/admin/php/elimina_cookie.php";
        $.ajax({ type: "POST", url: url, data: $('#elimina_cookie_form').serialize(), success: function(data){ $('.elimina_cookie').html(data); $('#quebusca').value = ''; } });

        return false;
    });
});

</script>

<form id="elimina_cookie_form"></form>


<form action="admin.php" method="get" id="enviousuid">
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>">
    <input type="hidden" id="seformbusca" name="se" value="">
    <input type="hidden" id="idformbusca" name="id" value="">
    <input type="hidden" name="idioma" value="<?php echo $idioma; ?>">
</form>

<div class="modal fade" id="elmpagina" tabindex="-1" role="dialog" aria-labelledby="elmpaginaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar página</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿ Seguro que quieres eliminar esta página ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary confirmarelmpag" onclick="submitconfirm()" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-2 elimina_cookie"><?php if(isset($_SESSION['busqueda'])){ ?><a class="cancel_session" href="#">Cancelar busqueda</a><?php } ?></div>
    <div class="col-sm-5">
        <form method="post" id="listausuor2" action="javascript:mostrarresulsearch()">
            <input type="hidden" name="opcion" value="2" />
            <input type="hidden" name="orden1" id="ordeno1" value="1" />
            <input type="hidden" name="orden2" id="ordeno2" value="1" />
            <input type="hidden" name="orden3" id="ordeno3" value="1" />
            <input type="hidden" name="orden4" id="ordeno4" value="1" />
            <input type="hidden" name="orden5" id="ordeno5" value="1" />
            <input type="hidden" name="tipoorden" id="tipoordeno" value="" />
            <input type="hidden" name="paginar" id="paginar1" value="<?php echo $paginar; ?>" />
            <input type="hidden" name="desde" id="desde1" value="<?php echo $desde; ?>" />
            <input type="hidden" name="hasta" id="hasta1" value="<?php echo $hasta; ?>" />
            <input type="hidden" name="idioma" value="<?php echo $idioma; ?>">
            <input type="hidden" name="encuentra" id="encuentra" value="">
            <input type="hidden" name="idencuentra" id="idencuentra" value="">
            <div class="typeahead__container">
                <div class="typeahead__field">
                    <span class="typeahead__query input-ppal">
                        <div id="input-ppal" class="input-ppalcls">
                            <div id="contenido_buscar" class="input-group stylish-input-group">
                                <input type="text" id="quebusca" autocomplete="off" class="form-control js-typeahead" name="busqueda" placeholder="Buscar" >
                                <span class="input-group-addon"><button type="submit"><span class="glyphicon glyphicon-search"></span></button></span>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <a class="submitform" title="1" href="#"><i class="fa fa-unlock-alt fa-fw"></i></a>
        <a class="submitform" title="2" href="#"><i class="fa fa-lock fa-fw"></i></a> 
        <a class="submitform" title="3" href="#"><i class="fa fa-trash fa-fw"></i></a>
    </div>
</div>


<form method="post" id="admin_lis_usu_php" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php">
    <input type="hidden" name="opcion" value="1" />
    <input type="hidden" name="orden1" id="orden1" value="1" />
    <input type="hidden" name="orden2" id="orden2" value="1" />
    <input type="hidden" name="orden3" id="orden3" value="1" />
    <input type="hidden" name="orden4" id="orden4" value="1" />
    <input type="hidden" name="orden5" id="orden5" value="1" />
    <input type="hidden" name="tipoorden" id="tipoorden" value="" />
    <input type="hidden" name="paginar" id="paginar" value="<?php echo $paginar; ?>" />
    <input type="hidden" name="desde" id="desde" value="<?php echo $desde; ?>" />
    <input type="hidden" name="hasta" id="hasta" value="<?php echo $hasta; ?>" />
    <input type="hidden" name="busqueda" id="buscador" value="" />
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="idioma" value="<?php echo $idioma; ?>">
    <input type="hidden" name="modo" value="ver" />
    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
    <input type="hidden" id="admin_lis_usu_php_op" name="admin_lis_usu_php_op" value="" />
    <input type="hidden" id="admin_lis_usu_php_id" name="admin_lis_usu_php_id" value="" />
    <input type="hidden" name="idioma" value="<?php echo $idioma; ?>">
    <div id="muestra_filas">
<table class="table table-hover table-striped">
    <thead>
        <th style="vertical-align:initial;">
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="seltodos" type="checkbox" style="position:absolute;" onclick="marcartodos();" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </th>
        <th id="muestra_label"><b style="cursor:pointer;" onclick="ajaorden(1)">Título <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th><b style="cursor:pointer;" onclick="ajaorden(2)">Url amigable <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th>Meta título</th>
        <th><b style="cursor:pointer;" onclick="ajaorden(3)">Sección <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(4)">Publicado <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(5)">Fecha <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;">Modificar</th>
        <th style="text-align:center;">Eliminar</th>
        <th style="text-align:center;">Ir</th>
    </thead>
<?php $sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$idioma."' and url_amg.seccion = '51' order by fecha desc limit ".$desde.",".$hasta); while($reg=$ini->fetch_object($sql)){ ?>
    <tr>
        <td>
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="chusu<?php echo $reg->id; ?>" name="chusu<?php echo $reg->id; ?>" type="checkbox" style="position:absolute;" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </td>
        <td><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=5&id=<?php echo $reg->id; ?>"><?php echo $reg->titulo; ?></a></td>
        <td><?php echo $reg->url_amg; ?></td>
        <td><?php $metas = explode("/**/",$reg->metas); echo $metas[0]; ?></td>
        <td><?php echo $depaset[$reg->plantilla]; ?></td>
        <td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td>
        <td style="text-align:center;"><?php $date = date_create($reg->fecha); echo date_format($date, 'd/m/Y H:i:s'); ?></td>
        <td style="text-align:center;"><a href="admin.php?op=<?php echo $_GET['op']; ?>&se=5&id=<?php echo $reg->id; ?>"><i class="fa fa-cogs fa-fw"></i></a></td>
        <td style="text-align:center;"><a class="submitform" title="6" id="<?php echo $reg->id; ?>" href="#"><i class="fa fa-trash-o fa-fw"></i></a></td>
        <?php $seccion = ""; if($reg->seccion != 0){ $seccion = $ini->busca("url_amg","url_amg_lang","id_url_amg",$reg->seccion,'lang',$idioma)."/"; } ?>
        <td style="text-align:center;"><a href="<?php echo $urlppal.$seccion.$reg->url_amg; ?>" target="_blank"><i class="fa fa-external-link-square fa-fw"></i></a></td>
    </tr>
<?php } ?>
</table>
<script>
$(document).ready(function () {
    $('.submitform').click(function(){
        var op = this.title;
        var id = this.id;

        document.getElementById("admin_lis_usu_php_op").value = op; 

        document.getElementById("admin_lis_usu_php_id").value = id;
        if(op != 3 && op != 6){
        //document.getElementById("admin_lis_usu_php_op").value = ''; 
       // document.getElementById("admin_lis_usu_php_id").value = '';
            var url = "../utiles/admin/php/muestra_filas_servicios.php";
            $.ajax({ type: "POST", url: url, data: $('#admin_lis_usu_php').serialize(), success: function(data){ $('#muestra_filas').html(data); document.getElementById("admin_lis_usu_php_op").value = ''; document.getElementById("admin_lis_usu_php_id").value = '';  } });
        }else{
            $('#elmpagina').modal('show');
        }
        return false;
    });
});
</script>
    </div>
</form>

<div class="row resulporpag">
    <div class="col-sm-8"></div>
    <div class="col-sm-2">Resultados por pagina</div>
    <div class="col-sm-2">
        <form method="get" action="admin.php">
            <input type="hidden" name="pagina" value="1">
            <input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
            <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
            <input type="hidden" name="idioma" value="<?php echo $idioma; ?>" />
            <select onchange="this.form.submit()" name="npagt" class="form-control">
                <?php $opselpagp = "1,2,5,7,10,15,20,25,30,35,50,100,200"; 
                     $eopselpagp = explode(",", $opselpagp);
                     foreach ($eopselpagp as $eovalue) {
                         ?> <option value="<?php echo $eovalue; ?>"<?php if($paginar == $eovalue){ ?> selected="selected"<?php } ?>><?php echo $eovalue; ?></option> <?php
                     }
                ?>
            </select>
        </form>
    </div>
</div>


<div style="text-align: right;" class="">
    <ul class="pagination">    
        <?php 
            if($_GET['pag'] != ""){ $desde = ($_GET['pagina']-1)*$paginar; } 
            $hasta = $paginar; 
            $totalpaginas = ceil($contador/$paginar); 
            for($i=1;$i<=$totalpaginas;$i++){
                if($_GET['pagina'] != ""){ $pag = $_GET['pagina']; }else{ $pag = 1; } 
                $li = $i-5; 
                $lf = $i+5; 
                if($pag >= $li and $pag <= $lf){ 
                    if($pag == $lf){ ?> 
                        <li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=<?php echo $_GET['se']; ?>&pagina=1<?php if(isset($_GET['npagt'])){ echo "&npagt=".$_GET['npagt']; } ?>">1</a></li> 
                        <?php echo '<li><a href="#"> ... </a></li>'; 
                    } ?>  
                    <li<?php if($i == $pag){ ?> class="active"<?php } ?>><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=<?php echo $_GET['se']; ?>&pagina=<?php echo $i; if(isset($_GET['npagt'])){ echo "&npagt=".$_GET['npagt']; } ?>"><?php echo $i; ?></a> </li> 
                    <?php 
                    if($pag == $li){ 
                        echo '<li><a href="#"> ... </a></li>'; ?> 
                        <li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=<?php echo $_GET['se']; ?>&pagina=<?php echo $totalpaginas; if(isset($_GET['npagt'])){ echo "&npagt=".$_GET['npagt']; } ?>"><?php echo $totalpaginas; ?></a> </li>
                    <?php 
                    } 
                } 
            } 
        ?>
    </ul>
</div>

<script>
        typeof $.typeahead === 'function' && $.typeahead({
            input: ".js-typeahead", minLength: 0, maxItem: 9, dynamic: true, delay: 500, order: "asc", href: "javascript: buscador('{{id}}','{{se}}','{{division}}');", hint: true,
            searchOnFocus: false, accent:{ from: 'áéíóúàèìòù', to: 'aeiouaeiou'},
            emptyTemplate: '<a style="cursor:pointer;" onclick="buscarsolo(\'{{query}}\')">Buscar {{query}}</a>',
            display: ["titulo"], correlativeTemplate: true,
            template: '<span>' + '<span class="name">{{titulo}}</span>' + '</span>',
            source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar_servicios.php", dataType: "json",
            data: { q: "{{query}}", i: "{{<?php echo $idioma; ?>}}" } } }, callback: { done: function (data) { return data; } } }
        });
    
</script>

<?php }else{ echo "No hay páginas creadas"; } ?>

<?php } ?>

<?php if($_GET['se'] == 3){ ?>
<table class="table table-striped"><thead><th>Título</th><th>Url amigable</th><th>Meta título</th><th style="text-align:center;">Publicado</th><th style="text-align:center;">Eliminar</th><th style="text-align:center;">Ir</th></thead>
<?php $sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$idioma."' and seccion = '51' order by fecha desc"); while($reg=$ini->fetch_object($sql)){ ?>
<tr><td><?php echo $reg->titulo; ?></td><td><?php echo $reg->url_amg; ?></td><td><?php $metas = explode("/**/",$reg->metas); $metatit = $metas[0]; echo $metatit; ?></td>
<td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td><td style="text-align:center;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=6&id=<?php echo $reg->id; ?>"><i class="fa fa-trash-o fa-fw"></i></a></td>
<td style="text-align:center;"><a href="<?php echo $urlppal.$reg->url_amg; ?>" target="_blank"><i class="fa fa-external-link-square fa-fw"></i></a></td></tr><?php } ?></table>
<?php } ?>

<?php if($_GET['se'] == 5){ ?>

<?php
 $continuar = false;
 $sqla = $ini->consulta("select * from url_amg where id = '".$_GET['id']."'"); 
 if($ini->num_rows($sqla) == 1){ $continuar = true;  }
 $sql = $ini->consulta("select id, contenido, titulo, metas, activo, url_amg, thumbs, plantilla, seccion, titalt from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$_GET['id']."' and lang = '".$idioma."'"); 
 if($ini->num_rows($sql) == 0 and $continuar){ $reg = $ini->fetch_object($sqla); }else{ $reg = $ini->fetch_object($sql); }
 $metas = explode("/**/",$reg->metas);  $metatit = $metas[0];   $metades = $metas[1];   $metakey = $metas[2]; 
 $cssextra = "../plantilla/css/".$ini->selectcampo($reg->plantilla,'archivo','archivo').".css"; 
 $arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); }
$sql_redes = $ini->consulta("select * from redes_es where id = '".$_GET['id']."'"); $redes = $ini->fetch_object($sql_redes); 
$sqls = $ini->consulta("select * from servicio where id_servicio = '".$_GET['id']."'"); $regs = $ini->fetch_object($sqls);
?>

<script src="../utiles/caja_texto/iniciar/editor.js"></script>
<script src="../utiles/caja_texto/iniciar/gestor.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('.form-control').focusout(function() {
            if($(this).val() == ""){
                $(this).removeClass("relleno");
            }else{
                $(this).addClass("relleno");
            }
        });

        $('#content').liveEdit({
            height: 350,
            css: ['../utiles/css/bootstrap.min.css','../utiles/css/font-awesome.min.css','../plantilla/css/estilo.css','<?php echo $cssextra; ?>'],
            groups: [
                    ["group1", "", ["Bold", "Italic", "Underline", "ForeColor", "RemoveFormat","Strikethrough"]],
                    ["group2", "", ["Bullets", "Numbering", "Indent", "Outdent"]],
                    ["group3", "", ["Paragraph", "FontSize", "FontDialog", "TextDialog"]],
                    ["group4", "", ["ImageDialog", "TableDialog", "Emoticons", "Snippets"]],
                    ["group5", "", ["Undo", "Redo", "SourceDialog"]]
                    ] 
        });
        $('#content').data('liveEdit').startedit();

    });
    function save() {
        var sHtml = $('#content').data('liveEdit').getXHTMLBody(); 
        alert(sHtml);
    }

</script>


<form role="form" method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
<input type="hidden" name="modo" value="modificar" />
<input type="hidden" name="id" value="<?php echo $reg->id; ?>" />
<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
<input type="hidden" name="plantilla" value="<?php echo $reg->plantilla; ?>">
<input type="hidden" name="idioma" value="<?php echo $idioma; ?>">

<div class="panel panel-warning">
    <div class="panel-heading">Modificar servicios</div>
    <div class="panel-body">


        <div class="form-group row">
            <input class="form-control<?php if($reg->titulo != ""){ echo " relleno"; } ?>" id="idname<?php echo $reg->id; ?>" type="text" name="name" value="<?php echo $reg->titulo; ?>" />
            <label for="idname<?php echo $reg->id; ?>">Título:</label>
        </div>
        <div class="form-group row">
            <div class="paddingf">
                <label for="content">Texto:</label>
                <textarea name="texto" id="content" rows="4" cols="30"><?php echo $reg->contenido; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($reg->url_amg != ""){ echo " relleno"; } ?>" id="idurl<?php echo $reg->id; ?>" type="text" name="url" value="<?php echo $reg->url_amg; ?>" />
            <label for="idurl<?php echo $reg->id; ?>">Url amigable</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($metatit != ""){ echo " relleno"; } ?>" id="idmtit<?php echo $reg->id; ?>" type="text" name="mtit" value="<?php echo $metatit; ?>" />
            <label for="idmtit<?php echo $reg->id; ?>">Meta título</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($metades != ""){ echo " relleno"; } ?>" id="idmdes<?php echo $reg->id; ?>" type="text" name="mdes" value="<?php echo $metades; ?>" />
            <label for="idmdes<?php echo $reg->id; ?>">Meta descripción</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($metakey != ""){ echo " relleno"; } ?>" id="idmkey<?php echo $reg->id; ?>" type="text" name="mkey" value="<?php echo $metakey; ?>" />
            <label for="idmkey<?php echo $reg->id; ?>">Meta keywords</label>
        </div>

        <div class="form-group row">
        <label for="idpublicado<?php echo $reg->id; ?>" class="si si-switcher">
          <input type="checkbox" id="idpublicado<?php echo $reg->id; ?>" name="publicado" value="si"<?php if($reg->activo == 1){ ?> checked="checked"<?php } ?> />
          <span class="si-label">Publicado</span>
        </label>
        </div>


        <hr />

        <?php if($redes->imgf != ""){    ?>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                      <img src="<?php echo $redes->imgf; ?>" alt="Facebook Cervezas Málaga" title="Facebook Cervezas Málaga" />
                    </a>
                </div>
            </div>
        <?php } ?>

        <h3>Facebook</h3>
        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1f"></label>
              <input id="file_1f" name="imgf" class="upload" type="file" />
            </div>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idurlf" type="text" name="urlf" value="" />
            <label for="idurlf">Url imagen</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($redes->titf){ ?> relleno<?php } ?>" id="idtitf" type="text" name="titf" value="<?php echo $redes->titf; ?>" />
            <label for="idtitf">Título</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($redes->desf){ ?> relleno<?php } ?>" id="iddesf" type="text" name="desf" value="<?php echo $redes->desf; ?>" />
            <label for="iddesf">Descripción</label>
        </div>
        
        <hr />

        <?php if($redes->imgt != ""){ ?>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                      <img src="<?php echo $redes->imgt; ?>" alt="Twitter Cervezas Málaga" title="Twitter Cervezas Málaga" />
                    </a>
                </div>
            </div>
        <?php } ?>


        <h3>Twitter</h3>
        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1t"></label>
              <input id="file_1t" name="imgt" class="upload" type="file" />
            </div>
        </div>
        <div class="form-group row">
            <input class="form-control" id="idurlt" type="text" name="urlt" value="" />
            <label for="idurlt">Url imagen</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($redes->titt){ ?> relleno<?php } ?>" id="idtitt" type="text" name="titt" value="<?php echo $redes->titt; ?>" />
            <label for="idtitt">Título</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($redes->dest){ ?> relleno<?php } ?>" id="iddest" type="text" name="dest" value="<?php echo $redes->dest; ?>" />
            <label for="iddest">Descripción</label>
        </div>
        

        
    </div>
</div>


<div class="panel panel-warning">
    <div class="panel-heading">Icono destacado <a target="_blank" href="admin.php?op=13">ver lista</a> (solo con fa, no la)</div>
    <div class="panel-body">
        <div class="form-group row">    
            <input class="form-control<?php if($regs->icono){ ?> relleno<?php } ?>" id="idicono" type="text" name="icono" value="<?php echo $regs->icono; ?>" />
            <label for="idicono">Icono</label>
        </div>    
            <p><i class="fa <?php echo $regs->icono; ?> fa-fw"></i></p>
    </div>
</div>

<div class="panel panel-warning">
    <div class="panel-heading">Imagen destacada</div>
    <div class="panel-body">


    <?php if($reg->thumbs != ""){  $titalt = explode("/**/",$reg->titalt);  ?>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                      <img src="<?php echo $reg->thumbs; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
                    </a>
                </div>
            </div>
        <?php } ?>


    <div class="form-group row">
    <div class="input__row uploader">
      <div id="inputval" class="input-value"></div>
      <label for="file_1"></label>
      <input id="file_1" name="archivo" class="upload" type="file" />
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
    <input type="text" name="timg" id="idtimg" value="<?php echo $titalt[0]; ?>" class="form-control<?php if($titalt[0] != ""){ echo " relleno"; } ?>" />
    <label for="idtimg">Título:</label>
    </div>

    <div class="form-group row">
    <input type="text" name="aimg" id="idaimg" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
    <label for="idaimg">Alt:</label>
    </div>


    </div>
</div>
<!--
<?php $sql = $ini->consulta("select * from lang"); while($regi = $ini->fetch_object($sql)){ 
      $sqlie = $ini->consulta("select * from url_amg_lang where id_url_amg = '".$_GET['id']."' and lang = '".$regi->id."'"); 
      if($ini->num_rows($sqlie) == 0 and $idioma != $regi->id){ ?>
<div class="form-group row">
    <div class="col-sm-3"><label>Añadir idioma:</label></div> 
    <div class="col-sm-3"><a href="admin.php?op=<?php echo $_GET['op']; ?>&se=<?php echo $_GET['se']; ?>&idioma=<?php echo $regi->id; ?>&id=<?php echo $_GET['id']; ?>"><?php echo $regi->nombre; ?></a></div>
</div>-->
<?php } } ?>


<div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
</form>

<?php } ?>

<?php if($_GET['se'] == 6){ ?>

<form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">

    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="1" />

    <?php 
    if($_POST['admin_lis_usu_php_op'] == 3){
        
        $sql = $ini->consulta("select * from url_amg where seccion = '51'");
        while($reg = $ini->fetch_object($sql)){
            
            if(isset($_POST['chusu'.$reg->id])){ ?> 
                <input type="hidden" name="chusu<?php echo $reg->id; ?>" value="1" /> 
            <?php 
            } 
        }
        ?> 

        <input type="hidden" name="admin_lis_usu_php_op" value="3" /> 
    <?php
    }

    if($_POST['admin_lis_usu_php_op'] == 6){ ?> 
        <input type="hidden" name="admin_lis_usu_php_id" value="<?php echo $_POST['admin_lis_usu_php_id']; ?>" /> 
        <input type="hidden" name="admin_lis_usu_php_op" value="6" /> 
    <?php 
    } ?>

    <input type="hidden" name="modo" value="ver" />
<div class="row"><div class="col-sm-12"><input type="submit" class="btn btn-danger" value="Eliminar definitivamente" /></div></div><br><br>
<div class="panel panel-danger"><div class="panel-heading">Eliminar pagina/s</div><div class="panel-body">
<div class="form-group row"><div class="col-sm-6"><label for="idcodigo">Seguro que quieres eliminar esta/s pagina/s:</label></div></div>
<?php if($_POST['admin_lis_usu_php_op'] == 3){
$sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where seccion = '51' and lang = '".$_POST['idioma']."'");  while($reg = $ini->fetch_object($sql)){
if(isset($_POST['chusu'.$reg->id])){            
?><div class="form-group row"><div class="col-sm-6"><label for="idcodigo"><?php echo $reg->titulo; ?></label></div></div><?php } } }
if($_POST['admin_lis_usu_php_op'] == 6){
$sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$_POST['admin_lis_usu_php_id']."' and lang = '".$_POST['idioma']."'");  $reg = $ini->fetch_object($sql);
?><div class="form-group row"><div class="col-sm-6"><label for="idcodigo"> <?php echo $reg->titulo; ?></label></div></div><?php } ?>
</div></div><br><br>        
<div class="row"><div class="col-sm-12"><input type="submit" class="btn btn-danger" value="Eliminar definitivamente" /></div></div>
</form> 
<?php } ?>
<?php }else{ ?>
Lo sentimos, no tiene permisos para acceder a esta zona.
<?php } ?>
