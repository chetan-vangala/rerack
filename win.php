<?php require('../shared/_head.php');

  if(ene($_REQUEST, 'id') && is_numeric($_REQUEST['id'])){
    $id = intval($_REQUEST['id']);
  } else {
    redirect_to("index.php?house=$the_id");
  }
  
  $team = new Team($id);
  $team->wins++;
  
?>