<?php
class T{

	# executes class#action(params)

	static public function exec($var,$params = null,$settings = null){
		$var = explode('#',$var);
		$class = new $var[0]($settings);
		$class->$var[1]($params);
	}
}
?>