<?php if($permiso == 1 or $permiso == 3){ ?>
<?php if($_GET['se'] == 1){ ?>
<?php $arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); } ?>
<script src="../utiles/caja_texto/iniciar/editor.js"></script>
<script src="../utiles/caja_texto/iniciar/gestor.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $('.form-control').focusout(function() {
            if($(this).val() == ""){
                $(this).removeClass("relleno");
            }else{
                $(this).addClass("relleno");
            }
        });

        $('#idpais').on('change', function(){
            $('#paisaenviar').val(this.value);
            var url = "../utiles/admin/php/muestra_provincias.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarpais').serialize(), success: function(data){ $('#caja_provincias').html(data); } }); 
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
</script>
<form id="enviarpais" method="post"> <input type="hidden" id="paisaenviar" name="pais" value="" /> </form>
<form role="form" method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
<input type="hidden" name="modo" value="crear" />
<input type="hidden" name="idioma" value="<?php echo $idioma; ?>">
<div class="panel panel-warning">
<div class="panel-heading">Insertar Usuario</div>
<div class="panel-body">

    <div class="form-group row">
        <input class="form-control" id="idname" type="text" name="name" value="" required="required" />
        <label for="idname">Nombre</label>
    </div>
    <div class="form-group row">
        <input class="form-control" id="idapellido" type="text" name="apellido" value="" />
        <label for="idapellido">Apellidos</label>
    </div>
    <div class="form-group row">
        <label for="elmn">Texto:</label>
        <textarea id="content" name="texto" rows="4" cols="30"></textarea>
    </div>
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
</div>
</div>


<div class="panel panel-warning">
    <div class="panel-heading">Foto personal</div>
    <div class="panel-body">
        <div class="form-group row">
            <div class="input__row uploader">
              <div id="inputval" class="input-value"></div>
              <label for="file_1"></label>
              <input id="file_1" name="archivo" class="upload" type="file" />
            </div>
        </div>
        <div class="form-group row">
            <input type="text" class="form-control" name="uimg" />
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


<div class="panel panel-warning">
    <div class="panel-heading">Datos</div>
    <div class="panel-body">
        <div class="form-group row">
            <input type="email" name="email" id="idemail" class="form-control" />
            <label for="idemail">Email</label>
        </div>
        <div class="form-group row">
            <input class="form-control" id="iddes_c" type="text" name="des_c" value="" />
            <label for="iddes_c">Descripción corta</label>
        </div>
        <div class="form-group row">
            <input type="text" name="eslogan" id="ideslogan" class="form-control" />
            <label for="ideslogan">Eslogan</label>
        </div>
        <div class="form-group row">
            <div class="box">
            <select name="pais" id="idpais" class="form-control">
                <option value="0">Selecciona País</option>
                <?php $sqla = $ini->consulta("select * from pais order by pais asc"); while($rega = $ini->fetch_object($sqla)){ ?>
                    <option value="<?php echo $rega->id; ?>"><?php echo $rega->pais; ?></option>
                <?php } ?>
            </select>
            </div>
        </div>
        <div id="caja_provincias"></div>
        <div class="form-group row">
            <input type="text" name="ubicacion" id="idubicacion" class="form-control">
            <label for="idubicacion">Ubicación</label>
        </div>
        <div class="form-group row">
            <div class="box">
            <select name="permiso" id="idpermiso" class="form-control">
                <option value="0">Selecciona Permiso</option>
                    <?php $sqlp = $ini->consulta("select * from permiso order by id asc"); while($regp = $ini->fetch_object($sqlp)){ ?>
                        <option value="<?php echo $regp->id; ?>"><?php echo $regp->nombre; ?></option>
                    <?php } ?>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <input type="text" name="passwd" id="idpasswd" class="form-control">
            <label for="idpasswd">Contraseña</label> 
        </div>
    </div>
</div>

<div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Insertar" /></div>
</form>
<?php } ?>

<?php if($_GET['se'] == 2){ ?>

<?php $depaset = array(); $sqldep = $ini->consulta("select * from archivo"); while($regdep = $ini->fetch_object($sqldep)){ $depaset[$regdep->id] = $regdep->nombre; } ?>

<?php $sql = $ini->consulta("select * from usuarios_web"); if($ini->num_rows($sql) > 0){ ?>

<link href="<?php echo $urlppal; ?>/utiles/css/jquery.typeahead.css" rel="stylesheet">
<script src="<?php echo $urlppal; ?>/utiles/js/jquery.typeahead.js"></script>

<?php if(isset($_GET['npagt'])){ $paginar = $_GET['npagt']; }else{ $paginar = 10; } $desde = 0;
if($_GET['pagina'] != ""){ $desde = ($_GET['pagina']-1)*$paginar; } $hasta = $paginar; 
$sql = $ini->consulta("select * from usuarios_web usuarios_web"); $contador = $ini->num_rows($sql); ?>

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

        var url = "../utiles/admin/php/muestra_filas_usuario.php"; 
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
    var url = "../utiles/admin/php/muestra_filas_usuario.php"; 
    $.ajax({ type: "POST", url: url, data: $('#admin_lis_usu_php').serialize(), success: function(data){ $('#muestra_filas').html(data); } }); 
}

function marcartodos(){ 
    if(document.getElementById("seltodos").checked == true){ 
        <?php $sql = $ini->consulta("select * from usuarios_web order by fecha desc limit ".$desde.",".$hasta); while($reg = $ini->fetch_object($sql)){ ?>
            document.getElementById("chusu<?php echo $reg->id; ?>").checked = true; 
        <?php } ?> 
    } 
    if(document.getElementById("seltodos").checked == false){
        <?php $sql = $ini->consulta("select * from usuarios_web order by fecha desc limit ".$desde.",".$hasta); while($reg = $ini->fetch_object($sql)){ ?> 
            document.getElementById("chusu<?php echo $reg->id; ?>").checked = false; 
        <?php } ?> 
    } 
}

function mostrarresulsearch(){ 
    document.getElementById('buscador').value = document.getElementById('quebusca').value; 
    var url = "../utiles/admin/php/muestra_filas_usuario.php";
    $.ajax({ type: "POST", url: url, data: $('#listausuor2').serialize(), success: function(data){ $('#muestra_filas').html(data); } }); 
}

function submitconfirm(){
        var url = "../utiles/admin/php/muestra_filas_usuario.php";
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
        <th id="muestra_label"><b style="cursor:pointer;" onclick="ajaorden(1)">Nombre <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th><b style="cursor:pointer;" onclick="ajaorden(2)">Apellidos <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th>Municipio</th>
        <th><b style="cursor:pointer;" onclick="ajaorden(3)">Tipo <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(4)">Activo <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(5)">Fecha <i class="fa fa-caret-down fa-fw"></i></b></th>
        <th style="text-align:center;">Modificar</th>
        <th style="text-align:center;">Eliminar</th>
    </thead>
<?php $sql = $ini->consulta("select * from usuarios_web order by fecha_i desc limit ".$desde.",".$hasta); while($reg=$ini->fetch_object($sql)){ ?>
    <tr>
        <td>
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="chusu<?php echo $reg->id; ?>" name="chusu<?php echo $reg->id; ?>" type="checkbox" style="position:absolute;" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </td>
        <td><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=5&id=<?php echo $reg->id; ?>"><?php echo $reg->nombre; ?></a></td>
        <td><?php echo $reg->apellidos; ?></td>
        <td><?php if($reg->municipio != 0){ echo $ini->selectcampo($reg->municipio,"municipios","Nombre"); } ?></td>
        <td><?php echo $ini->selectcampo($reg->permiso,"permiso","nombre"); ?></td>
        <td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td>
        <td style="text-align:center;"><?php $date = date_create($reg->fecha); echo date_format($date, 'd/m/Y H:i:s'); ?></td>
        <td style="text-align:center;"><a href="admin.php?op=<?php echo $_GET['op']; ?>&se=5&id=<?php echo $reg->id; ?>"><i class="fa fa-cogs fa-fw"></i></a></td>
        <td style="text-align:center;"><a class="submitform" title="6" id="<?php echo $reg->id; ?>" href="#"><i class="fa fa-trash-o fa-fw"></i></a></td>
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
        document.getElementById("admin_lis_usu_php_op").value = ''; 
        document.getElementById("admin_lis_usu_php_id").value = '';
            var url = "../utiles/admin/php/muestra_filas_usuario.php";
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
            source: { ajax: function (query) { return { type: "POST", url: "<?php echo $urlppal; ?>utiles/buscador/auto-completar_usuario.php", dataType: "json",
            data: { q: "{{query}}", i: "{{<?php echo $idioma; ?>}}" } } }, callback: { done: function (data) { return data; } } }
        });
    
</script>

<?php }else{ echo "No hay páginas creadas"; } ?>

<?php } ?>

<?php if($_GET['se'] == 3){ ?>
<table class="table table-striped"><thead><th>Título</th><th>Url amigable</th><th>Meta título</th><th style="text-align:center;">Publicado</th><th style="text-align:center;">Eliminar</th><th style="text-align:center;">Ir</th></thead>
<?php $sql = $ini->consulta("select * from usuarios_web order by fecha desc"); while($reg=$ini->fetch_object($sql)){ ?>
<tr><td><?php echo $reg->titulo; ?></td><td><?php echo $reg->url_amg; ?></td><td><?php $metas = explode("/**/",$reg->metas); $metatit = $metas[0]; echo $metatit; ?></td>
<td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td><td style="text-align:center;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=<?php echo $_GET['op']; ?>&se=6&id=<?php echo $reg->id; ?>"><i class="fa fa-trash-o fa-fw"></i></a></td>
<td style="text-align:center;"><a href="<?php echo $urlppal.$reg->url_amg; ?>" target="_blank"><i class="fa fa-external-link-square fa-fw"></i></a></td></tr><?php } ?></table>
<?php } ?>

<?php if($_GET['se'] == 5){ ?>

<?php
 $continuar = false;
 $sqla = $ini->consulta("select * from usuarios_web where id = '".$_GET['id']."'"); if($ini->num_rows($sqla) == 1){ $continuar = true;  }
 $sql = $ini->consulta("select * from usuarios_web where id = '".$_GET['id']."'"); 
 if($ini->num_rows($sql) == 0 and $continuar){ $reg = $ini->fetch_object($sqla); }else{ $reg = $ini->fetch_object($sql); }
 $metas = explode("/**/",$reg->metas);  $metatit = $metas[0];   $metades = $metas[1];   $metakey = $metas[2]; 
 //$cssextra = "../plantilla/css/".$ini->selectcampo($reg->plantilla,'archivo','archivo').".css";
 $arbica = array(); $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
while($regcr=$ini->fetch_object($sqlcr)){ $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); }  
$sqlu = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where usuario = '".$_GET['id']."'"); $regu = $ini->fetch_object($sqlu);
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

        $('#idpais').on('change', function(){
            $('#paisaenviar').val(this.value);
            var url = "../utiles/admin/php/muestra_provincias.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarpais').serialize(), success: function(data){ $('#caja_provincias').html(data); } }); 
        });

        var i = 1;
        var d = 1;
        $('.insertcat').click(function(){
            d++;
            var elmPPAL = document.getElementById('mas-cat');
            var elmDivPpal1 = document.createElement('div'); elmDivPpal1.className = 'form-group row';
            var elmDivPpal2 = document.createElement('div'); elmDivPpal2.className = 'form-group row';
            var elmDivCI1 = document.createElement('div'); elmDivCI1.className = 'col-sm-3';
            var elmDivCD1 = document.createElement('div'); elmDivCD1.className = 'col-sm-6';
            var elmDivCI2 = document.createElement('div'); elmDivCI2.className = 'col-sm-3';
            var elmDivCD2 = document.createElement('div'); elmDivCD2.className = 'col-sm-6';
            var elmLabel1 = document.createElement('label'); elmLabel1.textContent = 'Categoría '+d;
            var elmLabel2 = document.createElement('label'); elmLabel2.textContent = 'Nueva categoría';
            var elmInputU = document.createElement('input'); elmInputU.type = 'text'; elmInputU.name = 'ncat'+d; elmInputU.className = 'form-control';
            var elmSelect = document.createElement('select'); elmSelect.name = 'cat'+d; elmSelect.className = 'form-control';
            <?php $sqsql = $ini->consulta("select * from categoria inner join cat_lang on categoria.id = cat_lang.id_categoria where lang = '1' and tipo = '1'");
            $slsql = $ini->consulta("select * from categoria inner join cat_lang on categoria.id = cat_lang.id_categoria where lang = '1' and tipo = '1'"); ?>
            var arrayVar = [<?php $o = 1; while ($regg = $ini->fetch_object($sqsql)){ if($o != 1){ echo ","; } echo '"'.$regg->categoria.'"'; $o++; } ?>];
            var arrayId = [<?php $o = 1; while ($regg = $ini->fetch_object($slsql)){ if($o != 1){ echo ","; } echo '"'.$regg->id.'"'; $o++; } ?>];
            for(var e = 0; e < arrayVar.length; e++){ var option = document.createElement('option'); option.value = arrayId[e]; option.text = arrayVar[e]; elmSelect.appendChild(option); }
            elmDivPpal1.appendChild(elmDivCI1); elmDivPpal1.appendChild(elmDivCD1); elmDivPpal2.appendChild(elmDivCI2); elmDivPpal2.appendChild(elmDivCD2);
            elmDivCI1.appendChild(elmLabel1); elmDivCI2.appendChild(elmLabel2); elmDivCD1.appendChild(elmSelect); elmDivCD2.appendChild(elmInputU);
            elmPPAL.insertBefore(elmDivPpal1,elmPPAL.childNodes[0]); elmPPAL.insertBefore(elmDivPpal2,elmPPAL.childNodes[1]);
            return false;
        });

        $('.confirmarelmthumb').click(function(){
            var url = "../utiles/admin/php/muestra_thumb.php";
            $.ajax({ type: "POST", url: url, data: $('#envformelmthumb').serialize(), success: function(data){ $('#elmthumbdiv').html(data); } }); 
        });
        $('.confirmarelmcat').click(function(){
            var url = "../utiles/admin/php/muestra_cat.php";
            $.ajax({ type: "POST", url: url, data: $('#envformelmcat').serialize(), success: function(data){ $('#elmcatdiv').html(data); } }); 
        });

        $('.insertfila').click(function(){
            i++; 
            var elmPPAL = document.getElementById('mas-img');
            var elmDivPpal1 = document.createElement('div'); elmDivPpal1.className = 'form-group row';
            var elmDivPpal2 = document.createElement('div'); elmDivPpal2.className = 'form-group row';
            var elmDivPpal3 = document.createElement('div'); elmDivPpal3.className = 'form-group row';
            var elmDivCI1 = document.createElement('div'); elmDivCI1.className = 'col-sm-3';
            var elmDivCD1 = document.createElement('div'); elmDivCD1.className = 'col-sm-6';
            var elmDivCI2 = document.createElement('div'); elmDivCI2.className = 'col-sm-3';
            var elmDivCD2 = document.createElement('div'); elmDivCD2.className = 'col-sm-6';
            var elmDivCI3 = document.createElement('div'); elmDivCI3.className = 'col-sm-3';
            var elmDivCD3 = document.createElement('div'); elmDivCD3.className = 'col-sm-6';
            var elmP1 = document.createElement('p'); elmP1.textContent = 'Desde ordenador:';
            var elmP2 = document.createElement('p'); elmP2.textContent = "Desde url";
            var elmLabel1 = document.createElement('label'); elmLabel1.textContent = 'Imagen '+i;
            var elmLabel2 = document.createElement('label'); elmLabel2.textContent = 'Título';
            var elmLabel3 = document.createElement('label'); elmLabel3.textContent = 'Alt';
            var elmInputF = document.createElement('input'); elmInputF.type = 'file'; elmInputF.name = 'img'+i; elmInputF.className = 'form-control';
            var elmInputU = document.createElement('input'); elmInputU.type = 'text'; elmInputU.name = 'uimg'+i; elmInputU.className = 'form-control';
            var elmInputT = document.createElement('input'); elmInputT.type = 'text'; elmInputT.name = 'tit'+i; elmInputT.className = 'form-control';           
            var elmInputA = document.createElement('input'); elmInputA.type = 'text'; elmInputA.name = 'alt'+i; elmInputA.className = 'form-control'; 
            var elmBR = document.createElement('br');
            elmDivPpal1.appendChild(elmDivCI1); elmDivPpal1.appendChild(elmDivCD1); elmDivPpal2.appendChild(elmDivCI2); elmDivPpal2.appendChild(elmDivCD2); elmDivPpal3.appendChild(elmDivCI3); elmDivPpal3.appendChild(elmDivCD3);
            elmDivCI1.appendChild(elmLabel1); elmDivCI2.appendChild(elmLabel2); elmDivCI3.appendChild(elmLabel3);
            elmDivCD1.insertBefore(elmP1,elmDivCD1.childNodes[0]); elmDivCD1.insertBefore(elmInputF,elmDivCD1.childNodes[1]); elmDivCD1.insertBefore(elmBR,elmDivCD1.childNodes[2]); elmDivCD1.insertBefore(elmP2,elmDivCD1.childNodes[3]); elmDivCD1.insertBefore(elmInputU,elmDivCD1.childNodes[4]);
            elmDivCD2.appendChild(elmInputT); elmDivCD3.appendChild(elmInputA);
            elmPPAL.insertBefore(elmDivPpal1,elmPPAL.childNodes[0]); elmPPAL.insertBefore(elmDivPpal2,elmPPAL.childNodes[1]); elmPPAL.insertBefore(elmDivPpal3,elmPPAL.childNodes[2]);
            return false;
        });
    });
    function save() {
        var sHtml = $('#content').data('liveEdit').getXHTMLBody(); 
        alert(sHtml);
    }

   
</script>
<form id="enviarpais" method="post"> <input type="hidden" id="paisaenviar" name="pais" value="" /> </form>
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="catModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿ Seguro que quieres eliminar esta categoría ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary confirmarelmcat" data-dismiss="modal">Eliminar</button>
        <form id="envformelmcat" action="" method="post">
            <input type="hidden" name="id_slide" value="" id="id_slide_form">
            <input type="hidden" name="id_post" value="<?php echo $_GET['id']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="thumbModal" tabindex="-1" role="dialog" aria-labelledby="thumbModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar imagen de slide</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿ Seguro que quieres eliminar esta imagen del slide ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary confirmarelmthumb" data-dismiss="modal">Eliminar</button>
        <form id="envformelmthumb" action="" method="post">
            <input type="hidden" name="id_thumb" value="" id="id_thumb_form">
            <input type="hidden" name="id_post" value="<?php echo $_GET['id']; ?>">
            <input type="hidden" name="idioma" value="<?php echo $_GET['idioma']; ?>">
        </form>
      </div>
    </div>
  </div>
</div>

<form role="form" method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">
<input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
<input type="hidden" name="modo" value="modificar" />
<input type="hidden" name="id" value="<?php echo $reg->id; ?>" />
<input type="hidden" name="se" value="<?php echo $_GET['se']; ?>" />
<input type="hidden" name="plantilla" value="<?php echo $reg->plantilla; ?>">
<input type="hidden" name="idioma" value="<?php echo $idioma; ?>">

<div class="panel panel-warning">
    <div class="panel-heading">Modificar Usuario</div>
    <div class="panel-body">

        <div class="form-group row">
            <input class="form-control<?php if($reg->nombre != ""){ echo " relleno"; } ?>" id="idname" type="text" name="name" value="<?php echo $reg->nombre; ?>" required="required"/>
            <label for="idname">Nombre:</label>
        </div>

        <div class="form-group row">
            <input class="form-control<?php if($reg->apellidos != ""){ echo " relleno"; } ?>" id="idapellido" type="text" name="apellido" value="<?php echo $reg->apellidos; ?>" required="required"/>
            <label for="idname">Apellidos:</label>
        </div>

        <div class="form-group row">
            <label for="elmn">Texto:</label>
            <textarea id="content" name="texto" rows="4" cols="30"><?php echo $regu->contenido; ?></textarea>
        </div>

        <div class="form-group row">
            <input class="form-control<?php if($regu->url_amg != ""){ echo " relleno"; } ?>" id="idurl" type="text" name="url" value="<?php echo $regu->url_amg; ?>" />
            <label for="idurl">Url amigable:</label>
        </div>

        <div class="form-group row">
            <input class="form-control<?php if($metatit != ""){ echo " relleno"; } ?>" id="idmtit" type="text" name="mtit" value="<?php echo $metatit; ?>" />
            <label for="idmtit">Meta título:</label>
        </div>

        <div class="form-group row">
            <input class="form-control<?php if($metades != ""){ echo " relleno"; } ?>" id="idmdes" type="text" name="mdes" value="<?php echo $metades; ?>" />
            <label for="idmdes">Meta descripción:</label>
        </div>

        <div class="form-group row">
            <input class="form-control<?php if($metakey != ""){ echo " relleno"; } ?>" id="idmkey" type="text" name="mkey" value="<?php echo $metakey; ?>" />
            <label for="idmkey">Meta keywords:</label>
        </div>

        <div class="form-group row">
        <label for="idpublicado<?php echo $reg->id; ?>" class="si si-switcher">
          <input type="checkbox" id="idpublicado<?php echo $reg->id; ?>" name="publicado" value="si"<?php if($reg->activo == 1){ ?> checked="checked"<?php } ?> />
          <span class="si-label">Publicado</span>
        </label>
        </div>

    </div>
</div>




<div class="panel panel-warning">
    <div class="panel-heading">Redes sociales</div>
    <div class="panel-body">
 

       <div class="form-group row">
            <input class="form-control<?php if($reg->facebook != ""){ echo " relleno"; } ?>" id="idfacebook" type="text" name="facebook" value="<?php echo $reg->facebook; ?>" />
            <label for="idfacebook">Facebook:</label>
        </div>

       <div class="form-group row">
            <input class="form-control<?php if($reg->twitter != ""){ echo " relleno"; } ?>" id="idtwitter" type="text" name="twitter" value="<?php echo $reg->twitter; ?>" />
            <label for="idtwitter">Twitter:</label>
        </div>

       <div class="form-group row">
            <input class="form-control<?php if($reg->instagram != ""){ echo " relleno"; } ?>" id="idinstagram" type="text" name="instagram" value="<?php echo $reg->instagram; ?>" />
            <label for="idinstagram">Instagram:</label>
        </div>

       <div class="form-group row">
            <input class="form-control<?php if($reg->pinterest != ""){ echo " relleno"; } ?>" id="idpinterest" type="text" name="pinterest" value="<?php echo $reg->pinterest; ?>" />
            <label for="idpinterest">Pinterest:</label>
        </div>

       <div class="form-group row">
            <input class="form-control<?php if($reg->youtube != ""){ echo " relleno"; } ?>" id="idyoutube" type="text" name="youtube" value="<?php echo $reg->youtube; ?>" />
            <label for="idyoutube">Youtube:</label>
        </div>

       <div class="form-group row">
            <input class="form-control<?php if($reg->linkedin != ""){ echo " relleno"; } ?>" id="idlinkedin" type="text" name="linkedin" value="<?php echo $reg->linkedin; ?>" />
            <label for="idlinkedin">Linkedin:</label>
        </div>

    </div>
</div>




<div class="panel panel-warning">
    <div class="panel-heading">Foto personal</div>
    <div class="panel-body">


        <?php if($reg->thumb != ""){  $titalt = explode("/**/",$reg->titalt);  ?>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <a href="#" class="thumbnail">
                      <img src="<?php echo $reg->thumb; ?>" alt="<?php echo $titalt[1]; ?>" title="<?php echo $titalt[0]; ?>" />
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
            <label for="idtimg">Título</label>
        </div>
        <div class="form-group row">
            <input type="text" name="aimg" id="idaimg" value="<?php echo $titalt[1]; ?>" class="form-control<?php if($titalt[1] != ""){ echo " relleno"; } ?>" />
            <label for="idaimg">Alt</label>
        </div>


    </div>
</div>


<div class="panel panel-warning">
    <div class="panel-heading">Datos</div>
    <div class="panel-body">

        <div class="form-group row">
            <input type="email" name="email" id="idemail" class="form-control<?php if($reg->email != ""){ echo " relleno"; } ?>" value="<?php echo $reg->email; ?>" />
            <label for="idtelefono">Email:</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($reg->descripcion != ""){ echo " relleno"; } ?>" id="iddes_c" type="text" name="des_c" value="<?php echo $reg->descripcion; ?>" />
            <label for="iddes_c">Descripción corta:</label>
        </div>
        <div class="form-group row">
            <input type="text" name="eslogan" value="<?php echo $reg->eslogan; ?>" id="ideslogan" class="form-control<?php if($reg->eslogan != ""){ echo " relleno"; } ?>" />
            <label for="ideslogan">Eslogan:</label>
        </div>
        <div class="form-group row">
            <div class="box">
                <select name="pais" id="idpais" class="form-control">
                    <option value="0">Selecciona país</option>
                    <?php $sqla = $ini->consulta("select * from pais order by pais asc"); while($rega = $ini->fetch_object($sqla)){ ?>
                        <option<?php if($rega->id == $reg->pais){ ?> selected="selected"<?php } ?> value="<?php echo $rega->id; ?>"><?php echo $rega->pais; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <input type="text" class="form-control" name="nueva_pais" value="" />
            <label for="nueva">¿Añadir Nuevo País?</label>
        </div>
        <div id="caja_provincias">
            <?php if($reg->pais != "0"){ ?>
                <div class="form-group row">
                    <div class="box">
                        <select name="pais" id="idprovincia" class="form-control">
                            <option value="0">Selecciona Provincia</option>
                            <?php $sqla = $ini->consulta("select * from provincias where id_pais='".$reg->pais."' order by provincia asc"); while($rega = $ini->fetch_object($sqla)){ ?>
                                <option<?php if($rega->id == $reg->provincia){ ?> selected="selected"<?php } ?> value="<?php echo $rega->id; ?>"><?php echo $rega->provincia; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="text" class="form-control" name="nueva_provincia" value="" />
                    <label for="nueva_provincia">¿Añadir Nueva Provincia?</label>
                </div>
                <div id="caja_municipios">
                    <?php if($reg->provincia != "0"){ ?>
                        <div class="form-group row">
                            <div class="box">
                                <select name="municipio" id="idmunicipio" class="form-control">
                                    <option value="0">Selecciona Localidad</option>
                                    <?php $sqla = $ini->consulta("select * from municipios where IdProvincia='".$reg->provincia."' order by Nombre asc"); while($rega = $ini->fetch_object($sqla)){ ?>
                                        <option<?php if($rega->Id == $reg->municipio){ ?> selected="selected"<?php } ?> value="<?php echo $rega->Id; ?>"><?php echo $rega->Nombre; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <input type="text" class="form-control" name="nueva_municipio" value="" />
                            <label for="nueva_municipio">¿Añadir Nueva Localidad?</label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group row">
            <input type="text" name="ubicacion" value="<?php echo $reg->ubicacion; ?>" id="idubicacion" class="form-control<?php if($reg->ubicacion != ""){ echo " relleno"; } ?>" />
            <label for="idubicacion">Ubicación:</label>
        </div>
        <div class="form-group row">
            <div class="box">
                <select name="permiso" id="idpermiso" class="form-control">
                    <?php $sqlp = $ini->consulta("select * from permiso order by id asc"); while($regp=$ini->fetch_object($sqlp)){ ?>
                        <option<?php if($regp->id == $reg->permiso){ ?> selected="selected"<?php } ?> value="<?php echo $regp->id; ?>"><?php echo $regp->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>  
        <div class="form-group row">
            <input type="text" class="form-control" name="passwd" id="idpasswd" />
            <label for="idpasswd">Nueva Contraseña:</label>
        </div>

    </div>
</div>



<div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
</form>

<?php } ?>

<?php if($_GET['se'] == 6){ ?>

<form method="post" action="form/<?php echo $ad->htmlop($_GET['op']); ?>.php" enctype="multipart/form-data">

    <input type="hidden" name="op" value="<?php echo $_GET['op']; ?>" />
    <input type="hidden" name="se" value="1" />

    <?php 
    if($_POST['admin_lis_usu_php_op'] == 3){
        
        $sql = $ini->consulta("select * from url_amg where seccion = '28'");
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
$sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$_POST['idioma']."' and seccion = '28'");  while($reg = $ini->fetch_object($sql)){
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
