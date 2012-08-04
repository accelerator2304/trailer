<?php

class EnvSettings extends GlobalSettings{

	protected $MAILER_SETTINGS  = array(
		'type' 		=> 'sendmail',	
		'smtp_host' => '',
		'smtp_port' => '',
		'smtp_user' => '',
		'smtp_pass' => '',
		'smtp_ssl'	=> false
	);

	protected $LOGGER_SETTINGS = array(
		'stdout' => array(
			'active' => false 
		),
		'file' => array(
			'active' => true,
			'dir' => 'log/'
		),
		'remote' => array(
			'active' => false,
			'hostname' => '',
			'port' => 0,
			'timeout' => 10
		)
	);

}


?>