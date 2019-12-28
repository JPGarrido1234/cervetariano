<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin();

if($_POST['admin_lis_usu_php_op'] != ""){
        switch($_POST['admin_lis_usu_php_op']){
            case 1:{ $sql = $ini->consulta("select * from url_amg where seccion = '51'");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
                     $ssql = $ini->consulta("update url_amg set activo = '1' where id = '".$reg->id."'"); } } }; break;
            case 2:{ $sql = $ini->consulta("select * from url_amg where seccion = '51'");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
                     $ssql = $ini->consulta("update url_amg set activo = '0' where id = '".$reg->id."'"); } } }; break;
            case 3:{ $sql = $ini->consulta("select * from url_amg");  while($reg = $ini->fetch_object($sql)){
                     if(isset($_POST['chusu'.$reg->id])){ 
                        $ssql = $ini->consulta("delete from url_amg where id = '".$reg->id."'"); 
                        $ssql = $ini->consulta("delete from union_ngc_lcld where id_localidad = '".$reg->id."'");
                    } } }; break;
            case 4:{ $ssql = $ini->consulta("update url_amg set activo = '1' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
            case 5:{ $ssql = $ini->consulta("update url_amg set activo = '0' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
            case 6:{ 
                $ssql = $ini->consulta("delete from url_amg where id = '".$_POST['admin_lis_usu_php_id']."'");
                $ssql = $ini->consulta("delete from union_ngc_lcld where id_localidad = '".$_POST['admin_lis_usu_php_id']."'");
            }; break;
        }
}

if($_POST['encuentra'] != 1){
    $arrord = array(1=>'titulo',2=>'url_amg',3=>'seccion',4=>'activo',5=>'fecha'); 
    if($_POST['orden'.$_POST['tipoorden']] == 1){ $oras = "asc"; $fle = "down"; }else{ $oras = "desc"; $fle = "up"; } $buscarsql = ""; $buscarsqll = "";

    if(isset($_POST['busqueda']) and $_POST['busqueda'] != "" or isset($_SESSION['busqueda'])){  
        if($_POST['tipoorden'] == ""){ $_POST['tipoorden'] = 1; } if(isset($_POST['busqueda']) and !isset($_SESSION['busqueda'])){ $_SESSION['busqueda'] = $_POST['busqueda']; }
        $buscarsql = ", match(titulo,metas,contenido) against ('".$_POST['busqueda']."') as buscador"; $buscarsqll = " where match(titulo,metas,contenido) against ('".$_POST['busqueda']."') and lang = '".$_POST['idioma']."' and seccion = '51'"; 
        $sql = $ini->consulta("select *".$buscarsql." from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg ".$buscarsqll." order by ".$arrord[$_POST['tipoorden']]." ".$oras);
        
    }else{
        if($_POST['tipoorden'] == ""){
            $sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$_POST['idioma']."' and seccion = '51' order by fecha desc limit ".$_POST['desde'].",".$_POST['hasta']);
        }else{
            $sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$_POST['idioma']."' and seccion = '51' order by ".$arrord[$_POST['tipoorden']]." ".$oras." limit ".$_POST['desde'].", ".$_POST['hasta']);
        }
    }
}else{
    $sql = $ini->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where lang = '".$_POST['idioma']."' and plantilla = '".$_POST['idencuentra']."' order by fecha desc");
}

$depaset = array(); $sqldep = $ini->consulta("select * from archivo"); while($regdep = $ini->fetch_object($sqldep)){ $depaset[$regdep->id] = $regdep->nombre; }

if($ini->num_rows($sql) > 0){
?>

<table class="table table-hover table-striped">
    <thead>
        <th style="vertical-align:initial;">
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="seltodos" type="checkbox" style="position:absolute;" onclick="marcartodos();" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </th>
        <th id="muestra_label"><b style="cursor:pointer;" onclick="ajaorden(1)">Título <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 1){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th><b style="cursor:pointer;" onclick="ajaorden(2)">Url amigable <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 2){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th>Meta título</th>
        <th><b style="cursor:pointer;" onclick="ajaorden(3)">Sección <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 3){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(4)">Publicado <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 4){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(5)">Fecha <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 5){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;">Modificar</th>
        <th style="text-align:center;">Eliminar</th>
        <th style="text-align:center;">Ir</th>
    </thead>


<?php while($reg = $ini->fetch_object($sql)){ ?>


    <tr>
        <td>
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="chusu<?php echo $reg->id; ?>" name="chusu<?php echo $reg->id; ?>" type="checkbox" style="position:absolute;" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </td>
        <td><a href="admin.php?op=5&se=5&id=<?php echo $reg->id; ?>"><?php echo $reg->titulo; ?></a></td>
        <td><?php echo $reg->url_amg; ?></td>
        <td><?php $metas = explode("/**/",$reg->metas); $metatit = $metas[0]; echo $metatit; ?></td>
        <td><?php echo $depaset[$reg->plantilla]; ?></td>
        <td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td>
        <td style="text-align:center;"><?php $date = date_create($reg->fecha); echo date_format($date, 'd/m/Y H:i:s'); ?></td>
        <td style="text-align:center;"><a href="admin.php?op=5&se=5&id=<?php echo $reg->id; ?>"><i class="fa fa-cogs fa-fw"></i></a></td>
        <td style="text-align:center;"><a class="submitform" title="6" id="<?php echo $reg->id; ?>" href="#"><i class="fa fa-trash-o fa-fw"></i></a></td>
        <?php $seccion = ""; if($reg->seccion != 0){ $seccion = $ini->busca("url_amg","url_amg_lang","id_url_amg",$reg->seccion,'lang',$idioma)."/"; } ?>
        <td style="text-align:center;"><a href="<?php echo $urlppal.$seccion.$reg->url_amg; ?>" target="_blank"><i class="fa fa-external-link-square fa-fw"></i></a></td>
    </tr>


<?php } ?>
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
            var url = "../utiles/admin/php/muestra_filas_servicios.php";
            $.ajax({ type: "POST", url: url, data: $('#admin_lis_usu_php').serialize(), success: function(data){ $('#muestra_filas').html(data); document.getElementById("admin_lis_usu_php_op").value = ''; document.getElementById("admin_lis_usu_php_id").value = '';  } });
        }else{
            $('#elmpagina').modal('show');
        }
        return false;
    });
});
</script>
</table>

<?php }else{ ?>
	
	
	
	No hay resultados <a href="admin.php?op=5&se=2">Volver</a>
	
<?php } ?>