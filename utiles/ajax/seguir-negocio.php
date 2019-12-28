<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php"); if(isset($ini->id_conectado)){ 
  $sqlid = $ini->consulta("select id from url_amg where usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'");  
 //echo "select id from url_amg where usuario = '".$ini->desencriptar($ini->id_conectado,$baz)."'"; 
    $regid = $ini->fetch_object($sqlid); $id_amg_usu = $regid->id;
$sql = $ini->consulta("insert into seguir_ngc_sr (id_negocio,id_usuario) value ('".$_POST['id_negocio']."','".$id_amg_usu."')");  }else{ ?>

<div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Usuario no identificado </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	Debes iniciar sesión para poder seguir a un negocio.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
	$('#mensajeModal').modal('show');
</script>

<?php } ?>