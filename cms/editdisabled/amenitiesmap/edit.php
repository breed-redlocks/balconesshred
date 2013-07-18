<?php



// define page title
if ($cms->curEditor->target == "new") {
	$which = "new";
} else {
	$which = "edit";
}
$site->stndpage->nav->setTitle($cms->curEditor->title[$which]);
$site->stndpage->nav->setMessage($cms->curEditor->getText("edit"));

// add in the swfobject JavaScript
$site->stndpage->addHeadScript("swfobject.js");

$content = <<< EOHTML
&nbsp;<br>
<div id="mapeditor">This editor requires Flash in order to operate.</div>
<script type="text/javascript">
// <![CDATA[
var so = new SWFObject("mapeditor.swf", "header", "920", "450", "8", "#FFFFFF");
//so.addVariable("tab", "The Arts");
so.write("mapeditor");
// ]]>
</script>
EOHTML;

/*
// prep prefill variable array
if ($which == "edit") {
	$theQuery  = "SELECT * FROM " . $cms->curEditor->id;
	$theQuery .= " WHERE `id` = " . $cms->curEditor->target;
	
	require_once("../../class/Database.php");
	$database = new Database;
	$theResults = $database->getResults($theQuery);
	
	$prefill = mysql_fetch_assoc($theResults);
} else {
	$theQuery = "";
	$prefill = false;
}

// begin form and table
$content  = "<form enctype=\"multipart/form-data\" action=\"../../save.php\" ";
$content .= "accept-charset=\"UTF-8\" method=\"post\">\n";
$content .= "<table class=\"edit\" cellspacing=\"0\">\n";
$content .= "<!-- $theQuery -->\n";

// instantiate formfield
require_once("../../class/FormField.php");
$formfield = new FormField;

// construct each field
foreach ($cms->curEditor->field as $config) {
	$content .= "<tr>\n";
	//$content .= "<th>{$config['name']}</th>\n";
	$content .= "<th>{$config['name']}";
	
	if (isset($config['sub'])) {
		$content .= "<br>({$config['sub']})";
	}
	
	$content .= "<td>";
	if ($prefill) {
		$config['prefill'] = $prefill[$config['var']];
	} else {
		$config['prefill'] = "";
	}
	$content .= $formfield->getHTML($config);
	$content .= "</td>\n";
	$content .= "</tr>\n";
}

// construct hidden fields and buttons
$content .= "<tr>\n";
$content .= "<th>&nbsp;";
$content .= "<input type=\"hidden\" name=\"redir\" value=\"{$cms->curEditor->wpath}\">";
$content .= "<input type=\"hidden\" name=\"edid\" value=\"{$cms->curEditor->id}\">";
$content .= "<input type=\"hidden\" name=\"id\" value=\"{$cms->curEditor->target}\">";
$content .= "</th>\n";
$content .= "<td>";
$content .= "<input type=\"submit\" name=\"action\" value=\"Save Item\"> &nbsp; ";

// don't make a Delete button if this is a new item
if ($which == "edit") {
	$content .= "<input type=\"submit\" name=\"action\" value=\"Delete Item\"> &nbsp; ";
}

$content .= "<input type=\"submit\" name=\"action\" value=\"Cancel\">";
$content .= "</td>\n";
$content .= "</tr>\n";

// close table and form
$content .= "</table>\n";
$content .= "</form>\n";
*/

?>