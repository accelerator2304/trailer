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

	protected $LOGGER_SETTINGS =array(
		'stdout'  => false,
		'file'    => true,
		'browser' => false,
		'dir'     => 'log/',
		'env'     => 'production'
		);

}


?>