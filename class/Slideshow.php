<?php

class Slideshow {
	function Slideshow() {
		require_once("Database.php");
		$this->database = new Database();
		require_once("Textile.php");
		$this->textile = new Textile();
		$this->detail = "/teammember";
		
		$this->defineMemberData();
	}
	
	function defineMemberData() {
		if (isset($_GET['item'])) {
			$item = $this->database->prepVariable($_GET['item']);
		}
		
		$query  = "SELECT * FROM `team` ";
		$query .= "WHERE `item` = '$item' ";
		$query .= "LIMIT 1 ";
		$result = $this->database->getResults($query);
		$this->memberData = mysql_fetch_assoc($result);
	}
	
	function getHTMLHomeSlides() {
		$query  = "SELECT `id`,`link`,`home`, `title`, `altText` FROM `slideshow` ";
		$query .= "WHERE `onhome` = 'true' ";
		$query .= "ORDER BY `sort` ASC ";
		$results = $this->database->getResults($query);
		
		$folder = "/rsrc/slideshow";
		$detail = $this->detail;
		
		$theHTML  = "";
		$theHTML .= "<ul id=\"slides\">\n";
		while ($row = mysql_fetch_assoc($results)) {
			$id   = $row['id'];
			$link = $row['link'];
			$file = $row['home'];
			$title = $row['title'];
			$altText = $row['altText'];
			
			$src   = "$folder/$file";
			$img   = "<img src=\"$src\"  alt=\"$altText\" title=\"$title\">";
			$ahref = "<a href=\"/$link\" alt=\"$altText\" title=\"$title\">";
			
			$theHTML .= "<li>$ahref$img</a></li>\n";
		}
		$theHTML .= "</ul>\n";
		
		return $theHTML;
	}
	
	function getHTMLList() {
		$query  = "SELECT `id`,`link`,`item` FROM `team` ";
		$query .= "WHERE `visible` = 'true' ";
		$query .= "ORDER BY `sort` ASC ";
		
		$results = $this->database->getResults($query);
		$detail = $this->detail;
		
		$theHTML  = "";
		while ($row = mysql_fetch_assoc($results)) {
			$id   = $row['id'];
			$item = $row['item'];
			$link = $row['link'];
			
			$src = "/rsrc/yourteam/links/$link";
			
			$theHTML .= "<a href=\"$detail/$item\"><img src=\"$src\"><br>\n";
		}
		
		return $theHTML;
	}
	
	function getHTMLTextList() {
		$query  = "SELECT * FROM `team` ";
		$query .= "WHERE `visible` = 'true' ";
		$query .= "ORDER BY `sort` ASC ";
		
		$results = $this->database->getResults($query);
		
		$theHTML  = "";
		while ($row = mysql_fetch_assoc($results)) {
			$detail = $this->detail;
			$id    = $row['id'];
			$name  = $row['name'];
			$item  = $row['item'];
			$title = $row['title'];
			
			$theHTML .= "<div class=\"teammember\">\n";
			$theHTML .= "<p><a href=\"$detail/$item\">$name $title</p>\n";
			$theHTML .= "<img src=\"/rsrc/common/teamarrow.gif\"></a>\n";
			$theHTML .= "<div class=\"clear\"></div>\n";
			$theHTML .= "</div>\n";
		}
		
		return $theHTML;
	}
	
	function getHTMLFeature() {
		$file = $this->memberData['feature'];
		if ($file == "") {
			$file = "unavailable.gif";
		}
		$theHTML = "<img src=\"/rsrc/yourteam/features/$file\">\n";
		
		return $theHTML;
	}
	
	function getHTMLMember() {
		$row = $this->memberData;
		
		$name  = $row['name'];
		$title = $row['title'];
		$intro = $this->textile->TextileThis($row['intro']);
		$body  = $this->textile->TextileThis($row['body']);
		$callout = "/rsrc/yourteam/callouts/";
		if ($row['callout'] != "") {
			$callout .= $row['callout'];
		} else {
			$callout .= "unavailable.gif";
		}
		
		$theHTML  = "";
		//$theHTML .= "<h1>$name $title</h1>\n";
		$theHTML .= "$intro\n";
		$theHTML .= "<div class=\"right\"><img src=\"$callout\"></div>\n";
		$theHTML .= "$body\n";
		
		return $theHTML;
	}
}

?>