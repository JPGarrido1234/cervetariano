<?php
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_errors', 1); } session_start();
$adaux = "../../php/"; include("../../php/iniciar.php"); include('../../php/admin.php'); $ad = new admin(); 

if($_POST['admin_lis_usu_php_op'] != ""){
        switch($_POST['admin_lis_usu_php_op']){
            case 1:{ $sql = $ini->consulta("select * from usuarios_web");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
                     $ssql = $ini->consulta("update usuarios_web set activo = '1' where id = '".$reg->id."'"); } } }; break;
            case 2:{ $sql = $ini->consulta("select * from usuarios_web");  while($reg = $ini->fetch_object($sql)){ if(isset($_POST['chusu'.$reg->id])){
                     $ssql = $ini->consulta("update usuarios_web set activo = '0' where id = '".$reg->id."'"); } } }; break;
            case 3:{ $sql = $ini->consulta("select * from usuarios_web");  while($reg = $ini->fetch_object($sql)){
                     if(isset($_POST['chusu'.$reg->id])){ 
                        $ssql = $ini->consulta("delete from usuarios_web where id = '".$reg->id."'"); 
                    } } }; break;
            case 4:{ $ssql = $ini->consulta("update usuarios_web set activo = '1' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
            case 5:{ $ssql = $ini->consulta("update usuarios_web set activo = '0' where id = '".$_POST['admin_lis_usu_php_id']."'"); }; break;
            case 6:{ $ssql = $ini->consulta("delete from usuarios_web where id = '".$_POST['admin_lis_usu_php_id']."'");             }; break;
        }
}

if($_POST['encuentra'] != 1){
    $arrord = array(1=>'usuarios_web.nombre',2=>'usuarios_web.apellido',3=>'permiso.nombre',4=>'activo',5=>'fecha_i'); 
    if($_POST['orden'.$_POST['tipoorden']] == 1){ $oras = "asc"; $fle = "down"; }else{ $oras = "desc"; $fle = "up"; } $buscarsql = ""; $buscarsqll = "";

    if(isset($_POST['busqueda']) and $_POST['busqueda'] != "" or isset($_SESSION['busqueda'])){  
        if($_POST['tipoorden'] == ""){ $_POST['tipoorden'] = 1; } if(isset($_POST['busqueda']) and !isset($_SESSION['busqueda'])){ $_SESSION['busqueda'] = $_POST['busqueda']; }
        $buscarsql = ", match(nombre,apellido,email) against ('".$_POST['busqueda']."') as buscador"; $buscarsqll = " where match(nombre,apellido,email) against ('".$_POST['busqueda']."')"; 
        $sql = $ini->consulta("select *".$buscarsql." from usuarios_web inner join permiso on usuarios_web.permiso = permiso.id ".$buscarsqll." order by ".$arrord[$_POST['tipoorden']]." ".$oras);
        
    }else{
        if($_POST['tipoorden'] == ""){
            $sql = $ini->consulta("select * from usuarios_web order by fecha_i desc limit ".$_POST['desde'].",".$_POST['hasta']);
        }else{
            $sql = $ini->consulta("select * from usuarios_web order by ".$arrord[$_POST['tipoorden']]." ".$oras." limit ".$_POST['desde'].", ".$_POST['hasta']);
        }
    }
}else{
    $sql = $ini->consulta("select * from usuarios_web order by fecha_i desc");
}


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
        <th id="muestra_label"><b style="cursor:pointer;" onclick="ajaorden(1)">Nombre <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 1){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th><b style="cursor:pointer;" onclick="ajaorden(2)">Apellidos <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 2){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th>Municipio</th>
        <th><b style="cursor:pointer;" onclick="ajaorden(3)">Tipo <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 3){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(4)">Activo <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 4){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;"><b style="cursor:pointer;" onclick="ajaorden(5)">Fecha <i class="fa fa-caret-<?php if($_POST['tipoorden'] == 5){ echo $fle; }else{ echo "down"; } ?> fa-fw"></i></b></th>
        <th style="text-align:center;">Modificar</th>
        <th style="text-align:center;">Eliminar</th>
        
    </thead>


<?php while($reg = $ini->fetch_object($sql)){ ?>


    <tr>
        <td>
            <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position:relative">
                <input id="chusu<?php echo $reg->id; ?>" name="chusu<?php echo $reg->id; ?>" type="checkbox" style="position:absolute;" />
                <ins class="iCheck-helper" style="position:absolute; top:0%; left:0%; display:block; width:100%;height:100%;margin:0px;padding:0px;background:rgb(255,255,255);border:0px;"></ins>
            </div>
        </td>
        <td><a href="admin.php?op=<?php echo $_POST['op']; ?>&se=5&id=<?php echo $reg->id; ?>"><?php echo $reg->nombre; ?></a></td>
        <td><?php echo $reg->apellidos; ?></td>
        <td><?php if($reg->municipio != 0){ echo $ini->selectcampo($reg->municipio,"municipios","Nombre"); } ?></td>
        <td><?php echo $ini->selectcampo($reg->permiso,"permiso","nombre"); ?></td>
        <td style="text-align:center;"><?php if($reg->activo == 1){ echo "si"; }else{ echo "no"; } ?></td>
        <td style="text-align:center;"><?php $date = date_create($reg->fecha_i); echo date_format($date, 'd/m/Y H:i:s'); ?></td>
        <td style="text-align:center;"><a href="admin.php?op=<?php echo $_POST['op'] ?>&se=5&id=<?php echo $reg->id; ?>"><i class="fa fa-cogs fa-fw"></i></a></td>
        <td style="text-align:center;"><a class="submitform" title="6" id="<?php echo $reg->id; ?>" href="#"><i class="fa fa-trash-o fa-fw"></i></a></td>
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
       // document.getElementById("admin_lis_usu_php_op").value = ''; 
       // document.getElementById("admin_lis_usu_php_id").value = '';
            var url = "../utiles/admin/php/muestra_filas_negocio.php";
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
	
	
	
	No hay resultados <a href="admin.php?op=<?php echo $_POST['op']; ?>&se=2">Volver</a>
	
<?php } ?>