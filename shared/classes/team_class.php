<?php

class Team extends Model{  

  function after_create() {
    $t = new Team();
    $playing = $t->find('queued=0');
    $h = new House();
    $house = $h->find($this->house_id);
    if(count($playing) < ($house[0]->tables * 2)){
      $this->queued = 0;
      $this->update();
    }
  }

}

?>