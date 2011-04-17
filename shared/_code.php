<form id="create-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <label class="description" for="name">House Code:</label>
  <input class="wide" type="text" name="house[code]" id="code" value="<?php echo double_ene_val($_POST,'house','code'); ?>" />
  <input class="submit_btn" type="submit" name="submit" value="Play" />
</form>