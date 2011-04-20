<?php

class Table extends Model{  

  function tableUpdate($hid, $tid, $n, $p, $win){
    $tables = $this->find(array("house_id=$hid"));
    $e_tables = $this->find(array("house_id=$hid", "team_id!=0", "opponent_id=0"));
    $found = empty($tables) ? 0 : count($tables);
    $e_found = empty($e_tables) ? 0 : count($e_tables);
    if($win){
      if()
      
    } elseif(($found == 0) || ($found < $n && !($p%2) && $e_found == 0)){
      $temp = new Table();
      $temp->house_id = $hid;
      $temp->team_id = $tid;
      $temp->save();
      return 0;
    } elseif($p%2 && ($found <= $n) && $e_found != 0){
      $e_tables[0]->opponent_id = $tid;
      $e_tables[0]->update();
      return 1;
    } else {
      return -1;
    }    
  }
}
?>