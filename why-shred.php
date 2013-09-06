<?php


// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Why Shred");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/whyshred.gif">
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>
