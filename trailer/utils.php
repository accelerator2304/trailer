<?php
class T{

	# executes class#action(params)
	
	static public function exec($var,$params = null){
		$var = explode('#',$var);
		$class = new $var[0]();
		$class->$var[1]($params);
	}
}
?>