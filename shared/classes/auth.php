<?php

/**
 * Figure out if a user is logged in or not
 * @access public
 * @return boolean
 */
function logged_in(){
  return(isset($_SESSION['user']) && is_int($_SESSION['user']));
}

/**
 * Return the current user object if one exists
 * @access public
 * @return User
 */
function current_user(){
  if (logged_in()){
    $u = new User($_SESSION['user']);
    if(empty($u->id)){
      return false;
    }
    return $u;
  } else {
    return false;
  }
}

/**
 * Figure out if an admin user is logged in or not
 * @access public
 * @return boolean
 */
function admin_logged_in(){
  return(logged_in() && current_user()->is_admin);
}

function debug_logged_in(){
  return(logged_in() && current_user()->is_debugging);
}


function login($email, $password){
  $user = new User();
  if($user->login($email, $password)){
    $user->db = null;
    $_SESSION['user'] = intval($user->id);
    return true;
  } else {
    return false;
  }
}

function logout(){
  $_SESSION['user'] = null;
  unset($_SESSION['user']);
}

function require_login($return_path = ''){
  if(!logged_in()){
    redirect_to(root . '/index.php?login=true&return=' . $return_path);
  }
}

function require_admin_login($return_path = ''){
  if(!logged_in()){
    redirect_to(root .  '/index.php?login=true&return=' . $return_path);
  } elseif(!admin_logged_in()){
    redirect_to(root .  '/denied.php');
  }
}

function require_login_and_pass($return_path = ''){
  if(!logged_in()){
    redirect_to(root .  '/index.php?login=true&return=' . $return_path);
  }
  if(current_user()->expired_password()){
    redirect_to(root .  '/admin/update_pass.php?redirect=' . $return_path);
  }
}


?>
