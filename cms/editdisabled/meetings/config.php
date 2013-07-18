<?php

$this->name = "Meetings";

$this->link["List Meetings"] = "";
$this->link["Add New Meeting"] = "?edit=new";

$this->title['edit'] = "Edit Meeting";
$this->title['new']  = "New Meeting";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `datetime` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['datetime'] = "DATE &amp; TIME";
$this->head['location'] = "LOCATION";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['datetime'] = "datetime";

// formats : $format => $string
$this->form['datetime'] = "M j, Y h:i a";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "datetime",
	'name' => "Date &amp; Time",
	'form' => "F j, Y h:i a",
	'type' => "datetime"
);
$this->field[] = array(
	'var'  => "location",
	'name' => "Location",
	'type' => "text"
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this meeting?";
$this->itemid = array("datetime","location");

?>