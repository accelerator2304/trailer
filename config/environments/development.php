<?php

class EnvSettings extends GlobalSettings{


	protected $MAILER_SETTINGS = array(
		'type' 		=> 'sendmail',	#sendmail or smtp
		'smtp_host' => '',
		'smtp_port' => '',
		'smtp_user' => '',
		'smtp_pass' => '',
		'smtp_ssl'	=> false

	);

	protected $LOGGER_SETTINGS = array(
		'stdout'  => false,
		'file'    => true,
		'browser' => true,
		'dir'     => 'log/',
		'env'     => 'development'
		);

}


?>