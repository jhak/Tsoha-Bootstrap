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
    ListController::logonpage();
  });
/*
  $routes->get('/drinkkilistaus', function() {
  DrinkArchiveController::drinklist();
}); */

  $routes->get('/drinkkilistaus', function () use ($routes) {
          $srch = $routes->request()->params('srch');
          ListController::drinklist($srch);
});
  
    $routes->get('/suosikit', function () use ($routes) {
          $srch = $routes->request()->params('srch');
          ListController::drinklistFav($srch);
});

    $routes->post('/addIngrd', function () {
      DrinkArchiveController::addNewIngrd();
});
    
        $routes->post('/updName', function () {
      DrinkArchiveController::updateDrinkName();
});
    
$routes->post('/delIngrd', function () {
      DrinkArchiveController::delIngrd();
});
$routes->post('/addPrep', function () {
       DrinkArchiveController::setPrepText();
});
$routes->post('/addfav', function () {
       DrinkArchiveController::addFav();
});
$routes->post('/delFav', function () {
       DrinkArchiveController::delFav();
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

$routes->get('/poistau/:id', function($id){
  DrinkArchiveController::delUsr($id);
});

$routes->get('/poistad/:id', function($id){
  DrinkArchiveController::delDrink($id);
});

$routes->get('/hyvaksy/:id', function($id){
  DrinkArchiveController::approve($id);
});

$routes->get('/hallinta', function () use ($routes) {
  $srch = $routes->request()->params('srch');
  DrinkArchiveController::hallinta($srch);
});

  $routes->get('/suunnitelmat/drinkkilistaus', function() {
  HelloWorldController::drinklist();
});
$routes->get('/suunnitelmat/login', function() {
  DrinkArchiveController::logonpage();
});

$routes->get('/suunnitelmat/login', function() {
  DrinkArchiveController::performLogin();
});

$routes->post('/login', function() {
  ListController::performLogin();
});
$routes->post('/hallinta', function() {
  DrinkArchiveController::hallinta();
});
$routes->post('/logout', function(){
  ListController::logout();
});
$routes->get('/suunnitelmat/muokkaus', function() {
  HelloWorldController::muokkaus();
});
$routes->get('/suunnitelmat/tarkastelu', function() {
  HelloWorldController::tarkastelu();
});
