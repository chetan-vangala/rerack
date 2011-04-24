<div id="top-nav">
  <div class='center-block'>
    <div id="title-bar">
      <span class="left"><?php echo "$house->name" ?></span>
      <span><?php echo "$house->code" ?></span>
      <span class="right"><span class="small">sms </span><?php echo '('.substr(TF,0,3).') '.substr(TF,3,3).'-'.substr(TF,6,10) ?></span>
    </div>
    <div class="logo"></div>
    <ul>
      <li id="mug-li" class="mug"><a href="<?php echo link_to('dashboard', $the_code, $team_code) ?>"></a></li>
      <li id="list-li" class="list"><a href="<?php echo link_to('list', $the_code, $team_code) ?>"></a></li>
      <li id="rules-li" class="rules"><a href="<?php echo link_to('rules', $the_code, $team_code) ?>"></a></li>
    </ul>
  </div>
</div>
<div id="wrapper">
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
<div id="fade-wrap">