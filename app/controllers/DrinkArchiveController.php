<?php
class DrinkArchiveController extends BaseController{
  // ...
  public static function drinklist(){
    View::make('drinkkilistaus.html');
  }

    public static function logon(){
    View::make('loginpage.html');
  }
}