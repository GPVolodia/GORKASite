<?php session_start();?>
<?php
if($_GET['language']) 
{
	$_SESSION['lang'] = $_GET['language'];
	header('Location: /news');
}
if (!$_SESSION['user_id'])
	$_SESSION['lang'] = "ua";
//error_reporting(0);
define('ROOT', dirname(__FILE__));
define('DEVMODE', true);

require_once ROOT . '/components/Autoload.php';

$router = new Router();
$router->run();