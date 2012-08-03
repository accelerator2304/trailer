<?php

function __autoload($class){
	if(!class_exists($class)){
		
		$class = strtolower($class);
		

		if(substr_count($class,'controller') != 0){
			$class = str_replace('controller','_controller',$class);
			require_once "controllers/$class.php";
		}
		else{
			require_once "models/$class.php";
		}
	}
}

class Core{

	var $PATH  = '';
	
	var $UTILS = array(
		'database',
		'migration',
		'route',
		'router',
		'controller',
		'model',
		'utils'
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
}
?>