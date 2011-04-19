<?php require('shared/_head.php');

$house = new House();
//Has the form been submitted?
if(count($_POST) > 0){
  $data = $_POST['house'];

  $errors = array();

  //Verify the fields are filled out
  if(!ene($data,array('name','tables'))){
    $errors[] = 'All fields must be complete.';
  }
  //If there are no error thus far, continue creating the survey
  if(empty($errors)){
    //Update all the attributes we can in the array.
    $house->update_attributes($data);
    if($house->create()){
      redirect_to('index.php');
      return;
    } else {
      $errors[] = "Unable to create house.";
    }
  }
  //Display any error messages we've encountered.
  if(!empty($errors)){
    print_errors($errors);
  }
  
} else {
  $house->name = "";
}
?>
</head>
<body>
  <form id="create-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <label class="description" for="name">House Name:</label><br />
    <input class="wide" type="text" name="house[name]" id="name" value="<?php echo double_ene_val($_POST,'house','name'); ?>" />
    <br />
    <label class="description" for="name">Number of Tables:</label><br />
    <input class="wide" type="text" name="house[tables]" id="tables" value="<?php echo double_ene_val($_POST,'house','tables'); ?>" />
    <br />
    <input class="submit_btn" type="submit" name="submit" value="Finish" />
  </form>
</div>  
</body>