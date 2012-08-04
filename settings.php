<?php

class DbSettings extends GlobalSettings{

	/* DATABASE SETTINGS */

	protected $DEVELOPMENT = array(
		'type'    => 'mysql',
		'host'    => 'localhost',
		'port'    => 3306,
		'user' 	  => 'root',
		'password'=> '',
		'database'=> 'trailer_development',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

	protected $PRODUCTION = array(
		'type'    => 'mysql',
		'host'    => 'localhost',
		'port'    => 3306,
		'user' 	  => 'root',
		'password'=> '',
		'database'=> 'trailer_production',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

	protected $TEST = array(
		'type' 	  => 'mysql',
		'host'    => 'localhost',
		'port'    => 3306,
		'user' 	  => 'root',
		'password'=> '',
		'database'=> 'trailer_production',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

}

class GlobalSettings{

	var $PATH = __DIR__;
	var $APP_NAME = 'Trailer';
	var $TIMEZONE = 'Europe/Moscow';

	function __construct(){
		date_default_timezone_set($TIMEZONE);
	}
}
?>