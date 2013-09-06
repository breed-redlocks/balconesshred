<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the FAQs class
require_once("class/FAQs.php");
$faqs = new FAQs();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("FAQs: Ask Chewy");
$page->addJSItem("jquery.faqs.js");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/faqs.gif">
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();
//$content['page'] = $page->getHTMLDefaultContent();

//$content['col1'] = $faqs->getHTMLList();
//$content['col2'] = $faqs->getHTML();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("e");
$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>