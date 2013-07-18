<?php

class Site {
	var $stndpage;
	var $homepage;
	var $divs;
	var $version;
	var $name;
	var $company;
	var $root;
	var $metalist;
	
	/**
	 *
	 */
	function Site($cmsReference) {
		$this->cms = $cmsReference;
		$this->version = $this->getVersion();
		
		$this->name    = "Balcones | CMS Content Manager";
		$this->froot   = realpath(dirname(__FILE__) . "/../") . "/";
		
		// define the default meta list
		$this->metalist = array(
			"generator" => "Stratosphere Creative Gold Engine"
		);
		
		// define the standard page
		require_once("Page.php");
		$this->stndpage = new Page();
		$this->stndpage->setSiteName($this->name);
		$this->stndpage->setPageTitle("");
		$this->stndpage->addVersItem($this->version);
		$this->stndpage->setMetaItems($this->metalist);
		$this->stndpage->setCharSet("UTF-8");
		//$this->stndpage->setAnalytics("common");
		//$this->stndpage->addHeadScript("/swfobject.js");
		//$this->stndpage->addHeadScript("/rollover.js");
		
		require_once($this->froot . "siteheader.php");
		require_once($this->froot . "sitefooter.php");
		
		$this->stndpage->divs->setDivContent("hdr",$this->header);
		$this->stndpage->divs->setDivContent("ftr",$footer);
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Site Class";
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
}

?>