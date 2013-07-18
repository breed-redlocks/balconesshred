<?php

class FormField {
	
	function FormField() {
		// define defaults
		$this->text->size = "40";
		$this->textarea->rows = "3";
		$this->textarea->cols = "40";
	}
	
	function setTextSize($newSize) {
		$this->text->size = $newSize;
	}
	
	function getHTML($config) {
		$theHTML = "";
		//$theHTML .= print_r($config, true);
		
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
				case "state":
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
			case "category":
				require_once("../../../class/Categories.php");
				$cateories = new Categories();
				$config['vals'] = $cateories->getCategoriesAssoc();
				break;
			case "state":
				require_once("SelectState.php");
				$selectState = new SelectState();
				$selectState->setKeyOrder("State,abbr");
				$config['vals'] = $selectState->getStates("");
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
		
		// assign class
		$class = "";
		if (isset($config['class'])) {
			$class = " class=\"{$config['class']}\"";
		}
		
		// construct simple types
		switch ($config['simp']) {
			case "text":
				$size = $this->getAttribute($config, "size");
				$theHTML .= "<input type=\"text\" $name$tabindex$class $size value=\"";
				if (isset($config['prefill'])) {
					$theHTML .= $config['prefill'];
				} elseif (isset($config['default'])) {
					$theHTML .= $config['default'];
				}
				$theHTML .= "\">";
				break;
			case "textarea":
				$rows = $this->getAttribute($config, "rows");
				$cols = $this->getAttribute($config, "cols");
				$theHTML .= "<textarea $rows $cols $name$tabindex$class>";
				$theHTML .= $config['prefill'];
				$theHTML .= "</textarea>";
				break;
			case "file":
				$theHTML .="<input $name$tabindex$class type=\"file\">";
				break;
			case "select":
				$theHTML .= "<select $name$tabindex$class>\n";
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
				$theHTML .= "<img$class src=\"";
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
					$theHTML .= "<input type=\"checkbox\" $inid$class value=\"$value\" $name$checked>";
					$theHTML .= "<label $lfor> $display</label>";
				}
				break;
			case "radio":
				foreach ($config['vals'] as $value => $display) {
					$checked = "";
					if (isset($config['prefill']) and $value == $config['prefill']) {
						$checked = " checked";
					}
					$rid  = "{$config['var']}$value";
					$theHTML .= "<input type=\"radio\" id=\"$rid\"$class value=\"$value\" $name$checked>";
					$theHTML .= "<label for=\"$rid\"> $display</label><br>";
				}
				break;
		}
		
		return $theHTML;
	}
	
	function getHTMLSelectItem($name,$value,$config) {
		if (isset($config['prefill']) and $value == $config['prefill']) {
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