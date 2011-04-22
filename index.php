<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#code').focus();
});
</script>
</head>
<body>
  <div id="wrapper" data-role="page">    
    <?php 
      if(count($_POST) > 0){
        $data = $_POST['code'];
        $house  = $h->find(array('code'=> $data));
        if($data != null && !empty($house)){
          redirect_to('dashboard.php?id=' . $data);
        } elseif($data != null && empty($house)){  
          print_errors(array('House not found. Try Again.'));
        } else {
          print_errors(array('All fields must be complete.'));
        }
      }
    ?>
    <img src="/images/rr-logo.gif" id="center-logo" />
    <div id="login" data-role="content">
      <form id="code-input" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input size="5" maxlength="5" type="text" class="clean" name="code" id="code" value="<?php echo ene_val($_POST,'code'); ?>" />
        <input class="inline-submit" type="submit" name="submit" value="go" />
      </form>
      <div id="errors"></div>
    </div>
  </div>
</body>
</html>