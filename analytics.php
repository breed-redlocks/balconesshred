<?php

ini_set("display_errors", true);

// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the testimonials class
require_once("class/Testimonials.php");
$testimonials = new Testimonials();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("News & Testimonials");
$page->analytics = "common";

$content['top'] = <<<EOHTML
<a href="/newstestimonials.php"><img src="/rsrc/common/pagetitles/newstestimonials.gif"></a>
EOHTML;

$content['col1']  = "";
$content['col1'] .= "<p><img class=\"headline\" src=\"/rsrc/common/headlines/testimonials.gif\"></p>\n";
$content['col1'] .= $testimonials->getHTMLList();

$content['col2'] = $testimonials->getHTML();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("c");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>