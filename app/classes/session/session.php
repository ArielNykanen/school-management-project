<?php

class Session {

  public static function add($name, $value){
  
    if($name != '' && !empty($name) && $value != '' && !empty($value)) {
      return $_SESSION[$name] = $value;
    }

    throw new \Exception('Ma,e Amd Va;ie Reqiored');
    
  }

  public static function get($name){
    
    return $_SESSION[$name];
    
  }

  public static function has($name){
  
    if($name != '' && !empty($name)) {
      return (isset($_SESSION[$name])) ? true : false;
    }
    
    throw new \Exception("name is required");

  }

   public static function remove($name) {
  
    if(self::has($name)) {
      unset($_SESSION[$name]);
    }
    
  }

}

?>