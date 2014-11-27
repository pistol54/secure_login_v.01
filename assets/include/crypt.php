<?php
/*
 *-----------------------------COOKIE ENCRYPT AND DECRYPT
 *
 *Author| Edgar Zakaryan
 *Email| zakaryan.edgar@gmail.com
 */
class cookie{
    var $cookie_key;
    var $cookie_value;
	var $cookie_name;
	var $cookie_expire;
	var $cookie_path;
	var $cookie_domain;
	var $cookie_secure;
	
    var $encrypt_cookie="";
    var $decrypt_cookie="";
    
	function cookie() {
		return ;
	}
	
    function params($cookie_key,$cookie_name,$cookie_value,$cookie_expire='',$cookie_path='/',$cookie_domain='',$cookie_secure=0){
        $this->cookie_key=$cookie_key;    
		$this->cookie_name=$cookie_name;   
        $this->cookie_value=$cookie_value;
		if($cookie_expire["month"]==0 && $cookie_expire["day"]==0 && $cookie_expire["year"]==0){
			$this->cookie_expire=0;
		}else{
			$this->cookie_expire=mktime(date("h")+$cookie_expire["hour"], date("i")+$cookie_expire["minute"], date("s")+$cookie_expire["second"], date("m")+$cookie_expire["month"], date("d")+$cookie_expire["day"], date("Y")+$cookie_expire["year"]);
		}
		
		$this->cookie_path=$cookie_path;
		$this->cookie_path=$cookie_path;
		$this->cookie_domain=$cookie_domain;
		$this->cookie_secure=$cookie_secure;
    }
    
    function cookie_encrypt(){
        $valuecrypt = bin2hex($this->cookie_value) ;
        for($i=0; $i<=strlen($valuecrypt)-1; $i++){
            $this->encrypt_cookie.=intval(ord($valuecrypt[$i])*$this->cookie_key)."|";             
        }    
		setcookie($this->cookie_name,$this->encrypt_cookie, $this->cookie_expire,$this->cookie_path,$this->cookie_domain,$this->cookie_secure);
        return $_COOKIE[$this->cookie_name];
    }
    
    function cookie_decrypt($cookie,$key){
        foreach(explode("|",$cookie) as $val){
            $this->decrypt_cookie.=strval(chr($val/$key));
        }
        $this->decrypt_cookie=@pack("H*",$this->decrypt_cookie);
        return $this->decrypt_cookie;
    }
}
?>