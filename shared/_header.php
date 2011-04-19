<div id="top-nav">
  <div id="title-bar">
    <?php echo $house->name ?>
  </div>
  <ul>
    <li><a href="dashboard.php?house=<?php echo $the_code ?>">mugshot</a></li>
    <li><a href="list.php?house=<?php echo $the_code ?>">list</a></li>
    <li><a href="index.php">house</a></li>
  </ul>
</div>
<div id="page-top">
  <h1>mugshot</h1>
  <div id="record">
    <?php 
      $top = $t->find(array('id=' . $house->top_team_id));
      echo '<div class="games">' . $top[0]->wins . '</div><div class="meta"><p>current record</p><h2>';
      echo $top[0]->name . '</h2></div>';
    ?>
  </div>
    
</div>