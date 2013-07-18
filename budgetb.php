<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Budget");

$content['top'] = <<<EOHTML
<div class="overflow-hidden"></div>
<ul id="categories">
<li><img src="/rsrc/common/categories/budget-active.gif"></li>
<li><a href="/services.php"><img src="/rsrc/common/categories/services-title.gif"></a></li>
<li><a href="/compliance.php"><img src="/rsrc/common/categories/compliance-title.gif"></a></li>
</ul>
<div class="clear"></div>
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>