<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#list-li').addClass('active');
  $('#sec-title').text('ponglist');
});
</script>
</head>
<body>
<div id="wrapper">
  <?php require 'shared/_header.php'; ?>
  <div id="house-rules">
    <?php echo $house->rules ?>
  </div>
  <?php require 'shared/_teambar.php' ?>\
</div>
</body>