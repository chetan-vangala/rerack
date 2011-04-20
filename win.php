<?php require('shared/_head.php');

  $team = $t->find(array("id=$team_code"));
  if(!empty($team)){
   $team[0]->win();
  } else {
    echo 'Error. Invalid team.';    
  }
  redirect_to("dashboard.php?id=$the_code&t=" . encrypt($team_code,KEY));
  
?>