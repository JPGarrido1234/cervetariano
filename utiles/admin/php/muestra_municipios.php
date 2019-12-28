<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();

if($_POST['provincia']){  $sqla = $ini->consulta("select * from municipios where IdProvincia = '".$_POST['provincia']."' order by Nombre asc");  if($ini->num_rows($sqla) > 0){ ?>

    <div class="form-group row">
       	<div class="box">
            <select name="municipio" id="idmunicipio" class="form-control">
            	<option value="0">Selecciona Localidad</option>
                <?php  while($rega = $ini->fetch_object($sqla)){ ?>
                    <option value="<?php echo $rega->Id; ?>"><?php echo $rega->Nombre; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <input type="text" class="form-control" name="nueva_municipio" value="" />
        <label>¿Añadir Nuevo Municipio?</label>
    </div>

<?php } } ?>