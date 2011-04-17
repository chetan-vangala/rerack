<?php require('shared/_head.php');
echo $the_code;
$team = new team();
//Has the form been submitted?
if(count($_POST) > 0){
  $data = $_POST['team'];
  $errors = array();

  //Verify the fields are filled out
  if(!ene($data,array('name','number','player','teammate'))){
    $errors[] = 'All fields must be complete.';
  }
  //If there are no error thus far, continue creating the survey
  if(empty($errors)){
    //Update all the attributes we can in the array.
    //array_push($data, array('house_id' => ));
    $team->update_attributes($data);
    if($team->create()){
      redirect_to("index.php?house=" . $the_code);
      return;
    } else {
      $errors[] = "Unable to create team.";
    }
  }
  //Display any error messages we've encountered.
  if(!empty($errors)){
    print_errors($errors);
  }
  
} else {
  $team->name = "";
}
?>
</head>
<body>
  <form id="create-form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
    <label class="description" for="name">Team Name:</label><br />
    <input class="wide" type="text" name="team[name]" id="name" value="<?php echo double_ene_val($_POST,'team','name'); ?>" />
    <br />
    <label class="description" for="name">Cell Number:</label><br />
    <input class="wide" type="text" name="team[number]" id="tables" value="<?php echo double_ene_val($_POST,'team','number'); ?>" />
    <br />
    <label class="description" for="name">Your Name:</label><br />
    <input class="wide" type="text" name="team[player]" id="tables" value="<?php echo double_ene_val($_POST,'team','player'); ?>" />
    <br />
    <label class="description" for="name">Teammate Name:</label><br />
    <input class="wide" type="text" name="team[teammate]" id="tables" value="<?php echo double_ene_val($_POST,'team','teammate'); ?>" />
    <br />
    <input type="hidden" name="team[house_id]" id="house_id" value="<?php echo $the_id ?>">
    <input class="submit_btn" type="submit" name="submit" value="Finish" />
  </form>
</div>  
</body>