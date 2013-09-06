<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("What to Shred");

$content['top'] = <<<EOHTML
<a href="/whyshred.php"><img src="/rsrc/common/pagetitles/whattoshred.gif"></a>
EOHTML;

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/whattoshred.gif">
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>