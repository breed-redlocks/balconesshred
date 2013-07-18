<?php

// set page title
$site->stndpage->nav->setTitle($cms->curEditor->title['del']);

// construct the query
$theQuery  = "SELECT * FROM " . $cms->curEditor->id;
$theQuery .= " WHERE `id` = " . $cms->curEditor->target;

// instantiate the database
require_once("../../class/Database.php");
$database = new Database;
$theResults = $database->getResults($theQuery);

$row = mysql_fetch_assoc($theResults);

// construct the item identifier
foreach ($cms->curEditor->itemid as $field) {
	if (isset($cms->curEditor->cfrm[$field])) {
		if (preg_match('/date/',$cms->curEditor->cfrm[$field]) == 1) {
			$datestamp = strtotime($row[$field]);
			$item[] = date($cms->curEditor->form[$cms->curEditor->cfrm[$field]],$datestamp);
		} else {
			$item[] = $rawvalue;
		}
	} else {
		$item[] = $row[$field];
	}
}
$targetID = implode($item, " ");

// begin table and form
$content  = "<form action=\"../../save.php\" method=\"post\">\n";
$content .= "<table class=\"delete\" cellspacing=\"0\">\n";

$content .= "<tr>\n";
$content .= "<td>{$cms->curEditor->prompt['del']}</td>";
$content .= "</tr>\n";
$content .= "<tr>\n";
$content .= "<td class=\"item\">$targetID</td>";
$content .= "</tr>\n";
$content .= "<tr>\n";
$content .= "<td>";
$content .= "<input type=\"submit\" name=\"action\" value=\"Delete\"> ";
$content .= "<input type=\"submit\" name=\"action\" value=\"Cancel\">";
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

$content .= "</td>\n";
$content .= "</tr>\n";

// close table and form
$content .= "</table>\n";
$content .= "</form>\n";

?>