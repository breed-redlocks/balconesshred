<?php

class News {
	function News() {
		require_once("Database.php");
		$this->database = new Database();
		
		require_once("Textile.php");
		$this->textile = new Textile();
		
		$this->detail = "/news";
		$this->listDateFormat = "M j, Y";
		$this->detailDateFormat = "l, F j, Y";
		
		if (isset($_GET['item'])) {
			$this->currentItem = $_GET['item'];
		}
	}
	
	function getHTML() {
		$item = $this->database->prepVariable($this->currentItem);
	
		$query  = "SELECT * FROM `news` ";
		$query .= "WHERE `item` = '$item' ";
		$query .= "LIMIT 1 ";
		$result = $this->database->getResults($query);
		$row = mysql_fetch_assoc($result);
		
		$date = date($this->detailDateFormat, strtotime($row['date']));
		$body = $this->textile->TextileThis($row['body']);
		
		$theHTML  = "";
		$theHTML .= "<h2>$date</h2>\n";
		$theHTML .= $body;
		
		return $theHTML;
	}
	
	function getHTMLHomeList() {
		$detail = $this->detail;
		$query  = "SELECT * FROM `news` ";
		$query .= "ORDER BY `date` DESC ";
		$query .= "LIMIT 5 ";
		
		$results = $this->database->getResults($query);
		
		$theHTML  = "";
		
		while ($row = mysql_fetch_assoc($results)) {
			$id = $row['id'];
			$item = $row['item'];
			$summary = $row['summary'];
			$date = date($this->listDateFormat, strtotime($row['date']));
			
			$class = "homeitem";
			if ($id == $this->currentID) {
				$class = "current-homeitem";
			}
			
			$theHTML .= "<div class=\"homeitem\">\n";
			$theHTML .= "<a class=\"date\" href=\"$detail/$item\">$date</a>\n";
			$theHTML .= "<p class=\"summary\"><a href=\"$detail/$item\">$summary</a></p>\n";
			$theHTML .= "<div class=\"clear\"></div>\n";
			$theHTML .= "</div>\n";
		}
		
		return $theHTML;
	}
	
	function getHTMLList() {
		$detail = $this->detail;
		$query  = "SELECT * FROM `news` ";
		$query .= "ORDER BY `date` DESC ";
		
		$results = $this->database->getResults($query);
		
		$theHTML  = "";
		
		while ($row = mysql_fetch_assoc($results)) {
			$id = $row['id'];
			$item = $row['item'];
			$summary = $row['summary'];
			$date = date($this->listDateFormat, strtotime($row['date']));
			
			$class = "item";
			if ($item == $this->currentItem) {
				$class = "current-item";
			}
			
			$theHTML .= "<p class=\"$class\"><a class=\"date\" href=\"$detail/$item\">$date</a><br>\n";
			$theHTML .= "<a href=\"$detail/$item\">$summary</a></p>\n";
		}
		
		return $theHTML;
	}
}

?>