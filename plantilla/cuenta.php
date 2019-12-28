<div class="contenido cuenta">

<?php if(isset($_SESSION['mensaje'])){ 

    if($_SESSION['mensaje'] == "ok"){
        echo '<font class="ok">Cambios realizados</font>';
    }else{
        echo '<font class="error">'.$_SESSION['mensaje'].'</font>';
    }
    unset($_SESSION['mensaje']);
} 
$idu = $ini->desencriptar($ini->id_conectado,$baz); ?>	

<?php 
if($idu > 0){
 $continuar = false;
 $sqla = $ini->consulta("select * from usuarios_web where id = '".$idu."'"); if($ini->num_rows($sqla) == 1){ $continuar = true;  }
 $sql = $ini->consulta("select * from usuarios_web where id = '".$idu."'"); 
 if($ini->num_rows($sql) == 0 and $continuar){ $reg = $ini->fetch_object($sqla); }else{ $reg = $ini->fetch_object($sql); }
 $sqlu = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where usuario = '".$idu."'"); $regu = $ini->fetch_object($sqlu);
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.form-control').focusout(function() {
            if($(this).val() == ""){
                $(this).removeClass("relleno");
            }else{
                $(this).addClass("relleno");
            }
        });
        $('#idpais').on('change', function(){
            $('#paisaenviar').val(this.value);
            var url = "<?php echo $urlppal; ?>utiles/admin/php/muestra_provincias.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarpais').serialize(), success: function(data){ $('#caja_provincias').html(data); } }); 
        });
        $('.confirmarelmthumb').click(function(){
            var url = "<?php echo $urlppal; ?>utiles/admin/php/muestra_thumb.php";
            $.ajax({ type: "POST", url: url, data: $('#envformelmthumb').serialize(), success: function(data){ $('#elmthumbdiv').html(data); } }); 
        });
    });
</script>

<form id="enviarpais" method="post"> <input type="hidden" id="paisaenviar" name="pais" value="" /> </form>

<div class="container-fluid"> 
<form role="form" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="op" value="op" />
<input type="hidden" name="modo" value="modificar" />
<input type="hidden" name="id" value="<?php echo $idu; ?>" />
<input type="hidden" name="se" value="se" />
<input type="hidden" name="plantilla" value="18">
<input type="hidden" name="idioma" value="1">

<div class="panel panel-warning">
    <div class="panel-heading">Modificar mi cuenta</div>
    <div class="panel-body">
        <div class="form-group row">
            <input class="form-control<?php if($reg->nombre != ""){ echo " relleno"; } ?>" id="idname" type="text" name="name" value="<?php echo $reg->nombre; ?>" required="required"/>
            <label for="idname">Nombre:</label>
        </div>
        <div class="form-group row">
            <input class="form-control<?php if($reg->apellidos != ""){ echo " relleno"; } ?>" id="idapellido" type="text" name="apellido" value="<?php echo $reg->apellidos; ?>" required="required"/>
            <label for="idname">Apellidos:</label>
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
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group row">
            <input type="text" name="ubicacion" value="<?php echo $reg->ubicacion; ?>" id="idubicacion" class="form-control<?php if($reg->ubicacion != ""){ echo " relleno"; } ?>" />
            <label for="idubicacion">Ubicación:</label>
        </div>
        <div class="form-group row">
            <input type="text" class="form-control" name="passwd" id="idpasswd" />
            <label for="idpasswd">Nueva Contraseña:</label>
        </div>
    </div>
</div>
<div class="form-group margen-top"><input type="submit" class="btn btn-warning" value="Modificar" /></div>
</form>
</div>

<?php }else{ ?>

		<div class="row login-registro">
			<div class="col-sm-6 zona-login">
				<p class="titular">Usar usuario y contraseña</p>
				<form method="post" id="form-login" action="<?php echo $urlppal; ?>">
					<div class="input-usuario"><input type="email" class="form-control" name="email" placeholder="Email" required="required" /></div>
					<div class="input-passwd"><input type="password" class="form-control" name="passwd" placeholder="Contraseña" required="required" /></div>
                    <div class="input-cookie"><input type="checkbox" id="cookie-activa" name="cookie" value="1" /> <span for="cookie-activa">Recuerdame</span></div>
					<div class="input-submit"><input type="submit" class="form-control btn-primary submit-login" name="submit" value="Conectarme" /></div>
				</form>
				<div class="row">
					<div class="col-sm-9"><a class="recordar-passwd" href="#">¿Has olvidado la contraseña?</a></div>
					<div class="col-sm-3"><a class="registro" href="#">Registrate</a></div>
				</div>
			</div>
			<div class="col-sm-6">Conectarme con facebook</div>
		</div>

<?php } ?>

</div>