<?php

class Nav {
	
	function Nav() {
		// instantiate the contact class
		require_once("Contact.php");
		$this->contact = new Contact();
		
		// instantiate the locations class
		require_once("Locations.php");
		$this->locations = new Locations();
		
		$this->div = "hdr";
		$this->subnavDiv = "sub";
		$this->sidebarDiv = "side";
		$this->footerDiv = "ftr";
		$this->defineItems();
		$this->version = $this->getVersion();
		
		// initialize marked item and subnav
		$this->markedItem = "";
		$this->subnav = "";
		
		// set modes
		$this->primaryMode   = "text";
		$this->secondaryMode = "text";
		
		// graphics folders
		$this->commonFolder  = "/rsrc/common";
		$this->primaryFolder = "/rsrc/nav";
		$this->categoryFolder = "/rsrc/common/categories";
		$this->secondaryFolder = "/rsrc/nav";
		$this->sidebarFolder = "/rsrc/side";
	}
	
	function getDiv() {
		return $this->div;
	}
	
	function getSubnavDiv() {
		return $this->subnavDiv;
	}
	
	function getSidebarDiv() {
		return $this->sidebarDiv;
	}
	
	function getFooterDiv() {
		return $this->footerDiv;
	}
	
	function markItem($which) {
		$this->markedItem = $which;
	}
	
	function setSubnav($which) {
		$this->subnav = $which;
	}
	
	// ===== OUTPUT METHODS ===== //
	
	function getHTML() {
		$folder = $this->primaryFolder;
		
		$theHTML  = "";
		$theHTML .= "<a class=\"logo\" href=\"/index.html\"><img src=\"$folder/logo.gif\"></a>\n";
		$theHTML .= $this->getHTMLPrimaryItems();
		$theHTML .= $this->getHTMLSecondaryItems();
		
		return $theHTML;
	}
	
	function getHTMLPrimaryItems() {
		foreach ($this->primaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$isrc = $item['isrc'];
			$msrc = $item['msrc'];
			$fold = $this->primaryFolder;
			
			if ($this->markedItem == $name) {
			$ahref = '<a href="' . $href . '" class="selected">';
			$linkt = "$ahref$name</a>";
			} else {
			$ahref = "<a href=\"$href\">";
			$linkt = "$ahref$name</a>";
			}
			
			$text[] = '<div class="primaryNavItem">' . $linkt;
			
			if ($this->markedItem == $name) {
				$image = "<img src=\"$fold/$msrc\">";
			} else {
				$image = "<img src=\"$fold/$isrc\">";
			}
			$images[] = "$ahref$image</a>";
			$items[]  = "<li>$ahref$image</a></li>";
		}
		
		//print_r ($text);
		switch ($this->primaryMode) {
			case "text":
				$theHTML = '<div id="primaryNav">' . implode('</div>', $text) . '</div><div class="clear"></div></div>';
				break;
			case "images":
				$theHTML = implode("", $images); 
				break;
			case "list":
			default:
				$theHTML  = "<ul class=\"nav\" id=\"primary\">\n";
				$theHTML .= implode("\n", $items);
				$theHTML .= "</ul>\n";
				break;
		}
				
		return $theHTML;
	}
	
	function getHTMLSecondaryItems() {
		foreach ($this->secondaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$isrc = $item['isrc'];
			$msrc = $item['msrc'];
			$fold = $this->secondaryFolder;
			
			//$ahref = "<a href=\"$href\">";
			if ($this->markedItem == $name) {
			$ahref = '<a href="' . $href . '" class="selected">';
			$linkt = "$ahref$name</a>";
			} else {
			$ahref = '<a href="' . $href . '">';
			$linkt = "$ahref$name</a>";
			}
			
			$text[] = '<div class="secondaryNavItem">' .  $linkt;
			
			if ($this->markedItem == $name) {
				$image = "<img src=\"$fold/$msrc\">";
			} else {
				$image = "<img src=\"$fold/$isrc\">";
			}
			$images[] = "$ahref$image</a>";
			$items[]  = "<li>$ahref$image</a></li>";
		}
		
		switch ($this->secondaryMode) {
			case "text":
				$theHTML = '<div id="secondaryNav">' . implode('</div>', $text) . '</div><div class="clear"></div></div>';
				break;
			case "images":
				$theHTML = implode("", $images); 
				break;
			case "list":
			default:
				$theHTML  = "<ul class=\"nav\" id=\"secondary\">\n";
				$theHTML .= implode("\n", $items);
				$theHTML .= "</ul>\n";
				break;
		}
				
		return $theHTML;
	}

	
	function getHTMLCategoryList($which) {
		$folder = $this->categoryFolder;
		
		$theHTML  = "";
		$theHTML .= "<ul id=\"categories\">\n";
		foreach ($this->categoryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$isrc = $item['isrc'];
			$asrc = $item['asrc'];
			$tsrc = $item['tsrc'];
			
			// define the anchor tag
			$ahref = "<a href=\"$href\">";
			
			// define the img tag
			if ($which == "home") {
				$img = "<img src=\"$folder/$isrc\" alt=\"Commercial Shredding Services\" title=\"Compliance Shredding\">";
				$theItem = "$ahref$img</a>";
			} else {
				$timg = "<img src=\"$folder/$tsrc\">";
				$aimg = "<img src=\"$folder/$asrc\">";
				if ($this->markedItem == $name) {
					$theItem = $aimg;
				} else {
					$theItem = "$ahref$timg</a>";
				}
			}
			
			$theHTML .= "<li>$theItem</li>";
		}
		$theHTML .= "</ul>\n";
		
		return $theHTML;
	}
	
	function getHTMLTertiaryItems() {
		$theHTML  = "";
		foreach ($this->tertiaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$targ = $item['targ'];
			
			$target = "";
			if ($targ != "") {
				$target = " target=\"$targ\"";
			}
			
			$ahref = "<a href=\"$href\"$target>";
			$linkt = "<li>$ahref$name</a></li>";
			$text[] = $linkt;
		}
		
		$theHTML  = "<ul class=\"nav\" id=\"tertiary\">\n";
		$theHTML .= implode("\n", $text);
		$theHTML .= "</ul>\n";

		
		return $theHTML;
	}
	
	function getHTMLSidebar() {
			$theHTML = '	
<div class="ask">
	  <p class="whiteTxt">FAQs <br>
	  <a href="http://www.balconesshred.com/faqs.html" class="bigTxt" title="Ask Chewy">
	  Ask Chewy</a></p>
</div>

<div class="Call">
	<p class="locations">North & Northwest Texas:<br>
  	<span class="phoneNumber"><a href="tel:9725346000">972-534-6000</a></span>
  	<div class="cities">
  	 <!-- <a href="/location/amarillo-shredding" title="Amarillo">Amarillo,</a> -->
  	 <a href="/location/dallas-fort-worth-shredding" title="Dallas/Fort Worth">Dallas & Fort Worth</a> 
	 <!-- <a href="/location/el-paso-shredding" title="El Paso">El Paso,</a> -->
  	 <!-- <a href="/location/lubbock-shredding" title="Lubbock">Lubbock</a> -->
  </div>
</p>
</div>

<div class="Call">
	<p class="locations">Central & South Texas:<br>
  	<span class="phoneNumber"><a href="tel:5126000787">512-600-0787</a></span>
  	<div class="cities">
  	<a href="/location/austin-shred" title="Austin">Austin, </a>
    <!-- <a href="/location/houston-shredding" title="Houston">Houston,</a> -->
    <a href="/location/san-antonio-shredding" title="San Antonio"> San Antonio,</a>
    <a href="/location/waco-shredding" title="Waco"> Waco</a>
  </div>
  </p> 
</div>
<div class="espanol">
<p><a href="mailto:espanol@balconesshred.com" class="Hespanol" title="Hablamos Español">Hablamos Español</a></p>
</div>' .

/*

<div class="quote-inq">
	<form id="quote" method="post" action="">
	<p><span class="phoneNumber">Quote Inquiry</span></p>
	Company *<br>
	<input type="text" class="text" name="company"><br>
	ZIP Code *<br>
	<input type="text" class="text" name="zipcode"><br>
	Contact Name *<br>
	<input type="text" class="text" name="contactname"><br>
	Phone Number *<br>
	<input type="text" class="text" name="phone"><br>
	Email *<br>
	<input type="text" class="text" name="email"><br>
	Details<br>
	<textarea class="text" rows="3" name="details"></textarea><br>
	* indicates required fields<br>
	<input type="hidden" name="quote" value="submitted">
	<input type="image" value="Submit" src="/rsrc/common/submit.gif" class="submit">
	</form>
</div>*/

'<div id="contact-form">
	<style type="text/css">
	#quote .field { padding: 2px; width: 261px; border: 0; }
	#quote p { color: white; }
	</style>
	<form class="contact" id="quote" action="" method="post" name="contactUs">
		<input type="hidden" name="encoding" value="UTF-8" />
		<input type="hidden" name="oid" value="00DG0000000gQuq" />
		<input type="hidden" name="retURL" value="http://balconesshred.com' . htmlentities($_SERVER['REQUEST_URI']) . '" />
		<input type="hidden" id="00NG0000009GAoF" maxlength="255" name="00NG0000009GAoF" value="http://balconesshred.com' . htmlentities($_SERVER['REQUEST_URI']) . '" />

		<input name="submitted" value="true" type="hidden" />

		<p><span class="phoneNumber">Quote Inquiry</span></p>

		<div id="contact-form-col-1">
			<div class="contact-form-row">	
				<div class="contact-form-field">
					First Name
					<input type="text" class="field" name="first_name" id="first_name" maxlength="40" value="" />
				</div>
			</div>

			<div class="contact-form-row">	
				<div class="contact-form-field">
					Last Name
					<input type="text" class="field" name="last_name" id="last_name" maxlength="80" value="" />
				</div>
			</div>
		
			<div class="contact-form-row">	
				<div class="contact-form-field">
					Company
					<input type="text" class="field" name="company" id="company" maxlength="40" value="" />
				</div>
			</div>
		
			<div class="contact-form-row">	
				<div class="contact-form-field">
					Address
					<input type="text" name="street" class="field" value="" />
				</div>
			</div>
			<div class="contact-form-row">	
				<div class="contact-form-field">
					City
					<input type="text" name="city" id="city" class="field" maxlength="40" value="" />
				</div>
			</div>		
			<div class="contact-form-row">	
				<div class="contact-form-field">
					State
					<input type="text" name="state" id="state" class="field" maxlength="20" value="" />
				</div>
			</div>
			<div class="contact-form-row">	
				<div class="contact-form-field">
					ZIP Code
					<input type="text" name="zip" id="zip" class="field" maxlength="20" value="" />
				</div>
			</div>
			<div class="contact-form-row">	
				<div class="contact-form-field">
					Phone Number
					<input type="text" name="phone" id="phone" class="field" maxlength="40" value="" />
				</div>
			</div>
			<div class="contact-form-row">	
				<div class="contact-form-field">
					Email
					<input type="text" name="email" id="email" class="field" maxlength="100" value="" />
				</div>
			</div>
			<div class="contact-form-row">	
				<div class="contact-form-field">
					Details
					<textarea name="description" class="field"></textarea>
				</div>
			</div>
			
			<div id="contact-button-row" class="contact-form-row">	
				<div class="contact-form-button">
					<input type="image" value="Submit" src="/rsrc/common/submit.gif" class="submit">
				</div>
			</div>
		</div>	
	</form>

	<script type="text/javascript">
		$("form.contact").submit(function(e){
			var firstName = $(this).find("#first_name"),
				lastName = $(this).find("#last_name"),
				email = $(this).find("#email");

			if(firstName.val() == firstName[0].defaultValue) {
				alert("First name is required");
				firstName.focus();
				e.preventDefault();
				return;
			}
			if(lastName.val() == lastName[0].defaultValue) {
				alert("Last name is required");
				lastName.focus();
				e.preventDefault();
				return;
			}
			if(email.val() == email[0].defaultValue) {
				alert("Email address is required");
				email.focus();
				e.preventDefault();
				return;
			}

			if(!e.isDefaultPrevented()) {
				e.preventDefault();

				$.ajax({
					type: "POST",
					url: "https://www.salesforce.com/servlet/servlet.WebToLead",
					data: $(this).serialize()
				});
				$("#thankyou").attr("src","quotethankyou.html"); 
				
				$(this).find("#contact-form-col-1").html("<p>Your inquiry has been submited. Thank you!</p>");
			}
		});
	</script>
	
</div>
<div class="clear"></div>';
		
		return $theHTML;
	}
	
	function getHTMLSubnav() {
		if ($this->subnav == "") {
			$theHTML = "&nbsp;";
		} else {
			foreach ($this->secondaryItems[$this->subnav] as $item) {
				$name = $item['name'];
				$href = $item['href'];
				$isrc = $item['isrc'];
				$msrc = $item['msrc'];
				
				if ($this->secondaryMode == "text") {
					$items[] = "<a href=\"$href\">$name</a>";
				} else {
					$items[] = "";
				}
			}
			
			$theHTML = implode("<br \>\n", $items);
		}
		
		return $theHTML;
	}
	
	function getHTMLFooter() {
		
		$primaries[] = "<a href=\"/index.html\">Home</a>";
		foreach ($this->primaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			
			$primaries[] = "<a href=\"$href\">$name</a>";
		}
		foreach ($this->secondaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$flag = $item['flag'];
			
			if ($flag != "notinfooter") {
				$secondaries[] = "<a href=\"$href\">$name</a>";
			}
		}
		foreach ($this->categoryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			
			$categories[] = "<a href=\"$href\">$name</a>";
		}
		foreach ($this->sidebarItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$xtra = $item['xtra'];
			$flag = $item['flag'];
			
			if ($flag != "notinfooter") {
				$sidebars[] = "<a href=\"$href\">$name</a>";
			}
		}
		foreach ($this->tertiaryItems as $item) {
			$name = $item['name'];
			$href = $item['href'];
			$targ = $item['targ'];
			
			$target = "";
			if ($targ != "") {
				$target = " target=\"$targ\"";
			}
			
			$tertiaries[] = "<a href=\"$href\"$target>$name</a>";
		}
		$locations = $this->locations->getList();
				
		$theHTML  = "";
		
		$footer = "/rsrc/common/footer";
		$theHTML .= "<div class=\"icons\"><iframe id ='thankyou' name='thankyou' width='0px' height='0px' src='wait.php' style='display:none;visibility:hidden'></iframe>\n";
		// Hide NAID logo for austin, waco, san antonio,
		if (isset($locations) && 
			($locations->data[item] !== "austin-shred") && 
			($locations->data[item] !== "san-antonio-shredding") && 
			($locations->data[item] !== "waco-shredding")) {
		
			$theHTML .= "<img src=\"$footer/naidaaaseal.gif\">\n";
		}

		$theHTML .= "<img src=\"$footer/facta.gif\">\n";
		$theHTML .= "<img src=\"$footer/redflag.gif\">\n";
		$theHTML .= "<img src=\"$footer/hitechhipaa.gif\">\n";
		//$theHTML .= "<img src=\"$footer/hipaa.gif\">\n";
		$theHTML .= "<img src=\"$footer/sox.gif\">\n";
		$theHTML .= "<img src=\"$footer/tx698.gif\">\n";
		$theHTML .= "</div>";
		
		$theHTML .= "<div class=\"top\">\n";
		$theHTML .= implode(" ", $primaries);
		$theHTML .= " | ";
		$theHTML .= implode(" ", $secondaries);
		$theHTML .= " | ";
		$theHTML .= implode(" ", $categories);
		$theHTML .= "</div>";
		$theHTML .= "<div class=\"top\">\n";
		$theHTML .= "<a href=\"/shred-locations.html\">Locations: </a>";
		$theHTML .= implode(" ", $locations);
		$theHTML .= "</div>";
		$theHTML .= implode(" ", $tertiaries);
		$theHTML .= " | ";
		$theHTML .= implode(" ", $sidebars);
		
		return $theHTML;
	}
		
	function getHTMLHierarchicalSecondaryItems($primaryitem) {
		$theHTML = "";
		
		if ($this->subnav == $primaryitem['name'] and
			isset($this->secondaryitems[$primaryitem['name']])) {
			foreach ($this->secondaryitems[$primaryitem['name']] as $secondaryitem) {
				$theHTML .= $this->getHTMLSecondaryItem($secondaryitem);
			}
		}
		
		return $theHTML;
	}
	
	function getHTMLSecondaryItem($secondaryitem) {
		$folder = $this->folder;
		$name = $secondaryitem['name'];
		$href = $secondaryitem['href'];
		$isrc = $secondaryitem['isrc'];
		$msrc = $secondaryitem['msrc'];
		
		// determine which image to use
		if ($this->markeditem == $secondaryitem['name']) {
			$src = $msrc;
		} else {
			$src = $isrc;
		}
		$image = "<img src=\"$folder/$src\" alt=\"$name\">";
		
		// determine whether to make a link
		if ($this->markeditem == $secondaryitem['name']) {
			$theHTML  = $image;
		} else {
			$theHTML  = "<a href=\"$href\">";
			$theHTML .= $image;
			$theHTML .= "</a>";
		}
		
		$theHTML .= "<br />\n";
		
		return $theHTML;
	}
	
	// ===== ITEM DEFINITION METHODS ===== //
	
	function defineItems() {
		$this->definePrimaryItems();
		$this->defineCategoryItems();
		$this->defineSecondaryItems();
		$this->defineTertiaryItems();
		$this->defineSidebarItems();
	}
	
	function definePrimaryItems() {
		$this->primaryItems[] = array(
			"name" => "Sustainability",
			"href" => "/shredding-sustainability.html",
			"isrc" => "sustainability.gif",
			"msrc" => "sustainability_m.gif"
		);
		$this->primaryItems[] = array(
			"name" => "Security",
			"href" => "/shredding-security.html",
			"isrc" => "security.gif",
			"msrc" => "security_m.gif"
		);
		$this->primaryItems[] = array(
			"name" => "What to Shred",
			"href" => "/what-to-shred.html",
			"isrc" => "whattoshred.gif",
			"msrc" => "whattoshred_m.gif"
		);
		$this->primaryItems[] = array(
			"name" => "Why Shred",
			"href" => "/why-shred.html",
			"isrc" => "",
			"msrc" => "active"
		);
		
		
		
	}
	
	function defineCategoryItems() {
		$this->categoryItems[] = array(
			"name" => "Budget Wise",
			"href" => "/budget.html",
			"isrc" => "budget.gif",
			"asrc" => "budget-active.gif",
			"tsrc" => "budget-title.gif",
		);
		$this->categoryItems[] = array(
			"name" => "Service Focused",
			"href" => "/shredding-services.html",
			"isrc" => "services.gif",
			"asrc" => "services-active.gif",
			"tsrc" => "services-title.gif",
		);
		$this->categoryItems[] = array(
			"name" => "Compliance Ready",
			"href" => "/compliance.html",
			"isrc" => "compliance.gif",
			"asrc" => "compliance-active.gif",
			"tsrc" => "compliance-title.gif",
		);
	}

	function defineSecondaryItems() {
		$this->secondaryItems[] = array(
			"name" => "Contact Us",
			"href" => "/contact-us-shred.html",
			"isrc" => "contactus.gif",
			"msrc" => "contactus_m.gif"
		);
		$this->secondaryItems[] = array(
			"name" => "Pay Online",
			"href" => "/pay-online-shredding.html",
			"isrc" => "payonline.gif",
			"msrc" => "payonline_m.gif"
		);
		$this->secondaryItems[] = array(
			"name" => "News & Testimonials",
			"href" => "/shredding-news-testimonials.html",
			"isrc" => "newstestimonials.gif",
			"msrc" => "newstestimonials_m.gif"
		);
		$this->secondaryItems[] = array(
			"name" => "Your Team",
			"href" => "/your-shredding-team.html",
			"isrc" => "yourteam.gif",
			"msrc" => "yourteam_m.gif"
		);
		$this->secondaryItems[] = array(
			"name" => "Locations",
			"href" => "/shred-locations.html",
			"isrc" => "locations.gif",
			"msrc" => "locations_m.gif",
			"flag" => "notinfooter",
		);
	}

	
	function defineTertiaryItems() {
		$this->tertiaryItems[] = array(
			"name" => "©2010 Balcones Resources",
			"href" => "http://www.balconesresources.com",
			"targ" => "_blank",
		);
		$this->tertiaryItems[] = array(
			"name" => "Privacy Policy",
			"href" => "/privacy.html",
		);
		$this->tertiaryItems[] = array(
			"name" => "Site Map",
			"href" => "/sitemap.html",
		);

	}
	
	function defineSidebarItems() {
		$this->sidebarItems[] = array(
			"name" => "FAQs: Ask Chewy",
			"href" => "/faqs.html",
			"isrc" => "faqs.gif",
			"msrc" => "faqs_m.gif",
			"xtra" => "",
			"flag" => "",
		);
		$this->sidebarItems[] = array(
			"name" => "North & Northwest Texas: 972-247-3500 " .
					  "(Amarillo, Dallas/Fort Worth, El Paso, Lubbock)",
			"isrc" => "callnorth.gif",
			"xtra" => "",
			"flag" => "notinfooter",
		);
		$this->sidebarItems[] = array(
			"name" => "Central & South Texas: 512-744-4999 " .
					  "(Austin, Houston, San Antonio, Waco)",
			"isrc" => "callsouth.gif",
			"xtra" => "",
			"flag" => "notinfooter",
		);
		/*
		$this->sidebarItems[] = array(
			"name" => "Call Us Today: 877-597-3500",
			"isrc" => "call.gif",
			"xtra" => "",
			"flag" => "notinfooter",
		);
		$this->sidebarItems[] = array(
			"name" => "The Epic of Chewy",
			"href" => "/chewy.php",
			"xtra" => "",
			"flag" => "notinsidebar",
		);
		*/
		$this->sidebarItems[] = array(
			"name" => "Hablamos Español",
			"href" => "mailto:espanol@balconesshred.com",
			"isrc" => "espanol.gif",
			"xtra" => "",
			"flag" => "notinfooter",
		);
		$this->sidebarItems[] = array(
			"name" => "Quote Inquiry",
			"href" => "",
			"isrc" => "quote.gif",
			"xtra" => $this->contact->getHTMLQuoteForm(),
			"flag" => "notinfooter",
		);
	}
	
	/**
	 * Returns an array specifying the version of this class
	 *
	 * @return array of version information
	 */
	function getVersion() {
		$name  = "Nav Class";
		$major = "2";
		$minor = "0";
		$rev   = "0";
		$build = "0005";
		$modified = "March 24, 2009";
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
}

?>