<?php

class Table {
	
	function Table($cmsReference) {
		$this->cms = $cmsReference;
		require_once("Database.php");
		$this->database = new Database;
		$this->filter = "";
	}

	function getHTMLList() {
		$curEditor = $this->cms->curEditor;
		$table = $curEditor->id;
		$theQuery  = "SELECT * FROM `$table`";
		
		// use override query if present
		if (isset($curEditor->customQuery)) {
			$theQuery = $curEditor->customQuery;
		}
		
		// check for filtered option
		if (func_num_args() > 0) {
			if (func_get_arg(0) == "filtered") {
				// apply alpha filter
				if ($_GET['alpha'] != "") {
					$alphaFiltered = true;
					if ($_GET['alpha'] == "non") {
						//$theQuery .= "WHERE `name` < 'A'";
						$theQuery .= "WHERE `name` NOT REGEXP '^[a-zA-Z]'";
					} else {
						$letter = $this->database->prepVariable($_GET['alpha']);
						$theQuery .= "WHERE `name` REGEXP '^$letter'";
					}
				} else {
					$alphaFiltered = false;
				}
				// apply category filter
				if ($_GET['category'] != "") {
					$catFiltered = true;
					$catFilter = $this->database->prepVariable($_GET['category']);
					if ($alphaFiltered) {
						$theQuery .= " AND ";
					} else {
						$theQuery .= "WHERE ";
					}
					$theQuery .= "`cat1` = '$catFilter'";
				} else {
					$catFiltered = false;
				}
				// memorize filter for appending to functions
				if ($alphaFiltered) {
					$this->filter .= "&alpha=" . urlencode($_GET['alpha']);
				}
				if ($catFiltered) {
					$this->filter .= "&category=" . urlencode($_GET['category']);
				}
			}
		}
				
		// add custom sort clause if present
		if (isset($curEditor->sortClause)) {
			$theQuery .= " ";
			$theQuery .= $curEditor->sortClause;
		}
		
		$theResults = $this->database->getResults($theQuery);
		
		// start the table
		$theHTML  = "<table class=\"item\" cellspacing=\"0\">\n";
		$theHTML .= "<!-- $theQuery -->\n";
		$theHTML .= "<tr>\n";
		
		// construct table heading
		foreach ($curEditor->head as $col => $text) {
			$theHTML .= "<th class=\"norm\">$text</th>\n";
		}
		
		// add the Functions column
		if (isset($curEditor->func)) {
			$theHTML .= "<th class=\"last\">FUNCTIONS</th>\n";
		}
		
		$theHTML .= "</tr>\n";
		
		// construct table items from database response
		$even = true;
		while ($row = mysql_fetch_assoc($theResults)) {
			if ($even) {
				$rowclass = "even";
			} else {
				$rowclass = "odd";
			}
			
			// start the row
			$theHTML .= "<tr class=\"$rowclass\">\n";
			
			// iterate through all the columns
			foreach ($curEditor->head as $col => $text) {
				$rawvalue = $row[$col];
				if (isset($curEditor->cfrm[$col])) { // custom format found
					$format = $curEditor->form[$curEditor->cfrm[$col]];
					if (preg_match('/date/',$curEditor->cfrm[$col]) == 1) {
						$datestamp = strtotime($rawvalue);
						$out = date($format,$datestamp);
					} else {
						switch ($curEditor->cfrm[$col]) {
							case "switch":
								$replacement = "Not found";
								foreach ($format as $input => $output) {
									if ($rawvalue == $input) {
										$replacement = $output;
									}
								}
								$out = $replacement;
								break;
							case "limit":
								$limit = 40;
								$out = substr($rawvalue,0,$limit);
								if (strlen($rawvalue) > $limit) {
									$out .= "...";
								}
								break;
							case "lookup":
								$lookupQuery  = "SELECT `name` FROM `content` ";
								$lookupQuery .= "WHERE `id` = '$rawvalue' ";
								$lookupQuery .= "LIMIT 1";
								$lookupResults = $this->database->getResults($lookupQuery);
								$lookupRow = mysql_fetch_assoc($lookupResults);
								$out = $lookupRow['name'];
								break;
							default:
								$out = $rawvalue;								
								break;
						}
						/*
						if ($curEditor->cfrm[$col] == "switch") {
							$replacement = "Not found";
							foreach ($format as $input => $output) {
								if ($rawvalue == $input) {
									$replacement = $output;
								}
							}
							$out = $replacement;
						} else {
							$out = $rawvalue;
						}
						*/
					}
				} else {
					$out = $rawvalue;
				}
				$theHTML .= "<td class=\"norm\">$out</td>\n";
			}

			// add the Functions column
			if (isset($curEditor->func)) {
				$theHTML .= "<td class=\"last\">";
				unset($funcItems);
				foreach ($curEditor->func as $text => $value) {
					$funcItems[] = "<a href=\"$value{$row['id']}{$this->filter}\">$text</a>";
				}
				$theHTML .= implode($funcItems, " &nbsp; ");
				$theHTML .= "</td>\n";
			}
			
			// end the row
			$theHTML .= "</tr>\n";

			$even = !$even;
		}
		
		// end the table
		$theHTML .= "</table>\n";
		
		return $theHTML;
	}
}

?>