<?php


class TemplateAdapter{
	public static function render($template){

		require_once (__DIR__.'/../modules/haml/lib/haml.php');
		
		$haml = new Haml();
		return $haml->parse($template);	
	}


}
?>