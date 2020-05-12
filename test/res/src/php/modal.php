<?php
setcookie('cross-site-cookie', 'name', ['samesite' => 'None', 'secure' => true]);
session_start();

require_once 'support/configuration.php';
require_once 'classes/autoloader.php';
require_once 'view.php';

$Admin = new Admin();
$User = new safeUser();
