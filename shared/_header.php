<div id="top-nav">
  <div id="title-bar">
    <?php echo "$house->name" ?>
  </div>
  <ul>
    <li id="mug-li" class="mug"><a href="dashboard.php?id=<?php echo "$the_code&t=" . encrypt($team_code,KEY) ?>"></a></li>
    <li id="list-li" class="list"><a href="list.php?id=<?php echo "$the_code&t=" . encrypt($team_code,KEY) ?>"></a></li>
    <li id="location-li" class="location"><a href="index.php"></a></li>
  </ul>
</div>
<div id="page-top">
  <h1 id="sec-title"></h1>
  <div id="record">
    <?php 
      if(!empty($house->tt_name)){
        echo '<div class="games">' . $house->tt_wins . '</div><div class="meta"><p>current record</p><h2>';
        echo $house->tt_name . '</h2></div>';
      }
    ?>
  </div>
</div>