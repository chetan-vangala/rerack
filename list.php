<?php require('shared/_head.php'); ?>
<?php require 'shared/_header.php'; ?>
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