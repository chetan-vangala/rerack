<?php
error_reporting(E_ALL);
define('KEY', '23423'); //Used to encrypt/decrypt ids

$url=parse_url(getenv("CLEARDB_DATABASE_URL"));
define('DB_USERNAME', $url["user"]); //Username
define('DB_PASSWORD', $url["pass"]); //Password
define('DB_NAME', substr($url["path"],1)); //Database name
define('DB_HOST', $url["host"]); //Database Server

define('TAV','2010-04-01'); // twilio api version
define('TSID', 'ACb421c4f6d7aa53a5f87cc9d11e51aaa0'); //sid
define('TAT', '720ff345fca3ac9ae8422c9272568b89'); //auth code
define('TF', '7125879671'); //twilio phone #

require_once 'classes/twilio.php';
require_once 'classes/database.php';
require_once 'classes/helpers.php';
require_once 'classes/model.php';
require_once 'classes/auth.php';
require_once 'classes/team_class.php';
require_once 'classes/house_class.php';
require_once 'classes/table_class.php';
require_once 'classes/user_class.php';

session_start();
?>
