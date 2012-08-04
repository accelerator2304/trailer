<?php
class Controller{

	protected $before_filter;
	protected $after_filter;
	protected $model;
	private $settings;

	function __construct(){
		$this->initialization();
		$this->before_filter();
		
	}

	function __destruct(){
		$this->after_filter();
	}

	function initialization(){
		$this->db = new Database();
		$this->GetModelName();
	}

	# Controller filters

	function before_filter(){
		if(!empty($this->before_filter)){
			$this->filter($this->before_filter);
		}
	}

	function after_filter(){
		if(!empty($this->after_filter)){
			$this->filter($this->after_filter);
		}
	}

	function filter($array){
		foreach ($array as $value) {
			if(method_exists($this,$value)){
				$this->$value();
			}
			else{
				T::exec($value);
			}
		}
	}

	# rest actions

	function index($params){
		$Objects = new $this->model();
		$Objects = $Objects->all();

		print_r($Objects[1]->id);
	}

	function show($params){

	}

	function _new($params){

	}

	function create($params){

	}

	function edit($params){

	}

	function update($params){

	}

	function destroy($params){

	}

	# functions - utils

	function GetModelName(){
		$this-> model = str_replace('Controller','',get_class($this));
	}

}
?>