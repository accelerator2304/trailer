<?php

	class Mysql extends Database{

	function __construct($debug = false){
		
		require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/dbconn.php';
		
		if(empty($DBName)){
		
		$DBName = 'bitrix';
		$DBHost = "localhost";
		$DBLogin = "root";
		$DBPassword = "";
		
		}
		$this->link = 	mysql_connect($DBHost, $DBLogin, $DBPassword,$DBName) ;
		$this->debug=   $debug;
		mysql_select_db($DBName,$this->link); 
		mysql_query("SET NAMES 'utf8';");
	
		
	}

	function query($query){
		
		$this->result = mysql_query($query);
		$this->q[] = $query ;
		#echo $query.'<br/>';
		return $this->result;
	}

	function fetch($query){

		$return = $this->query($query);

		$array = array();

		if($this->rows() > 0){
		#echo 'true<br/>';
		while($row = mysql_fetch_assoc($return))
			{
			array_push($array, $row);
			}

		}
		else{
		#echo 'false<br/>';
		}
		return $array; 
	}
	
	function smart_fetch($query,$id){
		$return = $this->query($query);

		$array = array();

		if($this->rows() > 0){
		#echo 'true<br/>';
		while($row = mysql_fetch_assoc($return))
			{
			$array[$row[$id]] = $row;
			}

		}
		else{
		#echo 'false<br/>';
		}
		return $array; 
	}

	function check(){
		return mysql_affected_rows($this->link);
	}

	function rows(){
		return mysql_num_rows($this->result);
	}

	function free(){
		mysql_free_result($this->result);
	}

	function close(){
		mysql_close($this->link);
	}

	function info(){
		$return = mysql_stat($this->link);
	return $return;	
	}

	function error() {
		$return = $this->error[] = mysql_error($this->link);
	return $return;
	}
	
	function last(){
		$return = mysql_insert_id($this->link);
	return $return;
	}
	
	function __destruct(){
		$A = mysql_error($this->link);
		if(!empty($A)){
			print_r($this->error);
			print_r($this->q);
		}
		
		if($this->debug){
			print_r($this->error);
			print_r($this->q);
		}
	}
}

?>