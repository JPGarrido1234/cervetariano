<?php

class inicio extends MySQL {

		public function prepCabs(){
			$this->id_url_amg = false;
			if(!$_GET){
				$this->id_url_amg = 1;   // home
				$this->lang = 1;		//  español
			}
			
				if(isset($_GET['zona']) and !isset($_GET['zonau'])){  // un solo parametro
					$sql = $this->consulta("select id, lang from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and url_amg = '".$_GET['zona']."' and activo = '1'"); 
					if($this->num_rows($sql) == 1){ 
						$reg = $this->fetch_object($sql);
						$this->id_url_amg = $reg->id;
						$this->lang = $reg->lang;
					}
				}
			
				if(isset($_GET['zonau']) and !isset($_GET['zonad'])){  // dos parametros
					$sql = $this->consulta("select id, lang from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and url_amg = '".$_GET['zona']."' and activo = '1'");
					if($this->num_rows($sql) == 1){
						$reg = $this->fetch_object($sql);
						$idsecc = $reg->id;
						$this->lang = $reg->lang;
						$sql = $this->consulta("select id from url_amg inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id where seccion = '".$idsecc."' and subsecc = '0' and url_amg = '".$_GET['zonau']."' and lang = '".$this->lang."' and activo = '1'");
						if($this->num_rows($sql) == 1){
							$reg = $this->fetch_object($sql);
							$this->id_url_amg = $reg->id;
						}else{
							$sql = $this->consulta("select id from url_amg inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id inner join categoria on url_amg.id = categoria.tipo inner join cat_lang on categoria.id = cat_lang.id_categoria where tipo = '".$idsecc."' and categoria_amg = '".$_GET['zonau']."' and cat_lang.lang = '".$this->lang."' and activo = '1'"); 
							if($this->num_rows($sql) == 1){
								$reg = $this->fetch_object($sql);
								$this->id_url_amg = $reg->amg;
							}
						}
					}
				}
				
				if(isset($_GET['zonad']) and !isset($_GET['zonat'])){  // tres parametros
					$sql = $this->consulta("select id, lang from url_amg_lang inner join url_amg on url_amg_lang.id_url_amg = url_amg.id where seccion = '0' and url_amg = '".$_GET['zona']."' and activo = '1'"); // 'zona-bandas' o 'publico'
					if($this->num_rows($sql) == 1){
						$reg = $this->fetch_object($sql);
						$idsecc = $reg->id;
						$this->lang = $reg->lang;
						$sql = $this->consulta("select id from url_amg inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id where seccion = '".$idsecc."' and subsecc = '0' and url_amg = '".$_GET['zonau']."' and lang = '".$this->lang."' and activo = '1'");
						if($this->num_rows($sql) == 1){
							$reg = $this->fetch_object($sql);
							$idsubsecc = $reg->id;
							
							$sql = $this->consulta("select id from url_amg inner join url_amg_lang on url_amg_lang.id_url_amg = url_amg.id where seccion = '".$idsecc."' and subsecc = '".$idsubsecc."' and url_amg = '".$_GET['zonau']."' and lang = '".$this->lang."' and activo = '1'");
							if($this->num_rows($sql) == 1){
								$reg = $this->fetch_object($sql);
								$this->id_url_amg = $reg->id;
							}
							
						}
					}
				}
			
			if(!$this->id_url_amg){ // 404
				$this->id_url_amg = 2;
			}
			
			$sql = $this->consulta("select * from url_amg inner join url_amg_lang on url_amg.id = url_amg_lang.id_url_amg where id = '".$this->id_url_amg."' and lang = '".$this->lang."'");
			$reg = $this->fetch_object($sql);
			
			$arrmetas = explode("/**/",$reg->metas);
			
			$this->metatit = $arrmetas[0];
			$this->metades = $arrmetas[1];
			$this->metakey = $arrmetas[2];
			$this->seccion = $reg->seccion;
			$this->subsecc = $reg->subsecc;	
			$this->contenido = $reg->contenido;
			$this->thumbs = $reg->thumbs;
			$this->titulo = $reg->titulo;
			$sql = $this->consulta("select archivo from archivo where id = '".$reg->plantilla."'");
			$reg = $this->fetch_object($sql);
			$this->archivo = $reg->archivo;
			$this->siglas = $this->selectcampo($this->lang,'lang','siglas');
            setcookie('language', $this->lang, time()+86400, '/');
			setcookie('language_sigla', $this->siglas, time()+86400, '/');

			return true;
		} // fin prepcabs



	public function lang(){
		if(!isset($_COOKIE['language']) and !isset($_COOKIE['language_sigla'])){
            setcookie('language', 1, time()+86400, '/');
			setcookie('language_sigla', 'es-es', time()+86400, '/');
		}

		return $_COOKIE['language'];
	}

  public function aleatorio(){
    $date = microtime();
    $ale = substr(md5($date), 15);
    return $ale;
  }

  public function encriptar($string, $key) {
     $result = '';
     for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
     }
     return base64_encode($result);
  }

  public function desencriptar($string, $key) {
     $result = '';
     $string = base64_decode($string);
     for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
     }
     return $result; 
  }

}
?>