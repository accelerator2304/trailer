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
		
		$this->RequireRenderEngine();
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
			$this->RequireUtil($value);
		}
	}

	function RequireRenderEngine(){
		switch ($this->TEMPLATE_ENGINE) {
			case 'Jade':
					$this->RequireUtil('modules/jade/Jade');
					$this->RequireUtil('modules/jade/lib/Parser');
					$this->RequireUtil('modules/jade/lib/Dumper');
					$this->RequireUtil('modules/jade/lib/Lexer');
					$this->RequireUtil('modules/jade/lib/node/Node');
					$this->RequireUtil('modules/jade/lib/node/DoctypeNode');
					$this->RequireUtil('modules/jade/lib/node/FilterNode');
					$this->RequireUtil('modules/jade/lib/node/BlockNode');
					$this->RequireUtil('modules/jade/lib/node/TagNode');
					$this->RequireUtil('modules/jade/lib/node/TextNode');
					$this->RequireUtil('modules/jade/lib/node/CodeNode');
				break;
			case 'Haml':
					$this->RequireUtil('modules/haml/lib/haml');
				break;
		}
	}

	function RequireUtil($util){
		require_once($this->PATH . "/trailer/$util.php");
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