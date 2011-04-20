<?php require('shared/_head.php'); require 'shared/_header.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#mug-li').addClass('active');
  $('#sec-title').text('mugshot');
});
</script>
<div id="content-area">
  <div id="table-container">
    <?php
    $tables = $tab->find(array("house_id=$the_id"));
    if(!empty($tables)){
      $i = 1;
      foreach($tables as $table){
        $team = $t->find(array('id=' . $table->team_id));
        $opp = $t->find(array('id=' . $table->opponent_id));
        $on = '';
        $oid = '';
        if(!empty($opp)) {
          $on = $opp[0]->name;
          $oid = $opp[0]->id;
        }
        echo '<div class="table"><div class="number">' . $i . '</div>';
        echo '<div class="player"><h3 id=team-' . $team[0]->id .'>' . $team[0]->name . '<span class="score">' . $team[0]->wins . '</span></h3></div>';
        echo '<div class="opponent"><h3 id=team-' . $oid .'>' . $on . '</h3></div></div>';
        $i++;
      }
    }
    ?>
  </div>
  <div id="house-deck">
    <div id="stats">
      <?php 
        echo "<h4>to play</h4><p class='toplay'>$house->left</p>";
        echo "<h4>played</h4><p class='played'>$house->played</p>";
      ?>
    </div>
    <h4>on deck</h4>
    <ul>
    <?php
    $teams = $t->find(array('queued=1', "house_id=$the_id"));
    if(!empty($teams)){
      $i = 0;
      foreach($teams as $team){
        echo '<li>' . $team->name . '</li>';
        if($i == 3) continue;
        $i++;
      }
    }
    ?>
    </ul>
  </div>
  <?php require 'shared/_teambar.php' ?>
</div>