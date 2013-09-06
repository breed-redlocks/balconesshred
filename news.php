<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the news class
require_once("class/News.php");
$news = new News();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("News & Testimonials");

$content['top'] = <<<EOHTML
<a href="/newstestimonials.php"><img src="/rsrc/common/pagetitles/newstestimonials.gif"></a>
EOHTML;

$content['col1']  = "";
$content['col1'] .= "<p><img class=\"headline\" src=\"/rsrc/common/headlines/news.gif\"></p>\n";
$content['col1'] .= $news->getHTMLList();

$content['col2'] = $news->getHTML();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("c");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>