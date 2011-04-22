<?php
error_reporting(E_ALL);
define('KEY', '23423'); //Used to encrypt/decrypt ids

define('DB_USERNAME', 'rerack'); //Username
define('DB_PASSWORD', 'rerack'); //Password
define('DB_NAME', 'rerack'); //Database name
define('DB_HOST', 'localhost'); //Database Server

require_once 'classes/twilio.php';
require_once 'classes/database.php';
require_once 'classes/helpers.php';
require_once 'classes/model.php';
require_once 'classes/auth.php';
require_once 'classes/user_class.php';
require_once 'classes/team_class.php';
require_once 'classes/house_class.php';
require_once 'classes/table_class.php';

session_start();
?>
