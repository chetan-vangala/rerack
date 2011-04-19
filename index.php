<?php require('shared/_head.php'); ?>
</head>
  <body id="login">
    <?php 
      if(count($_POST) > 0){
        $data = $_POST['code'];
        if(empty($_POST['code'])){
          print_errors('All fields must be complete.');
        } else {
          $data = implode($data);     
        redirect_to('dashboard.php?house=' . $data);
        }
      }
    ?>
    <br />
    <form id="code-input" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input type="text" name="code[1]" id="code-1" size="1" value="<?php echo ene($_POST,'code'); ?>" />
      <input type="text" disabled="disabled" name="code[2]" id="code-2" size="1" value="<?php echo ene($_POST,'code'); ?>" />
      <input type="text" disabled="disabled" name="code[3]" id="code-3" size="1" value="<?php echo ene($_POST,'code'); ?>" />
      <input type="text" disabled="disabled" name="code[4]" id="code-4" size="1" value="<?php echo ene($_POST,'code'); ?>" />
      <input type="text" disabled="disabled" name="code[5]" id="code-5" size="1" value="<?php echo ene($_POST,'code'); ?>" />
      <input class="submit_btn" style="visibility:hidden" type="submit" name="submit" value="Play" />
    </form>
  </body>
</html>