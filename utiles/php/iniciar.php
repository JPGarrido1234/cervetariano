<?php 
//4708421eb75f4104e70392034698e81f
include("config.php");
include("mysql.php");
include("inicio.php");
$ini = new inicio(); 
$lang = $ini->lang();
$ppal = $ini->prepCabs();
include("lenguaje.php");
$language = Language::getInstance();

?>