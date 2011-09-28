<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  if($('#code').val().length == 0) $('#code').focus();
  
  if(window.location.hash == '#confirm'){
    $("#errors").text('Check your inbox for your code');
  }
  
  $('#code').keyup(function(){
    if($('#code').val().length == 5){
      $('#code-input').get(0).submit('');
    }
  });
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
          $_SESSION['id'] = $data;
          redirect_to('dashboard.php');
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
        <input size="5" maxlength="5" type="text" class="clean" name="code" id="code" spellcheck="false" value="<?php echo ene_val($_POST,'code'); ?>" />
        <input class="inline-submit" type="submit" value="go" />
      </form>
      <div id="errors"></div>
    </div>
  </div>
</body>
</html>