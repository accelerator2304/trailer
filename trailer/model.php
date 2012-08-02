<?php

Class Model{

	var $Object;
	protected $Db;
	protected $Entity;
	protected $Debug;
	protected $Schema;

	function __construct($Object = null){
		$this->Object = $Object;
		$this->Db  = $Database;
		$this->init();
	}

	function init(){
		$this->Table  = strtolower($this->Entity);
	}

	function all(){
		echo 'all';
	}

	function first(){

	}

	function last(){

	}

	function find(){

	}

	function count(){

	}

	function select($array){
		$this->select = $array;
	}

	function order($string){
		$this->order = $string;
	}

	function limit($string){
		$this->limit = $string;
	}

}
?>