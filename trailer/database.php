<?php
class Database{
	protected $DB_SETTINGS;

	function __construct($SETTINGS){
		
		$this->DB_SETTINGS = $SETTINGS->get('DB_SETTINGS');

		require_once ("db_adapters/".$this->DB_SETTINGS['adapter'].".php");
	}

	function Migrate(){
		if($this->DB_SETTINGS['migrate']){
			require_once 'migrarion.php';
		}
	}
}
?>