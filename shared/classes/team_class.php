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
    $numTables = $house[0]->tables;
    if($playing < ($numTables * 2)){
      $this->queued = 0;
      $this->save();
      $i = $tab->tableUpdate($this->house_id, $this->id, $numTables, $playing, $w);
      //if(!$i){
        //echo "$this->id,  $this->house_id,  " . $house[0]->id . ",  ";
        //$house[0]->top_team_id = $this->id;
        //$house[0]->update();
      //}
    } else {
      $house[0]->left += 1;
      $house[0]->save();
    }
  }
}
?>