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
    //if(!$i){
      //echo "$this->id,  $this->house_id,  " . $house[0]->id . ",  ";
      //$house[0]->top_team_id = $this->id;
      //$house[0]->update();
    //}
    return $tab->tableUpdate($this, $house[0], $playing, $w);
  }
  
  function win(){
    $this->manageQueue(1);
  }
}
?>