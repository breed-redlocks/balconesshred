<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the locations class
require_once("class/Locations.php");
$locations = new Locations();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Location");
$page->addMetaItem("keywords", $locations->getField("keywords"));
$page->addMetaItem("description", $locations->getField("description"));
$page->title = $locations->getField("title");
if ((isset($_GET['item'])) &&  $_GET['item'] == "dallas-fort-worth-shredding") {
$content['top'] = <<<EOHTML
<a href="/locations.php"><img src="/rsrc/common/pagetitles/locations.gif"></a>
EOHTML;
} else {
$content['top'] = <<<EOHTML
<a href="/locations.php"><img src="/rsrc/common/pagetitles/locationsNoAAA.gif"></a>
EOHTML;
}

$content['col1'] = $locations->getHTMLText();

$content['col2'] = $locations->getHTMLDetails();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("c");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>
