<?php
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