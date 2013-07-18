<?php

$this->name = "Links";

$this->link["List Links"] = "";
$this->link["Add New Link"] = "?edit=new";

$this->title['edit'] = "Edit Link";
$this->title['new']  = "New Link";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `text`";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['text'] = "TEXT";
$this->head['link'] = "LINK";

// special formatting for columns : $dbcolumn => $format
//$this->cfrm['datetime'] = "datetime";

// formats : $format => $string
//$this->form['datetime'] = "M j, Y h:i a";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Link",
	'type' => "text"
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this link?";
$this->itemid = array("text");

?>