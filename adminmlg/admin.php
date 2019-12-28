<?php 
$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } session_start();
include("../utiles/php/iniciar.php"); include('../utiles/php/admin.php'); $ad = new admin();
if(!$_SESSION['user-'.$GLOBALS['userzft']] and !$_COOKIE['user-'.$GLOBALS['userzft']]){ header("location: index.php?error=3333"); exit(); } 
$idadmin = $_SESSION['user-'.$GLOBALS['userzft']] ? $_SESSION['user-'.$GLOBALS['userzft']] : $_COOKIE['user-'.$GLOBALS['userzft']];
$permiso = $ini->selectcampo($idadmin,'usuarios','permiso'); if($_GET['idioma'] != ""){ $idioma = $_GET['idioma']; }else{ $idioma = 1; } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head> 
    <title> Administrador <?php echo $GLOBALS['titzft']; ?></title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="<?php echo $urlppal; ?>utiles/admin/css/estilo.css?<?php echo $ini->aleatorio(); ?>" type="text/css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/admin/css/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/admin/css/timeline.css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/admin/css/startmin.css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/admin/css/morris.css" rel="stylesheet">
    <link href="<?php echo $urlppal; ?>utiles/css/font-awesome.min.css?4" rel="stylesheet" type="text/css">
    <script src="<?php echo $urlppal; ?>utiles/js/jquery.js"></script>
    <script src="<?php echo $urlppal; ?>utiles/js/bootstrap.min.js"></script>
    <script src="<?php echo $urlppal; ?>utiles/admin/js/metisMenu.min.js"></script>
    <script src="<?php echo $urlppal; ?>utiles/admin/js/startmin.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" target="_blank" href="<?php echo $urlppal; ?>"><?php echo $GLOBALS['titzft']; ?></a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="admin.php"><i class="fa fa-home fa-fw"></i> Menu principal</a></li>

            <?php $sql_lang = $ini->consulta("select * from lang"); while($reg_lang = $ini->fetch_object($sql_lang)){ 
                    if($_GET['op'] != ""){ $op = "&op=".$_GET['op']; }else{ $op = ""; }
                    if($_GET['se'] != ""){ $se = "&se=".$_GET['se']; }else{ $se = ""; }
                    if($_GET['id'] != ""){ $id = "&id=".$_GET['id']; }else{ $id = ""; }
                    if($_GET['pagina'] != ""){ $page = "&page=".$_GET['pagina']; }else{ $page = ""; }
                    if($_GET['ids'] != ""){ $ids = "&ids=".$_GET['ids']; }else{ $ids = ""; }
                    if($_GET['npagt'] != ""){ $npagt = "&npagt=".$_GET['npagt']; }else{ $npagt = ""; }
                    $url_lang = "admin.php?idioma=".$reg_lang->id.$op.$se.$id.$page.$ids.$npagt; ?>
                <li><a href="<?php echo $url_lang; ?>"><img width="18" height="14" src="<?php echo $urlppal; ?>utiles/lang/imagen/<?php echo $reg_lang->siglas; ?>.png"></a></li>
            <?php } ?>

        </ul>
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
         
                    <i <?php $alert = false; if($alert){ ?>style="color:#FF0000;" <?php } ?>class="fa fa-bell fa-fw"></i> <b <?php if($alert){ ?>style="color:#FF0000;" <?php } ?>class="caret"></b>
                </a>
                <?php if($alert){  $fechaahora = date("Y-m-d H:i:s"); ?>
                <ul class="dropdown-menu dropdown-alerts">
                	
                	<?php 
 
 						$aux = array();
						foreach($alertarray as $idid=>$valid){ $aux[$idid] = $valid[1]; }
						array_multisort($aux, SORT_DESC, $alertarray); 
 
						foreach($alertarray as $val){
						$fecha1 = new DateTime($val[1]);
						$fecha2 = new DateTime($fechaahora);
						$fechadiff = $fecha1->diff($fecha2);
						?>
                    <li>
                        <a href="admin.php?op=<?php echo $val[2]; ?>&se=<?php echo $val[3]; ?>&id=<?php echo $val[4]; ?>">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> <?php echo $val[0]; ?>
                                <span class="pull-right text-muted small">Hace <?php if($fechadiff->y > 0){ echo " ".$fechadiff->y." años, "; } if($fechadiff->m > 0){ echo " ".$fechadiff->m." meses, "; } if($fechadiff->d > 0){ echo " ".$fechadiff->d." dias, "; } if($fechadiff->h > 0){ echo " ".$fechadiff->h." horas, "; } if($fechadiff->i > 0){ echo " ".$fechadiff->i." minutos, "; } if($fechadiff->s > 0){ echo " ".$fechadiff->s." segundos. "; } ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <?php }  ?>

                </ul>
                <?php } ?>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="admin.php?op=1&se=3&id=<?php echo $idadmin; ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>
                    <li><a href="admin.php?op=1&se=4&id=<?php echo $idadmin; ?>"><i class="fa fa-gear fa-fw"></i> Configurar</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $urlppal; ?>utiles/php/unloggin.php?user=adm"><i class="fa fa-sign-out fa-fw"></i> Desconectar</a>
                    </li>
                </ul>
            </li>
        </ul>
        
    </nav>


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">

<?php if($permiso == 1){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=1&se=1"><i class="fa fa-user-secret fa-fw"></i> Administradores <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=1&se=1"><i class="fa fa-eye fa-fw"></i> Ver Administradores </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=1&se=2"><i class="fa fa-user-plus fa-fw"></i> Crear Administrador </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=1&se=4&id=<?php echo $idadmin; ?>"><i class="fa fa-edit fa-fw"></i> Editar Mi Perfil </a></li>
<li style="display:none;"><a href="admin.php?op=1&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?op=1&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?op=1&se=6">no</a></li>
</ul></li>
<?php } ?>
<?php if($permiso == 1 or $permiso == 2 or $permiso == 3){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=2&se=1"><i class="fa fa-photo fa-fw"></i> Imágenes <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=2&se=1"><i class="fa fa-eye fa-fw"></i> Ver Imágenes </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=2&se=2"><i class="fa fa-download fa-fw"></i> Subir Imágenes </a></li>
<li style="display:none;"><a href="admin.php?op=2&se=4">no</a></li>
</ul></li>
<?php } ?>
<?php if($permiso == 1){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=3&se=1"><i class="fa fa-th fa-fw"></i> Menú <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=3&se=1"><i class="fa fa-eye fa-fw"></i> Ver Menú </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=3&se=2"><i class="fa fa-edit fa-fw"></i> Editar Menú </a></li>
<li style="display:none;"><a href="admin.php?op=3&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?op=3&se=4">no</a></li>
</ul></li>
<?php } ?>
<?php if($permiso == 1){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=1"><i class="fa fa-puzzle-piece fa-fw"></i> Partes De La Web <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=1"><i class="fa fa-photo fa-fw"></i> Imagenes En La Web </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=2"><i class="fa fa-terminal fa-fw"></i> Partes En La Web </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=3"><i class="fa fa-share-alt-square fa-fw"></i> Redes Sociales </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=4"><i class="fa fa-line-chart fa-fw"></i> SEO </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=5"><i class="fa fa-bookmark fa-fw"></i> Categorías </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=6"><i class="fa fa-book fa-fw"></i> Secciones principales </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=4&se=7"><i class="la la-film"></i> Slide cabecera home </a></li>
</ul></li>
<?php } ?>
<?php if($permiso == 1 or $permiso == 3){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=5&se=1"><i class="fa fa-newspaper-o fa-fw"></i> Blog <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=5&se=1"><i class="fa fa-plus-circle fa-fw"></i> Insertar post </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=5&se=2"><i class="fa fa-edit fa-fw"></i> Acciones post </a></li>
<li style="display:none;"><a href="admin.php?op=5&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?op=5&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?op=5&se=5">no</a></li>
</ul></li>
<?php } ?>
<?php if($permiso == 1 or $permiso == 2){ ?>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=1"><i class="fa fa-shopping-cart fa-fw"></i> Tienda <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar Producto </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=2"><i class="fa fa-edit fa-fw"></i> Acciones Productos </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=3"><i class="fa fa-gear fa-fw"></i> Tienda </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=4"><i class="fa fa-user-plus fa-fw"></i> Insertar Usuarios </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=5"><i class="fa fa-users fa-fw"></i> Acciones Usuarios </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=6&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>

<?php } ?>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=1"><i class="fa fa-file-text-o fa-fw"></i> Páginas <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar Páginas </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=2"><i class="fa fa-edit fa-fw"></i> Acciones Páginas </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=14&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>



<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=1"><i class="fa fa-location-arrow fa-fw"></i> Fichas Localidades <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar localidades </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=2"><i class="fa fa-edit fa-fw"></i> Acciones localidades </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=10&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=1"><i class="fa fa-beer"></i> Fichas cervezas <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar cerveza </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=2"><i class="fa fa-edit fa-fw"></i> Acciones Cervezas </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=3"><i class="fa fa-gear fa-fw"></i> Tienda </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=7&se=21">no</a></li><?php /* ver  */ ?> 


</ul></li>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=1"><i class="fa fa-tags fa-fw"></i> Fichas Categorías <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar categoría </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=2"><i class="fa fa-edit fa-fw"></i> Acciones categoría </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=9&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=1"><i class="la la-cutlery"></i> Fichas Negocios <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar Negocios </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=2"><i class="fa fa-edit fa-fw"></i> Acciones Negocios </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=8&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=1"><i class="fa fa-calendar fa-fw"></i> Fichas Eventos <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=1"><i class="fa fa-cart-plus fa-fw"></i> Insertar Eventos </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=2"><i class="fa fa-edit fa-fw"></i> Acciones Eventos </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=15&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>



<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=1"><i class="fa fa-folder-open fa-fw"></i>    Fichas servicios <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=1"><i class="fa fa-cart-plus fa-fw"></i>      Insertar servicios </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=2"><i class="fa fa-edit fa-fw"></i>           Acciones servicios </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=11&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>


<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=1"><i class="fa fa-user fa-fw"></i>    Fichas usuarios <span class="fa arrow"></span></a><ul class="nav nav-second-level">
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=1"><i class="fa fa-user-plus fa-fw"></i>      Insertar usuarios </a></li>
<li><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=2"><i class="fa fa-group fa-fw"></i>           Acciones usuarios </a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=3">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=4">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=5">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=6">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=7">no</a></li><?php /* eliminar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=8">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=9">no</a></li><?php /* modificar  */ ?>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=31">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=32">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=33">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=34">no</a></li>
<li style="display:none;"><a href="admin.php?idioma=<?php echo $idioma; ?>&op=12&se=21">no</a></li><?php /* ver  */ ?>

</ul></li>

                    
                </ul>
            </div>
        </div>

    <div id="page-wrapper" style="min-height: 584px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if($_GET['op'] != ""){ echo $ad->htmlopb($_GET['op']); }else{ echo $ad->htmlopb("ppal"); } ?></h1>
                </div>
            </div>
            <?php if($_GET['msj'] != ""){ ?>
                <div class="alert <?php echo $ad->classmsj($_GET['msj']); ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $ad->msjusu($_GET['msj']); ?>
                </div>
            <?php } ?>

            <?php if(file_exists("html/".$ad->htmlop($_GET['op']).".php")){ include("html/".$ad->htmlop($_GET['op']).".php"); }else{ ?>
                <p>Bienvenido a su administrador, donde crear, modificar, y eliminar contenidos en su web, siga los menus e indicaciones de hola@cervezasmalaga.com, contacte con nosotros siempre que lo necesite, para problemas, nuevas herramientas en su administrador a hola@cervezasmalaga.com. Gracias por confiar en nosotros. <br /><br /><br />

                </p>
            <?php } ?>
            <div style="height:100px;"></div>
        </div>
    </div>
<div class="footer"> Soporte: <a href="mailto:hola@cervezasmalaga.com">hola@cervezasmalaga.com</a></div>
</div>
</body></html>