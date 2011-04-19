<?php require('shared/_head.php'); require 'shared/_header.php'; ?>
<div id="page-top">
  <h1>ponglist</h1>
  <div id="record">
    <?php 
      $top = $t->find(array('id=' . $house->top_team_id));
      echo '<div class="games">' . $top[0]->wins . '</div><div class="meta"><p>current record</p><h2>';
      echo $top[0]->name . '</h2></div>';
    ?>
  </div>
</div>
<div id="house-deck">
  <table>
  <?php
  $teams = $t->find(array('queued=1', "house_id=$the_id"));
  if(!empty($teams)){
    $i = 1;
    foreach($teams as $team){
      echo "<tr><td class='number'>$i</td><td class='name'>$team->name</td><td>$team->player</td><td>$team->teammate</td></tr>";
      $i++;
    }
  }
  ?>
  </table>
</div>