<?php

/**
 * Handles the creation and display of a page
 */
class Page {
	
	/**
	 * Sets the defaults for this instance
	 */
	function Page() {
		// define the site specific data
		$this->setSiteName("Balcones Shred");
		$this->showSiteName = false;
		$this->addMetaItem("keywords", "");
		$this->addMetaItem("author", "Balcones Resources, Inc");
		$this->addMetaItem("copyright", "&copy; 2010, Balcones Resources, Inc.");
		$this->addMetaItem("publisher", "Balcones Resources, Inc");
		$this->addMetaItem("robots", "all");
		$this->addMetaItem("revisit-after", "7 day");
		$this->setSiteFooter("2010", "Balcones Resources");
		
		// define folders
		$this->site = dirname(dirname(__FILE__));
		$this->rsrc = $this->site . "/rsrc";

		// define version
		$this->version = $this->getVersion();
		$this->addVersItem($this->version);	
				
		// instantiate the layout object
		require_once("Layout.php");
		$this->layout = new Layout();
		$this->addVersItem($this->layout->version);
		
		// instantiate the content object
		require_once("Content.php");
		$this->cont = new Content();

		/*
		// instantiate the user object
		require_once("User.php");
		$this->user = new User();
		$this->addVersItem($this->user->version);
		*/
		
		// instantiate the nav object
		require_once("Nav.php");
		$this->nav = new Nav();
		$this->addVersItem($this->nav->version);
		$this->navDiv = $this->nav->getDiv();
		$this->footerDiv = $this->nav->getFooterDiv();
		$this->sidebarDiv = $this->nav->getSidebarDiv();
		$this->markNav = true; // mark the nav when page title is set?
		
		// assign defaults
		$this->setDocType("html 5");
		$this->charSet     = "UTF-8";
		$this->title       = "";
		$this->cssList     = array("standard.css","layout.css","typography.css");
		$this->cssFolder   = "/css";
		$this->jsItems     = array("jquery-1.4.2.min.js","swfobject.js");
		$this->jsFolder    = "/js";
		$this->headScripts = array();
		$this->content     = "";
		$this->analytics   = "common";
		
		$this->addMetaItem("generator", "Stratosphere Creative Gold Engine");
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Page Class";
		$major = "2";
		$minor = "1";
		$rev   = "0";
		$build = "0005";
		$modified = "February 23, 2010";
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
	
	function addMetaItem($name,$value) {
		$this->metaList[$name] = $value;
	}
	
	function setColorStyle($which) {
		$this->colorstyle = $which;
	}
	
	function setColorPalette($which) {
		$this->palette = $which;
		if ($this->colorstyle == "white") {
			$this->addCSSItem("color$which.css");
		} else {
			$this->addCSSItem("colorfilled$which.css");
		}
		$this->nav->setColorPalette($which);
		
	}
	
	function setLayout($which) {
		$this->layout->setLayout($which);
		$this->addCSSItem("layout$which.css");
	}
	
	function setContent($content) {
		$this->layout->setContent($content);
	}
	
	function setContentOfDiv($which, $content) {
		$this->layout->setContentOfDiv($which, $content);
	}
		
	function echoHTML() {
		echo $this->getHTML();
	}
	
	/**
	 * returns the aggregated output of the html construction functions and the page's content
	 */
	function getHTML() {
		// add the nav to the layout
		$this->layout->setContentOfDiv($this->navDiv, $this->nav->getHTML());
		
		// add the sidebar to the layout
		$this->layout->setContentOfDiv($this->sidebarDiv, $this->nav->getHTMLSidebar());
		
		// add the footer nav to the layout
		//$this->layout->setContentOfDiv($this->footerDiv, $this->nav->getHTMLTertiaryItems());
		$this->layout->setContentOfDiv($this->footerDiv, $this->nav->getHTMLFooter());
		
		// add the footer to the layout
		//$this->layout->setContentOfDiv("ftr",$this->sitefooter);
		
		$theHTML  = "";
		
		$theHTML .= $this->getHTMLHeader();
		$theHTML .= $this->layout->getHTML();
		$theHTML .= $this->getHTMLFooter();
		
		return $theHTML;
	}
	
	function getHTMLDefaultContent() {
		return $this->getHTMLContentByName($this->identifier);
	}
	
	function getHTMLContent($which) {
		return $this->cont->getHTML($which);
	}
	
	function getHTMLContentByName($which) {
		return $this->cont->getHTMLByName($which);
	}
		
	/**
	 * Defines the site name for all pages (in the window title bar)
	 *
	 * @param  $newName the text of the new title
	 */
	function setSiteName($name) {
		$this->sitename = $name;
	}
	
	function setSubnav($which) {
		$this->nav->setSubnav($which);
	}
	
	function setSiteFooter($year, $company) {
		$byName = "Stratosphere Creative";
		$byHREF = "http://www.stratospherecreative.com";
		
		$footerItems[] = "<iframe id ='thankyou' name='thankyou' width='0px' height='0px' src='wait.php' style='display:none;visibility:hidden'></iframe>© $year $company";
		$footerItems[] = "<a href=\"privacy.php\">Privacy Policy</a>";
		$footerItems[] = "Site by <a href=\"$byHREF\" target=\"_blank\">$byName</a>";
		
		$text = implode(" | ", $footerItems);
		
		$this->sitefooter  = "<img src=\"/rsrc/common/ftr.gif\"><br>\n";
		$this->sitefooter .= "<p>$text</p>\n";
	}
	
	/**
	 * Defines the title for the page (in the window title bar)
	 *
	 * @param  $newTitle the text of the new title
	 */
	function setTitle($title) {
		$this->title = $title;
		if ($this->markNav) {
			$this->nav->markItem($title);
		}
	}
	
	function setIdentifier($identifier) {
		$this->identifier = $identifier;
		$this->title = $this->cont->getField("title", $identifier);
		$this->addMetaItem("keywords", $this->cont->getField("keywords", $identifier));
		$this->addMetaItem("description", $this->cont->getField("description", $identifier));
		if ($this->markNav) {
			$this->nav->markItem($identifier);
		}
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
			case "html5":
			case "html 5":
				$this->doctype = "<!DOCTYPE html>";
				break;
			case "html 4 strict":
			case "html 4.01 strict":
				$this->doctype = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" "
				. "\"http://www.w3.org/TR/html4/strict.dtd\">";
				break;
			case "html 4 transitional":
			case "html 4 trans":
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
	function addVersItem($item) {
		$this->versList[] = $item;
	}
	
	/**
	 * Completely replaces the css list
	 *
	 * @param  $newCSSItems array of items to use
	 */
	function setCSSItems($items) {
		$this->csslist = $items;
	}
	
	/**
	 * Adds an item to the the css list
	 *
	 * @param  $newCSSitem item to add to the list
	 */
	function addCSSItem($item) {
		$this->cssList[] = $item;
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
	function addJSItem($newHeadScript) {
		$this->jsItems[] = $newHeadScript;
	}
	
	function addHeadScript($newHeadScriptItem) {
		$this->headScripts[] = $newHeadScriptItem;
	}
	
	/**
	 * Returns the HTML of the header from the doctype (if any) up to and including the <body> tag
	 * 
	 * @return the HTML header
	 */
	function getHTMLHeader() {
		$doctype  = $this->doctype;
		$sitename = $this->sitename;
		$title    = $this->title;
		
		if ($this->showSiteName) {
			if ($sitename != "" & $title != "") {
				$title = "$title | $sitename";
			} else {
				$title = $sitename . $title;
			}
		}
				
		$theHTML  = "";
		
		$theHTML .= "$doctype\n";
		$theHTML .= "<html>\n";
		$theHTML .= "<head>\n";
		$theHTML .= $this->getHTMLMetaTags();
		$theHTML .= "<title>$title</title>\n";
		$theHTML .= $this->getHTMLCSSItems();
		$theHTML .= $this->getHTMLJSItems();
		$theHTML .= $this->getHTMLHeadScripts();
		$theHTML .= "</head>\n";
		$theHTML .= "<body>\n\n";

		return $theHTML;
	}
	
	function getHTMLMetaTags() {
		$metaList = $this->metaList;
		$versList = $this->versList;
		$charSet  = $this->charSet;
		
		$theHTML = "";
		
		if ($charSet != "") {
			$theHTML .= "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=7\" />";
			$theHTML .= "<meta http-equiv=\"Content-Type\" ";
			$theHTML .= "content=\"text/html; charset=UTF-8\">\n";
		}
		
		$theHTML .= "<meta http-equiv=\"imagetoolbar\" content=\"no\">\n";
		$theHTML .= "<meta http-equiv=\"Cache-Control\" content=\"no-cache\">\n";
		$theHTML .= "<meta http-equiv=\"Expires\" content=\"never\">\n";

		foreach ($metaList as $name => $content) {
			if ($content != "") {
				$theHTML .= "<meta name=\"$name\" content=\"$content\">\n";
			}
		}
		
		// create a version meta tag
		if ($versList != "") {
			$versions = "";
			foreach ($versList as $versItem) {
				$versions .= $versItem['name'];
				$versions .= ": ";
				$versions .= $versItem['shortnumber'];
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
	function getHTMLCSSItems() {
		$cssFolder = $this->cssFolder;

		$theHTML  = "";
		foreach ($this->cssList as $file) {
			$theHTML .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"$cssFolder/$file\">\n";
		}
				
		return $theHTML;
	}
	
	/**
	 * Returns the HTML of the head scripts
	 * 
	 * @return the HTML linking the page to the site's external scripts
	 */
	function getHTMLJSItems() {
		$jsFolder = $this->jsFolder;
		
		$theHTML  = "";
		foreach ($this->jsItems as $file) {
			$theHTML .= "<script type=\"text/javascript\" src=\"$jsFolder/$file\"></script>\n";
		}
		
		return $theHTML;
	}
	
	function getHTMLHeadScripts() {
		$theHTML  = "";
		foreach ($this->headScripts as $item) {
			$theHTML .= "<script type=\"text/javascript\">\n";
			$theHTML .= "$item\n";
			$theHTML .= "</script>\n";
		}
				
		return $theHTML;
	}

	
	/**
	 * Returns the HTML of the footer from the analytics up to and including the </html> tag
	 * 
	 * @return the HTML footer
	 */
	function getHTMLFooter() {
		$analytics = $this->analytics;
		
		$theHTML  = "";

		if ($analytics != "none") {
			$analyticsfile = $this->rsrc . "/analytics/$analytics.php";
			$theHTML .= "<div id=\"analytics\" style=\"display:none\">\n";
			$theHTML .= file_get_contents($analyticsfile);
			$theHTML .= "\n</div>\n";
		}
		
		$theHTML .= "\n</body>\n";
		$theHTML .= "</html>\n";

		return $theHTML;
	}
}

?>