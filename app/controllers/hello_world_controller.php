<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }

 
  // ...
  public static function drinklist(){
    View::make('/suunnitelmat/drinkkilistaus.html');
  }

    public static function logon(){
    View::make('/suunnitelmat/loginpage.html');
  }

    public static function muokkaus(){
    View::make('/suunnitelmat/muokkaus.html');
  }

      public static function tarkastelu(){
    View::make('/suunnitelmat/tarkastelu.html');
  }

  }
