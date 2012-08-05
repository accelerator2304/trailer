<?php
class ApplicationController extends Controller{
	
	#protected $before_filter = array('bue');

	function __construct(){
		parent::__construct();
	}

	function bue(){
		print 'Bue!';
		
		#ChromePhp::log(
		Log::info(1,'production');
	}
}
?>