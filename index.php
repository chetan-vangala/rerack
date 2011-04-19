<?php require('shared/_head.php'); ?>
</head>
  <body id="login">
    <?php 
      if(count($_POST) > 0){
        $data = $_POST['code'];
        if(empty($_POST['code'])){
          print_errors('All fields must be complete.');
        } else {      
        redirect_to('dashboard.php?house=' . $data);
        }
      }
    ?>
    <br />
    <form id="code-input" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input class="wide" type="text" name="code" id="code" size="5" value="<?php echo ene($_POST,'code'); ?>" />
      <input class="submit_btn" type="hidden" name="submit" value="Play" />
    </form>
  </body>
</html>