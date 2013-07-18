<?php

class Entries {
	function Entries() {
		require_once("Database.php");
		$this->database = new Database();
		
		require_once("../../../class/Categories.php");
		$categories = new Categories();
		$this->categories = $categories->getCategories();
	}
	
	function getEntries() {
		foreach ($this->categories as $catname => $category) {
			$catlist = "('" . join("','",$category) . "')";
			
			/*
			echo "<pre>$catname ";
			print_r($category);
			echo "</pre>";
			echo $catlist;
			*/
			
			$query  = "SELECT * FROM `entries` ";
			$query .= "WHERE `cat1` IN $catlist ";
			$query .= "ORDER BY `name` ";
			
			$dbResults = $this->database->getResults($query);
			
			while ($row = mysql_fetch_assoc($dbResults)) {
				$categoryitems[$row['name']] = $row['id'];
			}
			
			if (isset($categoryitems)) {
				$results[$catname] = $categoryitems;
			} else {
				//$results[$catname] = array();
			}
			unset($categoryitems);
		}
		
		
		return $results;
	}
	
	function getCalendarEntries() {
		foreach ($this->categories as $catname => $category) {
			if ($catname != "Directory Only") {
				$catlist = "('" . join("','",$category) . "')";
				
				/*
				echo "<pre>$catname ";
				print_r($category);
				echo "</pre>";
				echo $catlist;
				*/
				
				$query  = "SELECT * FROM `entries` ";
				$query .= "WHERE `cat1` IN $catlist ";
				$query .= "ORDER BY `name` ";
				
				$dbResults = $this->database->getResults($query);
				
				while ($row = mysql_fetch_assoc($dbResults)) {
					$categoryitems[$row['name']] = $row['id'];
				}
				
				if (isset($categoryitems)) {
					$results[$catname] = $categoryitems;
				} else {
					//$results[$catname] = array();
				}
				unset($categoryitems);
			}
		}
		
		
		return $results;
	}
	
	function getEntriesTestC() {
		$query  = "SELECT * FROM `entries` ";
		//$query .= "
		
		$dbResults = $this->database->getResults($query);
		
		while ($row = mysql_fetch_assoc($dbResults)) {
			$results[$row['name']] = $row['id'];
		}
		
		return $results;
	}
	
	function getEntriesTestB() {
		$entries = array(
			"Dining" => array(
				"Item 1" => "1",
				"Item 2" => "2",
				"Item 3" => "3",
			),
			"Nightlife" => array(
				"Item 4" => "4",
				"Item 5" => "5",
				"Item 6" => "6",
			),
			"Accommodations" => array(
				"Item 7" => "7",
				"Item 8" => "8",
				"Item 9" => "9",
			),
		);
		
		return $entries;
	}
	
	function getEntriesTestA() {
		$entries = array(
			"Item 1" => "1",
			"Item 2" => "2",
			"Item 3" => "3",
		);
		
		return $entries;
	}
}

?>