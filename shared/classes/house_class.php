<?php

class House extends Model{ 

  function after_create(){
    for($i = 0; $i < $this->tables; $i++){
      $p = array("house_id" => $this->id);
      $t = new Table($p);
      $t->save();
    }
    
    $this->getCode();
  }
  
  function getCode(){
    $this->code = md5($this->id * mt_rand(99, 9999));
     //= substr($c, 0, 5);
    if(!$this->save()){
      getCode();
    }
  }

}
?>