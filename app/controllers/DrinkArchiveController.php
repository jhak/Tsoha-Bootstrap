<?php

require 'app/models/Drink.php';
require 'app/models/Ingredient.php';
require 'app/models/Usraccount.php';
class DrinkArchiveController extends BaseController{
  // ...
  public static function drinklist($srchh){
    $srch = $srchh;
    $drinks = Drink::all();
    $ingredients = Ingredient::all();
    $Usraccounts = Usraccount::fetchNames();
    View::make('drinkkilistaus.html', array('drinks' => $drinks, 'ingredients' => $ingredients, 'Usraccounts' => $Usraccounts, 'srch' => $srch));
  }

  public static function fetchDetails($drink_id){
    $drink = Drink::find($drink_id);
    $ingredients = Ingredient::findAllFor($drink_id);

    $Usraccount = Usraccount::getName($drink -> usr_id);
    View::make('tarkastelu.html', array('drink' => $drink, 'ingredients' => $ingredients, 'Usraccount' => $Usraccount));
  }

    public static function fetchDetailsMod($drink_id){
    $drink = Drink::find($drink_id);
    $ingredients = Ingredient::findAllFor($drink_id);

    $Usraccount = Usraccount::getName($drink -> usr_id);
    View::make('muokkaus.html', array('drink' => $drink, 'ingredients' => $ingredients, 'Usraccount' => $Usraccount));
  }
  
  public static function suggestion2(){
       
    $params = $_POST;
    $drink = new Drink(array('name'=> $params['drink_name']
                             ));
    $drink->add();
    
    if(isset($params['ingrd_name1']) && $params['ingrd_name1'] != ''){
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name1'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount1'],
      'amount_type' => $params['amount_type1']
    ));
     $ingredient->add();
    }
        if(isset($params['ingrd_name2']) && $params['ingrd_name2'] != ''){
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name2'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount2'],
      'amount_type' => $params['amount_type2']
    ));
     $ingredient->add();
    }
        if(isset($params['ingrd_name3']) && $params['ingrd_name3'] != ''){
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name3'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount3'],
      'amount_type' => $params['amount_type3']
    ));
     $ingredient->add();
    }
        if(isset($params['ingrd_name4']) && $params['ingrd_name4'] != ''){
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name4'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount4'],
      'amount_type' => $params['amount_type4']
    ));
     $ingredient->add();
    }
        if(isset($params['ingrd_name5']) && $params['ingrd_name5'] != ''){
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name5'],
      'drink_id' => $drink->drink_id,
      'amount' => $params['amount5'],
      'amount_type' => $params['amount_type5']
    ));
     $ingredient->add();
    }
    
   

    Redirect::to('/drinkkilistaus');

  }
  
  
    public static function suggestion(){
       
        View::make('ehdotus.html');
  }
  
  public static function delIngrd(){
    $params = $_POST;
    
    Ingredient::delete($params['ingrd_id']);

    Redirect::to('/muokkaus/' . $params['drink_id']);
  }
  
  
  
  public static function addNewIngrd(){
    $params = $_POST;
    
    $ingredient = new Ingredient(array(
      'ingrd_name' => $params['ingrd_name'],
      'drink_id' => $params['drink_id'],
      'amount' => $params['amount'],
      'amount_type' => $params['amount_type']
    ));

    
    $ingredient->add();

    Redirect::to('/muokkaus/' . $ingredient->drink_id);
  }

    public static function logon(){
    View::make('loginpage.html');
  }
}