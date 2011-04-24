<?php require('shared/_head.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
  $('#rules-li').addClass('active');
  $('#sec-title').text('rules');
});
</script>
</head>
<body>
<div id="wrapper">
  <?php require 'shared/_header.php'; ?>
  <div id="house-rules">
    <?php echo $house->rules ?>
  </div>
</div>
<?php require 'shared/_teambar.php' ?>
</body>