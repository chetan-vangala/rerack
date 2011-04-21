<?php

  function show_tables($hid, $c, $tid){
    $tab = new Table();
    $t = new Team();
    $tables = $tab->find(array("house_id=$hid"));
    if(!empty($tables)){
      $c = 1;
      foreach($tables as $table){
        $temp = $t->find(array('id=' . $table->team_id));
        $x[0] = $temp[0];
        if($table->opponent_id != 0){
          $temp = $t->find(array('id=' . $table->opponent_id));
          $x[1] = $temp[0];
        }
        echo '<div class="table"><div class="number">' . $c . '</div>';
        for($i = 0; $i < count($x); $i++) {
          $class = $i == 1 ? 'opponent' : 'player';
          $h3 = "<div class='$class'><h3 id='team-" . $x[$i]->id . "'>";
          $link = $x[$i]->name;
          if($tid == $table->team_id) $link = '<a href="' . link_to('win', $c, $x[$i]->id) . '" onclick="return' .  " confirm('". $x[$i]->name . " wins?')" . '">' . $x[$i]->name . "</a>";
          if($i == 0){
            $close = "<span class='score'>" . $x[$i]->wins . '</span></h3></div>';
          } else {
            $close = '</h3></div>';
          }
          echo $h3 . $link . $close;
        }
        echo '</div>';
        $c++;
        $x = '';
      }
    }
  }

function redirect_to($url){
   echo "<script>window.open('" . $url . "','_parent');</script>";
}

function link_to($page, $c, $t){
  $link = "$page.php?id=$c";
  if(isset($t)) $link .= "&t=" . encrypt($t, KEY);
  return $link;
}

function exists_not_empty($array, $key){
  if(is_array($key)){
    $ret = true;
    foreach($key as $k){
      $ret = $ret * (array_key_exists($k, $array) && !empty($array[$k]));
    }
    return $ret;
  } else {
    return (array_key_exists($key, $array) && !empty($array[$key]));
  }
}
function ene($array, $key){
  return exists_not_empty($array, $key);
}

function ene_val($array, $key1 = ""){
  if(array_key_exists($key1, $array)){
    return $array[$key1];
  } else {
    return "";
  }
}

function print_errors($errors = array()){
  if(empty($errors)) return;	
	$e = '<script>$(document).ready(function(){$("#errors").html("';
  foreach($errors as $value){
  		 $e .= '<p>' . $value . '</p>';
  }
  $e .= '");});</script>';
	echo $e;
}

function mysql_time($time = 'NOW'){
  $time = strtotime($time);
  return date('Y-m-d H:i:s', $time);
}

function get_referrer($request) {
	if(ene($request, 'return')) {
		return "?return=" . $request['return'];
	}
}

function double_ene_val($array, $key1 = "", $key2 = ""){
  if(array_key_exists($key1, $array) && ene($array[$key1],$key2)){
    return $array[$key1][$key2];
  } else {
    return "";
  }
}

function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }
  return base64_encode($result);
}

function decrypt($string, $key) {
  $result = '';
  $string = base64_decode($string);
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
  return $result;
}

?>