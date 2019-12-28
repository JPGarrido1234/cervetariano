<?php 
class MySQL{
  private $conexion;
  public $conectado = false;
  public $id_conectado;

  public $connectNeg = false;
  public $idConnectNeg;

  function __construct(){ 
    if(!isset($this->conexion)){
      $this->conexion = mysqli_connect($GLOBALS['serverdb'],$GLOBALS['admindb'],$GLOBALS['passwddb'],$GLOBALS['tabladb']);
    }
    mysqli_query($this->conexion,"SET NAMES 'utf8'");
    
    if(isset($_SESSION['user-web-'.$GLOBALS['userzft']]) or isset($_COOKIE['user-web-'.$GLOBALS['userzft']])){
      $this->conectado = true;
      $this->id_conectado = $_SESSION['user-web-'.$GLOBALS['userzft']] ? $_SESSION['user-web-'.$GLOBALS['userzft']] : $_COOKIE['user-web-'.$GLOBALS['userzft']];
    }

    //Negocio
    if(isset($_SESSION['user-web-'.$GLOBALS['userzb']]) or isset($_COOKIE['user-web-'.$GLOBALS['userzb']])){
      $this->connectNeg = true;
      $this->idConnectNeg = $_SESSION['user-web-'.$GLOBALS['userzb']] ? $_SESSION['user-web-'.$GLOBALS['userzb']] : $_COOKIE['user-web-'.$GLOBALS['userzb']];
    }
  }
  public function consulta($consulta){ 
    return mysqli_query($this->conexion,$consulta);
  }
  public function fetch_object($consulta){
   return mysqli_fetch_object($consulta);
  }
  public function num_rows($consulta){
   return mysqli_num_rows($consulta);
  }
  public function ultimoid(){
    return mysqli_insert_id($this->conexion);
  }
  public function real_scape($cadena){
    return mysqli_real_escape_string($this->conexion,$cadena);
  }
  public function selectcampo($id,$tabla,$campo){
    $sql = $this->consulta("select ".$campo." as value from ".$tabla." where id = '".$id."' ");
    $reg = $this->fetch_object($sql);
    return $reg->value;
  }

  public function busca($paret,$tabla,$whereu,$conu,$whered='',$cond=''){
    if($whered == ''){
      $sql = $this->consulta("select ".$paret." as paret from ".$tabla." where ".$whereu." = '".$conu."' limit 1");
    }else{
      $sql = $this->consulta("select ".$paret." as paret from ".$tabla." where ".$whereu." = '".$conu."' and ".$whered." = '".$cond."' limit 1"); 
    }
    if($this->num_rows($sql) == 1){
      $reg = $this->fetch_object($sql);
      return $reg->paret; 
    }else{
      return false;
    }
  }



}

?>