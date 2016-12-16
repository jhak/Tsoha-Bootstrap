<?php

class Preparation extends BaseModel{
	
	public $drink_id,$prep_id,$prep_text;

  public function __construct($attributes){
    parent::__construct($attributes);
  }
  //valmistusohjeen lisäys drinkille
	public function add() {
    $query = DB::connection()->prepare('INSERT INTO Preparation (drink_id,prep_text) VALUES (:drink_id, :prep_text) RETURNING prep_id');
    
    $query->execute(array('drink_id' => $this->drink_id, 'prep_text'=> $this->prep_text));

    $row = $query->fetch();
    
    $this->prep_id = $row['prep_id']; 

    }
//valmistusohjeen etsintä drinkille - Muuttujat: id - drinkin id jolle ohje halutaan noutaa
    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Preparation WHERE drink_id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        $preparation = new Preparation(array(
          'drink_id' => $row['drink_id'],
          'prep_id' => $row['prep_id'],
          'prep_text' => $row['prep_text']));
        return $preparation;
      }
      return null;
    }
//valmistusohjeen päivitys - Muuttujat: id - drinkin id jonka ohjetta halutaan päivittää, prptxt - uusi ohjeteksti
	public static function updateText($id,$prptxt){
	  $trg = Preparation::find($id);
	  $query = DB::connection()->prepare('UPDATE Preparation SET prep_text = :ntxt WHERE drink_id = :id');
      $query->execute(array('id' => $trg->drink_id, 'ntxt'=>$prptxt));	
	}
//kokonaisulkoistus 
    public static function all(){
   
    $query = DB::connection()->prepare('SELECT * FROM Preparation');
  
    $query->execute();

    $rows = $query->fetchAll();
    $preparations = array();


    foreach($rows as $row){
    
      $preparations[] = new Preparation(array(
        'drink_id' => $row['drink_id'],
        'usr_id' => $row['prep_id'],
        'name' => $row['prep_text']  
      ));
    }

    return $preparations;
  }

}