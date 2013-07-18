<?php

class Divs {
	var $wrapped;
	var $nav;
	var $page;
	
	/**
	 * Defines the default div list and contents
	 */
	function Divs() {
		$this->version = $this->getVersion();
		
		// Standard Divs
		$this->divs = array(
			"spc" => "",
			"hdr" => "",
			"nav" => "",
			"cnt" => "",
			"ftr" => ""
		);
		$this->wrapped = true;
		
		$this->divClasses = array();
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Divs Class";
		$major = "0";
		$minor = "1";
		$rev   = "2";
		$build = "0003";
		
		$shortnumber = "$major.$minor";
		$longnumber  = "$major.$minor.$rev ($build)";
		
		return array(
			"name" => $name,
			"major" => $major,
			"minor" => $minor,
			"rev" => $minor,
			"build" => $build,
			"shortnumber" => $shortnumber,
			"longnumber" => $longnumber,
			"short" => "SC $name $shortnumber",
			"long" => "Stratosphere Creative $name, version $longnumber",
			"lastmodified" => "January 31, 2008",
			"author" => "Mark B. Priddy"
		);
	}
	
	/**
	 * Set a reference to my page so this instance can call its page's functions
	 */
	function setPage($thePage) {
		$this->page = $thePage;
		$this->page->addVersItem($this->version);
	}
	
	function __toString() {
		$this->getHTML();
	}
	
	/**
	 * Constructs the HTML divs for the template as defined in the list
	 */
	function getHTML() {
		$divs = $this->divs;
		$wrapped = $this->wrapped;
		
		$theHTML = "";
		
		if (false) {
			$theHTML .= "<!-- div list -->\n";
			foreach ($divs as $divid => $divcontent) {
				$theHTML .= "<!-- $divid -->\n";
			}
		}
		
		if ($wrapped) {
			$theHTML .= "<div id=\"wrp\">\n";
		}
		
		// write out the divs and their contents
		foreach ($divs as $divid => $divcontent) {
			$divClass = "";
			if (isset($this->divClasses[$divid])) {
				$divClass = " class=\"" . $this->divClasses[$divid] . "\"";
			}
			$theHTML .= "<div id=\"$divid\"$divClass>";
			
			/*
			if ($divid == "cnt") {
				$theHTML .= $this->cols->getHTML();
			}
			*/
			
			$theHTML .= $divcontent;
			$theHTML .= "</div><!-- /div id=\"$divid\" -->\n";
		}
				
		if ($wrapped) {
			$theHTML .= "</div><!-- /div id=\"wrp\" -->\n";
		}
		
		return $theHTML;
	}

	/**
	 * Adds the specified div, empty, to the end of the div list
	 *
	 * @param  $newDiv the id of the new div
	 */
	function addDiv($newDiv) {
		$this->divs[$newDiv] = "";
	}
	
	function removeDiv($which) {
		foreach ($this->divs as $divid => $content) {
			if ($divid != $which) {
				$newDivs[$divid] = $content;
			}
		}
		$this->divs = $newDivs;
	}
	
	/**
	 * Replaces the div list with an empty list
	 */
	function clearDivs() {
		$this->setDivs(array());
	}
	
	/**
	 * Replaces the div list with the new list
	 *
	 * @param  $newDivs array of new divs
	 */
	function setDivs($newDivs) {
		$this->divs = $newDivs;
	}
	
	function setDivClass($theDiv, $theClass) {
		$this->divClasses[$theDiv] = $theClass;
	}
	
	/**
	 * Sets the content of the specified div
	 *
	 * @param  $theDiv     id of the div
	 * @param  $theContent content to set the div to contain
	 */
	function setDivContent($theDiv, $theContent) {
		if (isset($this->divs[$theDiv])) {
			$this->divs[$theDiv] = "\n$theContent\n";
		}
	}
	
}

?>