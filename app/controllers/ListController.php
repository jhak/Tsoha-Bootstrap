<?php

require 'app/models/Drink.php';
require 'app/models/Ingredient.php';
require 'app/models/Usraccount.php';
require 'app/models/Preparation.php';
require 'app/models/Followed.php';

class ListController extends BaseController{
  // pääsivun listaus - Muuttujat: srchh - hakusana palautteen filtteröintiä varten.
  public static function drinklist($srchh){
    self::check_logged_in();
    $srch = $srchh;
    $drinks = Drink::all();
    $ingredients = Ingredient::all();
    $Usraccounts = Usraccount::fetchNames();
    $Followeds = Followed::allForId($_SESSION['user']);
    $curusr = Usraccount::getName($_SESSION['user']);
    View::make('drinkkilistaus.html', array('drinks' => $drinks, 'ingredients' => $ingredients, 'Usraccounts' => $Usraccounts, 'srch' => $srch,'curusr'=> $curusr,'followeds'=>$Followeds));
  }
  //suosikkejen listaus - Muuttujat: srchh - hakusana palautteen filtteröintiä varten.
    public static function drinklistFav($srchh){
    self::check_logged_in();
    $srch = $srchh;
    $drinks = Drink::all();
    $ingredients = Ingredient::all();
    $Usraccounts = Usraccount::fetchNames();
    $Followeds = Followed::allForId($_SESSION['user']);
    $curusr = Usraccount::getName($_SESSION['user']);
    View::make('suosikit.html', array('drinks' => $drinks, 'ingredients' => $ingredients, 'Usraccounts' => $Usraccounts, 'srch' => $srch,'curusr'=> $curusr,'followeds'=>$Followeds));
  }
  //kirjautumisnäkymä
    public static function logonPage(){
    
    if(isset($_SESSION['user'])){
      Redirect::to('/drinkkilistaus');
    }
    
    View::make('loginpage.html');
  }
  
    //uloskirjautuminen
    public static function logout(){
    self::check_logged_in();
    $_SESSION['user'] = null;
    Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
  }
  
  //kirjautumisen prosessointi.
   public static function performLogin(){
    
    $params = $_POST;
    $user=NULL;
     if(self::isStringValidEx($params['usrn'],'50') && self::isStringValidEx($params['usrn'],'50')){
    $user = Usraccount::auth($params['usrn'], $params['pwd']);
     }
    if($user === NULL){
      View::make('loginpage.html', array('message' => 'Virhe: Väärä käyttäjätunnus tai salasana tai uusi tunnus sisältää kiellettyjä merkkejä'));
    }else{
      $_SESSION['user'] = $user->usr_id;

      Redirect::to('/drinkkilistaus', array('message' => ''));
    }
  }
  }