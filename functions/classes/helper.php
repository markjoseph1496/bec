<?php 

define('HELPER_PHP', 1);

if(!function_exists('url')){
	function url($path = ''){
		if(isset($_SERVER['HTTPS'])){
			return $_SERVER['HTTPS'] == 'on' ? 
				"https://" .  $_SERVER['HTTP_HOST'] . '/' . $path:
				"http://" .  $_SERVER['HTTP_HOST'] . '/' . $path;
		}else{
			return "http://" .  $_SERVER['HTTP_HOST'] . '/' . $path;
		}
	}
}