<?php require('shared/_head.php'); require 'shared/_header.php';?>
<script type="text/javascript">
$(document).ready(function(){
  $('#mug-li').addClass('active');
  $('#sec-title').text('mugshot');
});
</script>
<div id="content-area">
  <div id="table-container">
    <?php show_tables($the_id, $the_code) ?>
  </div>
  <div id="errors"></div>
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