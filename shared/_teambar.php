<div id="start-team">
  <form action="signup.php?id=<?php echo $the_code ?>" method="POST">
    <?php 
      if($the_team == ''){
      ?>
      <input class="clean" type="text" name="team[name]" id="name" onblur="if (this.value == ''){this.value = 'type a team name to sign up';}" onfocus="if (this.value == 'type a team name to sign up') {this.value = '';}" value="type a team name to sign up" />
      <input class="inline-submit" type="submit" name="submit" value="Add" />
      <?php
      } else {
        echo '<input class="clean" readonly="readonly" type="text" name="team[name]" id="name" value="' . $the_team->name . '" />';
      }
    ?>
  </form>
</div>