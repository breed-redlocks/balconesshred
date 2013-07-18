<?php

class Testimonials {
	function Testimonials() {
		require_once("Database.php");
		$this->database = new Database();
		
		require_once("Textile.php");
		$this->textile = new Textile();
		
		$this->detail = "/testimonial.html";
		$this->listDateFormat = "M j, Y";
		$this->detailDateFormat = "l, F j, Y";
		
		if (isset($_GET['id'])) {
			$this->currentID = $_GET['id'];
		}
	}
	
	function getHTML() {
		$query  = "SELECT * FROM `testimonials` ";
		$query .= "WHERE `id` = '{$this->currentID}' ";
		$query .= "LIMIT 1 ";
		$result = $this->database->getResults($query);
		$row = mysql_fetch_assoc($result);
		
		$company = $row['company'];
		$body = $this->textile->TextileThis($row['body']);
		$byline = $row['name'];
		if ($row['title'] != "") {
			$byline .= "<br>\n" . $row['title'];
		}
		
		$theHTML  = "";
		$theHTML .= "<h2>$company</h2>\n";
		$theHTML .= $body;
		$theHTML .= "<p>$byline</p>";
		
		return $theHTML;
	}
	
	function getHTMLList() {
		$detail = $this->detail;
		$query  = "SELECT * FROM `testimonials` ";
		$query .= "ORDER BY `sort` ";
		
		$results = $this->database->getResults($query);
		
		$theHTML  = "";
		
		while ($row = mysql_fetch_assoc($results)) {
			$id = $row['id'];
			$summary = $row['summary'];
			$company = $row['company'];
			
			$class = "item";
			if ($id == $this->currentID) {
				$class = "current-item";
			}
			
			$theHTML .= "<p class=\"$class\"><a href=\"$detail?id=$id\">$company</a><br>\n";
			$theHTML .= "$summary</p>\n";
		}
		
		return $theHTML;
	}
}

?>