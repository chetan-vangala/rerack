<?php require('shared/_head.php');

$house = new House();
if(count($_POST) > 0){
  $data = $_POST['house'];
  $errors = array();
  if(!ene($data,array('name','tables'))){
    $errors[] = 'All fields must be complete.';
  }
  if(empty($errors)){
    $house->update_attributes($data);
    if($house->create()){
      redirect_to('index.php');
      return;
    } else {
      $errors[] = "Unable to create house.";
    }
  }
    print_errors($errors);
  }
} else {
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