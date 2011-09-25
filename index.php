<?php require('shared/_head.php'); ?>
</head>
<body>
  <div id="wrapper" data-role="page">    
    <?php 
      if(count($_POST) > 0){
        $data = $_POST['code'];
        $house  = $h->find(array('code'=> $data));
        if($data != null && !empty($house)){
          //$_SESSION['id'] = $data;
          redirect_to('dashboard.php');
        } elseif($data != null && empty($house)){  
          print_errors(array('House not found. Try Again.'));
        } else {
          print_errors(array('All fields must be complete.'));
        }
      }
    ?>
    <img src="/images/rr-logo.gif" id="top-logo" />
    <div id="code">
      <form id="code-input" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input size="5" maxlength="5" type="text" class="clean" name="code" id="code" spellcheck="false" value="<?php echo ene_val($_POST,'code'); ?>" />
        <input class="inline-submit" type="submit" value="go" />
      </form>
      <div id="errors"></div>
    </div>
    <div id="signup" data-role="content">
      <iframe id='prefinery_iframe_inline' allowTransparency='true' width='100%' height='600' scrolling='no' frameborder='0' src="http://platformthirteen.prefinery.com/betas/2361/testers/new?display=inline"></iframe>
    </div>
  </div>
</body>
</html>