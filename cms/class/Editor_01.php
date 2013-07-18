<?php

class Editor {
	
	function Editor($config) {
		// parse out the values passed by the instantiation statement
		foreach ($config as $name => $value) {
			$this->$name = $value;
		}
		
		$this->presaveFile = "";
		$configFile = $this->fpath . "config.php";
		require_once($configFile);
		
		$this->fileprefix = "";
	}
	
	function doPresave($debug) {
		$result = "No presave defined";
		if ($this->presaveFile != "") {
			$presavePath = $this->fpath . $this->presaveFile;
			require_once($presavePath);
		}
		
		return $result;
	}
	
	function getSetPhrase() {
		// instantiate the database
		require_once("Database.php");
		$database = new Database;
		
		$thePhrase = "SET ";
		
		foreach ($this->field as $config) {
			$error = false;
			
			//echo "----- {$config['var']} -----<br>\n";
			
			// translate arrays to comma delim
			//if ($config['type'] == "attributes") { // && $value == "") {
			if (isset($_POST[$config['var']]) && is_array($_POST[$config['var']])) {
				$value = implode(",",$_POST[$config['var']]);
				//echo "after implode: $value<br>\n";
				$value = $database->prepVariable($value);
				//echo "after prep: $value<br>\n";
				//$error = true;
			}
			
			if (isset($_POST[$config['var']])) {
				if (!is_array($_POST[$config['var']])) {
					$value = $database->prepVariable($_POST[$config['var']]);
				}
			} else {
				$value = "";
			}
			//echo "after regular prep: $value<br>\n";
			
			if ($config['type'] == "date") {
				$value = $database->convertToDate($value);
			}
			if ($config['type'] == "datetime") {
				$value = $database->convertToDateTime($value);
			}
			if ($config['type'] == "file") {
				//$value = $this->handleFileUpload($config['var']);
				$value = $this->handleFileUpload($config);
				if ($value == $this->fileprefix) {
					$error = true;
				}
			}
			if ($config['type'] == "image") {
				// check to see if this image is flagged for deletion
				if (isset($_POST['delete' . $config['var']]) and $_POST['delete' . $config['var']] == "on") {
					$deleteme = true;
				} else {
					$deleteme = false;
				}
				
				if (isset($config['allowdelete']) and $config['allowdelete'] and $deleteme) {
					$value = "";
				} else {
					$error = true;
				}
			}
			
			if (!$error) {
				$var[] = "`{$config['var']}` = '$value'";
			}
		}
		
		$thePhrase .= implode($var, ", ");
		
		return $thePhrase;
	}
	
	function handleFileUpload($config) {
		$var = $config['var'];
		
		if (false) {
			echo '<pre> $_FILES ';
			print_r($_FILES);
			print_r($config);
		}
		
		$filename = $this->massageFilename($_FILES[$var]['name']);
		
		$fUploadFolder = $this->assembleUploadFolder($config['fldr']);
		$destination = "$fUploadFolder$filename";
		if (is_writable($fUploadFolder)) {
			if (!move_uploaded_file($_FILES[$var]['tmp_name'], $destination)) {
				echo '<pre>$_FILES ';
				print_r($_FILES);
				echo "Config ";
				print_r($config);
				die ("Couldn't seem to move \"{$_FILES[$var]['tmp_name']}\" to $destination.");
			}
		} else {
			die ($fUploadFolder . " doesn't appear to be writable. ({$config['fldr']})");
		}
		
		return $filename;
	}
	
	function assembleUploadFolder($fldr) {
		$myFolder = dirname(__FILE__);
		$rawFolder = "$myFolder/../..$fldr";
		$fUploadFolder = realpath($rawFolder) . "/";

		return $fUploadFolder;
	}
	
	function massageFilename($filename) {
		$filename = strtolower($filename);
		
		// change spaces to underscores
		$filename = str_replace(" ", "_", $filename);
		
		// remove all non-alphanumerics
		$filename = preg_replace("/[^.0-9a-z]/", "", $filename);
		
		// remove fileprefix if it's there
		if ($this->fileprefix != "") {
			if (preg_match("/^[{$this->fileprefix}]+(.+)/", $filename, $results) == 1) {
				//echo "<pre>";
				//print_r($results);
				$filename = $results[1];
			}
		}
		
		return "{$this->fileprefix}$filename";
	}
	
	function getText($which) {
		if (isset($this->text[$which])) {
			return $this->text[$which];
		} else {
			return "";
		}
	}
	
	function getHTMLPageNav() {
		$theHTML  = $this->name . ": ";
		if (isset($this->link)) {
			unset($links);
			foreach ($this->link as $text => $linkend) {
				$link = $this->wpath . $linkend;
				$links[] = "<a href=\"$link\">$text</a>";
			}
			$theHTML .= implode($links, ", ");
		}
		
		return $theHTML;
	}
	
	function getHTMLHome() {
		$theHTML  = "<p class=\"editortitle\">$this->name</p>\n";
		if (isset($this->link)) {
			unset($links);
			foreach ($this->link as $text => $linkend) {
				$link = $this->wpath . $linkend;
				$links[] = "<a href=\"$link\">$text</a>";
			}
			$theHTML .= implode($links, "<br>\n");
		}
		
		return $theHTML;
	}
	
	function getHTMLMenuOption() {
		return "<option value=\"$this->id\">$this->name</option>\n";
	}
}

?>