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
        echo '<div class="table"><div class="number">' . $i . '</div>';
        echo '<div class="player"><h3>' . $team[0]->name . '<span class="score">' . $team[0]->wins . '</span></h3></div>';
        echo '<div class="opponent"><h3>' . ene_val($opp[0]->name) . '</h3></div></div>';
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
      foreach($teams as $team){
        echo '<li>' . $team->name . '</li>';
      }
    }
    ?>
    </ul>
  </div>
  <div id="start-team">
    <form action="signup.php?house=<?php echo $the_code ?>" method="POST">
      <input class="clean" type="text" name="team[name]" id="name" onblur="if (this.value == ''){this.value = 'type a team name to sign up';}" onfocus="if (this.value == 'type a team name to sign up') {this.value = '';}" value="type a team name to sign up" />
      <input class="inline-submit" type="submit" name="submit" value="Add" />
    </form>
  </div>
</div>