<?php 
class SuplierController extends Controller{


	var $after_filter = array('bue');	

/*
	function index($params){
		print ('hello  '. $this->model);
	}
*/
	function bue(){
		echo 'Bue!';
	}
}
?>