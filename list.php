<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#list-li').addClass('active');
  $('#sec-title').text('ponglist');
});
</script>
</head>
<body>
<div id="wrapper">
  <?php require 'shared/_header.php'; ?>
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
</div>
<?php require 'shared/_teambar.php' ?>
</body>