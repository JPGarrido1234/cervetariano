<?php error_reporting(0);
session_start();                  

$adaux = "../utiles/php/"; include('../utiles/php/iniciar.php');

$foo = 'www';
if (strlen(strstr($_SERVER["HTTP_HOST"], $foo)) == 0) {
    header("Location: https://www.cervetarianos.com/adminmlg/");
    exit;
}

if($_SESSION['user-'.$GLOBALS['userzft']] or $_COOKIE['user-'.$GLOBALS['userzft']]){
	header("location: admin.php");
	exit();
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang='es' xml:lang='es' xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Identificación  Administrador</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../utiles/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../utiles/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../utiles/logear/matrix-login.css" />
    <link rel="stylesheet" href="../utiles/logear/font-awesome.min.css" />
	<link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' type='text/css'>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> 
</head>
<body>

<?php if($_GET['error'] != ""){ $arr_error = array(1111=>"Mal insertado",1112=>"Datos incorrectos",1113=>"Datos erroneos",3333=>"Direccion incorrecta."); ?>     
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="alert alert-danger alert-dissable"><b>Error: <?php echo $arr_error[$_GET['error']]; ?></b></div>
        </div>
        <div class="col-sm-2"></div>
    </div>
<?php } ?>

<div id="loginbox">
    <form id="loginform" class="form-vertical" action="../utiles/php/loggear.php" method="post">
        <input type="hidden" name="formu" value="logg" />
        <div class="control-group normal_text"> <h3>Identificación <?php echo $GLOBALS['titzft']; ?></h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="fa fa-user"> </i></span><input type="text" name="usu" placeholder="Usuario" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="fa fa-lock"></i></span><input type="password" name="pass" placeholder="Contraseña" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls"><input type="checkbox" name="remember" value="si" /> Recordarme</div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Recordar contraseña</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-success" value="Entrar" /></span>
        </div>
    </form>

    <form id="recoverform" action="../utiles/php/loggear.php" class="form-vertical" method="post">
        <input type="hidden" name="formu" value="pass" />		   
		<p class="normal_text">Inserte su email de usuario</p>
        <div class="controls">
            <div class="main_input_box">
                <span class="add-on bg_lo"><i class="fa fa-envelope-o"></i></span><input type="text" name="email" placeholder="E-mail" />
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Atras</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-info" value="Enviar"/></span>
        </div>
    </form>
</div>

<script src="../utiles/logear/jquery.min.js"></script>  
<script src="../utiles/logear/matrix.login.js"></script>  

</body>
</html>