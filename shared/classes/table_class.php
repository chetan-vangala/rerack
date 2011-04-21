<?php

class Table extends Model{  

  function tableUpdate($team, $house, $p, $w){
    $empty = 0;
    if($w){
      $p -= 1;
      $x = $this->tableWin($team, $house);
      if(isset($x)) {
        $team = $x;
      } else {
        $empty = 1;
      }
    }
    if(!$empty){
      $numTables = $house->tables;
      $tables = $this->find(array("house_id=$house->id"));
      $e_tables = $this->find(array("house_id=$house->id", "team_id!=0", "opponent_id=0"));
      $found = empty($tables) ? 0 : count($tables);
      $e_found = empty($e_tables) ? 0 : count($e_tables);
    
      if($p < ($numTables * 2)){
        $team->queued = 0;
        $team->save();
        if($house->left != 0) $house->left -= 1;
        $house->save();
        if(($found == 0) || ($found < $numTables && !($p%2) && $e_found == 0)){
          $temp = new Table();
          $temp->house_id = $house->id;
          $temp->team_id = $team->id;
          $temp->save();
          return 0;
        } elseif($p%2 && ($found <= $numTables) && $e_found != 0){
          $e_tables[0]->opponent_id = $team->id;
          $e_tables[0]->update();
          return 1;
        } else {
        }
      } else {
        $house->left += 1;
        $house->save();
        return -1;
      }
    }
  }
  
  function tableWin($team, $house){
    $tab = $this->find(array("team_id=$team->id OR opponent_id=$team->id"), 0, 1);
    if($tab[0]->opponent_id == 0){
      return null;
    } elseif ($team->id == $tab[0]->opponent_id){ //delete holder and take spot
      $t_del = $team->find(array("id=" . $tab[0]->team_id));
      $tab[0]->team_id = $team->id;
    } elseif($team->id == $tab[0]->team_id){ //increase win count and delete opponent
      $team->wins += 1;
      $team->save();
      $t_del = $team->find(array("id=" . $tab[0]->opponent_id)); 
    }
    $t_del[0]->delete();
    //confirm record, increase play count, wait for opponent
    $team->highscore($house);
    $house->played += 1;
    $house->save();
    $tab[0]->opponent_id = 0;
    $tab[0]->save();
    //return next team in queue, or null
    $tmp = $team->find(array("house_id=$house->id", "queued=1"));
    return !empty($tmp) ? $tmp[0] : null;
  }
}
?>