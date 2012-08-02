<?php

Class Model{

	var $Object;
	protected $Db;
	protected $Entity;
	protected $Debug;
	protected $Schema;

	function __construct($Object,&$DB){
		$this->Object = $Object;
		$this->Db  = $Database;
		$this->init();
	}

	function init(){

		$this->Entity = get_called_class();
		$this->Table  = strtolower($this->Entity).'s';
		print($this->Table);
	}
	
	function get(){

	}

	function get_all(){

	}

	function set(){

	}

	function set_all(){

	}


}
?>