<?php
class Core extends EnvSettings{



	function __construct(){
		Log::init($this->LOGGER_SETTINGS);
	}



	function render($template = null,$params = null,$options = null){

		$this->choose_views_directory();

		$books[] = 'asdf';

		switch ($this->TEMPLATE_ENGINE) {
			case 'Jade':
			
			    $parser = new lib\Parser(new lib\Lexer());
			    $dumper = new lib\Dumper();

			    $jade = new Jade($parser, $dumper);

			    
			    echo $jade->render($this->get_template($template));


				break;

			case 'Haml':

				  $haml = new Haml();
				  $html_code = $haml->parse($this->get_template($template));
				  
				  echo $html_code;

				break;
		}
	}

	function get_template($template = null){
		if (!$template){
			$this->templates_dir  =	strtolower(str_replace('Controller','',get_class($this)));
			return file_get_contents($this->VIEWS_DIR.$this->templates_dir.'/index.jade');
		}
	}

	function save_parsed_template(){

	}

	function choose_views_directory(){
		if($this->ENVIRONMENT == 'development'){
			$this->VIEWS_DIR = $this->PATH.'/app/views/';
		}
		else{
			$this->VIEWS_DIR = $this->PATH.'/tmp/views/';
		}
	}
}
?>