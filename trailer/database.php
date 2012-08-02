<?php
class Database extends DbSettings{
	
	function __construct(){
		
		

		require_once ("db_adapters/".$this->DB_SETTINGS['adapter'].".php");
	}

	function Migrate(){
		if($this->DB_SETTINGS['migrate']){
			require_once 'migrarion.php';
		}
	}
}
?>