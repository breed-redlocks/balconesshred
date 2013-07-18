<?php

$this->name = "What’s New";

$this->link["List Items"] = "";
$this->link["Add New Item"] = "?edit=new";

$this->title['edit'] = "Edit Item";
$this->title['new']  = "New Item";
$this->title['del']  = "Confirm Delete";

$this->text['list'] = "Each file may be up to 20 MB.";
$this->text['edit'] = "Each file may be up to 20 MB.";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `title`";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['title'] = "TITLE";
$this->head['filename'] = "FILE NAME";

// special formatting for columns : $dbcolumn => $format
//$this->cfrm['date'] = "date";

// formats : $format => $string
//$this->form['date'] = "M j, Y";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "filename",
	'name' => "File",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "description",
	'name' => "description",
	'type' => "textarea"
);

$this->wUploadFolder = "/rsrc/details/cmsdownloads/";

$this->fUploadFolder = dirname(__FILE__) . "/../../.." . $this->wUploadFolder;
$this->fUploadFolder = realpath($this->fUploadFolder) . "/";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this download?";
$this->itemid = array("title");

?>