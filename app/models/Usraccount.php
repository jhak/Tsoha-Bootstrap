<?php

class Usraccount extends BaseModel{
	
	public $usr_id,$usr_name,$usr_password,$isadm;

  public function __construct($attributes){
    parent::__construct($attributes);
  }

  public static function getName($id){
    $query = DB::connection()->prepare('SELECT * FROM Usraccount WHERE usr_id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        $usracc = new Usraccount(array(
          'usr_id' => $row['usr_id'],
          'usr_name' => $row['usr_name']));
        return $usracc;
  }
  return null;
}

  public static function fetchNames(){

    $query = DB::connection()->prepare('SELECT * FROM usraccount');
  
    $query->execute();

    $rows = $query->fetchAll();
    $Usraccount = array();


    foreach($rows as $row){
    
      $Usraccount[] = new Usraccount(array(
        'usr_id' => $row['usr_id'],
        'usr_name' => $row['usr_name']
      ));
    }
    return $Usraccount;

  }




}