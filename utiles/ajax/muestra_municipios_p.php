<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../php/"; include("../php/iniciar.php"); include('../php/admin.php'); $ad = new admin();
$provinciappal = $ini->selectcampo($_POST['pais'],'provincias','provincia');
if(isset($_POST['pais']) and $_POST['pais'] != 0){  $sqla = $ini->consulta("select * from municipios where IdProvincia = '".$_POST['pais']."' order by Nombre asc");  if($ini->num_rows($sqla) > 0){ ?>
	<option value="0">Localidad en <?php echo $provinciappal; ?></option>
    <?php  while($rega = $ini->fetch_object($sqla)){ ?>
        <option value="<?php echo $rega->Id; ?>"><?php echo $rega->Nombre; ?></option>
    <?php } ?>
<?php } ?>
    <option value="0">Selecciona Municipio</option>
    <option value="0">Selecciona primero provincia</option>
<?php }else{ ?>
    <option value="0">Selecciona Municipio</option>
    <option value="0">Selecciona primero provincia</option>
<?php } ?>