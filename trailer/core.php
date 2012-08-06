<?php
class Core extends EnvSettings{

	private $VIEWS_TMP_PATH = '/tmp/views/';
	private $VIEWS_APP_PATH = '/app/views/';

	function __construct(){
		Log::init($this->LOGGER_SETTINGS);
	}



	function render($template = null,$params = array(),$options = null){

		$this->data = $params;
		$this->get_views_templates_dir();
		$this->get_compiled_views_path();

		$this->check_tmp_views_dir();

		$this->VIEWS_COMPILED_TEMPLATE = TemplateAdapter::render($this->get_sourse_template());

		$books[]='sdf';
		$books[]='saddf';

		$this->less_compile($this->VIEWS_TEMPLATES_DIR);
		$this->coffee_compile($this->VIEWS_TEMPLATES_DIR);
		
		if($this->save_compiled_template() == true){
			require_once $this->TEMPLATE_ABSOLUTE_PATH;
		}
		
	}

	function render_development(){

	}

	function render_production(){

	}

	function render_layout(){

	}

	function render_partial(){
		
	}

	function get_views_templates_dir(){
		$this->VIEWS_TEMPLATES_DIR  =	strtolower(str_replace('Controller','',get_class($this)));
	}


	function get_sourse_template($template = null){
		if (!$template){
			return file_get_contents($this->PATH.$this->VIEWS_APP_PATH.$this->VIEWS_TEMPLATES_DIR.'/index.'.strtolower($this->TEMPLATE_ENGINE));
		}
	}

	function get_compiled_template(){
		try{
			return file_get_contents($this->PATH.$this->VIEWS_TMP_PATH.$this->VIEWS_TEMPLATES_DIR.'/index'.'.php');		
		}
		catch(Exception $e){
			return false;
		}
	}

	function save_compiled_template(){
		try{
			$this->TEMPLATE_ABSOLUTE_PATH = $this->PATH.$this->VIEWS_TMP_PATH.$this->VIEWS_TEMPLATES_DIR.'/index'.'.php';
			file_put_contents($this->TEMPLATE_ABSOLUTE_PATH,$this->VIEWS_COMPILED_TEMPLATE);
			return true;
		}
		catch(Exception $e){
			return false;
		}
	}

	function get_compiled_views_path(){
		$this->COMPILED_VIEWS_PATH = $this->PATH.$this->VIEWS_TMP_PATH.$this->VIEWS_TEMPLATES_DIR;
	}

	function check_tmp_views_dir(){
		if (!file_exists($this->COMPILED_VIEWS_PATH) or !is_dir($this->COMPILED_VIEWS_PATH)){
			mkdir($this->COMPILED_VIEWS_PATH);
		}

	}

	function coffee_compile($filename){
		require_once ($this->PATH.'/trailer/modules/coffeescript/src/CoffeeScript/Init.php');


		CoffeeScript\Init::load();

		try
		{
		  $coffee = file_get_contents($this->PATH."/app/assets/javascripts/$filename.coffee");

		  // See available options below.
		  $js = CoffeeScript\Compiler::compile($coffee, array('filename' => $file));

		  file_put_contents($this->PATH."/tmp/assets/javascripts/$filename.js", $js);
		}
		catch (Exception $e)
		{
		  echo $e->getMessage();
		}
	}


	function less_compile($filename){
		require_once $this->PATH.'/trailer/modules/less/lessc.inc.php';

		try {
		    lessc::ccompile($this->PATH."/app/assets/stylesheets/$filename.less", $this->PATH."/tmp/assets/stylesheets/$filename.css");
		    return true;
		} catch (exception $ex) {
			Log::error('lessc fatal error: '.$ex->getMessage());
		    return ('lessc fatal error: '.$ex->getMessage());
		}
	}

}
?>