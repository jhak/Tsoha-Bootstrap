<?php

class Drink extends BaseModel{
	
	public $drink_id,$usr_id,$name,$created,$approved;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Drink WHERE drink_id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        $drink = new Drink(array(
          'drink_id' => $row['drink_id'],
          'usr_id' => $row['usr_id'],
          'name' => $row['name'],
          'created' => $row['created'],
          'approved' => $row['approved']));
        return $drink;
      }
      return null;
    }

    public static function all(){
   
    $query = DB::connection()->prepare('SELECT * FROM Drink');
  
    $query->execute();

    $rows = $query->fetchAll();
    $drinks = array();


    foreach($rows as $row){
    
      $drinks[] = new Drink(array(
        'drink_id' => $row['drink_id'],
        'usr_id' => $row['usr_id'],
        'name' => $row['name'],
        'created' => $row['created'],
        'approved' => $row['approved']  
      ));
    }

    return $drinks;
  }

}