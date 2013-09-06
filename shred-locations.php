<?php

define('HIDEAAA', true);


// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the locations class
require_once("class/Locations.php");
$locations = new Locations();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Locations");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/locationsNoAAA.gif">
EOHTML;

$content['feature'] = <<<EOHTML
<img src="/rsrc/locations/feature.gif" usemap="#locations">
<map name="locations">
<area shape="rect" coords="195,221,272,246" href="/location/austin-shred">
<area shape="rect" coords="337,247,426,267" href="/location/san-antonio-shredding">
<area shape="rect" coords="142,113,287,132" href="/location/dallas-fort-worth-shredding">
<area shape="rect" coords="192,168,268,188" href="/location/waco-shredding">
</map>
EOHTML;

/*
<map name="locations">
<area shape="rect" coords="205, 88,276,113" href="/location.php?id=3">
<area shape="rect" coords="243,150,339,175" href="/location.php?id=4">
<area shape="rect" coords="341,147,406,172" href="/location.php?id=1">
<area shape="rect" coords="262,217,326,234" href="/location.php?id=2">
<area shape="rect" coords="313,229,389,245" href="/location.php?id=5">
<area shape="rect" coords="294,247,397,267" href="/location.php?id=7">
</map>
EOHTML;
*/

$content['wcol1'] = $page->getHTMLDefaultContent();

$content['wcol2'] = $locations->getHTMLList("A");

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("d");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>
