<?php

date_default_timezone_set("Asia/Jakarta");
define("SERVER", 'http://' . $_SERVER['SERVER_NAME'] .  '/');
define("ENGINE_VER", "v0.3a");
define("SECRET_KEY", "MySecretKeyIsThis");
define("HASH_METHOD", "SHA256");

define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "joo-nath");
define("HOST", "localhost");

define("GET_PARAM", "post");
define("GET_ADMIN_PARAM", "module");
define("GET_PAGE_PARAM", "page");

/*
 * ROOT DEVELOPMENT
==================================*/
//get root dir
$str = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])) . '/';
$splits = explode("\\", $str);

//Utk localhost, pakai ini:
define("ROOT_DIR", '\\' . $splits[1] . '/');


/*
 * ROOT DEPLOY
==========================

//Utk web
$str = $_SERVER['PHP_SELF'];
$split = explode("/", $str);

define("ROOT_DIR", '/' . $split[1] . '/');
*/

include_once 'DBConfig.php';
include_once 'client.php';
?>