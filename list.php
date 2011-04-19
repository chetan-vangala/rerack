<?php require('shared/_head.php'); require 'shared/_header.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#list-li').addClass('active');
});
</script>
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
<div id="start-team">
  <form action="signup.php?house=<?php echo $the_code ?>" method="POST">
    <input class="clean" type="text" name="team[name]" id="name" onblur="if (this.value == ''){this.value = 'type a team name to sign up';}" onfocus="if (this.value == 'type a team name to sign up') {this.value = '';}" value="type a team name to sign up" />
    <input class="inline-submit" type="submit" name="submit" value="Add" />
  </form>
</div>