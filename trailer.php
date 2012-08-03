<?php
require_once 'settings.php';
require_once 'trailer/core.php';


$Core = new Core();


function __autoload($class){
	if(!class_exists($class)){
		
		$class = strtolower($class);
		

		if(substr_count($class,'controller') != 0){
			$class = str_replace('controller','_controller',$class);
			require_once "controllers/$class.php";
		}

	}
}


