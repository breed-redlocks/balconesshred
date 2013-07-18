<?php

/**
 * Handles the creation and display of a page
 */
class Page {
	var $divs;
	var $nav;
	var $doctype;
	var $charset;
	var $sitename;
	var $pagetitle;
	var $verslist;
	var $metalist;
	var $csslist;
	var $headscripts;
	var $htmlcontent;
	var $analytics;
	
	/**
	 * Sets the defaults for this instance
	 */
	function Page() {
		$this->version = $this->getVersion();
		$this->addVersItem($this->version);
		
		$this->sitename    = "Gold";
		$this->pagetitle   = "Welcome";
		$this->doctype     = "";
		$this->charset     = "";
		$this->metalist    = array();
		$this->csslist     = array("/standard.css","/layout.css","/tables.css","/styles.css");
		//$this->csslist     = array("/cms/layout.css","/styles.css");
		$this->headscripts = array();
		$this->htmlcontent = "";
		$this->analytics   = "none";
		
		require_once("Divs.php");
		$this->divs = new Divs();
		$this->divs->setPage($this);
		
		require_once("Nav.php");
		$this->nav = new Nav();
		//$this->nav->setPage($this);
		
		/*
		$this->addVersItem($this->divs->getVersion());
		$this->addVersItem($this->nav->getVersion());
		*/
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Page Class";
		$major = "0";
		$minor = "1";
		$rev   = "1";
		$build = "0002";
		
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
			"lastmodified" => "September 7, 2007",
			"author" => "Mark B. Priddy"
		);
	}
	
	/**
	 * returns the aggregated output of the html construction functions and the page's content
	 */
	function getHTML() {
		$theHTML  = "";
		
		$this->divs->setDivContent("nav",$this->nav->getHTML());
		$this->setContent($this->divs->getHTML());
		
		$theHTML .= $this->htmlHeader();
		$theHTML .= $this->htmlcontent;
		$theHTML .= $this->htmlFooter();
		
		return $theHTML;
	}
	
	/**
	 * Defines the site name for all pages (in the window title bar)
	 *
	 * @param  $newName the text of the new title
	 */
	function setSiteName($newName) {
		$this->sitename = $newName;
	}
	
	/**
	 * Defines the title for the page (in the window title bar)
	 *
	 * @param  $newTitle the text of the new title
	 */
	function setPageTitle($newTitle) {
		$this->pagetitle = $newTitle;
	}
	
	/**
	 * Defines the character set for the page
	 *
	 * @param  $newCharSet the new character set
	 */
	function setCharSet($newCharSet) {
		$this->charset = $newCharSet;
	}
	
	/**
	 * Defines the analytics for the page (at the bottom of the page)
	 *
	 * @param  $newAnalytics the last portion of the analytics document filename to be included
	 */
	function setAnalytics($newAnalytics) {
		$this->analytics = $newAnalytics;
	}
	
	/**
	 * Defines the DOCTYPE of the output HTML document
	 *
	 * @param  $dtCode the abbreviation to expand into a full doctype
	 */
	function setDocType($dtCode) {
		$dtCode = strtolower($dtCode);
		switch ($dtCode) {
			case "html 4.01 strict":
				$this->doctype = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" "
				. "\"http://www.w3.org/TR/html4/strict.dtd\">";
				break;
			case "html 4.01 transitional":
			case "html 4.01 trans":
				$this->doctype = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" "
				. "\"http://www.w3.org/TR/html4/loose.dtd\">";
				break;
			case "none":
			case "":
				$this->doctype = "";
				break;
			default:
				$this->doctype = "";
				break;
		}
	}
	
	/**
	 * Completely replaces the meta list
	 *
	 * @param  $newMetaItems array of items to use
	 */
	function setMetaItems($newMetaItems) {
		$this->metalist = $newMetaItems;
	}
	
	/**
	 * Adds items to the meta list
	 *
	 * @param  $newMetaItems array of items to add to the list
	 */
	function addMetaItems($newMetaItems) {
		foreach ($newMetaItems as $name => $content) {
			$this->metalist[$name] = $content;
		}
	}
	
	/**
	 * Adds item to the vers list
	 *
	 * @param  $newVersItem array of items to add to the list
	 */
	function addVersItem($newVersItem) {
		$this->verslist[] = $newVersItem;
	}
	
	/**
	 * Completely replaces the css list
	 *
	 * @param  $newCSSItems array of items to use
	 */
	function setCSSItems($newCSSItems) {
		$this->csslist = $newCSSItems;
	}
	
	/**
	 * Adds an item to the the css list
	 *
	 * @param  $newCSSitem item to add to the list
	 */
	function addCSSItem($newCSSitem) {
		$this->csslist[] = $newCSSitem;
	}
	
	/**
	 * Removes an item from the css list
	 *
	 * @param  $itemsToRemove array of items to remove
	 */
	function removeCSSItems($itemsToRemove) {
		$this->csslist = array_diff($this->csslist, $itemsToRemove);
	}
		
	/**
	 * Adds an item to the the head script list
	 *
	 * @param  $newHeadScript item to add to the list
	 */
	function addHeadScript($newHeadScript) {
		$this->headscripts[] = $newHeadScript;
	}

	
	/**
	 * Defines the payload of the page: what appears in the content between the body tags
	 *
	 * @param  $newContent HTML text of the content
	 */
	function setContent($newContent) {
		$this->htmlcontent = $newContent;
	}
	
	/**
	 * Returns the HTML of the header from the doctype (if any) up to and including the <body> tag
	 * 
	 * @return the HTML header
	 */
	function htmlHeader() {
		$doctype = $this->doctype;
		$sitename  = $this->sitename;
		$pagetitle = $this->pagetitle;
		if ($sitename != "" & $pagetitle !="") {
			$title = "$sitename | $pagetitle";
		} else {
			$title = $sitename . $pagetitle;
		}
		
		$theHTML  = "";
		
		$theHTML .= "$doctype\n";
		$theHTML .= "<html>\n";
		$theHTML .= "<head>\n";
		$theHTML .= "<title>$title</title>\n";
		$theHTML .= $this->htmlMetaTags();
		$theHTML .= $this->htmlCSSLinks();
		$theHTML .= $this->htmlHeadScripts();
		$theHTML .= "</head>\n";
		$theHTML .= "<body>\n";

		return $theHTML;
	}
	
	function htmlMetaTags() {
		$metalist = $this->metalist;
		$verslist = $this->verslist;
		$charset  = $this->charset;
		
		$theHTML = "";
		
		//<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
		if ($charset != "") {
			$theHTML .= "<meta http-equiv=\"Content-Type\" ";
			$theHTML .= "content=\"text/html; charset=UTF-8\">\n";
		}
		
		//<meta name="description" content="Stratosphere Creative of South Bend, ...">
		foreach ($metalist as $name => $content) {
			$theHTML .= "<meta name=\"$name\" content=\"$content\">\n";
		}
		
		// create a version meta tag
		if ($verslist != "") {
			$versions = "";
			foreach ($verslist as $versitem) {
				$versions .= $versitem['name'];
				$versions .= ": ";
				$versions .= $versitem['shortnumber'];
				$versions .= ", ";
			}
			$versions = trim($versions,", ");
			$theHTML .= "<meta name=\"version\" content=\"$versions\">\n";
		}
		
		return $theHTML;
	}
	
	/**
	 * Returns the HTML of the CSS links
	 * 
	 * @return the HTML linking the page to the site's CSS documents
	 */
	function htmlCSSLinks() {
		$csslist = $this->csslist;
	
		$theHTML  = "";

		//<link href="/styles.css" rel="stylesheet" type="text/css" media="all">
		foreach ($csslist as $fileref) {
			$theHTML .= "<link href=\"/cms/css$fileref\" rel=\"stylesheet\" type=\"text/css\" media=\"all\">\n";
		}
		
		return $theHTML;
	}
	
	/**
	 * Returns the HTML of the head scripts
	 * 
	 * @return the HTML linking the page to the site's external scripts
	 */
	function htmlHeadScripts() {
		$headscripts = $this->headscripts;
	
		$theHTML  = "";

		//<script type="text/javascript" src="swfobject.js"></script>
		foreach ($headscripts as $fileref) {
			$theHTML .= "<script type=\"text/javascript\" src=\"$fileref\"></script>\n";
		}
		
		return $theHTML;
	}

	
	/**
	 * Returns the HTML of the footer from the analytics up to and including the </html> tag
	 * 
	 * @return the HTML footer
	 */
	function htmlFooter() {
		$analytics = $this->analytics;
		
		$theHTML  = "";
		if ($analytics != "none") {
			require_once("analytics_$analytics.php");
		}
		$theHTML .= "\n</body>\n";
		$theHTML .= "</html>\n";

		return $theHTML;
	}
}

?>