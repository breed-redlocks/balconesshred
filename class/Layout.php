<?php

class Layout {

	function Layout() {
		$this->version = $this->getVersion();
		
		// define the default div structure
		$this->divs['wrp'] = array(
			'hdr' => array(
				'nav' => "",
				'top' => "",
				'clear' => "",
			),
			'cnt' => "",
			'ftr' => "",
		);
		
		// define where the layout-specific divs go
		$this->layoutDivContainer =& $this->divs['wrp']['cnt'];
		
		// define the default layout
		$this->setLayout("a");
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name     = "Layout Class";
		$major    = "1";
		$minor    = "0";
		$rev      = "0";
		$build    = "0001";
		$modified = "March 23, 2009";
		$author   = "Mark B. Priddy";
		
		$shortnumber = "$major.$minor";
		$longnumber  = "$major.$minor.$rev ($build)";
		
		return array(
			"name"  => $name,
			"major" => $major,
			"minor" => $minor,
			"rev"   => $rev,
			"build" => $build,
			"shortnumber" => $shortnumber,
			"longnumber"  => $longnumber,
			"short" => "SC $name $shortnumber",
			"long"  => "Stratosphere Creative $name, version $longnumber",
			"modified" => $modified,
			"author"   => $author,
		);
	}
	
	function setLayout($which) {
		$this->layout = $which;
		
		switch ($which) {
			case "a":
				$layoutDivs = array(
					'col1' => "",
					'side' => "",
					'clear' => "",
				);
				break;
			case "b":
				$layoutDivs = array(
					'main' => array(
						'feature' => "",
						'col1' => "",
					),
					'side' => "",
					'clear' => "",
				);
				break;
			case "c":
				$layoutDivs = array(
					'col1' => "",
					'col2' => "",
					'side' => "",
					'clear' => "",
				);
				break;
			case "d":
				$layoutDivs = array(
					'main' => array(
						'feature' => "",
						'wcol1' => "",
						'wcol2' => "",
					),
					'side' => "",
					'clear' => "",
				);
				break;
			case "e":
				$layoutDivs = array(
					'page' => array(
						'col1' => "",
						'col2' => "",
					),
					'side' => "",
					'clear' => "",
				);
				break;
		}
		
		$this->layoutDivContainer = $layoutDivs;
	}
	
	function setContent($contentItems) {
		foreach ($contentItems as $div => $content) {
			$this->setContentOfDiv($div, $content);
		}
	}
	
	function setContentOfDiv($div, $content) {
		$this->content[$div] = $content;
	}
	
	function debugDump() {
		echo "<xmp>";
		print_r($this->divs);
		$this->echoHTML();
		echo "</xmp>\n";
	}
	
	function echoHTML() {
		echo $this->getHTML();
	}
	
	function getHTML() {
		$theHTML = "";
		
		foreach($this->divs as $id => $children) {
			$theHTML .= $this->getHTMLDiv($id, $children);
		}
		
		return $theHTML;
	}
	
	function getHTMLDiv($id, $children) {
		$theHTML = "";
		if ($id == "clear") {
			$theHTML .= "<div class=\"clear\"></div>\n";
		} else {
			$divContent = $this->getHTMLDivContent($id);
			
			// if the div has content or children, add it to the HTML
			if ($divContent != "" or $children != "") {
				$theHTML .= "<div id=\"$id\">";
				//$theHTML .= $this->getHTMLDivContent($id);
				$theHTML .= $divContent;
				if ($children != "") {
					$theHTML .= "\n";
					foreach ($children as $sid => $schildren) {
						$theHTML .= $this->getHTMLDiv($sid, $schildren);
					}
				}
				$theHTML .= "</div>\n";
			}
		}
		
		return $theHTML;
	}
	
	function getHTMLDivContent($which) {
		$theHTML = "";
		
		if (isset($this->content[$which])) {
			$theHTML = "\n" . $this->content[$which] . "\n";
		}
		
		return $theHTML;
	}
}

?>