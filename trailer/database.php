<?php
class Database extends DbSettings{

	function __construct(){
		
		$connections = array(
				'development' => $this->DEVELOPMENT['type'].'://'.$this->DEVELOPMENT['user'].':'.$this->DEVELOPMENT['password'].'@'.$this->DEVELOPMENT['host'].'/'.$this->DEVELOPMENT['database'],
				'production' => $this->PRODUCTION['type'].'://'.$this->PRODUCTION['user'].':'.$this->PRODUCTION['password'].'@'.$this->PRODUCTION['host'].'/'.$this->PRODUCTION['database'],
				'test' => $this->TEST['type'].'://'.$this->TEST['user'].':'.$this->TEST['password'].'@'.$this->TEST['host'].'/'.$this->TEST['database']
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