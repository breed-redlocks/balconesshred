<?php
// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the team class
require_once("class/Slideshow.php");
$slidshow = new Slideshow();
$slides = $slidshow->getHTMLHomeSlides();

// instantiate the news class
require_once("class/News.php");
$news = new News();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Home");

$categories = $page->nav->getHTMLCategoryList("home");

$page->addJSItem("jquery.cycle.lite.1.0.min.js");
$page->addJSItem("jquery.homeslides.js");

$content['top'] = <<<EOHTML
$slides
$categories
<div class="clear"></div>
EOHTML;

/*
<ul id="categories">
<li><a href="/budget.php"><img src="/rsrc/common/categories/budget.gif" alt="Budjet Friendly Shredding" title="Budjet Friendly Shredding"></a></li>
<li><a href="/services.php"><img src="/rsrc/common/categories/services.gif" alt="Commercial Shredding Services" title="Commercial Shredding Services"></a></li>
<li><a href="/compliance.php"><img src="/rsrc/common/categories/compliance.gif" alt="Compliance Shredding" title="Compliance Shredding"></a></li>
</ul>
<div class="clear"></div>
EOHTML;
*/

$content['col1']  = $page->getHTMLDefaultContent();
$content['col1'] .= "<p><img src=\"/rsrc/common/headlines/latestnews.gif\" title=\"Dallas Shredding News\"></p>\n";
$content['col1'] .= $news->getHTMLHomeList();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("a");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>