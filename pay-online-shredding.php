<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Pay My Bill");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/payonline.gif">
EOHTML;

$content['col1']  = $page->getHTMLDefaultContent();

$content['col1'] .= <<<EOHTML
<form method="post" action="https://www.eProcessingNetwork.com/cgi-bin/wo/order.pl" target="_blank">

<input type="hidden" name="ePNAccount" value="031041">

<input type="hidden" name="ReturnApprovedURL" value="http://www.balconesshred.com/paymentapproved.php">
<input type="hidden" name="ReturnDeclinedURL" value="http://www.balconesshred.com/paymentfailed.php">

<input type="hidden" name="LogoURL" value="http://balconesshred.com/rsrc/nav/logo.gif">
<input type="hidden" name="BackgroundColor" value="#ffffff">
<input type="hidden" name="TextColor" value="#360f54">

<input type="hidden" name="ItemQty" value="1">
Invoice Number<br>
<input type="text" name="ItemDesc"><br>
Total Amount<br>
<input type="text" name="ItemCost"><br>
<input type="submit" value="Submit">
</form>
EOHTML;

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>