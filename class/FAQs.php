<?php

class FAQs {
	function FAQs() {
		require_once("Database.php");
		$this->database = new Database();
		
		$this->defineData();
		
		if (isset($_GET['id'])) {
			$this->id = $_GET['id'];
		} else {
			$this->id = 1;
		}
	}
	
	function getHTMLList() {
		$this->defineData();
		
		$theHTML = "";
		$theHTML .= "Rows: " . mysql_num_rows($this->results) . "<br>\n";
		while ($row = mysql_fetch_assoc($this->results)) {
			$question = $row['question'];
			
			$theHTML .= "$question<br>\n";
		}
		
		return $theHTML;
	}
	
	function getHTML() {
		$theHTML = "";
		
		$theHTML .= "Rows: " . mysql_num_rows($this->results) . "<br>\n";
		while ($row = mysql_fetch_assoc($this->results)) {
			$theHTML .= "row: ";
			if ($row['id'] == $this->id) {
				$theHTML .= "Row id: " . $row['id'] . "«<br>\n";
			} else {
				$theHTML .= "Row id: " . $row['id'] . "<br>\n";
			}
		}
		
		return $theHTML;
	}
	
	function defineData() {
		$query  = "SELECT * FROM `faqs` ";
		$query .= "ORDER BY `sort` ";
		$this->results = $this->database->getResults($query);
	}
}

?>