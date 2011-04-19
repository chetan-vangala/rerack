<?php require('shared/_head.php'); ?>
</head>
  <body>
    <?php 
      if(isset($_GET['house'])){
        redirect_to('dashboard.php?house=' . $_GET['house']);
      } else {
        if(count($_POST) > 0){
          $data = $_POST['code'];        
          $errors = array();
          if(!empty($data)){
            $errors[] = 'All fields must be complete.';
          }
          redirect_to('dashboard.php?house=' . $data);
          /*$house = new House();
          $h = $house->find('code=' . $data);
          if(!empty($h)){
            
            return;
          } else {
            $errors[] = "Unable to find house.";
          }*/
          print_errors($errors); 
        }
      }
    ?>
    <br />
    <form id="create-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <label class="description" for="name">House Code:</label>
      <input class="wide" type="text" name="code" id="code" value="<?php echo ene($_POST,'code'); ?>" />
      <input class="submit_btn" type="submit" name="submit" value="Play" />
    </form>
  </body>
</html>