<?php

define("HIDEAAA", true);

// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the locations class
require_once("class/Locations.php");
$locations = new Locations();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Contact Us");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/contactusNoAAA.gif">
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

$content['col2'] = $locations->getHTMLList("B");

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("c");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>
