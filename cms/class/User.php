<?php

class User {
	
	function User() {
		// initialize variables
		$this->loggedIn = false;
		$this->redirect = true;
		$this->outURL   = "/cms/";
		
		// check to see if this was called with arguments
		if (func_num_args() == 1) {
			if (func_get_arg(0) == "no redirect") {
				$this->redirect = false;
			}
		}
		
		// start the session
		session_start();
		$this->checkLogin();
	}
	
	function isLoggedIn() {
		return $this->loggedIn;
	}
	
	function completed() {
		if ($this->redirect) {
			header("location: $this->outURL");
		}
	}
	
	function checkLogin() {
		if (isset($_SESSION['userID'])) {
			$this->loggedIn = true;
			$this->id       = $_SESSION['userID'];
			$this->fullname = $_SESSION['fullname'];
			//$this->level    = $_SESSION['userlevel'];
		} else {
			$this->loggedIn = false;
			$this->id       = "undefined";
			$this->fullname = "undefined";
			//$this->level    = "undefined";
			$this->completed();
		}
	}
	
	function login($user, $pass) {
		require_once("Database.php");
		$database = new Database;
		
		// construct query
		$md5pass = md5($pass);
		$user = $database->prepVariable($user);
		$loginQuery = "SELECT * FROM cmsusers ".
		"WHERE username = '$user' " .
		"AND password = '$md5pass'";
		
		// execute query
		$loginResults = $database->getResults($loginQuery);
		
		// check the results
		if (mysql_num_rows($loginResults) == 1) { // found exactly one match
			$this->loggedIn = true;
			$row = mysql_fetch_assoc($loginResults);
			$_SESSION['userID']    = $row['username'];
			$_SESSION['fullname']  = $row['fullname'];
			//$_SESSION['userlevel'] = $row['userlevel'];
		}
		
		$this->redirect = true;
		$this->completed();
	}
	
	function logout() {
		if ($this->isLoggedIn()) {
			$this->loggedIn = false;
			unset($_SESSION['userID']);
			unset($_SESSION['fullname']);
			//unset($_SESSION['userlevel']);
		}
		$this->completed();
	}
}

?>