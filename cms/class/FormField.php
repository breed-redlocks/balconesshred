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
					$config['simp'] = "select";
					break;
				case "attributes":
					$config['simp'] = "checkboxes";
					break;
				default:
					$config['simp'] = $config['type'];
					break;
			}
		} else {
			$config['type'] = "text";
			$config['simp'] = "text";
		}
		
		// fetch items for special selects & checkboxes
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
			case "attributes":
				require_once("Work.php");
				$work = new Work();
				$config['vals'] = $work->getAttributeSet();
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
				$theHTML .= $config['fldr'] . "/";
				if ($config['prefill'] != "") {
					$theHTML .= $config['prefill'];
				} else {
					$theHTML .= "unavailable.gif";
				}
				
				$theHTML .= "\"";
				
				if (isset($config['width'])) {
					$theHTML .= " width=\"{$config['width']}\"";
				}
				if (isset($config['height'])) {
					$theHTML .= " height=\"{$config['height']}\"";
				}
				$theHTML .= ">\n";
				
				// add Delete this image checkbox
				if (isset($config['allowdelete']) and $config['allowdelete'] ) {
					$theHTML .= "<br><input type=\"checkbox\" ";
					$theHTML .= "name=\"delete{$config['var']}\" id=\"delete{$config['var']}\">";
					$theHTML .= "<label for=\"delete{$config['var']}\"> Delete this image</label>\n";
				}
				break;
			case "checkboxes":
				$name = "name=\"{$config['var']}[]\"";
				$prefill = explode(",",$config['prefill']);
				
				if (false) { // debug block
					$theHTML .= "<pre>\n";
					$theHTML .= print_r($config, true);
					$theHTML .= print_r($prefill,true);
					$theHTML .= "</pre>\n";
				}
				
				foreach ($config['vals'] as $value => $display) {
					$checked = "";
					//if ($value == $config['prefill']) {
					if (in_array($value,$prefill)) {
						$checked = " checked";
					}
					
					$inid  = "id=\"$value\"";
					$lfor  = "for=\"$value\"";
					
					$theHTML .= "<input type=\"checkbox\" $inid value=\"$value\" $name$checked>";
					$theHTML .= "<label $lfor> $display</label><br>\n";
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