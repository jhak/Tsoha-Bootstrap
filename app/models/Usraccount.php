<?php

class Usraccount extends BaseModel{
	
	public $usr_id,$usr_name,$usr_password,$isadm;

  public function __construct($attributes){
    parent::__construct($attributes);
  }
//käyttäjän tietojen nouto kannasta, muuttujat: id - käyttäjän id
  public static function getName($id){
    $query = DB::connection()->prepare('SELECT * FROM Usraccount WHERE usr_id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();
      if($row){
        $usracc = new Usraccount(array(
          'usr_id' => $row['usr_id'],
          'usr_name' => $row['usr_name'], 'isadm'=>$row['isadm']));
        return $usracc;
  }
  return null;
}
//käyttäjän poisto - muuttujat: id - poistettavan käyttäjän id
	public static function delete($id){
			
		$usr=Usraccount::getName($_SESSION['user']);
		if($usr->isadm === 1){
			$query = DB::connection()->prepare('Delete FROM Usraccount where usr_id = :id');
			$query->execute(array('id' => $id));
		}
    }

//nimen varauksen tarkistukseen - muuttujat: name - etsittävät nimi
//palautus null jos käyttäjää ei kyseisellä nimellä ole, muutoin palautetaan löydetty käyttäjä
  public static function nameExists($name){
    $query = DB::connection()->prepare('SELECT * FROM Usraccount WHERE usr_name = :name LIMIT 1');
      $query->execute(array('name' => $name));
      $row = $query->fetch();
      if($row){
        $usracc = new Usraccount(array(
          'usr_id' => $row['usr_id'],
          'usr_name' => $row['usr_name']));
        return $usracc;
  }
  return null;
}
// uuden käyttäjän lisäys kantaan - muuttujat: usr_name - uuden käyttäjän nimi, usr_password - uuden käyttäjän salasana
public static function newUser($usr_name,$usr_password){
	$tmp=self::nameExists($usr_name);
	if(!($tmp)){
	$query = DB::connection()->prepare('INSERT INTO Usraccount(usr_name,usr_password) values (:usr_name,:usr_password) returning usr_id');
	$query->execute(array('usr_name'=>$usr_name,'usr_password'=>$usr_password));
	$row = $query->fetch();
      if($row){
		$usracc = new Usraccount(array(
			'usr_id'=>$row['usr_id'],
			'usr_name'=>$usr_name,
			'usr_password'=>$usr_password
			
		));
		return $usracc;
	  }
	}
	return null;
	
}
//autentikointi - muuttujat: usrnm - käyttäjän nimi, usrpw - käyttäjän salasana.
  public static function auth($usrnm,$usrpw){
	
	  $query = DB::connection()->prepare('SELECT * FROM Usraccount WHERE usr_name = :usr_name LIMIT 1');
      $query->execute(array('usr_name' => $usrnm));
      $row = $query->fetch();
      if($row){
        $usracc = new Usraccount(array(
          'usr_id' => $row['usr_id'],
          'usr_name' => $row['usr_name']));
		if($row['usr_password'] != $usrpw){
				return null;
		} else {
        return $usracc;
		}
  }
  return self::newUser($usrnm,$usrpw);
	
  }
//kokonaisulkoistus käyttäjien nimistä
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