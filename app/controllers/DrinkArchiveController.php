<?php
 
require 'app/models/Drink.php';
require 'app/models/Ingredient.php';
require 'app/models/Usraccount.php';
require 'app/models/Preparation.php';
require 'app/models/Followed.php';
class DrinkArchiveController extends BaseController{
  
// tarkastelu - Muuttujat: drink_id - haluttavan drinkin ID
  public static function fetchDetails($drink_id){
    self::check_logged_in();
    $drink = Drink::find($drink_id);
    $ingredients = Ingredient::findAllFor($drink_id);
    $preparation = Preparation::find($drink_id);
    $Usraccount = Usraccount::getName($drink -> usr_id);
    $Followed = Followed::isFollowed($_SESSION['user'],$drink_id);
    View::make('tarkastelu.html', array('drink' => $drink, 'ingredients' => $ingredients, 'Usraccount' => $Usraccount,'Preparation'=>$preparation,'followed'=>$Followed));  
  }
//tiedot muokkausnäkymään - Muuttujat: drink_id - haluttavan drinkin ID
    public static function fetchDetailsMod($drink_id){
    self::check_logged_in();
    
    $drink = Drink::find($drink_id);
    if($drink->usr_id != $_SESSION['user']){ Redirect::to('/drinkkilistaus'); }
    $preparation = Preparation::find($drink_id);
    $ingredients = Ingredient::findAllFor($drink_id);

    $Usraccount = Usraccount::getName($drink -> usr_id);
    View::make('muokkaus.html', array('drink' => $drink, 'ingredients' => $ingredients, 'Usraccount' => $Usraccount, 'Preparation'=>$preparation));
  }
 //ehdotuksen rekisteröinti 
  public static function suggestion2(){
     self::check_logged_in();  
    $params = $_POST;
    $msg='';
    if(self::isStringValidEx($params['drink_name'],50)){
    $drink = new Drink(array('name'=> $params['drink_name']
                             ));
    $drink->add();
    } else {
      $msg='Virhe: Drinkin nimi ei ole kelvollinen';
    }
    if(isset($params['prep_text']) && $msg===''){
       if(self::isStringValidEx($params['prep_text'],200)){
    $prep = new Preparation(array('drink_id'=> $drink->drink_id, 'prep_text' =>$params['prep_text']));
    $prep->add();
       } else {
        $msg='Virhe: Valmistusohje ei ole kelvollinen';
       }
    }
    if(isset($params['ingrd_name1']) && $params['ingrd_name1'] != '' && $msg===''){
          $msg='';
    if(self::isStringNumbers($params['amount1'],9999)){
      if($params['amount_type1'] === "kpl" or $params['amount_type1'] === "cl" or $params['amount_type1'] === "dl" or
         $params['amount_type1'] === "tl" or $params['amount_type1'] === "rl" or $params['amount_type1'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name1'],50)){
              $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name1'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount1'],
      'amount_type' => $params['amount_type1']
    ));
     $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
      
    }
        if(isset($params['ingrd_name2']) && $params['ingrd_name2'] != '' && $msg===''){
          $msg='';
    if(self::isStringNumbers($params['amount2'],9999)){
      if($params['amount_type2'] === "kpl" or $params['amount_type2'] === "cl" or $params['amount_type2'] === "dl" or
         $params['amount_type2'] === "tl" or $params['amount_type2'] === "rl" or $params['amount_type2'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name2'],50)){
              $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name2'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount2'],
      'amount_type' => $params['amount_type2']
    ));
     $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
      
    }
       if(isset($params['ingrd_name3']) && $params['ingrd_name3'] != '' && $msg===''){
          $msg='';
    if(self::isStringNumbers($params['amount3'],9999)){
      if($params['amount_type3'] === "kpl" or $params['amount_type3'] === "cl" or $params['amount_type3'] === "dl" or
         $params['amount_type3'] === "tl" or $params['amount_type3'] === "rl" or $params['amount_type3'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name3'],50)){
              $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name3'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount3'],
      'amount_type' => $params['amount_type3']
    ));
     $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
      
    }
     if(isset($params['ingrd_name4']) && $params['ingrd_name4'] != '' && $msg===''){
          $msg='';
    if(self::isStringNumbers($params['amount4'],9999)){
      if($params['amount_type4'] === "kpl" or $params['amount_type4'] === "cl" or $params['amount_type4'] === "dl" or
         $params['amount_type4'] === "tl" or $params['amount_type4'] === "rl" or $params['amount_type4'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name4'],50)){
              $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name4'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount4'],
      'amount_type' => $params['amount_type4']
    ));
     $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
      
    }
        if(isset($params['ingrd_name5']) && $params['ingrd_name5'] != '' && $msg===''){
          $msg='';
    if(self::isStringNumbers($params['amount5'],9999)){
      if($params['amount_type5'] === "kpl" or $params['amount_type5'] === "cl" or $params['amount_type5'] === "dl" or
         $params['amount_type5'] === "tl" or $params['amount_type5'] === "rl" or $params['amount_type5'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name5'],50)){
              $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name5'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount5'],
      'amount_type' => $params['amount_type5']
    ));
     $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
      
    }
    
   
      if($msg===''){
    Redirect::to('/drinkkilistaus',array('message'=>$msg));
      } else {
        Redirect::to('/ehdotus',array('message'=>$msg));
      }

  }
  
  //ehdotuksen näkymä
    public static function suggestion(){
       self::check_logged_in();
        View::make('ehdotus.html');
  }
// ainesosan poisto  
  public static function delIngrd(){
    self::check_logged_in();
    $params = $_POST;
    
    Ingredient::delete($params['ingrd_id']);

    Redirect::to('/muokkaus/' . $params['drink_id']);
  }
  // suosikin lisäys
    public static function addFav(){
    self::check_logged_in();
    $params = $_POST;
    $followed = new Followed(array(
          'follower_id' => $_SESSION['user'],
          'followed_id' => $params['drink_id']
          ));
    $followed->add();

    Redirect::to('/tarkastelu/' . $params['drink_id']);
  }
  // suosikin poisto
  public static function delFav(){
    self::check_logged_in();
    $params = $_POST;
    Followed::delete($_SESSION['user'],$params['drink_id']);

    Redirect::to('/tarkastelu/' . $params['drink_id']);
  }
  
  
  // ainesosan lisäys
  public static function addNewIngrd(){
    self::check_logged_in();
    $params = $_POST;
    $msg='';
    if(self::isStringNumbers($params['amount'],9999)){
      if($params['amount_type'] === "kpl" or $params['amount_type'] === "cl" or $params['amount_type'] === "dl" or
         $params['amount_type'] === "tl" or $params['amount_type'] === "rl" or $params['amount_type'] === "ml"){
        if(self::isStringValidEx($params['ingrd_name'],50)){
          $ingredient = new Ingredient(array(
          'ingrd_name' => $params['ingrd_name'],
          'drink_id' => $params['drink_id'],
          'amount' => $params['amount'],
          'amount_type' => $params['amount_type']
          ));
          $ingredient->add();
        } else {
        $msg='Virhe: Ainesosan nimi ei ole kelvollinen';
        }
      } else {
        $msg='Virhe: Määrän tyyppi ei ole kelvollinen';
      }
    } else {
        $msg='Virhe: Määrä ei ole kelvollinen';
    }
    Redirect::to('/muokkaus/' . $ingredient->drink_id ,array('message'=>$msg));
  }
  // valmistusohjeen asettaminen
  public static function setPrepText(){
    self::check_logged_in();
    $msg ='';
    $params = $_POST;
    if(self::isStringValidEx($params['prep_text'],200)){
    Preparation::updateText($params['drink_id'],$params['prep_text']);
    } else {
      $msg='Virhe: Ohje on liian pitkä tai se sisältää kiellettyjä merkkejä, Sallitut merkit: Aakkoset ja numerot';
    }
    Redirect::to('/muokkaus/' . $params['drink_id'], array('message'=>$msg));
  }
  //drinkin nimen muuttaminen
    public static function updateDrinkName(){
      self::check_logged_in();
    $params = $_POST;
    $msg='';
    if(self::isStringValidEx($params['drink_name'],'50')){
    Drink::updateName($params['drink_id'],$params['drink_name']);
    } else {
      $msg='Virhe: Drinkin nimi ei ole kelvollinen, sallitut merkit: Aakkoset ja numerot';
    }
    Redirect::to('/muokkaus/' . $params['drink_id'],array('message'=>$msg));
  }


  //käyttäjän poisto - Muuttujat: id - poistettavan käyttäjän ID
  public static function delUsr($id){
      self::check_logged_in();
      Usraccount::delete($id);
      Redirect::to('/hallinta');
  }
  // drinkkiehdotuksen hyväksyntä - Muuttujat: id - hyväksyttävän drinkin ID
   public static function approve($id){
    self::check_logged_in();
      Drink::approve($id);
      Redirect::to('/hallinta');
  }
  // drinkin poisto - Muuttujat: id - poistettavan drinkin ID
     public static function delDrink($id){
      self::check_logged_in();
      Drink::delete($id);
      Redirect::to('/hallinta');
  }
  // hallinta näkymä ylläpitäjälle - Muuttujat: srchh - hakusana palautteen filtteröintiä varten
  public static function hallinta($srchh){
    self::check_logged_in();
    
    $srch = $srchh;
    $drinks = Drink::all();
    $ingredients = Ingredient::all();
    $Usraccounts = Usraccount::fetchNames();
    $curusr = Usraccount::getName($_SESSION['user']);

    
    $usr=Usraccount::getName($_SESSION['user']);
    if($usr->isadm ===1){
        View::make('hallinta.html', array('drinks' => $drinks, 'ingredients' => $ingredients, 'Usraccounts' => $Usraccounts, 'srch' => $srch,'curusr'=> $curusr));
    }else{
      Redirect::to('/drinkkilistaus');
    }
    
  }
 
  
}