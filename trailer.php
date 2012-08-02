<?php

require_once 'settings.php';


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

$SETTINGS = new Settings();

$DB = new Database($SETTINGS);



