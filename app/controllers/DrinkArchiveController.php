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