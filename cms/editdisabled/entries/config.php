<?php

$this->name = "Map Entries";

$this->link["List Entries"] = "";
$this->link["Add New Entry"] = "?edit=new";

$this->title['edit'] = "Edit Entry";
$this->title['new']  = "New Entry";
$this->title['del']  = "Confirm Delete";

//$this->text['list'] = "Each file may be up to 20 MB.";
//$this->text['edit'] = "Each file may be up to 20 MB.";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `name`";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['name'] = "NAME";
//$this->head['address'] = "ADDRESS";
//$this->head['spotlight'] = "SPOT";
//$this->head['mapshow'] = "ON MAP";
//$this->head['filename'] = "FILE NAME";

// special formatting for columns : $dbcolumn => $format
//$this->cfrm['date'] = "date";
$this->cfrm['spotlight'] = "switch";
$this->cfrm['mapshow'] = "switch";
$this->cfrm['address'] = "limit";

// formats : $format => $string
//$this->form['date'] = "M j, Y";
$this->form['switch'] = array("false" => "", "true" => "Yes");

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "name",
	'name' => "Name",
	'type' => "text"
);
/*
$this->field[] = array(
	'var'  => "mapshow",
	'name' => "Show on Map",
	'type' => "select",
	'vals' => array("Show" => "true", "Hide" => "false")
);
$this->field[] = array(
	'var'  => "spotlight",
	'name' => "Spotlight",
	'type' => "checkboxes",
	'vals' => array("true" => "Spotlight on home page")
);
$this->field[] = array(
	'var'  => "image",
	'name' => "Upload Image",
	'sub'  => "220x150",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image",
	'name' => "Current Image",
	'fldr' => "/rsrc/entry/",
	'type' => "image"
);
$this->field[] = array(
	'var'  => "address",
	'name' => "Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "phone",
	'name' => "Phone Number",
	'type' => "text"
);
*/
$this->field[] = array(
	'var'  => "url",
	'name' => "URL",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "description",
	'name' => "Description",
	'type' => "textarea"
);
$this->field[] = array(
	'var'  => "cat1",
	'name' => "Category",
	'type' => "category"
);
/*
$this->field[] = array(
	'var'  => "cat2",
	'name' => "Category 2",
	'type' => "category"
);
$this->field[] = array(
	'var'  => "cat3",
	'name' => "Category 3",
	'type' => "category"
);
$this->field[] = array(
	'var'  => "cat4",
	'name' => "Category 4",
	'type' => "category"
);
$this->field[] = array(
	'var'  => "cat5",
	'name' => "Category 5",
	'type' => "category"
);
*/

$this->wUploadFolder = "/rsrc/entry/";

$this->fUploadFolder = dirname(__FILE__) . "/../../.." . $this->wUploadFolder;
$this->fUploadFolder = realpath($this->fUploadFolder) . "/";

// ========== Presave ============

$this->presaveFile = "presave.php";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this entry?";
$this->itemid = array("name");

?>