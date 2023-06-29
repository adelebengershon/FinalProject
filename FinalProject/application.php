<?
	
	session_start();
	include_once "settings.php";
	global $config;
	global $db;
	
	
	include_once $config->filepath."apps/dblib.php";
	include_once $config->filepath."apps/agents.php";
	include_once $config->filepath."apps/asset_category.php";
	include_once $config->filepath."apps/assets.php";
	include_once $config->filepath."apps/categories.php";
	include_once $config->filepath."apps/contact_us.php";
	include_once $config->filepath."apps/subscriptions.php";
	include_once $config->filepath."apps/admin_users.php";
	
	$db = new DB($config->servername, $config->dbname, $config->dbUsername, $config->dbPassword);	

?>