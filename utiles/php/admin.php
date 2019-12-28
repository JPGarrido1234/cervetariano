<?php class admin extends MySQL {
public function classmsj($msj){ if(strlen($msj) == 5){ return 'alert-danger'; }else{ if(substr($msj,0,1) == '1'){ return 'alert-danger'; }else{ return 'alert-success'; } } }
public function htmlop($msj){ $arr_arch = array(1=>"usuario",2=>"imagen",3=>"menu",4=>"partes",5=>"blogs",6=>"tienda",7=>"cerveza",8=>"negocio",9=>"categoria",10=>"localidades",11=>"servicios",12=>"usuarios",13=>"pruebas",14=>"paginas",15=>"eventos"); return $arr_arch[$msj]; }
public function htmlopb($msj){ if($msj == "ppal"){ return "Menu principal"; }else{ $arr_arch = array(1=>"Usuarios",2=>"Imágenes",3=>"Menú",4=>"Opciones",5=>"Blog",6=>"Tienda",7=>"Cervezas",8=>"Establecimientos",9=>"Categoría",10=>"Localidades",11=>"Servicios",12=>"Usuarios",13=>"Pruebas",14=>"Páginas",15=>"Eventos"); return $arr_arch[$msj]; } }
public function menuop($op){ $arr_arch = array(1=>'Cabecera'); }
public function msjusu($msj){
$arr_error = array('01'=>"<strong>¡Error!</strong> Cambios no modificados",'02'=>"Error de imagen, las extensiones permitidas son: jpg, jpeg, png, gif y bmp",'03'=>"imagen demasiado ancha");
$arr_bien = array('01'=>"<strong>¡Bien hecho!</strong> Cambios modificados",'02'=>"CAMBIOS MODIFICADOS",'03'=>'URL BORRADA','04'=>"URL NUEVA");
$arr_grave = array('91'=>"ERROR GRAVE, Contacte con el proveedore de pagina web. error 10991.",'92'=>"ERROR GRAVE, Contacte con el proveedore de pagina web. error 10992.");
if(strlen($msj) == 5){ $error = $arr_grave[substr($msj,3,2)]; }else{ if(substr($msj,0,1) == '1'){ $error = $arr_error[substr($msj,2,2)]; }else{ $error = $arr_bien[substr($msj,2,2)]; } }
return $error; }

public function quitarprep($url){
$prep = array("-a-","-ante-","-cabe-","-con-","-contra-","-de-","-desde-","-hasta-","-para-","-por-","-junto-","-en-","-pesar-","-al-","-tras-","-sobre-","-so-","-sin-","-y-","-que-");
$url = str_replace($prep,"-",$url); return $url; }

public function cambiaralfn($dato,$punto="si"){ 
$dato = htmlentities(strtolower($dato),ENT_QUOTES,"UTF-8");
$find = array("&quot;","&amp;","&lt;","&gt;","&euro;","&nbsp;","&acute;","&AElig;","&aelig;","&brvbar;","&cedil;","&cent;","&circ;","&copy;","&curren;","&deg;","&divide;","&ETH;","&eth;","&fnof;","&frac12;","&frac14;","&frac34;","&iquest;","&laquo;","&macr;","&micro;","&middot;","&not;","&OElig;","&oelig;","&ordm;","&Oslash;","&oslash;","&para;","&plusmn;","&pound;","&raquo;","&reg;","&Scaron;","&scaron;","&sect;","&shy;","&sup1;","&sup2;","&sup3;","&szlig;","&THORN;","&thorn;","&tilde;","&times;","&uml;","&ndash;","&mdash;","&lsquo;","&rsquo;","&sbquo;","&ldquo;","&rdquo;","&bdquo;","&lsaquo;","&rsaquo;","&dagger;","&Dagger;","&permil;","&bull;","&hellip;","&Prime;","&prime;","&oline;","&frasl;","&weierp;","&image;","&real;","&trade;","&alefsym;","&larr;","&uarr;","&rarr;","&darr;","&harr;","&crarr;","&lArr;","&uArr;","&rArr;","&dArr;","&hArr;","&forall;","&part;","&exist;","&empty;","&nabla;","&isin;","&notin;","&ni;","&prod;","&sum;","&minus;","&lowast;","&radic;","&prop;","&infin;","&ang;","&and;","&or;","&cap;","&cup;","&int;","&there4;","&sim;","&cong;","&asymp;","&ne;","&equiv;","&le;","&ge;","&sub;","&sup;","&nsub;","&sube;","&supe;","&oplus;","&otimes;","&perp;","&hArr;","&sdot;","&lceil;","&rceil;","&lfloor;","&rfloor;","&lang;","&rang;","&loz;","&spades;","&clubs;","&hearts;","&diams;","&alpha;","&Beta;","&beta;","&Gamma;","&gamma;","&Delta;","&delta;","&Epsilon;","&epsilon;","&Zeta;","&zeta;","&Eta;","&eth;","&Theta;","&theta;","&thetasym;","&Iota;","&iota;","&Kappa;","&kappa;","&Lambda;","&lambda;","&Mu;","&mu;","&Nu;","&nu;","&Xi;","&xi;","&Omicron;","&omicron;","&Pi;","&pi;","&piv;","&Rho;","&rho;","&Sigma;","&sigma;","&sigmaf;","&Tau;","&tau;","&Upsilon;","&upsilon;","&upsih;","&Phi;","&phi;","&Chi;","&chi;","&Psi;","&psi;","&Omega;","&omega;","&ome","&iexcl;"); 
$dato = str_replace("&ntilde","n",$dato);
$dato = str_replace($find,"",$dato); $dato = str_replace (array("&aacute;","&agrave;","&acirc;","&atilde;","&auml;"), "a", $dato);
$dato = str_replace (array("&eacute;","&egrave;","&ecirc;","&etilde;","&euml;"), "e", $dato); $dato = str_replace (array("&iacute;","&igrave;","&icirc;","&itilde;","&iuml;"), "i", $dato);
$dato = str_replace (array("&oacute;","&ograve;","&ocirc;","&otilde;","&ouml;"), "o", $dato); $dato = str_replace (array("&uacute;","&ugrave;","&ucirc;","&utilde;","&uuml;"), "u", $dato);
$dato = str_replace (array("&Aacute;","&Agrave;","&Acirc;","&Atilde;","&Auml;"), "A", $dato); $dato = str_replace (array("&Eacute;","&Egrave;","&Ecirc;","&Etilde;","&Euml;"), "E", $dato);
$dato = str_replace (array("&Iacute;","&Igrave;","&Icirc;","&Itilde;","&Iuml;"), "I", $dato); $dato = str_replace (array("&Oacute;","&Ograve;","&Ocirc;","&Otilde;","&Ouml;"), "O", $dato); 
$dato = str_replace (array("&Uacute;","&Ugrave;","&Ucirc;","&Utilde;","&Uuml;"), "U", $dato);	
$find = array('^','´','`','¨','~','!','"','#','$','%','&','\'','(',')','*','+',',','/',':',';','=','?','@','[','\\',']','^','{','|','}','¡','¢','£','¤','¥','§','©','«','¬','®','¯','°','±','µ','¶','·','¸','»','¿','Æ','Ø','ß','æ','÷','ø'); $repl = ""; $dato = str_replace($find, $repl, $dato); $dato = str_replace(" ", "-", $dato);
if($punto == "si"){ $dato = str_replace(".", "", $dato); } return $dato; } } ?>