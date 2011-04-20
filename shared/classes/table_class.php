<?php

class Table extends Model{  

  function tableUpdate($hid, $tid, $n, $p){
    $tables = $this->find(array("house_id=$hid"));
    $found = empty($tables) ? 0 : count($tables);
    if(($found == 0) || ($found < $n && !($p%2))){
      $temp = new Table();
      $temp->house_id = $hid;
      $temp->team_id = $tid;
      $temp->save();
      return 0;
    } elseif($p%2 && ($found <= $n)){
      $tables[$found-1]->opponent_id = $tid;
      $tables[$found-1]->update();
      return 1;
    } else {
      return -1;
    }    
  }
}
?>