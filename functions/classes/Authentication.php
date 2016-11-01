<?php 

include_once('classes.php');

class Authentication{

	public $EmployeeID;
	function __construct(){
		@session_start();
		if($this->loggedIn()){
			$this->EmployeeID = $_SESSION['EmpID'];
		}
	}

	function getUser(){
		return new User($this->EmployeeID);
	}

	function check(){
		if(!$this->loggedIn()){
			if(isset($_SERVER['HTTPS'])){
				header('Location: ' . $_SERVER['HTTPS'] == 'on' ? 
					"https://" .  $_SERVER['HTTP_HOST'] :
					"http://" .  $_SERVER['HTTP_HOST']
				);
				die();
			}
			header('Location: http://' . $_SERVER['HTTP_HOST']);
			die();
		}
	}

	function logout(){
		@session_start();
		if(isset($_SESSION)){
			unset($_SESSION);
		}
		@session_destroy();
		$this->check();
	}

	function loggedIn(){
		@session_start();
		$a = isset($_SESSION['rnd']);
		$a = $a && isset($_SESSION['hashEmpID']);
		$a = $a && isset($_SESSION['EmpID']);
		return $a;
	}
}


$auth = new Authentication();