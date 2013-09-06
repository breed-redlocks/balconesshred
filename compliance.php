<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Compliance Ready");
$categories = $page->nav->getHTMLCategoryList("category");

$content['top'] = <<<EOHTML
<div class="overflow-hidden"></div>
$categories
EOHTML;

/*
$content['top'] = <<<EOHTML
<div class="overflow-hidden"></div>
<ul id="categories">
<li><a href="/budget.php"><img src="/rsrc/common/categories/budget-title.gif"></a></li>
<li><a href="/services.php"><img src="/rsrc/common/categories/services-title.gif"></a></li>
<li><img src="/rsrc/common/categories/compliance-active.gif"></li>
</ul>
EOHTML;
*/

$content['col1'] = $page->getHTMLDefaultContent();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>