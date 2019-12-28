<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();
$sqla = $ini->consulta("select url_amg.id as id, url_amg_lang.titulo as titulo from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where url_amg.id = '".$_POST['cerveza']."'");
$rega = $ini->fetch_object($sqla);
?>
 
     <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" checked="checked" name="crvz<?php echo $rega->id; ?>" value="1" aria-label="...">
      </span>
      <input type="text" class="form-control" disabled="disabled" value="<?php echo $rega->titulo; ?>" aria-label="...">
    </div>

<div id="insertar_cerveza_<?php echo $_POST['count_ser']; ?>"></div>
