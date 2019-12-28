<?php 
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin(); ?>

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Elegir imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel panel-warning"><div class="panel-heading">Ver Imágenes</div><div class="panel-body">
            
            <?php 
            $arbica = array(); 
            $sqlcr = $ini->consulta("select id, carpeta, nombre_amg from carpetas");
            while($regcr=$ini->fetch_object($sqlcr)){ 
                $arbica[$regcr->id] = array($regcr->id,$regcr->carpeta,$regcr->nombre_amg); 
            } ?>
            <form action="" method="post" id="formcambiacar">
                <input type="hidden" name="elcarpeta" value="activo" />
                <p>Mostrar carpeta: 
                    <select name="carpetabs" class="seleccarpeta">
                        <option value="todas">todas</option>
                        <?php foreach($arbica as $e=>$val){ ?>
                            <option value="<?php echo $arbica[$e][0]; ?>"<?php if(isset($_POST['carpetabs']) and $_POST['carpetabs'] == $arbica[$e][0]){ ?> selected="selected"<?php } ?>><?php echo $arbica[$e][2]; ?></option>
                        <?php } ?>
                    </select>
                </p>
            </form>
            <?php 
            if(isset($_POST['elcarpeta'])){ 
                $arbica = array();
                $sql = $ini->consulta("select id, carpeta, nombre_amg from carpetas"); 
                while($reg=$ini->fetch_object($sql)){
                    if($reg->id == $_POST['carpetabs'] or $_POST['carpetabs'] == "todas"){ 
                        $arbica[$reg->id] = array($reg->id,$reg->carpeta,$reg->nombre_amg); 
                    } 
                } 
            } ?>
            <div class="row">
            <?php 
            $c = 0; 
            foreach($arbica as $e=>$val){ 
                foreach(glob("../../../imagen".$arbica[$e][1]."*") as $archivos_carpeta){ 
                    if(!is_dir($archivos_carpeta)){ 
                        $c++;
                        $wh = getimagesize($archivos_carpeta);  
                        $archivos_carpeta = str_replace("../../../",$urlppal,$archivos_carpeta); ?>
                        <div class="col-sm-6 col-md-3">
                            <a href="#" class="thumbnail selecimg" id="<?php echo $archivos_carpeta; ?>" data-dismiss="modal" target="_blank">
                                <img src="<?php echo $archivos_carpeta; ?>" />
                            </a>
                        </div>
                        <?php 
                    } 
                } 
            } ?>
            </div>


            <script type="text/javascript">
                $(document).ready(function () {
                    $('.seleccarpeta').change(function(){
                        var url = "../../../admin/php/muestra_imagen_caja_texto.php";
                        $.ajax({ type: "POST", url: url, data: $('#formcambiacar').serialize(), success: function(data){ $('#ver_imagen_caja_texto').html(data); } });
                    });
                    $('.selecimg').click(function(){
                        document.getElementById('inpImgURL').value = this.id;
                    });
                });
            </script>


            
        </div>
    </div>
    <?php if($c == 0){ ?> - Sin Imágenes - <?php } ?>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        
        <form id="confirmar_form_img" action="" method="post">
            <input type="hidden" name="url_img" value="" id="url_img_form">
            <input type="hidden" name="carpeta" value="" id="carpeta_form">
        </form>
      </div>
    </div>
  </div>