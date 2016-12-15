<?php

  class BaseController{

    public static function get_user_logged_in(){
        if(isset($_SESSION['user'])){
      $user_id = $_SESSION['user'];
      $user = Usraccount::getName($user_id);
      return $user;
    }
    return null;
    }

    public static function check_logged_in(){
      if(!(isset($_SESSION['user']))){
           View::make('loginpage.html');
      }
    }
    
    public static function isStringValid($string){
      if(preg_match("/^[a-zA-ZäöåÄÖÅ 0-9]+$/i",$string)){
        return true;
      }
      return false;
    }
    
    public static function isStringValidEx($string,$maxlen){
      if(self::isStringValid($string) && strlen($string)<$maxlen){
        return true;
      }
      return false;
    }
    
        public static function isStringNumbers($string,$maxlen){
      if(preg_match("/^[0-9]+$/",$string) && strlen($string)<intval($maxlen)){
        return true;
      }
      return false;
    }
 

  }
