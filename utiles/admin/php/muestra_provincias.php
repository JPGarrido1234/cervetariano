<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();

if($_POST['pais']){  $sqla = $ini->consulta("select * from provincias where id_pais = '".$_POST['pais']."' order by provincia asc");  if($ini->num_rows($sqla) > 0){ ?>
<script type="text/javascript">
    $(document).ready(function(){
         $('#idprovincia').on('change', function() {
            $('#provinciaaenviar').val(this.value);
            var url = "../utiles/admin/php/muestra_municipios.php"; 
            $.ajax({ type: "POST", url: url, data: $('#enviarprovincia').serialize(), success: function(data){ $('#caja_municipios').html(data); } }); 
        });   	

    });
</script>
<form id="enviarprovincia" method="post"> <input type="hidden" id="provinciaaenviar" name="provincia" value="" /> </form>

    <div class="form-group row">
        <div class="box">
            <select name="provincia" id="idprovincia" class="form-control">
                <option value="0">Selecciona Provincia</option>
                <?php  while($rega = $ini->fetch_object($sqla)){ ?>
                    <option value="<?php echo $rega->id; ?>"><?php echo $rega->provincia; ?></option>
                <?php } ?>
            </select>
        </div> 
    </div>

    <div class="form-group row">
        <input type="text" class="form-control" name="nueva_provincia" value="" />
        <label>¿Añadir Nueva Provincia?</label>
    </div>

    <div id="caja_municipios"> </div>

<?php } } ?>