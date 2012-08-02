<?php
class Controller{

	protected $before_filter;
	protected $after_filter;

	function __construct(){
		$this->before_filter();
	}

	function __destruct(){
		$this->after_filter();
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

	}

	function new($params){

	}

	function create($params){

	}

	function edit($params){

	}

	function update($params){

	}

	function destroy($params){

	}
}
?>