<?php
class Language extends MySQL {
    private static $instance;
    private  $tags = array();
    public static function getInstance() {  if (self::$instance === null) {  self::$instance = new self();  }  return self::$instance;   }
    public function __construct() { if(isset($_COOKIE['language_sigla'])){ $idioma = $_COOKIE['language_sigla']; }else{ $idioma = "es-es"; }
	    $this->tags = include($_SERVER['DOCUMENT_ROOT']."/cervetariano/utiles/lang/".$idioma.".php");
    }
    public function __destruct() { $this->tags = array();    }
    public function __get($tag)  { return $this->tags[$tag]; } 
}
?>