<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#rules-li').addClass('active');
  $('#sec-title').text('rules');
});
</script>
</head>
<body>
  <?php require 'shared/_header.php'; ?>
  <div id="wrapper">
  <div id="house-rules">
    <?php echo $house->rules ?>
  </div>
<?php require 'shared/_teambar.php' ?>
</div>
</body>