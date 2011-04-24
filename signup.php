<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  //$('#number').focus();
  $('#sec-title').text('signup');
});
</script>
</head>
<body>
<div id="wrapper">
  <?php
    require 'shared/_header.php';
    $team = new team();
    if(count($_POST) > 0){
      $data = $_POST['team'];
      $die = 0;
      $errors = array();
      $fields = array('name','number','player','teammate', 'house_id');
      if(ene($data,$fields)){ //validate data
        $i = 0;
        if(!is_numeric($data['number'])){
          $die = 1;
          $errors[] ='Please enter a 10 digit cell number.';
        } else {
          foreach($fields as $field){
            if($data[$field] == $titles[$i]){
              $die = 1;
              break;
            }
            $i++;
          }
        }
      } else {
        $die = 1;
      }
      if($die) $errors[] = 'All fields must be complete.';
        
      if(empty($errors)){
        $team->update_attributes($data);
        if($team->create()){
          redirect_to("index.php?id=$the_code&t=" . encrypt($team->id,KEY));
          return;
        } else {
          $errors[] = "Unable to create team.";
        }
      }
      print_errors($errors);
    } else {
    }
  ?>
  <div id="signup-fields">
    <form id="create-form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
      <input class="clean light" type="text" name="team[name]" id="name" value="<?php echo double_ene_val($_POST,'team','name'); ?>" />
      <input class="clean" type="text" maxlength="10" name="team[number]" id="number" onblur="if (this.value == ''){this.value = 'your cell number';}" onfocus="if (this.value == 'your cell number') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'team','number'); echo $x != '' ? $x : 'your cell number'; ?>" />
      
      <input class="clean separator" type="text" name="team[player]" id="player" onblur="if (this.value == ''){this.value = 'your first name';}" onfocus="if (this.value == 'your first name') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'team','player'); echo $x != '' ? $x : 'your first name'; ?>" />
      <input class="clean" type="text" name="team[teammate]" id="teammate" onblur="if (this.value == ''){this.value = 'teammate name';}" onfocus="if (this.value == 'teammate name') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'team','teammate'); echo $x != '' ? $x : 'teammate name';?>" />
      <input type="hidden" name="team[house_id]" id="house_id" value="<?php echo $the_id ?>">
      <input class="inline-submit" type="submit" name="submit" value="Add to List" />
    </form>
  </div>  
  <div id="errors"></div>
</div>
</body>