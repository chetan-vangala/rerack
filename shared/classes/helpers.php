<?php

//Redirect you somewhere else
function redirect_to($url){
   //header("Location: $url",true,302);
   //exit();
   echo "<script>window.open('" . $url . "','_parent');</script>";
}

//Test for array key presence and value
//aka exists_not_empty
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

//Print error messages
//Might want to clean this up to be prettier
function print_errors($errors = array()){
	if(empty($errors)) return; //nothing to do here
	echo'<div class="pleft" id="status">';
  foreach($errors as $value){
  		echo "<p>" . $value . "</p>";
  }
	echo '</div>';
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