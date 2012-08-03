<?php
class Database extends DbSettings{

	function __construct(){
		
		$connections = array(
				'development' => $this->DEVELOPMENT['adapter'].'://'.$this->DEVELOPMENT['user'].':'.$this->DEVELOPMENT['pass'].'@'.$this->DEVELOPMENT['host'].'/'.$this->DEVELOPMENT['base'],
				'production' => $this->PRODUCTION['adapter'].'://'.$this->PRODUCTION['user'].':'.$this->PRODUCTION['pass'].'@'.$this->PRODUCTION['host'].'/'.$this->PRODUCTION['base'],
				'test' => $this->TEST['adapter'].'://'.$this->TEST['user'].':'.$this->TEST['pass'].'@'.$this->TEST['host'].'/'.$this->TEST['base']
		);

		ActiveRecord\Config::initialize(function($cfg) use ($connections){


		    $cfg->set_model_directory('app/models');
		    $cfg->set_connections($connections);

			// you can change the default connection with the below
		    //$cfg->set_default_connection('production');
			});
	}
}
?>