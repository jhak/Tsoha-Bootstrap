<?php

class Followed extends BaseModel{
	
	public $follower_id,$followed_id;

  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
	public function add() {
    $query = DB::connection()->prepare('INSERT INTO Followed(follower_id,followed_id) VALUES (:follower_id, :followed_id)');
    $query->execute(array('follower_id' => $this->follower_id, 'followed_id'=> $this->followed_id));
    }

    public static function delete($follower_id,$followed_id) {
    $query = DB::connection()->prepare('delete from followed where follower_id = :follower_id and followed_id = :followed_id');
    $query->execute(array('follower_id' => $follower_id, 'followed_id'=> $followed_id));
    }
	
	  public static function isFollowed($follower_id,$followed_id){
      $query = DB::connection()->prepare('SELECT * FROM Followed WHERE follower_id = :follower_id and followed_id = :followed_id LIMIT 1');
      $query->execute(array('follower_id' => $follower_id,'followed_id'=>$followed_id));
      $row = $query->fetch();
      if($row){
        
        return true;
      }
       return false;
    }

    public static function allForId($id){
   
    $query = DB::connection()->prepare('SELECT * FROM Followed where follower_id = :follower_id');
    $query->execute(array('follower_id' => $id));

    $rows = $query->fetchAll();
    $followed = array();
    foreach($rows as $row){
      $followed[] = new Followed(array(
        'follower_id' => $row['follower_id'],
        'followed_id' => $row['followed_id']
      ));
    }

    return $followed;
  }

}