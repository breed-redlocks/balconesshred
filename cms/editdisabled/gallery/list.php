<?php



// define page title
if ($cms->curEditor->target == "new") {
	$which = "new";
} else {
	$which = "list";
}

$site->stndpage->nav->setTitle($cms->curEditor->title[$which]);
$site->stndpage->nav->setMessage($cms->curEditor->getText("list"));

// add in the swfobject JavaScript
$site->stndpage->addHeadScript("swfobject.js");

$content = <<< EOHTML
&nbsp;<br>
<div id="slideeditor">This editor requires Flash in order to operate.</div>
<script type="text/javascript">
// <![CDATA[
var so = new SWFObject("slideeditor.swf", "slideeditor", "950", "355", "8", "#FFFFFF");
so.write("slideeditor");
// ]]>
</script>
EOHTML;

?>