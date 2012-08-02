<?php

class Settings{

	var $PATH  = '';
	
	/* DATABASE SETTINGS */

	var $DB_SETTINGS = array(
		'adapter' => 'mysql',
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_pass' => '',
		'db_name' => 'trailer',
		'prefix'  => 'nectarin_',
		'debug'   => false,
		'migrate' => true
	);

	/* Utils list */

	var $UTILS = array(
		'database',
		'migration',
		'route',
		'router',
		'controller',
		'model',
		'utils'
	);

	/* Routers */

	var $ROUTERS = array(


	);

	/* Class methods */

	function __construct(){
		$this->RequireUtils();
		$this->RequireCore();
	}

	function RequireCore(){
		require_once ($this->PATH.'routes.php');
	}

	function RequireUtils(){
		foreach ($this->UTILS as $value) {
			require_once($this->PATH . "trailer/$value.php");
		}
	}

	function get($parameter){
			return $this->$parameter;
		
	}

}

?>