<?php

class Table extends Model{  

  function tableUpdate($team, $house, $p, $win){
    $numTables = $house->tables;
    if($win){
      $tab = $this->find(array("team_id=$team->id OR opponent_id=$team->id"), 0, 1);
      if ($team->id == $tab[0]->opponent_id){ //opponent
        $t_del = $team->find(array("id=" . $tab[0]->team_id));
          
        $tab[0]->team_id = $team->id;
        echo "<br />opponent:  " . $team->id . "  " .  $t_del[0]->id . "  " . $tab[0]->opponent_id;
      } elseif($team->id == $tab[0]->team_id){ //incumbent
        $team->wins += 1;
        $team->save();
        $t_del = $team->find(array("id=" . $tab[0]->opponent_id));
        echo "<br />incumbent:  " . $team->id . "  " .  $tab[0]->opponent_id;  
      }
      $team->highscore($house);
      $tmp = $team->find(array("house_id=$house->id", "queued=1"));
      $team = $tmp[0];
      $house->played += 1;
      $house->save();      
      $t_del[0]->delete();
      $tab[0]->opponent_id = 0;
      $tab[0]->save();
      $p -= 1;
    }
    
    $tables = $this->find(array("house_id=$house->id"));
    $e_tables = $this->find(array("house_id=$house->id", "team_id!=0", "opponent_id=0"));
    $found = empty($tables) ? 0 : count($tables);
    $e_found = empty($e_tables) ? 0 : count($e_tables);
    
    if($p < ($numTables * 2)){
      echo "<br />less:  $p $team->id $numTables"; 
      $team->queued = 0;
      if($house->left != 0) $house->left -= 1;
      $team->save();
      $house->save();
      if(($found == 0) || ($found < $numTables && !($p%2) && $e_found == 0)){
        echo "<br />create:  $found $team->id $numTables $e_found";
        $temp = new Table();
        $temp->house_id = $house->id;
        $temp->team_id = $team->id;
        $temp->save();
        return 0;
      } elseif($p%2 && ($found <= $numTables) && $e_found != 0){
        echo "<br />fill:  $found $team->id $numTables $e_found";
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
?>