<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8" /><meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="robots" content="noindex" />

<title><?php echo $ini->metatit; ?></title>
<meta name="Description" content="<?php echo $ini->metades; ?>" />
<meta name="keywords" content="<?php echo $ini->metakey; ?>" />
<meta name="author" content="Bazinga Studio">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="cleartype" content="on">
<script type='text/javascript' src='<?php echo $urlppal; ?>utiles/js/jquery.js'></script>
<script src="<?php echo $urlppal; ?>utiles/js/bootstrap.min.js"></script>
<link href="<?php echo $urlppal; ?>utiles/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo $urlppal; ?>utiles/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $urlppal; ?>plantilla/css/estilo.css?<?php echo $ini->aleatorio(); ?>" type="text/css" media="screen, projection" />
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500i,600,700,800,900&display=swap" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet" />

<script type="text/javascript" src="<?php echo $urlppal; ?>utiles/js/slide-seccion-header.js"></script>

<!--
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '2432131173696845',
      cookie     : true,
      xfbml      : true,
      version    : 'v4.0'
    });
      
    FB.AppEvents.logPageView();   
     
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));



function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
    console.log(response);
  });
}

</script>
-->

<script>
	$(document).ready(function () {
		
    $('.submit-login').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/login.php";
      $.ajax({ type: "POST", url: url, data: $('#form-login').serialize(), success: function(data){ $('.login-registro').html(data); } });
    });

    $('.submit-busness').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/post_negocio.php";
      $.ajax({ type: "POST", url: url, data: $('#form-busness').serialize(), success: function(data){ $('.busness-registro').html(data); } });

    });

    $('.submit_form_buscador').click(function(){
        $('#buscador_form').submit();
    });
    
    $('.enviar-registro').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/registro.php";
      $.ajax({ type: "POST", url: url, data: $('#datos-registro').serialize(), success: function(data){ $('.zona-registro').html(data); } });
    });

    $('.enviar-registro-negocio').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/registro_negocio.php";
      $.ajax({
        type: "POST", 
        url: url,
        data: $('#datos-registro-negocio').serialize(),
        sucess: function(data){
          $('.zona-registro-negocio').html(data);
        }
      });
    });


    $('.redireccionar').click(function(){
      window.location = '<?php echo $urlppal; ?>';
    });

    $('.mostrar-menu-usu').click(function(event){
      event.preventDefault();
      if($('.menu-usu').css('opacity') == '0'){
        $('.menu-usu').css('opacity','1');
        $('.menu-usu').css('top','45px');
      }else{
        $('.menu-usu').css('opacity','0');
        $('.menu-usu').css('top','-1000px');
      }
    });

    $('.mostrar-menu-negocio').click(function(event){
      event.preventDefault();
      if($('.menu-negocio').css('opacity') == '0'){
        $('.menu-negocio').css('opacity','1');
        $('.menu-negocio').css('top','45px');
      }else{
        $('.menu-negocio').css('opacity','0');
        $('.menu-negocio').css('top','-1000px');
      }
    });

    $('.registro').click(function(event){
      event.preventDefault();
      $('.login-registro').css('display','none');
      $('.zona-registro').css('display','block');
    });

    $('.ir_a_login').click(function(event){
      event.preventDefault();
      $('.zona-registro').css('display','none');
      $('.login-registro').css('display','block');
    });

    $('.registro-negocio').click(function(event){
      event.preventDefault();
      $('.busness-registro').css('display','none');
      $('.zona-registro-negocio').css('display','block');
    });

    $('.ir_a_negocio').click(function(event){
      event.preventDefault();
      $('.busness-registro').css('display','block');
      $('.zona-registro-negocio').css('display','none');
    });

    $('.cerrar-sesion').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/logout.php";
      $.ajax({ type: "POST", url: url, data: $('#form-login').serialize(), success: function(data){ $('.pagina').html(data); } });
    });

    $('.cerrar-sesion-negocio').click(function(event){
      event.preventDefault();
      var url = "<?php echo $urlppal; ?>/utiles/ajax/logoutNeg.php";
      $.ajax({ type: "POST", url: url, data: $('#form-busness').serialize(), success: function(data){ $('.pagina').html(data); } });
    });

    $('body').on('click', function() {
        var dropdown4 = $('.menu-negocio');
        var dropdown3 = $('.o-menu-mo');
        var dropdown2 = $('.menu-compartir'); 
        var dropdown = $('.menu-usu');

        if(dropdown.css('opacity') == '1' && $('.menu-usu:hover').length == 0){
            $('.menu-usu').css('opacity','0');
            $('.menu-usu').css('top','-1000px');
        }

        if(dropdown4.css('opacity') == '1' && $('.menu-negocio:hover').length == 0){
            $('.menu-negocio').css('opacity','0');
            $('.menu-negocio').css('top','-1000px');
        }

        if(dropdown2.css('opacity') == 1 && $('.menu-compartir:hover').length == 0){
            $('.menu-compartir').css('opacity','0');
        }
        if(dropdown3.css('display') == "block" && $('.o-menu-mo:hover').length == 0){
            if($('.menu').hasClass("primera-v")){
              $('.menu').removeClass("primera-v");
            }else{
              $('.o-menu-mo').css('display','none');
              $(".menu").removeClass(".o-menu-mo");
            }
        }
    });

    $(".modal").on("hidden.bs.modal", function(){
      window.location = "<?php echo $_SERVER['REQUEST_URI']; ?>";
    });

    $(".menu-movil").on('click', function(){
      event.preventDefault();
      if($(".menu").css("display") == "block"){
        $(".menu").css("display","none");
        $(".menu").removeClass("o-menu-mo");
        $('.menu').removeClass("primera-v");
      }else{
        $(".menu").css("display","block");
        $(".menu").addClass("o-menu-mo");
        $(".menu").addClass("primera-v");
      }
    });

	});



</script>

<link rel="stylesheet" type="text/css" href="<?php echo $urlppal; ?>utiles/css/style1.css" />


<?php if(file_exists("plantilla/css/".$ini->archivo.".css")){ ?><link href="<?php echo $urlppal."plantilla/css/".$ini->archivo.".css"; ?>?<?php echo $ini->aleatorio(); ?>" rel="stylesheet" type="text/css" /><?php } ?>
<?php if(file_exists("plantilla/cabecera/".$ini->archivo.".php")){ include("plantilla/cabecera/".$ini->archivo.".php"); } ?>
<?php $lanes = include("utiles/lang/".$ini->selectcampo($ini->lang,'lang','siglas').".php"); ?>
</head>	
<body>
<div class="pagina">
<?php include('plantilla/cabecera.php'); ?>
<?php include('plantilla/'.$ini->archivo.".php"); ?>
<?php include('plantilla/pie.php'); ?>
</div>
</body>
</html>

<div class="modal fade" id="busnessModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Identifica Negocio </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

		<div class="row busness-registro">
			<div class="zona-negocio">
				<p class="titular">Usar usuario y contraseña del negocio</p>
				<form method="post" id="form-busness" action="<?php echo $urlppal; ?>">
					<div class="input-usuario"><input type="email" class="form-control" name="email" placeholder="Email" required="required" /></div>
					<div class="input-passwd"><input type="password" class="form-control" name="passwd" placeholder="Contraseña" required="required" /></div>
          <div class="input-cookie"><input type="checkbox" id="cookie-activa" name="cookie" value="1" /> <span for="cookie-activa">Recuerdame</span></div>
					<div class="input-submit"><input type="submit" class="form-control btn-primary submit-busness" name="submit" value="Conectarme" /></div>
				</form>
				<div class="row">
					<div class="col-sm-9"><a class="recordar-passwd" href="#">¿Has olvidado la contraseña?</a></div>
					<div class="col-sm-6"><a class="registro-negocio" href="#">Registra un negocio</a></div>
				</div>
			</div>
		</div>

    <div class="row zona-registro-negocio">
      <div class="col-sm-12 center"><a class="ir_a_negocio" href="#">Tengo un negocio</a></div>
      <p class="titular">Rellena los siguientes datos</p>
      <form method="post" action="<?php echo $urlppal; ?>" id="datos-registro-negocio">
      <input type="hidden" name="registro" value="1" />
      <div class="col-sm-6">
        <div class="input-form"><input type="text" name="nombre" value="" placeholder="Nombre" class="form-control" required="required" /></div>
        <div class="input-form"><input type="email" name="email" value="" placeholder="Email" class="form-control" required="required" /></div>
      </div>
      <div class="col-sm-6">
        <div class="input-form"><input type="text" name="marca" value="" placeholder="Nombre marca" class="form-control" required="required" /></div>
        <div class="input-form"><input type="password" name="passwd" value="" placeholder="Contraseña" class="form-control" required="required" /></div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="facebook" value="" placeholder="Facebook" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="twitter" value="" placeholder="Twitter" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="instagram" value="" placeholder="Instagram" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="pinterest" value="" placeholder="Pinterest" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="youtube" value="" placeholder="Youtube" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="linkedin" value="" placeholder="Linkedin" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-form">
          <input type="text" name="google" value="" placeholder="Google" class="form-control" />
        </div>
      </div>
      <div class="col-sm-12 btn-submit"><input class="btn btn-primary enviar-registro-negocio" type="submit" name="submit" value="Enviar" /></div>
      </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger cerrar-modal-negocio" data-dismiss="modal">cerrar</button>
    </div>
  </div>
  </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Identificate </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!--
<fb:login-button 
  scope="public_profile,email"
  onlogin="checkLoginState();">
</fb:login-button>
-->

		<div class="row login-registro">
			<div class="col-sm-6 zona-login">
				<p class="titular">Usar usuario y contraseña</p>
				<form method="post" id="form-login" action="<?php echo $urlppal; ?>">
					<div class="input-usuario"><input type="email" class="form-control" name="email" placeholder="Email" required="required" /></div>
					<div class="input-passwd"><input type="password" class="form-control" name="passwd" placeholder="Contraseña" required="required" /></div>
          <div class="input-cookie"><input type="checkbox" id="cookie-activa" name="cookie" value="1" /> <span for="cookie-activa">Recuerdame</span></div>
					<div class="input-submit"><input type="submit" class="form-control btn-primary submit-login" name="submit" value="Conectarme" /></div>
				</form>
				<div class="row">
					<div class="col-sm-9"><a class="recordar-passwd" href="#">¿Has olvidado la contraseña?</a></div>
					<div class="col-sm-3"><a class="registro" href="#">Registrate</a></div>
				</div>
			</div>
			<div class="col-sm-6 conectar-con">


     

      <?php
      include('utiles/php-graph-sdk-5.x/src/Facebook/autoload.php');
      $fb = new Facebook\Facebook([
        'app_id' => '2432131173696845',
        'app_secret' => 'f12774c9d85cb1ada21cd2ff5427866f',
        'default_graph_version' => 'v3.2',
        ]);
 
      $helper = $fb->getRedirectLoginHelper();
     // $accessToken = $helper->getAccessToken();
    

      


      $permissions = ['email']; // Optional permissions
      //$loginUrl = $helper->getLoginUrl('https://www.cervetarianos.com/index.php?conect=ok', $permissions);
      $loginUrl = $helper->getLoginUrl('https://www.cervetarianos.com/callback.php', $permissions);
      echo '<a target="_blank" href="' . htmlspecialchars($loginUrl) . '"><img src="'.$urlppal.'imagen/redescabecera/facebook-conectarse.png" /></a>';

     // echo var_dump($accessToken);



      ?>

      </div>
		</div>



    <div class="row zona-registro">
      <div class="col-sm-12 center"><a class="ir_a_login" href="#">Tengo una cuenta</a></div>
      <p class="titular">Rellena los siguientes datos</p>
      <form method="post" action="<?php echo $urlppal; ?>" id="datos-registro">
      <input type="hidden" name="registro" value="1" />
      <div class="col-sm-6">
        <div class="input-form"><input type="text" name="nombre" value="" placeholder="Nombre" class="form-control" required="required" /></div>
        <div class="input-form"><input type="email" name="email" value="" placeholder="Email" class="form-control" required="required" /></div>
      </div>
      <div class="col-sm-6">
        <div class="input-form"><input type="text" name="apellidos" value="" placeholder="Apellidos" class="form-control" required="required" /></div>
        <div class="input-form"><input type="password" name="passwd" value="" placeholder="Contraseña" class="form-control" required="required" /></div>
      </div>
      <div class="col-sm-12">
        <div class="input-form"><textarea name="comentario" placeholder="Comentario" class="form-control"></textarea></div>
      </div>
      <div class="col-sm-12 btn-submit"><input class="btn btn-primary enviar-registro" type="submit" name="submit" value="Enviar" /></div>
      </form>
    </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger cerrar-modal-login" data-dismiss="modal">cerrar</button>
      </div>
    </div>
  </div>
</div>
<div class="ajax"></div>