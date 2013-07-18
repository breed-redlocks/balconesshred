<?php

$this->name = "Amenities Map";

$this->link["Open Amenities Map Editor"] = "";
$this->link["View Amenities Map"] = "viewmap.php";

$this->title['edit'] = "Amenities Map Editor";
/*
$this->text['edit']  = "To add a dot, use the <a href=\"../amenities/\">";
$this->text['edit'] .= "Amenities Editor</a> to set an Entry's \"Show on Map\" value to ";
$this->text['edit'] .= "\"Show.\" For best results, enable only a few Entries at a ";
$this->text['edit'] .= "time. New Entries will show up at the top left of the map. ";
$this->text['edit'] .= "Click Save at the bottom of the map when you're done.";
*/

/*
$this->title['edit'] = "Edit Calendar Event";
$this->title['new']  = "New Calendar Event";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `datetime` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['datetime'] = "DATE & TIME";
$this->head['name']     = "NAME";
//$this->head['location'] = "LOCATION";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['datetime'] = "datetime";

// formats : $format => $string
$this->form['datetime'] = "D, F j, Y g:i a";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "datetime",
	'name' => "Date & Time",
	'form' => "F j, Y g:i a",
	'type' => "datetime"
);
$this->field[] = array(
	'var'  => "name",
	'name' => "Name",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "eid",
	'name' => "Location",
	'type' => "entry",
);
$this->field[] = array(
	'var'  => "url",
	'name' => "URL",
	'type' => "text",
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this calendar entry?";
$this->itemid = array("datetime","name");
*/

?>