<?php

class Database {
	var $dbhost;
	var $dbuser;
	var $dbpass;
	var $dbname;
	var $page;
	
	/**
	 * Defines the defaults
	 */
	function Database() {
		$this->version = $this->getVersion();
		
		$this->dbhost = "localhost";
		$this->dbuser = "balconesshred";
		$this->dbpass = "V9N3zV6hVb5D";
		$this->dbname = "balconesshred";
		
		/*
		$this->dbhost = "localhost";
		$this->dbuser = "balcones";
		$this->dbpass = "rjb64_6bfq";
		$this->dbname = "balcones";
		*/
		
		$this->useUTF8 = true;
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Database Class";
		$major = "0";
		$minor = "1";
		$rev   = "3";
		$build = "0003";
		
		$shortnumber = "$major.$minor";
		$longnumber  = "$major.$minor.$rev ($build)";
		
		return array(
			"name" => $name,
			"major" => $major,
			"minor" => $minor,
			"rev" => $minor,
			"build" => $build,
			"shortnumber" => $shortnumber,
			"longnumber" => $longnumber,
			"short" => "SC $name $shortnumber",
			"long" => "Stratosphere Creative $name, version $longnumber",
			"lastmodified" => "January 31, 2008",
			"author" => "Mark B. Priddy"
		);
	}
	
	function convertToDate($rawvalue) {
		$timestamp = strtotime($rawvalue);
		$output = date("Y-m-d",$timestamp);
		
		return $output;
	}
	
	function convertToDatetime($rawvalue) {
		$timestamp = strtotime($rawvalue);
		$output = date("Y-m-d H:i:s",$timestamp);
		
		return $output;
	}
	
	/**
	 * Set a reference to my page so this instance can call its page's functions
	 */
	function setPage($thePage) {
		$this->page = $thePage;
		$this->page->addVersItem($this->version);
	}
	
	function prepVariable($theVariable) {
		if (get_magic_quotes_gpc()) {
			$theValue = mysql_escape_string(stripslashes($theVariable));
		} else {
			$theValue = mysql_escape_string($theVariable);
		}
		
		return $theValue;
	}
	
	function getResults($theQuery) {
		$dbhost = $this->dbhost;
		$dbuser = $this->dbuser;
		$dbpass = $this->dbpass;
		$dbname = $this->dbname;
	
		$db = mysql_connect($dbhost,$dbuser,$dbpass) or die("Connection failed.");
		if ($this->useUTF8) {
			mysql_query("SET NAMES 'utf8'",$db);
		}
		mysql_select_db($dbname) or die("Could not select database.");
		$theResult = mysql_query($theQuery,$db);
		mysql_close($db);
		
		return $theResult;
	}
}

?>
