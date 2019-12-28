<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();

if($_POST['id_thumb'] != "" and $_POST['id_post'] != ""){
	$ssql = $ini->consulta("delete from slide where tipo = '".$_POST['id_post']."' and id = '".$_POST['id_thumb']."'");
    $sql = $ini->consulta("delete from slide_lang where id_slide = '".$_POST['id_thumb']."'");
}

$sqlslide = $ini->consulta("select * from slide inner join slide_lang on slide.id = slide_lang.id_slide where tipo = '".$_POST['id_post']."' and id_lang = '".$_POST['idioma']."'"); if($ini->num_rows($sqlslide) > 0){  ?>

<div class="form-group row">

    <?php while($regslide = $ini->fetch_object($sqlslide)){ $titalt = explode("/**/", $regslide->titalt) ?>
        <div class="col-sm-2 thumbnail"> 
            <img src="<?php echo $regslide->url; ?>"> 
            <p class="help-block"><b>Título:</b> <?php echo $titalt[0]; ?></p> 
            <p class="help-block"><b>Alt:</b> <?php echo $titalt[1]; ?></p>
            <p class="help-block">
                <button type="button" class="btn btn-primary setdataformthumb" data-toggle="modal" id="<?php echo $regslide->id; ?>" data-target="#thumbModal">
                    <i class="fa fa-trash fa-fw"></i>
                </button>
            </p> 
        </div>
    <?php } ?>

</div>
    <script>
        $(document).ready(function () {
             $('.setdataformthumb').click(function(){
                var elminput = document.getElementById('id_thumb_form');
                elminput.value = this.id;
            });            
        });
    </script>
<?php } ?>