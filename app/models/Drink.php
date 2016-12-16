	<?php
			
	class Drink extends BaseModel{
		
		public $drink_id,$usr_id,$name,$created,$approved;
	
	  public function __construct($attributes){
		parent::__construct($attributes);
	  }
	  // drinkin lisäys kantaan
		public function add() {	
		$query = DB::connection()->prepare('INSERT INTO Drink (name,usr_id) VALUES (:name, :usr_id) RETURNING drink_id');
		
		$query->execute(array('name' => $this->name,'usr_id'=> $_SESSION['user']));
	
		$row = $query->fetch();
		
		$this->drink_id = $row['drink_id']; 
	
		}
		// drinkin poisto kannasta - Muuttujat: id - poistettavan drinkin id.
		public static function delete($id){
			
			$usr=Usraccount::getName($_SESSION['user']);
			if($usr->isadm === 1){
		  $query = DB::connection()->prepare('Delete FROM Drink where drink_id = :id');
		  $query->execute(array('id' => $id));
			}
		}
		//drinkin hyväksyminen - ainoastaan ylläpitäjien käyttöön - Muuttujat: id - hyväksyttävän drinkin id
		public static function approve($id){
			
			$usr=Usraccount::getName($_SESSION['user']);
			if($usr->isadm = true){
		  $trg = Drink::find($id);
		  $query = DB::connection()->prepare('UPDATE Drink SET approved = true WHERE drink_id = :id');
		  $query->execute(array('id' => $trg->drink_id));
			}
		}
		//drinkin nimen päivittäminen - Muuttujat: id - drinkin id, newname - drinkin uusi nimi
		public static function updateName($id,$newname){
		  $trg = Drink::find($id);
		  $query = DB::connection()->prepare('UPDATE Drink SET name = :ntxt WHERE drink_id = :id');
		  $query->execute(array('id' => $trg->drink_id, 'ntxt'=>$newname));	
		}
		//tietyn drinkin tietojen nouto kannasta - Muuttujat: id - haettavan drinkin id.
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
		// kaikkien drinkkien tietojen nouto kannasta
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