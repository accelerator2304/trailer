<?php

class DbSettings extends GlobalSettings{

	/* DATABASE SETTINGS */

	protected $DEVELOPMENT = array(
		'adapter' => 'mysql',
		'host'    => 'localhost',
		'user' 	  => 'root',
		'pass'    => '',
		'base'    => 'trailer_development',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

	protected $PRODUCTION = array(
		'adapter' => 'mysql',
		'host'    => 'localhost',
		'user' 	  => 'root',
		'pass'    => '',
		'base'    => 'trailer_production',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

	protected $TEST = array(
		'adapter' => 'mysql',
		'host'    => 'localhost',
		'user' 	  => 'root',
		'pass'    => '',
		'base'    => 'trailer_production',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

}

class GlobalSettings{
	var $PATH = __DIR__;
	var $APP_NAME = 'Trailer';
}
?>