<?php require('shared/_head.php');

$house = new House();
$user = new User();
if(count($_POST) > 0){
  $data = $_POST['house'];
  $udata = $_POST['user'];
  $errors = array();
  $rf1 = array('name', 'tables', 'rules');
  $rf2 = array('name', 'email', 'number', 'password');
  if(ene($data,$rf1) && ene($udata,$rf2) && $udata['password']!='your password' && is_numeric($data['tables'])){
    if(!is_numeric($udata['number']) || strlen($udata['number']) != 10){
      $errors[] ='Please enter a 10 digit cell number.';
    }
  } else {
    $errors[] = 'All fields must be complete.';
  }
  $udata['password'] = $user->salt_password($udata['password']);
  if(array_key_exists('user', $_POST) && ene($_POST['user'], 'email')){
    $u = new User();
    if($u->find(array('email' => $_POST['user']['email']), true)){
      $errors[] = "Email address already in use";
    }
  }
  if(empty($errors)){
    $data['rules'] = nl2br($data['rules']);
    $user->update_attributes($udata);
    $house->update_attributes($data);
    if($house->create() && $user->create()){
      $user->house_id = $house->id;
      $house->user_id = $user->id;
      $house->update();
      $user->update();
      redirect_to('index.php#confirm');
      return;
    } else {
      $errors[] = "Unable to create account.";
    }
  }
    print_errors($errors);
} else {
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#name').focus();
    $('#rules').focus(function(){
      if($(this).val() == "House Rules Here\nOne Per Line") $(this).val('');
    });
    $('#rules').blur(function(){
      if($(this).val() == '') $(this).val("House Rules Here\nOne Per Line");
    });
  });
</script>
</head>
<body>
  <img src="/images/rr-logo.gif" id="top-logo" />
  <div id="new-account">
    <form id="create-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input class="clean" type="text" name="user[name]" id="name" onblur="if (this.value == ''){this.value = 'your name';}" onfocus="if (this.value == 'your name') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'user','name'); echo $x != '' ? $x : 'your name'; ?>" />
      <input class="clean" type="text" name="house[name]" id="number" onblur="if (this.value == ''){this.value = 'house name';}" onfocus="if (this.value == 'house name') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'house','name'); echo $x != '' ? $x : 'house name'; ?>" />
      <input class="clean" type="text" maxlength="2" name="house[tables]" id="tables" onblur="if (this.value == ''){this.value = 'number of tables';}" onfocus="if (this.value == 'number of tables') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'house','tables'); echo $x != '' ? $x : 'number of tables'; ?>" />
      <input class="clean" type="text" name="user[email]" id="email" onblur="if (this.value == ''){this.value = 'email address';}" onfocus="if (this.value == 'email address') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'user','email'); echo $x != '' ? $x : 'email address'; ?>" />
      <input class="clean" type="text" maxlength="10" name="user[number]" id="number" onblur="if (this.value == ''){this.value = 'your cell number';}" onfocus="if (this.value == 'your cell number') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'user','number'); echo $x != '' ? $x : 'your cell number'; ?>" />
      <input class="clean" type="text" name="user[password]" id="password" onblur="if (this.value == ''){this.value = 'your password';}" onfocus="if (this.value == 'your password') {this.value = '';}" value="<?php $x = double_ene_val($_POST,'user','password'); echo $x != '' ? $x : 'your password'; ?>" />
      <textarea class="clean" id="rules" name="house[rules]">
House Rules Here
One Per Line</textarea>
      <input class="new-submit" type="submit" name="submit" value="create account" />
    </form><div id="errors"></div>
  </div>
</div>  
</body>