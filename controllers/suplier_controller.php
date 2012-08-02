<?php 
class SuplierController extends Controller{


	var $after_filter = array('bue');	

	function index($params){
		print ('hello '.$params['id']);
	}

	function bue(){
		echo 'Bue!';
	}
}
?>