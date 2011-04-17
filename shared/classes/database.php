<?php

//Brian Michalski
//bmichalski@gmail.com
//Database abstraction, requires PDO support within PHP
//Well formed SQL statements should be able to work on a 
//number of different database platforms, but I've only
//tested MySQL.

class Database {

  private static $instance; 

  //The PDO object
  private $db;
    
  private function __construct($username, $password, $db_name, $host){    
    $this->db = false;
    
    $this->connect($username, $password, $db_name, $host);
  }
  
  public static function get(){
    if (!self::$instance){
      self::$instance = new Database(DB_USERNAME, DB_PASSWORD, DB_NAME, DB_HOST);
    }

    return self::$instance;  
  }
  
  public function connect($username, $password, $db_name, $host){
    try {
      $this->db = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password); //, array(PDO::ATTR_PERSISTENT => true));
    } catch (PDOException $e) {
      echo 'DB Connection failed: ' . $e->getMessage();
    }
  }
  
  public function query($sql){
    $qry = $this->db->query($sql);
    $result = $qry->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function quote($value){
    if(is_null($value)){
       return 'NULL';
     } else {
       return $this->db->quote($value);
     }
  }
  
  public function exec($sql){
    return $this->db->exec($sql);
  }
  
  public function prepared_exec($sql, $values){
    $qry = $this->db->prepare($sql);
    return $qry->execute($values);
  }
  public function lastInsertId(){
    return $this->db->lastInsertId();
  }

}

?>
