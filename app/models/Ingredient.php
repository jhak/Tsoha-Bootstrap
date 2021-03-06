<?php

class Ingredient extends BaseModel{
	
	public $drink_id,$ingrd_id,$ingrd_name,$amount,$amount_type;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

//drinkin ainesosien nouto kannasta - muuttujat: id - drinkin_id jolle ainesosia halutaan etsiä
    public static function findAllFor($id){
    $query = DB::connection()->prepare('SELECT * FROM Ingredient where drink_id = :id');
    $query->execute(array('id' => $id));
    $rows = $query->fetchAll();
    $ingredients = array();

    foreach($rows as $row){
        $ingredients[] = new Ingredient(array(
          'ingrd_id' => $row['ingrd_id'],
          'drink_id' => $row['drink_id'],
          'ingrd_name' => $row['ingrd_name'],
          'amount' => $row['amount'],
          'amount_type' => $row['amount_type']
          ));
      }
      return $ingredients;
    }
//ainesosien kokonaisulkoistus
    public static function All(){
    $query = DB::connection()->prepare('SELECT * FROM Ingredient');
    $query->execute();
    $rows = $query->fetchAll();
    $ingredients = array();

    foreach($rows as $row){
        $ingredients[] = new Ingredient(array(
          'ingrd_id' => $row['ingrd_id'],
          'drink_id' => $row['drink_id'],
          'ingrd_name' => $row['ingrd_name'],
          'amount' => $row['amount'],
          'amount_type' => $row['amount_type']
          ));
      }
      return $ingredients;
    }
// aineosan poisto kannasta - Muuttujat: id - ainesosan id
    public static function delete($id){
      $query = DB::connection()->prepare('Delete FROM Ingredient where ingrd_id = :id');
      $query->execute(array('id' => $id));

    }
// ainesosan lisäys kantaan
    public function add() {
    $query = DB::connection()->prepare('INSERT INTO Ingredient (ingrd_name, drink_id, amount, amount_type) VALUES (:ingrd_name, :drink_id, :amount, :amount_type) RETURNING ingrd_id');
    
    $query->execute(array('ingrd_name' => $this->ingrd_name, 'drink_id' => $this->drink_id, 'amount' => $this->amount, 'amount_type' => $this->amount_type));

    $row = $query->fetch();
    
    $this->ingrd_id = $row['ingrd_id']; 

    }
    


}