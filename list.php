<?php require('shared/_head.php'); require 'shared/_header.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#list-li').addClass('active');
  $('#sec-title').text('ponglist');
});
</script>
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