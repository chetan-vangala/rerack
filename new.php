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
} else {
}
?>
</head>
<body>
  <form id="create-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <input class="clean" type="text" maxlength="10" name="house[name]" id="number" onblur="if (this.value == ''){this.value = 'your name';}" onfocus="if (this.value == 'your name') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'house','name'); echo $x != '' ? $x : 'your name'; ?>" />
    <label class="description" for="name">Number of Tables:</label><br />
    <input class="wide" type="text" name="house[tables]" id="tables" value="<?php echo double_ene_val($_POST,'house','tables'); ?>" />
    <br />
    <input class="submit_btn" type="submit" name="submit" value="Finish" />
  </form>
</div>  
</body>