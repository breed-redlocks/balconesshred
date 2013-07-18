<?php

class Content {
	function Content() {
		require_once("Database.php");
		$this->database = new Database();
		
		require_once("Textile.php");
		$this->textile = new Textile();
		
		$this->defaultFieldValue = "Balcones Shred";
		
		$this->showNotes = false; // outputs notes field to page
		$this->showName  = false; // outputs title field to page
	}
	
	function getText($which) {
		$query  = "SELECT * FROM `content` ";
		$query .= "WHERE `id` = '$which' ";
		$query .= "LIMIT 1";
		
		$results = $this->database->getResults($query);
		$row = mysql_fetch_assoc($results);
		$title = $row['title'];
		
		$theText = $row['text'];
		
		return $theText;
	}
	
	function getHTML($which) {
		$query  = "SELECT * FROM `content` ";
		$query .= "WHERE `id` = '$which' ";
		$query .= "LIMIT 1";
		
		$this->seekName  = "id";
		$this->seekValue = $which;
		$results = $this->database->getResults($query);
		
		return $this->getHTMLEntry($results);
	}
	
	function getHTMLByName($which) {
		$query  = "SELECT * FROM `content` ";
		$query .= "WHERE `name` = '$which' ";
		$query .= "LIMIT 1";
		
		$this->seekName  = "name";
		$this->seekValue = $which;
		$results = $this->database->getResults($query);
		
		return $this->getHTMLEntry($results);
	}
	
	function getField($field, $which) {
		$query  = "SELECT `$field` FROM `content` ";
		$query .= "WHERE `name` = '$which' ";
		$query .= "LIMIT 1";
		
		$results = $this->database->getResults($query);
		$row = mysql_fetch_assoc($results);
		
		if ($row[$field] == "") {
			$theValue = $this->defaultFieldValue;
		} else {
			$theValue = $row[$field];
		}
		
		return $theValue;
	}
	
	function getHTMLEntry($results) {
		$row = mysql_fetch_assoc($results);
		
		$theHTML  = "";
		
		if ($this->showName) {
			$theHTML .= "<h1>{$row['name']}</h1>\n";
		}
		
		if ($row['text'] == "") {
			$name  = $this->seekName;
			$value = $this->seekValue;
			$theHTML .= "No content with the $name “{$value}” was found in the CMS.";
		} else {
			$theHTML .= $this->textile->TextileThis($row['text']) . "\n\n";
		}
		
		if ($this->showNotes) {
			$theHTML .= "<p class=\"notes\">{$row['notes']}</p>\n";
		}
		
		return $theHTML;
	}
}

?>