<div id="top-nav">
  <div id="title-bar">
    <?php echo $house->name ?>
  </div>
  <ul>
    <li id="mug-li" class="mug"><a href="dashboard.php?house=<?php echo $the_code ?>"></a></li>
    <li id="list-li" class="list"><a href="list.php?house=<?php echo $the_code ?>"></a></li>
    <li id="location-li" class="location"><a href="index.php"></a></li>
  </ul>
</div>
<div id="page-top">
  <h1 id="sec-title"></h1>
  <div id="record">
    <?php 
      $top = $t->find(array('id=' . $house->top_team_id));
      if(!empty($top)){
        echo '<div class="games">' . $top[0]->wins . '</div><div class="meta"><p>current record</p><h2>';
        echo $top[0]->name . '</h2></div>';
      }
    ?>
  </div>
</div>