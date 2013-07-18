<?php

class Locations {
	function Locations() {
		require_once("Database.php");
		$this->database = new Database();
		
		require_once("Textile.php");
		$this->textile = new Textile();
		
		$this->detail = "/location.php";
		$this->linkstem = "/location/"; // used with the rewrite rule
		
		$this->defineCurrentID();
	}
	
	function defineCurrentID() {
		if (isset($_GET['id'])) {
			$this->currentID = $this->database->prepVariable($_GET['id']);
		}
		if (isset($_GET['item'])) {
			$item = $this->database->prepVariable($_GET['item']);
			$query  = "SELECT `id` FROM `locations` ";
			$query .= "WHERE `item` = '$item' ";
			$query .= "LIMIT 1 ";
			$result = $this->database->getResults($query);
			$row = mysql_fetch_assoc($result);
			$this->currentID = $row['id'];
		}
	}
	
	function defineListData() {
		if (!isset($this->listResults)) {
			$query  = "SELECT `id`,`name`,`item`,`link_a`,`link_b` FROM `locations` ";
			$query .= "WHERE `visible` = 'true' AND `name` != 'houston' AND `name` != 'Amarillo' AND `name` != 'El Paso' AND `name` !=  'Lubbock'  ";
			$query .= "ORDER BY `sort` ASC ";
			
			$this->listResults = $this->database->getResults($query);
		}
	}
	
	function getField($which) {
		$this->defineData();
		return $this->data[$which];
	}
	
	function getHTMLList($type) {
		$this->defineListData();
		$detail = $this->detail;
		$linkstem = $this->linkstem;
		
		$theHTML  = "";
		while ($row = mysql_fetch_assoc($this->listResults)) {
			$id    = $row['id'];
			$item  = $row['item'];
			$afile = $row['link_a'];
			$bfile = $row['link_b'];
			
			if ($type == "A") {
				$src = "/rsrc/locations/links_a/$afile";
			} else  {
				$src = "/rsrc/locations/links_b/$bfile";
			}
			
			//$theHTML .= "<a href=\"$detail?id=$id\"><img src=\"$src\"></a><br>\n";
			$theHTML .= "<a href=\"$linkstem$item\"><img src=\"$src\"></a><br>\n";
		}
		
		return $theHTML;
	}
	
	function getList() {
		$this->defineListData();
		$detail = $this->detail;
		$linkstem = $this->linkstem;
		
		while ($row = mysql_fetch_assoc($this->listResults)) {
			$id    = $row['id'];
			$name  = $row['name'];
			$item  = $row['item'];
			
			$theList[] = "<a href=\"$linkstem$item\">$name</a>";
		}
		
		return $theList;
	}
	
	function defineData() {
		if (!isset($this->data)) {
			$query  = "SELECT * FROM `locations` ";
			$query .= "WHERE `id` = '{$this->currentID}' ";
			$query .= "LIMIT 1 ";
			$result = $this->database->getResults($query);
			$this->data = mysql_fetch_assoc($result);
		}
	}
	
	function getHTMLDetails() {
		$this->defineData();
		$row = $this->data;
		
		// construct address
		$addressItems[] = $row['address'];
		if ($row['address2'] != "") {
			$addressItems[] = $row['address2'];
		}
		$citystzip  = $row['city'] . ", ";
		$citystzip .= $row['state'] . " ";
		$citystzip .= $row['zipcode'];
		$addressItems[] = $citystzip;
		$address = implode("<br>\n", $addressItems);
		
		if ($row['photo'] != "") {
			$photo = "<p><img src=\"/rsrc/locations/photos/{$row['photo']}\"></p>\n";
		} else {
			$photo = "";
		}
		
		$phone = $row['phone'];
		
		$theHTML  = "";
		$theHTML .= $photo;
		$theHTML .= "<p>$address</p>";
		$theHTML .= "<p>$phone</p>";
		
		return $theHTML;
	}
	
	function getHTMLText() {
		$this->defineData();
		$row = $this->data;
		
		$body = $this->textile->TextileThis($row['body']);
		
		$theHTML  = "";
		$theHTML .= $body;
		
		return $theHTML;
	}
}

?>