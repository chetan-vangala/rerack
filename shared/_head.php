<?php require_once 'config.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- chris butler did this - platformthirteen.com -->
  <head>
    <title>rerackapp.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href='http://fonts.googleapis.com/css?family=Kreon:regular,bold' rel='stylesheet' type='text/css'>
    <link href="/css/rerack.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/images/favicon.png" />
    <link rel="image_src" href="/images/thumb.png" />
    <!--script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery.colorbox-min.js" type="text/javascript"></script-->
    <script src="/js/jquery.mobile.min.js" type="text/javascript"></script>
    <?php
      if(isset($_GET['house'])){
        $the_code = $_GET['house'];
        $h = new House();
        $house = $h->find(array('code'=> $the_code));
        if(!empty($house)){
          $the_id = $house[0]->id;
        } else {
          $the_id = 0;
        }
      }
    ?>