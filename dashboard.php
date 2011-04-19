<?php require('shared/_head.php'); require 'shared/_header.php'; ?>
<div id="content-area">
  <div id="table-container">
    <?php
    $t = new Team();
    $tab = new Table();
    $tables = $tab->find(array("house_id=$the_id"));
    if(!empty($tables)){
      $i = 1;
      foreach($tables as $table){
        $team = $t->find(array('id=' . $table->team_id));
        $opp = $t->find(array('id=' . $table->opponent_id));
        echo '<div class="table"><div class="number">' . $i . '</div>';
        echo '<div class="player"><h3>' . $team[0]->name . '<span class="score">' . $team[0]->wins . '</span></h3></div>';
        echo '<div class="opponent"><h3>' . $opp[0]->name . '</h3></div></div>';
        $i++;
      }
    }
    ?>
  </div>
  

  <br />
  <form id="create-form" action="signup.php?house=<?php echo $the_code ?>" method="POST">
    <label class="description" for="name">Team Name:</label>
    <input class="wide" type="text" name="team[name]" id="name" value="<?php echo double_ene_val($_POST,'team','name'); ?>" />
    <input class="submit_btn" type="submit" name="submit" value="Add" />
  </form>
  <br />
  <table>
    <tbody>
      <?php          
        $teams = $t->find(array('queued=1', "house_id=$the_id"));
      if(!empty($teams)){
        foreach($teams as $team){
          echo '<tr><td>';
          echo $team->name . '</td><td>' . $team->player . '</td><td>' . $team->teammate . '</td><td>' . $team->wins . '</td></tr>';
        }
      }
      ?>
      </tbody>  
  </table>
</div>