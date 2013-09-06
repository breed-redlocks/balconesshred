<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Containers");

$content['top'] = <<<EOHTML
<a href="/containers.php"><img src="/rsrc/common/pagetitles/containers.gif"></a>
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>