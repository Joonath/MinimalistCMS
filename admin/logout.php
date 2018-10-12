<?php
//echo '<meta http-equiv="refresh" content="1; index.php" />';
if(isset($_COOKIE['sess'])) unset($_COOKIE['sess']);
if(isset($_COOKIE['addr'])) unset($_COOKIE['addr']);
if(isset($_COOKIE['PHPSESSID'])) unset($_COOKIE['PHPSESSID']);

setcookie('sess', null, -1, '/');
setcookie('addr', null, -1, '/');
setcookie('PHPSESSID', null, -1, '/');

session_unset();
session_destroy();

die('<meta http-equiv="refresh" content="0; index.php" />');
?>