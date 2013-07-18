<?php

$this->name = "Glossary";

$this->link["List Entries"] = "";
$this->link["Add New Entry"] = "?edit=new";

$this->title['edit'] = "Edit Entry";
$this->title['new']  = "Add New Entry";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `item` ASC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['item']  = "ITEM";
//$this->head['publication'] = "PUBLICATION";
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
//$this->cfrm['date'] = "date";

// formats : $format => $string
//$this->form['date'] = "M j, Y";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$taginfo = "<b>Sample Tags</b><br>\n[media:100]Caption for Media Item 100[/media]";

$this->field[] = array(
	'var'  => "item",
	'name' => "Item",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'type' => "textarea"
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this entry?";
$this->itemid = array("item");

?>