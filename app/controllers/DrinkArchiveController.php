<?php

require 'app/models/Drink.php';
require 'app/models/Ingredient.php';
require 'app/models/Usraccount.php';
class DrinkArchiveController extends BaseController{
  // ...
  public static function drinklist(){

    $drinks = Drink::all();
    $ingredients = Ingredient::all();
    $Usraccounts = Usraccount::fetchNames();
    View::make('drinkkilistaus.html', array('drinks' => $drinks, 'ingredients' => $ingredients, 'Usraccounts' => $Usraccounts));
  }

  public static function fetchDetails($drink_id){

    $drink = Drink::find($drink_id);
    $ingredients = Ingredient::findAllFor($drink_id);

    $Usraccount = Usraccount::getName($drink -> usr_id);
    View::make('tarkastelu.html', array('drink' => $drink, 'ingredients' => $ingredients, 'Usraccount' => $Usraccount));

  }
    public static function logon(){
    View::make('loginpage.html');
  }
}