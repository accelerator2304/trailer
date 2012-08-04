<?php
class Loader extends GlobalSettings{

	
	var $UTILS = array(
		'modules/router/route',
		'modules/router/router',
		'modules/activerecord/ActiveRecord',
		'modules/logger/logger',
		'core',
		'database',
		'controller',
		'utils'
	);

	/* Class methods */

	function __construct(){
		$this->RequireEnvironment();
		$this->RequireUtils();
		$this->RequireCore();
	}

	function RequireCore(){
		require_once ($this->PATH.'/routes.php');
	}

	function RequireEnvironment(){
		require_once ($this->PATH.'/config/environments/'.$this->ENVIRONMENT.'.php');
	}

	function RequireUtils(){
		foreach ($this->UTILS as $value) {
			require_once($this->PATH . "/trailer/$value.php");
		}
	}
}

function autoloader($class){
	if(!class_exists($class)){
		
		$class = strtolower($class);
		

		if(substr_count($class,'controller') != 0){
			$class = str_replace('controller','_controller',$class);
			require_once "app/controllers/$class.php";
		}

	}
}

spl_autoload_register(autoloader,false,false);
?>