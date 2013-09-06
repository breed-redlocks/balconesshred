<?php

define('HIDEAAA', true);

// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// instantiate the team class
require_once("class/Team.php");
$team = new Team();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Your Team");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/yourteamNoAAA.gif">
EOHTML;

$content['col1'] = $page->getHTMLDefaultContent();

$content['col2'] = $team->getHTMLList();

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("c");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>
