<?php
require 'settings.php';

class Migrate extends DbSettings{
	function __construct($argv){

		date_default_timezone_set($this->TIMEZONE);

		define('RUCKUSING_DB_DIR', $this->PATH . '/db');
		define('RUCKUSING_BASE', $this->PATH . '/trailer/modules/migrations' );

		//requirements
		require RUCKUSING_BASE . '/lib/classes/util/class.Ruckusing_Logger.php';
		require RUCKUSING_BASE . '/lib/classes/class.Ruckusing_FrameworkRunner.php';

		$ruckusing_db_config = array(
			'development' => $this->DEVELOPMENT,
			'test'		  => $this->TEST,
			'production'  => $this->PRODUCTION
		);

		$main = new Ruckusing_FrameworkRunner($ruckusing_db_config, $argv);
		$main->execute();
	}
}

$Migrate = new Migrate($argv);




?>