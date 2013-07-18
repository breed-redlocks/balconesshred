<?php

$this->name = "Schedule";

$this->link["List Schedule Items"] = "";
$this->link["Add New Schedule Item"] = "?edit=new";

$this->title['edit'] = "Edit Schedule Item";
$this->title['new']  = "New Schedule Item";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `startdate` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['startdate'] = "START DATE";
$this->head['enddate']   = "END DATE";
$this->head['type']      = "TYPE";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['startdate'] = "date";
$this->cfrm['enddate']   = "date";

// formats : $format => $string
$this->form['date'] = "M Y";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "startdate",
	'name' => "Start Date",
	'form' => "F j, Y",
	'type' => "date"
);
$this->field[] = array(
	'var'  => "enddate",
	'name' => "End Date",
	'form' => "F j, Y",
	'type' => "date"
);
$this->field[] = array(
	'var'  => "type",
	'name' => "Type",
	'type' => "textarea",
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this schedule item?";
$this->itemid = array("startdate","type");

?>