<?php

class CMS {

	function CMS() {
		$this->froot = realpath(dirname(__FILE__) . "/../") . "/";
		$this->feditorsFolder = $this->froot . "edit/";
		$this->wroot = "/cms/";
		$this->weditorsFolder = $this->wroot . "edit/";
		
		require_once("Editor.php");
		$this->initEditors();
	}
	
	function dump() {			
		echo "<pre>Indicies ";
		print_r($this->editorIDs);
		echo "<pre>Editor ";
		print_r($this->editor);
		echo "\nCur Editor ";
		print_r($this->curEditor);
		echo "</pre>";
	}
	
	function initEditors() {
		// put all items into an array - in no particular order
		if ($handle = opendir($this->feditorsFolder)) {
			while (false !== ($path = readdir($handle))) {
				if ($path != "." && $path != "..") {
					$theEditor['id'] = $path;
					$theEditor['fpath'] = $this->feditorsFolder . "$path/";
					$theEditor['wpath'] = $this->weditorsFolder . "$path/";
					$this->editor[] = new Editor($theEditor);
				}
			}
		}
		
		// put the editors into order
		//sort($this->editor);
		
		foreach ($this->editor as $number => $object) {
			$this->editorIDs[$object->id] = $number;
		}
	}
	
	function getEditorNumber($id) {
		return $this->editorIDs[$id];
	}
	
	function getEditorID($filepath) {
		$dirname = dirname($filepath);
		$nameitems = explode("/",$dirname);
		$editorID = $nameitems[count($nameitems)-1];
		
		if (false) {
			echo "$filepath<br>\n";
			echo "$dirname<br>\n";
			echo "$editorID<br>\n";
		}
		
		return $editorID;
	}
	
	function getHTMLEditorMenu() {
		$theHTML  = "<select onchange=\"this.form.submit();\" name=\"editor\">\n";
		$theHTML .= "<option value=\"\">Choose a section ...</option>\n";
		for ($e = 0; $e < count($this->editor); $e++) {
			//$theHTML .= "<option>{$this->editor[$e]->name}</option>\n";
			$theHTML .= $this->editor[$e]->getHTMLMenuOption();
		}
		$theHTML .= "</select>\n";
		
		return $theHTML;
	}
	
	function getHTMLEditorsHome() {
		$theHTML  = "<div id=\"editorleft\">\n";
		for ($e = 0; $e < count($this->editor); $e += 2) {
			$theHTML .= $this->editor[$e]->getHTMLHome();
		}
		$theHTML .= "</div><!-- /div id=\"editorleft\" -->";
		$theHTML .= "<div id=\"editorright\">";
		for ($e = 1; $e < count($this->editor); $e += 2) {
			$theHTML .= $this->editor[$e]->getHTMLHome();
		}
		$theHTML .= "</div><!-- /div id=\"editorright\" -->";
		
		return $theHTML;
	}
	
	function selectEditor($which) {
		$this->curEditor = $this->editor[$which];
	}
}

?>