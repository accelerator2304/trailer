<?php
/**
 * Logger with stdout, file and remote logging facilities
 *
 * @package	logger
 * @author	Ilya I
 * @copyright	2012
 * @version	0.1
 */
class Log {
	
	// Socket connection
	protected static	$conn;
	
	// Main configuration
	protected static	$config;
	
	// Default Main configuration
	protected static	$defaultConfig = array(
		'stdout'  => false,
		'file'    => true,
		'browser' => true,
		'dir'     => 'log/',
		'env'     => 'development'
		);

	/**
	 * Initialization 
	 *
	 * @param	array	$config
	 * @return	bool
	 */
	public static function init(array $config = array()) {

		// static::$config = json_decode(json_encode(array_merge(static::$config, $config)));
		
		static::$config = array();
		foreach (static::$defaultConfig as $i => $v) {
			if (isset($config[$i])) {
				static::$config[$i] = $config[$i];
			} else {
				static::$config[$i] = static::$defaultConfig[$i];
			}
		}
		// var_dump(static::$config);
		return true;
		
	}

	/**
	 * Deinitialization 
	 *
	 * @return	void
	 */
	public static function close() {
		
		@fclose(static::$conn);
		
	}

	/**
	 * Log shorthand, notice priority 
	 *
	 * @param	string	$message
	 * @return	void
	 */
	public static function info($message,$env = null) {
		if(!$env or $env == static::$config['env']){
			return static::logger($message, E_USER_NOTICE);
		}
	}

	/**
	 * Log shorthand, warning priority 
	 *
	 * @param	string	$message
	 * @return	void
	 */
	public static function warn($message,$env = null) {
		if(!$env or $env == static::$config['env']){
			return static::logger($message, E_USER_WARNING);
		}
	}

	/**
	 * Log shorthand, error priority 
	 *
	 * @param	string	$message
	 * @return	void
	 */
	public static function error($message,$env = null) {
		
		if(!$env or $env == static::$config['env']){
			return static::logger($message, E_USER_ERROR);
		}
	}
	
	/**
	 * Convert arguments to strings and log composed message 
	 *
	 * @param	mixed	...
	 * @return	void
	 */
	public static function dump($data) {

		$args = func_get_args();
		
		foreach ($args as $key => $arg) {
			if (is_array($args) || is_object($args)) {
				$args[$key] = print_r($arg, true);
			} else {
				$args[$key] = var_dump($arg, true);
			}
		}
		
		return static::log(implode("\n", $args));
		
	}
	
	/**
	 * Log message according to the configuration with doing required preparations
	 *
	 * @param	string	$message
	 * @param	int		$level 
	 * @return	void
	 */
	public static function logger($message, $level = E_USER_NOTICE) {

		if (!(error_reporting() & $level))
			return;		// this message should be supressed
		
		$prefix = sprintf("[%s] [%-10s] ", date("Y-m-d H:i:s"), static::getLevelName($level));
		
		if (strpos($message, "\n") !== false) {
			// Multiline message
			$msg = str_pad("==== {$prefix}", 80, "=");
			$msg .= "\n{$message}\n";
			$msg .= str_pad("", 80, "=")."\n";
		} else {
			// Singleline message
			$msg = "{$prefix} {$message}\n";
		}
		
		if (static::$config['stdout']) {
			
			$contentType = array_filter(headers_list(), function($value) {
				return (stripos($value, 'Content-Type') !== false);
			});
			$contentType = ($contentType ? array_shift($contentType) : "");

			if ($contentType && stripos($contentType, 'html') !== false) {
				// HTML
				$html = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
				if (!$html) {
					// manual escaping
					$html = str_replace(
						array('&', '"', '\'', '<', '>'), 
						array('&amp;', '&quot;', '&apos;', '&lt;', '&gt;'),
						$msg);
				}
				echo "\n<pre>\n".$html."</pre>\n";
			} else {
				// Plain text
				echo $msg;
			}
			
			flush();
			
		}

		
		if (static::$config['file']) {
			
			$dir =  static::$config['dir'];
			$env =  static::$config['env'];
			
			if (is_dir($dir) && is_writable($dir)) {
				$file = $dir."/".$env.".log";
				@error_log($msg, 3, $file);
			}
			
		}

	}

	/**
	 * Get string representation of predefined error level
	 *
	 * @param	const	Error Level Constant
	 * @return	string
	 */
	public static function getLevelName($level) {
		
		switch ($level) {
			case E_USER_NOTICE:
				return "NOTICE";
			case E_USER_WARNING:
				return "WARNING";
			case E_USER_ERROR:
				return "ERROR";
			case E_NOTICE:
				return "NOTICE";
			case E_WARNING:
				return "WARNING";
			case E_ERROR:
				return "ERROR";
			case E_PARSE:
				return "PARSE";
			case E_STRICT:
				return "STRICT";
			case E_DEPRECATED:
				return "DEPRECATED";
			default:
				return "#{$level}";
		}
		
	}

}

?>