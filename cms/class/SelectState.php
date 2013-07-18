<?php

/* * * * *
 * Stratosphere Creative
 * Form Library
 * Copyright 2007, All Rights Reserved
 *
 * This library is designed to facilitate the construction of state menus in HTML forms.
 *
 * Primary Functions:
 * - getHTML(): returns HTML for a popup menu containing states and their abbreviations
 */

Class SelectState {
	var $version;
	
	function SelectState() {
		$this->version = $this->getVersion();
		$this->variable = "st";
		$this->stList   = "usstandard";
		$this->selected = "";
		$this->prompt   = "Please select ...";
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "SelectState Class";
		$major = "1";
		$minor = "1";
		$rev   = "1";
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
			"lastmodified" => "November 13, 2007",
			"author" => "Mark B. Priddy"
		);
	}
	
	/*** HTML Construction Functions ***/
	
	function getHTML() {
		$vers     = $this->version;
		$variable = $this->variable;
		$stList   = $this->stList;
		$selected = $this->selected;
		$prompt   = $this->prompt;
		
		if (func_num_args() == 1) { // arguments were passed to this function
			$config = func_get_arg(0);
			if (isset($config['var'])) {
				$variable = $config['var'];
			}
			if (isset($config['list'])) {
				$stList = $config['list'];
			}
			if (isset($config['selected'])) {
				$selected = $config['selected'];
			}
			if (isset($config['mini'])) {
				$mini = $config['mini'];
				if ($mini == "true") {
					$prompt = "";
				}
			} else {
				$mini = "false";
			}
		} else {
			$mini = "false";
		}
		
		$states   = $this->getStates($stList);
		
		$theHTML  = "<select name=\"$variable\" ";
		if (isset($this->tabindex)) {
			$theHTML .= "tabindex=\"$this->tabindex\" ";
		}
		$theHTML .= "scfl=\"$vers\">\n";
		$theHTML .= "<option value=\"\">$prompt</option>\n";
		foreach($states as $abbrv => $name){
			$optSel  = $this->selected($abbrv,$selected);
			$option  = "<option value=\"$abbrv\"$optSel>";
			$end     = "</option>";
			if ($mini == "true") {
				$theHTML .= "$option$abbrv$end\n";
			} else {
				$theHTML .= "$option$name$end\n";
			}
		}
		$theHTML .= "</select>\n";
		
		return $theHTML;
	}
	
	function setTabIndex($newIndex) {
		$this->tabindex = $newIndex;
	}
	
	function selected($a, $b) {
		$theResult = "";
		
		if ($a == $b) {
			$theResult = " selected";
		}
	
		return $theResult;
	}
	
	/*** Data Functions ***/
	
	function getStates($stateList) {
		// retrieve the base data
		$usfifty = $this->usfiftystates();
		$usterr  = $this->uscommonwealthterritories();
		$usmil   = $this->usmilitarystates();
		
		switch ($stateList) {
			case "usfifty":
				$states  = $usfifty;
				break;
			case "usall":
				$states = $usfift + $usterr + $usmil;
				break;
			case "usstandard":
			default:
				$states  = $usfifty;
				$states += array("DC" => $usterr["DC"]);
				$states += array("PR" => $usterr["PR"]);
				break;
		}
		
		asort($states); // sort the array by name (not abbrv)
		
		return $states;
	}
	
	/*** Data Functions - United States State Names and Abbreviations ***/
	
	function usfiftystates() {	// United States - Fifty States
		return array(				// data last updated 2007 0725 mp
			"AL" => "Alabama",
			"AK" => "Alaska",
			"AZ" => "Arizona",
			"AR" => "Arkansas",
			"CA" => "California",
			"CO" => "Colorado",
			"CT" => "Connecticut",
			"DE" => "Delaware",
			"FL" => "Florida",
			"GA" => "Georgia",
			"HI" => "Hawaii",
			"ID" => "Idaho",
			"IL" => "Illinois",
			"IN" => "Indiana",
			"IA" => "Iowa",
			"KS" => "Kansas",
			"KY" => "Kentucky",
			"LA" => "Louisiana",
			"ME" => "Maine",
			"MD" => "Maryland",
			"MA" => "Massachusetts",
			"MI" => "Michigan",
			"MN" => "Minnesota",
			"MS" => "Mississippi",
			"MO" => "Missouri",
			"MT" => "Montana",
			"NE" => "Nebraska",
			"NV" => "Nevada",
			"NH" => "New Hampshire",
			"NJ" => "New Jersey",
			"NM" => "New Mexico",
			"NY" => "New York",
			"NC" => "North Carolina",
			"ND" => "North Dakota",
			"OH" => "Ohio",
			"OK" => "Oklahoma",
			"OR" => "Oregon",
			"PA" => "Pennsylvania",
			"RI" => "Rhode Island",
			"SC" => "South Carolina",
			"SD" => "South Dakota",
			"TN" => "Tennessee",
			"TX" => "Texas",
			"UT" => "Utah",
			"VT" => "Vermont",
			"VA" => "Virginia",
			"WA" => "Washington",
			"WV" => "West Virginia",
			"WI" => "Wisconsin",
			"WY" => "Wyoming"
		);
	}
	
	function uscommonwealthterritories() {	// United States - Commonwealths and Territories
		return array(						// data last updated 2007 0725 mp
			"AS" => "American Samoa",
			"DC" => "District of Columbia",
			"FM" => "Federated States of Micronesia",
			"GU" => "Guam",
			"MH" => "Marshall Islands",
			"MP" => "Northern Mariana Islands",
			"PW" => "Palau",
			"PR" => "Puerto Rico",
			"VI" => "Virgin Islands"
		);
	}
	
	function usmilitarystates() {	// United States - Military States
		return array(				// data last updated 2007 0725 mp
			"AE" => "Armed Forces Africa",
			"AA" => "Armed Forces Americas",
			"AE" => "Armed Forces Canada",
			"AE" => "Armed Forces Europe",
			"AE" => "Armed Forces Middle East",
			"AP" => "Armed Forces Pacific"
		);
	}
	
	/*** Data Functions - Canada Province Names and Abbreviations ***/
	
	function canadaprovinces() {	// Canada Provinces
		return array(				// data last updated 2007 0726 mp
			"AB" => "Alberta",
			"BC" => "British Columbia",
			"MB" => "Manitoba",
			"NB" => "New Brunswick",
			"NL" => "Newfoundland/Labrador",
			"NT" => "Northwest Territory",
			"NS" => "Nova Scotia",
			"NU" => "Nunavut Territory",
			"ON" => "Ontario",
			"PE" => "Prince Edward Island",
			"QC" => "Quebec",
			"SK" => "Saskatchewan",
			"YT" => "Yukon Territory"
		);
	}
}	
?>