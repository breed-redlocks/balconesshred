<?php



// instantiate the page class
require_once("class/Page.php");
$page = new Page();

// ===== DEFINE PAGE CONTENT ===== //

$page->setIdentifier("Contact Us");

$content['top'] = <<<EOHTML
<img src="/rsrc/common/pagetitles/contactus.gif">
EOHTML;

$content['col1'] = '
	<div class="contact-us">
	<form id="contact-us-form" method="post" action="">
	Company *<br>
	<input type="text" class="text" name="company"><br>
	ZIP Code *<br>
	<input type="text" class="text" name="zipcode"><br>
	Contact Name *<br>
	<input type="text" class="text" name="contactname"><br>
	Phone Number *<br>
	<input type="text" class="text" name="phone"><br>
	Email *<br>
	<input type="text" class="text" name="email"><br>
	Details<br>
	<textarea class="text" rows="3" name="details"></textarea><br>
	* indicates required fields<br>
	<input type="hidden" name="quote" value="submitted">
	<input type="image" value="Submit" src="/rsrc/common/submit.gif" class="submit">
	</form>
</div>
<div class="clear"></div>';

// ===== END OF PAGE CONTENT ===== //

$page->setLayout("b");
$page->setContent($content);

// write out the HTML
$page->echoHTML();

?>