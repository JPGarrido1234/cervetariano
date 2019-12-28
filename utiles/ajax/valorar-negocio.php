<?php session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php");

if($ini->conectado){

$sql = $ini->consulta("select id_negocio from valoracion_ngc where id_negocio = '".$_POST['id_negocio']."' and id_usuario = '".$ini->desencriptar($_POST['id_usuario'],$baz)."'");

$comentario=str_replace("\r\n","<br>",$_POST['comentario']);
$comentario = $ini->real_scape($comentario);

if($ini->num_rows($sql) > 0){
	$sql = $ini->consulta("update valoracion_ngc set comentario = '".$comentario."', cervezas = '".$_POST['cerveza']."', artesanales = '".$_POST['artesanales']."', malaga = '".$_POST['malaga']."', local = '".$_POST['local']."' where id_negocio = '".$_POST['id_negocio']."' and id_usuario = '".$ini->desencriptar($_POST['id_usuario'],$baz)."'");
}else{
	$sql = $ini->consulta("insert into valoracion_ngc (id_negocio,id_usuario,comentario,cervezas,artesanales,malaga,local) value ('".$_POST['id_negocio']."','".$ini->desencriptar($_POST['id_usuario'],$baz)."','".$comentario."','".$_POST['cerveza']."','".$_POST['artesanales']."','".$_POST['malaga']."','".$_POST['local']."')");


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
        $mail->Subject = "valoración realizada | Cervezas Málaga";
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
        $mail->Subject = "valoración realizada | Cervezas Málaga";
        $mail->Body = $html;
        $mail->send();
      } catch(Exception $e){
        echo 'Error. Mensaje de PHPMailer: ', $mail->ErrorInfo; exit();
      }






}
?>
				<div class="caja-borde comentario">
				<div class="contenido-caja">
					<div class="row">
						<div class="col-sm-6">
							<div class="titulo"><span class="icono"><i class="fa fa-thumbs-o-up fa-fw"></i></span> <span class="texto">Negocio valorado</span></div>
							<div class="row zona-votar">
								<div class="col-sm-6">
									<div class="votar-cerveza">
										<p>Variedad de<br />cervezas</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['cerveza']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="cerveza" id="cerveza" />
									</div>
									<div class="votar-malaga">
										<p>Variedad de<br />Cervezas Málaga</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['malaga']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="malaga" id="malaga" />
									</div>
								</div>
								<div class="col-sm-6">
									<div class="votar-artesanales">
										<p>Variedades de<br />Artesanales</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['artesanales']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="artesanales" id="artesanales" />
									</div>
									<div class="votar-local">
										<p>Experiencia<br />en el Local</p>
										<div class="margb">
											<div>
												<div class="valoracion"><?php $ttp = ($_POST['local']*100)/5; $wdt = ($ttp*150)/100; ?>
													<div><div class="contenido-sitio clearfix"><ul class="votacion" style="width:150px;"><li class="barra" style="width:<?php echo $wdt; ?>px;">Currently 2/663</li></ul></div></div>
												</div>
											</div>
										</div>
										<input type="hidden" value="0" name="local" id="local" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="titulo"><span class="icono"><i class="la la-comments"></i></span> <span class="texto">Tu comentario</span></div>
							<div class="row">
								<div class="col-sm-12 comentado"><?php echo $comentario; ?></div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
<?php }else{ ?>

<div class="error">No se ha conectado, necesita conectarse para poder hacer una valoración</div>

<?php } ?>

