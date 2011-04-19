<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#code').focus();
});
</script>
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
      <input type="text" class="clean" name="code" id="code" size="5" value="<?php echo ene($_POST,'code'); ?>" />
      <input class="inline-submit" type="submit" name="submit" value="go" />
    </form>
  </body>
</html>