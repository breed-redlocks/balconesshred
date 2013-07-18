<?php

class FormField {
	
	function FormField() {
		// define defaults
		$this->text->size = "40";
		$this->textarea->rows = "3";
		$this->textarea->cols = "40";
	}
	
	function getHTML($config) {
		$theHTML = "";
		
		// default select
		if (isset($config['prompt'])) {
			$prompt = $config['prompt'];
		} else {
			$prompt = "Please select ...";
		}
		
		// change complex types to simple types
		if (isset($config['type'])) {
			switch ($config['type']) {
				case "date":
				case "datetime":
					$config['simp'] = "text";
					break;
				case "entry":
				case "calendarentry":
				case "category":
				case "spotlight":
				case "parent":
					$config['simp'] = "select";
					break;
				default:
					$config['simp'] = $config['type'];
					break;
			}
		} else {
			$config['type'] = "text";
			$config['simp'] = "text";
		}
		
		// fetch items for special selects
		switch ($config['type']) {
			case "entry":
				require_once("Entries.php");
				$entries = new Entries();
				$config['vals'] = $entries->getEntries();
				break;
			case "calendarentry":
				require_once("Entries.php");
				$entries = new Entries();
				$config['vals'] = $entries->getCalendarEntries();
				break;
			case "category":
				require_once("../../../class/Categories.php");
				$cateories = new Categories();
				$config['vals'] = $cateories->getCategoriesAssoc();
				break;
			case "parent":
				require_once("Database.php");
				$database = new Database();
				$parentQuery = "SELECT `id`,`name` FROM `{$config['table']}` ORDER BY `name` ASC";
				$parentResults = $database->getResults($parentQuery);
				while ($row = mysql_fetch_assoc($parentResults)) {
					$config['vals'][$row['name']] = $row['id'];
				}
				break;
		}
		
		// adjust complex prefill
		if (isset($config['form']) && $config['prefill'] != "") {
			switch ($config['type']) {
				case "date":
					$timestamp = strtotime($config['prefill']);
					$config['prefill'] = date($config['form'],$timestamp);
					break;
				case "datetime":
					$timestamp = strtotime($config['prefill']);
					$config['prefill'] = date($config['form'],$timestamp);
					break;
			}
		}
		
		$name = "name=\"{$config['var']}\"";
		$inid = "id=\"{$config['var']}\"";
		$lfor = "for=\"{$config['var']}\"";
		
		// assign tab index
		$tabindex = "";
		if (isset($config['tabi'])) {
			$tabindex = " tabindex=\"{$config['tabi']}\"";
		}
		
		// construct simple types
		switch ($config['simp']) {
			case "text":
				$size = $this->getAttribute($config, "size");
				$theHTML .= "<input type=\"text\" $name$tabindex $size value=\"";
				$theHTML .= $config['prefill'];
				$theHTML .= "\">";
				break;
			case "textarea":
				$rows = $this->getAttribute($config, "rows");
				$cols = $this->getAttribute($config, "cols");
				$theHTML .= "<textarea $rows $cols $name$tabindex>";
				$theHTML .= $config['prefill'];
				$theHTML .= "</textarea>";
				break;
			case "file":
				$theHTML .="<input $name$tabindex type=\"file\">";
				break;
			case "select":
				$theHTML .= "<select $name$tabindex>\n";
				//$theHTML .= "<option value=\"\">Please select ...</option>\n";
				$theHTML .= "<option value=\"\">$prompt</option>\n";
				foreach ($config['vals'] as $name => $value) {
					if (is_array($value)) {
						$theHTML .= "<optgroup label=\"$name\">\n";
						foreach ($value as $subname => $subvalue) {
							$theHTML .= $this->getHTMLSelectItem($subname,$subvalue,$config);
						}
						$theHTML .= "</optgroup>\n";
					} else {
						$theHTML .= $this->getHTMLSelectItem($name,$value,$config);
					}
				}
				$theHTML .= "</select>\n";
				break;
			case "image":
				$theHTML .= "<img src=\"";
				$theHTML .= $config['fldr'];
				if ($config['prefill'] != "") {
					$theHTML .= $config['prefill'];
				} else {
					$theHTML .= "unavailable.gif";
				}
				$theHTML .= "\">\n";
				break;
			case "checkboxes":
				foreach ($config['vals'] as $value => $display) {
					$checked = "";
					if ($value == $config['prefill']) {
						$checked = " checked";
					}
					$theHTML .= "<input type=\"checkbox\" $inid value=\"$value\" $name$checked>";
					$theHTML .= "<label $lfor> $display</label>";
				}
				break;
		}
		
		return $theHTML;
	}
	
	function getHTMLSelectItem($name,$value,$config) {
		if ($value == $config['prefill']) {
			$selected = " selected";
		} else {
			$selected = "";
		}
		
		return "<option$selected value=\"$value\">$name</option>\n";
	}
	
	function getAttribute($config, $attribute) {
		$simpletype = $config['simp'];
		
		if (isset($config[$attribute])) {
			$theValue = $config[$attribute];
		} else {
			$theValue = $this->$simpletype->$attribute;
		}

		$theHTML = "$attribute=\"$theValue\"";
		
		return $theHTML;
	}
}

?>