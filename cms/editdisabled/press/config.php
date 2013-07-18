<?php

$this->name = "Press";

$this->link["List Items"] = "";
$this->link["Add New Item"] = "?edit=new";

$this->title['edit'] = "Edit Press Item";
$this->title['new']  = "Add New Press Item";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `date` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['date']  = "DATE";
$this->head['title'] = "TITLE";
//$this->head['publication'] = "PUBLICATION";
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['date'] = "date";

// formats : $format => $string
$this->form['date'] = "M j, Y";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "date",
	'name' => "Date",
	'form' => "F j, Y",
	'type' => "date"
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "filename",
	'name' => "PDF",
	'fldr' => "/rsrc/press/releases/",
	'type' => "file",
);
/*
$this->field[] = array(
	'var'  => "publication",
	'name' => "Publication",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "preview",
	'name' => "Preview",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "reference",
	'name' => "Reference",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "type",
	'name' => "Type",
	'type' => "select",
	'vals' => array("Local" => "local", "Remote" => "remote")
);
$this->field[] = array(
	'var'  => "target",
	'name' => "Target",
	'type' => "select",
	'vals' => array("New Window" => "_blank", "Same Window" => "_self")
);
*/

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this item?";
$this->itemid = array("date","title");

?>