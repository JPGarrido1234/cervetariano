<?php 
session_start(); $bug = 0; if($bug == 0){ error_reporting(0); }else{ ini_set('display_error', 1); } include("../php/iniciar.php"); 
include('../php/admin.php'); $ad = new admin();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$email = "parejasisi@gmail.com";

$email2 = "hola@vivesinnova.com";

if($_POST['cerveza_existente'] == "nueva"){

    $titulo = $ini->real_scape($_POST['name']);

    if($_POST['name'] != ""){ $url_amg = $_POST['name']; }else{ $url_amg = "cerveza"; }  $url_amg = $ad->cambiaralfn($url_amg); $long = strlen($url_amg); 
    if($long > 95){ $url_amg = substr($url_amg,0,95);  $pos = strripos($url_amg,"-"); $url_amg = substr($url_amg,0,$pos); }
    $sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg = '".$url_amg."' and seccion = '27'"); 
    $url_amgfn = $url_amg; $i=1; 
    while($ini->num_rows($sqlurlamg) > 0){
        $url_amgfn = $url_amg.$i; $i++; 
        $sqlurlamg = $ini->consulta("select id_url_amg from url_amg_lang where url_amg_lang = '".$url_amgfn."' and seccion = '27'"); 
    } 
    $url_amg = $url_amgfn;

    $imagen = "";
    if($_FILES['archivo-foto-0']['tmp_name'] != ""){
        $subir_imagen = true;
        $carpeta = "/cervezas/";
        $dir = $carpeta;
        $arralta = explode("/",$_FILES['archivo-foto-0']['type']); 
        $ext = strtolower($arralta[1]);
        if($ext != "gif" and $ext != "jpg" and $ext != "jpeg" and $ext != "png" and $ext != "bmp" and $ext != "pjpeg" and $ext != "x-png"){
            $subir_imagen = false;
        }
        $name = $ad->cambiaralfn($_FILES['archivo-foto-0']['name'],'no'); $namec = $name; $sigue = true; $e = 1;
        while($sigue){
            $sigue = false;
            foreach(glob("../../imagen".$dir."*") as $archivos_carpeta){
                if("../../imagen".$dir.$name == $archivos_carpeta){
                    $name = $namec; 
                    $sigue = true; 
                    $name = $e.$name; 
                    $e++;
                }
            }
        }
        if($subir_imagen){
            if(!move_uploaded_file($_FILES['archivo-foto-0']['tmp_name'],"../../imagen".$dir.$name)){  
                $subir_imagen = false;
            }
        }
        if($subir_imagen){
            $imagen = $urlppal."imagen".$dir.$name;
            $titalt = $url_amg."/**/".$url_amg;
        }
    }



    $fecha = date("Y-m-d H:i:s");
    $contenido = str_replace("\r","<br>",$_POST['contenido']);

    $sql = $ini->consulta("insert into url_amg (seccion,subsecc,plantilla,fecha,thumbs,activo) values ('27','0','8','".$fecha."','".$imagen."','0')");
    $ultimoid = $ini->ultimoid();
    $sql = $ini->consulta("insert into url_amg_lang (id_url_amg,lang,url_amg,titulo,metas,contenido,titalt) values ('".$ultimoid."','1','".$url_amg."','".$titulo."','".$titulo."/**/".$titulo."/**/".$titulo."','".$contenido."','".$titalt."')");





        $marca = "";
        if($_POST['nueva_marca'] != ""){ 
            $sql = $ini->consulta("insert into cz_marca (titulo_es) value ('".$_POST['nueva_marca']."')");
            $marca = $ini->ultimoid();
        }elseif($_POST['marca'] != ""){
            $marca = $_POST['marca'];
        }

        $denominacion = $ini->real_scape($_POST['denominacion']);

        $pais = "";
        if($_POST['nueva_pais'] != ""){  
            $sql = $ini->consulta("insert into pais (pais) value ('".$_POST['nueva_pais']."')");
            $pais = $ini->ultimoid();
        }elseif($_POST['pais'] != ""){
            $pais = $_POST['pais'];
        }



        $provincia = "";
        if($_POST['nueva_provincia'] != ""){  
            $sql = $ini->consulta("insert into provincias (id_pais,provincia) value ('".$pais."',".$_POST['nueva_provincia']."')");
            $provincia = $ini->ultimoid();
        }elseif($_POST['provincia'] != ""){
            $provincia = $_POST['provincia'];
        }


        $municipio = "";
        if($_POST['nueva_municipio'] != ""){  
            $sql = $ini->consulta("insert into municipios (IdProvincia,Nombre) value ('".$provincia."',".$_POST['nueva_municipio']."')");
            $municipio = $ini->ultimoid();
        }elseif($_POST['municipio'] != ""){
            $municipio = $_POST['municipio'];
        }



        $productor = "";
        if($_POST['nueva_productor'] != ""){ 
            $sql = $ini->consulta("insert into cz_productor (titulo_es) value ('".$_POST['nueva_productor']."')");
            $productor = $ini->ultimoid();
        }elseif($_POST['productor'] != ""){
            $productor = $_POST['productor'];
        }

        $tipo = "";
        if($_POST['nueva_tipo'] != ""){ 
            $sql = $ini->consulta("insert into cz_tipo (titulo_es) value ('".$_POST['nueva_tipo']."')");
            $tipo = $ini->ultimoid();
        }elseif($_POST['tipo'] != ""){
            $tipo = $_POST['tipo'];
        }


        $capacidad = "";
        if($_POST['nueva_capacidad'] != ""){ 
            $sql = $ini->consulta("insert into cz_capacidad (titulo_es) value ('".$_POST['nueva_capacidad']."')");
            $capacidad = $ini->ultimoid();
        }elseif($_POST['capacidad'] != ""){
            $capacidad = $_POST['capacidad'];
        }


        $alcohol = $ini->real_scape($_POST['alcohol']);

        $color = "";
        if($_POST['nueva_color'] != ""){ 
            $sql = $ini->consulta("insert into cz_color (titulo_es) value ('".$_POST['nueva_color']."')");
            $color = $ini->ultimoid();
        }elseif($_POST['color'] != ""){
            $color = $_POST['color'];
        }

        $ibus = $ini->real_scape($_POST['ibus']);

        $ebc = "";
        if($_POST['nueva_ebc'] != ""){ 
            $sql = $ini->consulta("insert into cz_ebc (titulo_es) value ('".$_POST['nueva_ebc']."')");
            $ebc = $ini->ultimoid();
        }elseif($_POST['ebc'] != ""){
            $ebc = $_POST['ebc'];
        }

        $fermentacion = "";
        if($_POST['nueva_fermentacion'] != ""){ 
            $sql = $ini->consulta("insert into cz_fermentacion (titulo_es) value ('".$_POST['nueva_fermentacion']."')");
            $fermentacion = $ini->ultimoid();
        }elseif($_POST['fermentacion'] != ""){
            $fermentacion = $_POST['fermentacion'];
        }

        $consumo = $ini->real_scape($_POST['consumo']);
        $adicional = $ini->real_scape($_POST['adicional']);


        if($_POST['id_cat'] == 207){
            $sqldcat = $ini->consulta("select titulo, pais, provincia, municipio, marca from url_amg_lang inner join negocio on url_amg_lang.id_url_amg = negocio.id_negocio where id_url_amg = '".$_POST['id_negocio']."'"); $regcat = $ini->fetch_object($sqlcat);
            $marca = $regcat->marca;
            if($marca == 0){
                $sqlmarca  = $ini->consulta("insert into cz_marca ('titulo_es') value ('".$regcat->titulo."')");
                $marca = $ini->ultimoid();
                $sqlmarca = $ini->consulta("update negocio set marca = '".$marca."' where id_negocio = '".$_POST['id_negocio']."'");
            }
            $pais = $regcat->pais;
            $provincia = $regcat->provincia;
            $municipio = $regcat->municipio;
        }

        $ssql = $ini->consulta("insert into cerveza (id_cerveza,marca,denominacion,pais,provincia,municipio,productor,tipo,capacidad,alcohol,color,ibus,ebc,fermentacion,consumo,adicional,destacado) value ('".$ultimoid."','".$marca."','".$denominacion."','".$pais."','".$provincia."','".$municipio."','".$productor."','".$tipo."','".$capacidad."','".$alcohol."','".$color."','".$ibus."','".$ebc."','".$fermentacion."','".$consumo."','".$adicional."','0')");

   
        $ssql = $ini->consulta("insert into union_ngc_crvz (id_cerveza,id_negocio) value ('".$ultimoid."','".$_POST['id_negocio']."')");

        $marca = $ini->selectcampo($marca,'cz_marca','titulo_es');
        $productor = $ini->selectcampo($productor,'cz_productor','titulo_es');
        $tipo = $ini->selectcampo($tipo,'cz_tipo','titulo_es');
        $capacidad = $ini->selectcampo($capacidad,'cz_capacidad','titulo_es');
        $color = $ini->selectcampo($color,'cz_color','titulo_es');
        $ebc = $ini->selectcampo($ebc,'cz_ebc','titulo_es');
        $fermentacion = $ini->selectcampo($fermentacion,'cz_fermentacion','titulo_es');
        $pais = $ini->selectcampo($pais,'pais','pais');
        $provincia = $ini->selectcampo($provincia,'provincias','provincia');
        $municipio = $ini->busca('Nombre','municipios','Id',$municipio);




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
    $html.= "                   <p>Imagen: ".$imagen."</p>\n";
    $html.= "                   <p>URL: ".$url_amg."</p>\n";
    $html.= "                   <p>Nombre: ".$titulo."</p>\n";
    $html.= "                   <p>Marca: ".$marca."</p>\n";
    $html.= "                   <p>Denominación: ".$denominacion."</p>\n";
    $html.= "                   <p>País: ".$pais."</p>\n";
    $html.= "                   <p>Provincia: ".$provincia."</p>\n";
    $html.= "                   <p>Municipio: ".$municipio."</p>\n";
    $html.= "                   <p>Productor: ".$productor."</p>\n";
    $html.= "                   <p>Tipo: ".$tipo."</p>\n";
    $html.= "                   <p>Capacidad: ".$capacidad."</p>\n";
    $html.= "                   <p>Alcohol: ".$alcohol."</p>\n";
    $html.= "                   <p>Color: ".$color."</p>\n";
    $html.= "                   <p>IBUS: ".$ibus."</p>\n";
    $html.= "                   <p>EBC: ".$ebc."</p>\n";
    $html.= "                   <p>Fermentación: ".$fermentacion."</p>\n";
    $html.= "                   <p>Consumo: ".$consumo."</p>\n";
    $html.= "                   <p>Contenido:</p>\n";    
    $html.= "                   <p>".$contenido."</p>\n";
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


}else{

 $sqlunion = $ini->consulta("insert into union_ngc_crvz (id_negocio,id_cerveza) value ('".$_POST['id_negocio']."','".$_POST['cerveza_existente']."')");

 $html = "Activar vinculación";   
    
}


      $mail = new PHPMailer(true);
      try{
        $mail->SMTPDebug = 2; 
        $mail->CharSet =  "utf-8";
       // $mail->IsSMTP(); 
        $mail->Host = "smtp.ionos.es";
        $mail->Username = "soporte@bazinga-studio.com";
        $mail->Password = "r2d2lasiestaesbuenaDPS"; 
        //$mail->SMTPSecure = 'tls';
        //$mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->setFrom("soporte@bazinga-studio.com","Cervezas Málaga");
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Nueva cerveza";
        $mail->Body = $html;
       // $mail->addAttachment($filenamed);
        //$mail->AddEmbeddedImage('utiles/imagenes/pdf/merry_mail_y_pdf.png','cid1');
       // $mail->AddEmbeddedImage("utiles/qr_img/".basename($filename),'cid2');
        $mail->send();
      } catch(Exception $e){
        echo 'Error. Mensaje de PHPMailer: ', $mail->ErrorInfo; exit();
      }

      $mail = new PHPMailer(true);
      try{
        $mail->SMTPDebug = 2; 
        $mail->CharSet =  "utf-8";
       // $mail->IsSMTP(); 
        $mail->Host = "smtp.ionos.es";
        $mail->Username = "soporte@bazinga-studio.com";
        $mail->Password = "r2d2lasiestaesbuenaDPS"; 
        //$mail->SMTPSecure = 'tls';
        //$mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->setFrom("soporte@bazinga-studio.com","Cervezas Málaga");
        $mail->addAddress($email2);
        $mail->isHTML(true);
        $mail->Subject = "Nueva cerveza";
        $mail->Body = $html;
       // $mail->addAttachment($filenamed);
        //$mail->AddEmbeddedImage('utiles/imagenes/pdf/merry_mail_y_pdf.png','cid1');
       // $mail->AddEmbeddedImage("utiles/qr_img/".basename($filename),'cid2');
        $mail->send();
      } catch(Exception $e){
        echo 'Error. Mensaje de PHPMailer: ', $mail->ErrorInfo; exit();
      }

?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Espera nuestra respuesta </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Registro de cerveza realizada con éxito, nos pondremos en contacto lo antes posible si es necesario, activaremos la cerveza lo antes posible para que se vea en la web. Gracias por contactar con nosotros.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>