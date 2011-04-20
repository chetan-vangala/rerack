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
        $house  = $h->find(array('code'=> $data));
        if($data != null && !empty($house)){
          redirect_to('dashboard.php?house=' . $data);
        } elseif($data != null && empty($house)){  
          print_errors(array('House not found. Try Again.'));
        } else {
          print_errors(array('All fields must be complete.'));
        }
      }
    ?>
    <br />
    <form id="code-input" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      <input size="5" maxlength="5" type="text" class="clean" name="code" id="code" value="<?php echo ene_val($_POST,'code'); ?>" />
      <input class="inline-submit" type="submit" name="submit" value="go" />
    </form>
  </body>
</html>