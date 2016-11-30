<?php
 /*
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
*/
  $routes->get('/', function() {
    DrinkArchiveController::logon();
  });
/*
  $routes->get('/drinkkilistaus', function() {
  DrinkArchiveController::drinklist();
}); */

  $routes->get('/drinkkilistaus', function () use ($routes) {
          $srch = $routes->request()->params('srch');
          DrinkArchiveController::drinklist($srch);
});

    $routes->post('/addIngrd', function () {
      DrinkArchiveController::addNewIngrd();
});
    
$routes->post('/delIngrd', function () {
      DrinkArchiveController::delIngrd();
});
$routes->get('/ehdotus', function () {
      DrinkArchiveController::suggestion();
});
$routes->post('/ehdotus', function () {
      DrinkArchiveController::suggestion2();
});
$routes->get('/tarkastelu/:id', function($id){
  DrinkArchiveController::fetchDetails($id);
});

$routes->get('/muokkaus/:id', function($id){
  DrinkArchiveController::fetchDetailsMod($id);
});

  $routes->get('/suunnitelmat/drinkkilistaus', function() {
  HelloWorldController::drinklist();
});
$routes->get('/suunnitelmat/login', function() {
  HelloWorldController::logon();
});

$routes->get('/suunnitelmat/muokkaus', function() {
  HelloWorldController::muokkaus();
});
$routes->get('/suunnitelmat/tarkastelu', function() {
  HelloWorldController::tarkastelu();
});
