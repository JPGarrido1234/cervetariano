<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } 
include("utiles/php/iniciar.php");

      include('utiles/php-graph-sdk-5.x/src/Facebook/autoload.php');
      $fb = new Facebook\Facebook([
        'app_id' => '2432131173696845',
        'app_secret' => 'f12774c9d85cb1ada21cd2ff5427866f',
        'default_graph_version' => 'v3.2',
        ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo '1 Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('2432131173696845'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

 // echo '<h3>Long-lived</h3>';
 // var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;


   
     // $accessToken = $helper->getAccessToken();
    

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo '2 Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
echo 'Email' . $user['email'];


$sql = $ini->consulta("select * from usuarios_web where email = '".$user['email']."'");

if($ini->num_rows($sql) > 0){

  $reg = $ini->fetch_object($sql); $id = $ini->encriptar($reg->id,$baz);
  $_SESSION['user-web-'.$GLOBALS['userzft']] = $id;
  $_SESSION['mensaje-facebook'] = "ok";
  header('location: '.$urlppal);
  exit();

}else{


  include('utiles/php/admin.php'); $ad = new admin();

  $fecha = date("Y-m-d H:i:s");
  $passwd = md5($fecha);
  $clave = md5($fecha);
  $nombre = $ini->real_scape($user['name']);
  $apellidos = ' ';
  $email = $ini->real_scape($user['email']);
  $url_amg = $ad->cambiaralfn($nombre);


    $sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amg."' and seccion = '3'"); 
    $url_amgfn = $url_amg; $i=1; 
    while($ini->num_rows($sqlurlamg) > 0){
        $url_amgfn = $url_amg.$i; $i++; 
        $sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg_lang = '".$url_amgfn."' and seccion = '3'"); 
    }
    $url_amg = $url_amgfn;

    $sql = $ini->consulta("insert into usuarios_web (fecha_i,fecha_u,pass,activo,permiso,clave,nombre,apellidos,email,url_amg) value ('".$fecha."','".$fecha."','".$passwd."','0','1','".$clave."','".$nombre."','".$apellidos."','".$email."','".$url_amg."')");
    echo "insert into usuarios_web (fecha_i,fecha_u,pass,activo,permiso,clave,nombre,apellidos,email,url_amg) value ('".$fecha."','".$fecha."','".$passwd."','0','1','".$clave."','".$nombre."','".$apellidos."','".$email."','".$url_amg."')";

    exit();

    $id = $ini->ultimoid();

    $sql = $ini->consulta("insert into url_amg (seccion,subsecc,plantilla,fecha,thumbs,activo,usuario) value ('3','0','17','".$fecha."','','1','".$id."')");
    $sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido,titalt) value ('".$id."','1','".$url_amg."','".$nombre."','','','')");

    $_SESSION['user-web-'.$GLOBALS['userzft']] = $id;
    $_SESSION['mensaje-facebook'] = "ok";
    





  require '../PHPMailer-master/src/Exception.php';
  require '../PHPMailer-master/src/PHPMailer.php';
  require '../PHPMailer-master/src/SMTP.php';

  $email = "parejasisi@gmail.com";
  $email2 = "hola@vivesinnova.com";

    $html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
    $html.= "<html>\n";
    $html.= "<head>\n";
    $html.= "<title>Tuett</title>\n";
    $html.= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";

    $html.= "<style>\n";
    $html.= "body {\n";
    $html.= " font-family: Arial, Helvetica, sans-serif;\n";
    $html.= " color: #292929;\n";
    $html.= " margin: 20px 0;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"wrapper\"] {\n";
    $html.= " width: 600px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"master_table\"]{\n";
    $html.= " width: 700px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"padds\"]{\n";
    $html.= " width: 50px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"social\"]{\n";
    $html.= " width: 25px;\n";
    $html.= " height: 24px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"social_space\"]{\n";
    $html.= " width: 10px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"social_holder\"]{\n";
    $html.= " width: 130px;\n";
    $html.= " height: 24px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"footer_social_holder\"]{\n";
    $html.= " width: 130px;\n";
    $html.= " height: 24px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"social\"] img{\n";
    $html.= " width: 25px;\n";
    $html.= " height: 24px;\n";
    $html.= " display: block;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "a[class=\"nodecoration\"]{\n";
    $html.= " text-decoration: none;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"preheader_padding\"]{\n";
    $html.= " width: 130px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"viewonline\"]{\n";
    $html.= " width: 340px;\n";
    $html.= " text-align: center;\n";
    $html.= " color: #8e8e8e;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"logo\"]{\n";
    $html.= " width: 215px;\n";
    $html.= " border-collapse: collapse;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"navigation_space\"]{\n";
    $html.= " width: 10px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"main_image\"] {\n";
    $html.= " width: 600px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"main_image\"] img {\n";
    $html.= " display: block;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"content\"]{\n";
    $html.= " width: 600px;\n";
    $html.= " text-align: justify;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"footer\"] {\n";
    $html.= " color: #ffffff;\n";
    $html.= " font-weight: normal;\n";
    $html.= " width: 420px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"footer_padding\"] {\n";
    $html.= " width: 50px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"location\"]{\n";
    $html.= " text-align:center;\n";
    $html.= " color: #ffffff;\n";
    $html.= " width: 600px;\n";
    $html.= " line-height: 20px;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "td[class=\"footer_nav\"]{\n";
    $html.= " line-height: 25px;\n";
    $html.= " color: #838383;\n";
    $html.= " text-align: center;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "table[class=\"main_table\"]{\n";
    $html.= " width: 700px;\n";
    $html.= " box-shadow: 0 0 5px #CCCCCC, 0 0 0 #000000 inset;\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "@media screen and (max-width: 480px) and (min-width: 321px) {\n";
    $html.= " td[class=\"padds\"]{\n";
    $html.= "   width: 10px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"wrapper\"]{\n";
    $html.= "   width: 440px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"viewonline\"]{\n";
    $html.= "   width: 310px !important;\n";
    $html.= "   text-align: left !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"preheader_padding\"] {\n";
    $html.= "   width: 10px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " table[class=\"main_table\"]{\n";
    $html.= "   width: 460px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " table[class=\"master_table\"]{\n";
    $html.= "   width: 460px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"content\"]{\n";
    $html.= "   width: 440px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"logo\"] img {\n";
    $html.= "   display: none !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"logo\"] {\n";
    $html.= "   width: 137px !important;\n";
    $html.= "   display: block;\n";
    $html.= "   height: 82px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"main_image\"] img {\n";
    $html.= "   display: none !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"main_image\"] {\n";
    $html.= "   width: 440px !important;\n";
    $html.= "   height: 212px !important;\n";
    $html.= "   display: block;\n";
    $html.= "   background-size: contain;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"picks_image\"] img{\n";
    $html.= "   width: 280px !important;\n";
    $html.= "   height: 110px !important;\n";
    $html.= "   margin: 0 auto;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " body {\n";
    $html.= "   margin: 10px 0 !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"navigation_space\"]{\n";
    $html.= "   width: 10px !important;\n";
    $html.= " }\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "@media screen and (max-width: 320px) {\n";
    $html.= " td[class=\"padds\"]{\n";
    $html.= "   width: 10px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"wrapper\"]{\n";
    $html.= "   width: 280px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"content\"]{\n";
    $html.= "   width: 280px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"viewonline\"]{\n";
    $html.= "   width: 140px !important;\n";
    $html.= "   text-align: left !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"preheader_padding\"] {\n";
    $html.= "   width: 10px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " table[class=\"main_table\"]{\n";
    $html.= "   width: 300px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " table[class=\"master_table\"]{\n";
    $html.= "   width: 300px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"logo\"] img {\n";
    $html.= "   display: none !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"logo\"] {\n";
    $html.= "   width: 137px !important;\n";
    $html.= "   display: block;\n";
    $html.= "   height: 82px !important;\n";
    $html.= "   clear: both;\n";
    $html.= "   margin: 0 auto;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"main_image\"] img {\n";
    $html.= "   display: none !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"main_image\"] {\n";
    $html.= "   width: 280px !important;\n";
    $html.= "   height: 135px !important;\n";
    $html.= "   background-size: contain;\n";
    $html.= "   display: block;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"main_image\"] img {\n";
    $html.= "   width: 280px !important;\n";
    $html.= "   height: 163px !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " body {\n";
    $html.= "   margin: 10px 0 !important;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"navigation_space\"]{\n";
    $html.= "   display: none;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"footer_social_holder\"]{\n";
    $html.= "   width: 130px !important;\n";
    $html.= "   display: block;\n";
    $html.= "   text-align: left;\n";
    $html.= "   margin: 0 auto !important;\n";
    $html.= "   text-align: center;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"footer\"]{\n";
    $html.= "   width: 280px !important;\n";
    $html.= "   display: block;\n";
    $html.= "   margin: 0 auto 10px !important;\n";
    $html.= "   text-align: center;\n";
    $html.= " }\n";
    $html.= "\n";
    $html.= " td[class=\"footer_padding\"]{\n";
    $html.= "   display: none;\n";
    $html.= " }\n";
    $html.= "}\n";
    $html.= "\n";
    $html.= "</style>\n";
    $html.= "</head>\n";
    $html.= "<body style=\"background-color: #f5fbff; font-family: Arial, Helvetica, sans-serif; color: #292929; margin: 20px 0;\">\n\n";
    $html.= "<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"main_table\" style=\"width: 700px; border: 1px solid #999999; box-shadow: 0 0 5px #CCCCCC, 0 0 0 #000000 inset;\">\n";

    $html.= "  <tr>\n";
    $html.= "    <td class=\"master_table\" style=\"width: 700px;\" bgcolor=\"#ffffff\" >\n";
    $html.= "      <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
    $html.= "        <tr>\n";
    $html.= "          <td class=\"padds\" style=\"width: 50px;\"></td>\n";
    $html.= "          <td class=\"wrapper\">\n";
    $html.= "            <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\n";
    $html.= "              <tr>\n";
    $html.= "                <td class=\"content\" style=\"width: 600px;\" height=\"25\">\n";
    $html.= "                </td>\n";
    $html.= "              </tr>\n";
    $html.= "              <tr>\n";
    $html.= "                <td class=\"content\" style=\"width: 600px; text-align:justify; font-size:20px; \">\n";
    $html.= "                   <p>Fecha: ".$fecha."</p>\n";
    $html.= "                   <p>URL: ".$url_amg."</p>\n";
    $html.= "                   <p>Nombre: ".$nombre."</p>\n";
    $html.= "                   <p>Apellidos: ".$apellidos."</p>\n";
    $html.= "                   <p>Email: ".$email."</p>\n";
    $html.= "                </td>\n";
    $html.= "              </tr>\n";
    $html.= "              <tr>\n";
    $html.= "                <td class=\"content\" style=\"width: 600px;\" height=\"40\">\n";
    $html.= "                </td>\n";
    $html.= "              </tr>\n";
    $html.= "            </table>\n";
    $html.= "          </td>\n";
    $html.= "          <td class=\"padds\" style=\"width: 50px;\"></td>\n";
    $html.= "        </tr>\n";
    $html.= "      </table>\n";
    $html.= "    </td>\n";
    $html.= "  </tr>\n";

    $html.= "  <tr>\n";
    $html.= "    <td>\n";
    $html.= "      <p style=\" padding: 10px 10px 10px 10px;font-size:8px; text-align:justify;\">\n";
    $html.= "        De conformidad con lo establecido en el REGLAMENTO (UE) 2016/679 de protección de datos de carácter personal, le informamos que los datos que usted nos facilite serán incorporados al sistema de tratamiento titularidad de Cervezas Málaga con CIF B00000000 y domicilio social sito en C/ Málaga, N 555, con la finalidad de PUBLICIDAD Y PROSPECCIÓN COMERCIAL; GESTIÓN DE CLIENTES, CONTABLE, FISCAL Y ADMINISTRATIVA.\n";
    $html.= "        <br><br>\n";
    $html.= "        Sus datos podrán ser objeto de tratamiento por terceros (serán encargados del tratamiento destinatarios de sus datos con una finalidad contractual lícita, por ejemplo nuestra empresa de mantenimiento informático exigiendo el mismo nivel de derechos, obligaciones y responsabilidades establecidas.\n";
    $html.= "        <br><br>\n";
    $html.= "        Sus datos serán conservados durante el plazo estrictamente necesario. Serán borrados cuando haya transcurrido un tiempo sin hacer uso de los mismos. Usted se compromete a notificarnos cualquier variación en los datos.\n";
    $html.= "        <br><br>\n";
    $html.= "        Podrá ejercer los derechos de acceso, rectificación, limitación de tratamiento, supresión, portabilidad y oposición al tratamiento de sus datos de carácter personal dirigiendo su petición a la dirección postal indicada arriba o al correo electrónico hablemos@vivesinnova.com\n";
    $html.= "        <br><br>\n";
    $html.= "        Podrá dirigirse a la Autoridad de Control competente para presentar la reclamación que considere oportuna.\n";
    $html.= "      </p>\n";
    $html.= "    </td>\n";
    $html.= "  </tr>\n";

    $html.= "</table>\n\n";
    $html.= "</body>\n";
    $html.= "</html>";





    $mail_conf = "soporte@bazinga-studio.com";
    $pass_conf = "r2d2lasiestaesbuenaDPS";
    $from_conf = "soporte@bazinga-studio.com";
    $smtp_conf = "smtp.ionos.es";

 /*
      $mail = new PHPMailer(true);
      try{
        $mail->SMTPDebug = 2; 
        $mail->CharSet =  "utf-8";
        $mail->Host = $smtp_conf;
        $mail->Username = $email_conf;
        $mail->Password = $paswd_conf; 
        $mail->Port = 465;
        $mail->setFrom($efrom_conf,"Cervezas Málaga");
        $mail->addAddress($email2);
        $mail->isHTML(true);
        $mail->Subject = "Nuevo Usuario";
        $mail->Body = $mensaje[1];
        $mail->send();
      } catch(Exception $e){
        echo 'Error. Mensaje de PHPMailer: ', $mail->ErrorInfo; exit();
      }
*/
      $mail = new PHPMailer(true);
      try{
        $mail->SMTPDebug = 2; 
        $mail->CharSet =  "utf-8"; 
        $mail->Host = $smtp_conf;
        $mail->Username = $email_conf;
        $mail->Password = $paswd_conf; 
        $mail->Port = 465;
        $mail->setFrom($efrom_conf,"Cervezas Málaga");
        $mail->addAddress($email2);
        $mail->isHTML(true);
        $mail->Subject = "Usuario registrado mediante facebook | Cervezas Málaga";
        $mail->Body = $html;
        $mail->send();
      } catch(Exception $e){
        echo 'Error. Mensaje de PHPMailer: ', $mail->ErrorInfo; exit();
      }







    header('location: '.$urlppal);
    exit();

}






// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>