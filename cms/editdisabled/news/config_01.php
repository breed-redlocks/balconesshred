<?php

$this->name = "News";

$this->link["List News Items"] = "";
$this->link["Add New Item"] = "?edit=new";

$this->title['edit'] = "Edit News Item";
$this->title['new']  = "Add New Item";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `date` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['date']  = "DATE";
$this->head['title'] = "TITLE";
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
	'var'  => "summary",
	'name' => "Summary",
	'sub'  => "one sentence",
	'type' => "textarea"
);
$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'rows' => "20",
	'type' => "textarea"
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Link",
	'sub'  => "optional",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "href",
	'name' => "Web Address",
	'sub'  => "optional",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "linktarget",
	'name' => "Link Target",
	'sub'  => "optional",
	'type' => "select",
	'vals' => array("New Window" => "_blank", "Same Window" => "")
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this news item?";
$this->itemid = array("date","title");

?>