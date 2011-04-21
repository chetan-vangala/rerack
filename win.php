<?php require('shared/_head.php');

  $team = $t->find(array("id=$team_code"));
  if(!empty($team)){
   $team[0]->win();
   echo 'success';
  } else {
    echo 'Error. Invalid team.';    
  }
  redirect_to(link_to('dashboard', $the_code, $team_code));
  
?>