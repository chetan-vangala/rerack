<?php require 'config.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- chris butler did this - platformthirteen.com -->
  <head>
    <title>rerackapp.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=640; height=device-height; initial-scale=0.5; maximum-scale=1.0; user-scalable=no; target-densitydpi=320;">
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href='http://fonts.googleapis.com/css?family=Kreon:light,regular,bold' rel='stylesheet' type='text/css'>
    <link href="/css/rerack.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/css/wide.css" rel="stylesheet" type="text/css" media="screen and (min-width:801px)"/>
    <link href="/css/display.css" rel="stylesheet" type="text/css" media="screen and (min-width:1360px)"/>
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <link rel="icon" type="image/png" href="/images/favicon.png" />
    <link rel="image_src" href="/images/thumb.png" />
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/rerack.js" type="text/javascript"></script>
    <?php
      $the_code = $the_id = $team_code = $the_team = $house = null;
      $h = new House();
      $t = new Team();
      $tab = new Table();
      if(isset($_GET['id'])){
        $the_code = $_GET['id'];
        $house  = $h->find(array('code'=> $the_code));
        if(!empty($house)){
          $house = $house[0];
          $the_id = $house->id;
        } else {
          redirect_to('index.php');
        }
      }
      if(isset($_GET['t'])){
        $team_code = decrypt($_GET['t'], KEY);
        $the_team  = $t->find(array('id'=> $team_code));
        if(!empty($the_team)){
          $the_team = $the_team[0];
        } else {
          $the_team = null;
        }
      } else {
        $team_code = '';
      }
    ?>
    