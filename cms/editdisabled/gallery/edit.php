<?php



// define page title
if ($cms->curEditor->target == "new") {
	$which = "new";
} else {
	$which = "edit";
}
$site->stndpage->nav->setTitle($cms->curEditor->title[$which]);
$site->stndpage->nav->setMessage($cms->curEditor->getText("edit"));

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
$content  = "<div id=\"col1\">\n";
$content .= "<form enctype=\"multipart/form-data\" action=\"../../save.php\" ";
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
	if ($prefill && isset($prefill[$config['var']])) {
		$config['prefill'] = $prefill[$config['var']];
	} else {
		$config['prefill'] = "";
	}
	$content .= $formfield->getHTML($config);
	$content .= "</td>\n";
	
	// construct extra TD if there's a col2
	$content .= "<td>";
	if (isset($config['col2'])) {
		$content .= $config['col2'];
	} else {
		$content .= "&nbsp;";
	}
	$content .= "</td>\n";
	
	$content .= "</tr>\n";
}

// construct hidden fields and buttons
$content .= "<tr>\n";
$content .= "<th>&nbsp;";
$content .= "<input type=\"hidden\" name=\"redir\" value=\"{$cms->curEditor->wpath}\">";
$content .= "<input type=\"hidden\" name=\"edid\" value=\"{$cms->curEditor->id}\">";
$content .= "<input type=\"hidden\" name=\"id\" value=\"{$cms->curEditor->target}\">";

if (isset($_GET['alpha'])) {
	$alpha = $database->prepVariable($_GET['alpha']);
	$content .= "<input type=\"hidden\" name=\"alpha\" value=\"$alpha\">";
}
if (isset($_GET['category'])) {
	$category = $database->prepVariable($_GET['category']);
	$content .= "<input type=\"hidden\" name=\"category\" value=\"$category\">";
}

$content .= "</th>\n";
$content .= "<td>";
$content .= "<input type=\"submit\" name=\"action\" value=\"Save Item\"> &nbsp; ";

// don't make a Delete button if this is a new item
if ($which == "edit") {
	//$content .= "<input type=\"submit\" name=\"action\" value=\"Delete Item\"> &nbsp; ";
}

$content .= "<input type=\"submit\" name=\"action\" value=\"Cancel\">";
$content .= "</td>\n";
$content .= "<td>";
$content .= "&nbsp;";
$content .= "</td>\n";
$content .= "</tr>\n";

// close table and form
$content .= "</table>\n";
$content .= "</form>\n";
$content .= "</div><!-- /div id=\"col1\" -->\n";

// start column 2, if present
if (isset($cms->curEditor->content['col2'])) {
	$content .= "<div id=\"col2\">\n";
	$content .= $cms->curEditor->content['col2'];
	$content .= "\n</div><!-- /div id=\"col2\" -->\n";
}

?>