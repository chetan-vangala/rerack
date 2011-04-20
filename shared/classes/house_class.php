<?php

class House extends Model{ 

  function after_create(){
    $this->genCode();
  }
  
  function genCode(){
    $this->code = md5($this->id);
    if(!$this->save()){
      genCode();
    }
  }
}
?>