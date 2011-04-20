<?php

class Team extends Model{
  function after_create() {
    $this->manageQueue(0);
  }
  
  function manageQueue($w){
    $tab = new Table();
    $h = new House();
    $playing = count($this->find(array('queued=0', "house_id=$this->house_id")));
    $house = $h->find(array("id=$this->house_id"));
    return $tab->tableUpdate($this, $house[0], $playing, $w);
  }
  
  function win(){
    $this->manageQueue(1);
  }
  
  function highScore($house){
    if($this->wins > $house->tt_wins){
      $house->tt_name = $this->name;
      $house->tt_wins = $this->wins;
      $house->update();
    }
  }
}
?>