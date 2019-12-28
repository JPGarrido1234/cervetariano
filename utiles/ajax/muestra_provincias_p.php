<?php
$bug = 1; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../php/"; include("../php/iniciar.php"); include('../php/admin.php'); $ad = new admin();



$paisppal = $ini->selectcampo($_POST['pais'],'pais','pais');
if(isset($_POST['pais']) and $_POST['pais'] != 0){  $sqla = $ini->consulta("select * from provincias where id_pais = '".$_POST['pais']."' order by provincia asc");  if($ini->num_rows($sqla) > 0){ ?>
    <option value="0">Provincia en <?php echo $paisppal; ?></option>
    <?php  while($rega = $ini->fetch_object($sqla)){ ?>
        <option value="<?php echo $rega->id; ?>"><?php echo $rega->provincia; ?></option>
    <?php } ?>
<?php }else ?>
    <option value="0">Selecciona Provincia</option>
    <option value="0">Selecciona primero país</option>
<?php }else{ ?>
    <option value="0">Selecciona Provincia</option>
    <option value="0">Selecciona primero país</option>
<?php } ?>