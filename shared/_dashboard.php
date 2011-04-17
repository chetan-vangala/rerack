<table>
  <tbody>
    <?php
    $h = new House();
    $house_id = ($h->find('code=' . $_GET['house']));
    $house_id = $house_id[0]->id;

    $house = $h->find("id=$house_id");
    echo $house[0]->name . ' ' . $house[0]->code;
    $t = new Team();
    $teams = $t->find(array('queued=0', "house_id=$house_id"));
    
    if(!empty($teams)){
    $i = 2;
      foreach($teams as $team){
        echo '<tr><td>';
        if(!($i % 2)) {
          echo '</td></tr><tr><br /></tr><tr><td><h2>' . $i / 2 . '</h2></td><td>';
        } else {
          echo '</td><td>';
        }
        echo $team->name . '</td><td>' . $team->player . '</td><td>' . $team->teammate . '</td><td>' . $team->wins . '</td></tr>';
        $i++;
      }
    }
    ?>
  </tbody>  
</table>
<br />
<form id="create-form" action="signup.php" method="POST">
  <label class="description" for="name">Team Name:</label>
  <input class="wide" type="text" name="team[name]" id="name" value="<?php echo double_ene_val($_POST,'team','name'); ?>" />
  <input class="submit_btn" type="submit" name="submit" value="Add" />
</form>
<br />
<table>
  <tbody>
    <?php
      $teams = $t->find(array('queued=1', "house_id=$house_id"));
      foreach($teams as $team){
        if(!empty($teams)){
          echo '<tr><td>';
          echo $team->name . '</td><td>' . $team->player . '</td><td>' . $team->teammate . '</td><td>' . $team->wins . '</td></tr>';        
          }
      }
    ?>
    </tbody>  
</table>