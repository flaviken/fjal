<?php 

	define("dbserver", "wm117.wedos.net");

	define("dbuser", "a132515_honzik");

	define("dbpass", "Nvhgvrft");

	define("dbname", "d132515_honzik");



	global $db;
	$db = new PDO(

		"mysql:host=" .dbserver. ";dbname=" .dbname,dbuser,dbpass,

			array(

				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",

				PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"

			)

	);
    date_default_timezone_set('Europe/Amsterdam');
?>