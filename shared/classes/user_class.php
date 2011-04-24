<?php

class User extends Model{  

  private $headers = "From: Rerack App <accounts@rerackapp.com>\n"; //headers for email
  
  function after_update(){
    $h = new House();
    $h = $h->find(array("id=$this->house_id"));
    $this->email_code($h[0]);
  }

  function salt_password($password){
    $salt = sha1(md5($password));
    return md5($password . $salt);
  }

  function login($email = '', $password = ''){
    if(strlen($email) < 0 || strlen($password) < 0){
      return false;
    }
    $pass = $this->salt_password($password);
    $results = $this->find(array('email' => $email, 'password' => $pass), true);
    return $results;
  }

  function new_guid(){
    $new_guid = md5(time() . $this->password);
    $this->guid = $new_guid;
    return $this->update();
  }

  function guid(){
    if(empty($this->guid)){
      if(!$this->new_guid()){
        //Error generating guid
        return false;
      }
    }
    return $this->guid;
  }
  
  function email_code($h){
    $to = $this->email;
    $subject = "Your rerack code for $h->name";
    $text = "Hey $this->name,\n\n\nYour five-digit code: $h->code";
    return mail($to, $subject, $text, $this->headers);
  }
  
}
?>