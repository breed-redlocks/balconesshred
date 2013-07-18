<?php

$this->name = "Contact";

$this->link["List Contact Items"] = "";
$this->link["Add New Contact"] = "?edit=new";

$this->title['edit'] = "Edit Contact Item";
$this->title['new']  = "Add New Contact";
$this->title['del']  = "Confirm Delete";


// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `created` DESC ";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['created']  = "DATE";
$this->head['type'] = "TYPE";
$this->head['email'] = "EMAIL";
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['created'] = "datetime";

// formats : $format => $string
$this->form['datetime'] = "M j, Y g:i:s a";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "created",
	'name' => "Date created",
	'form' => "F j, Y g:i:s a",
	'type' => "datetime"
);
$this->field[] = array(
	'var'  => "type",
	'name' => "Type",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "email",
	'name' => "Email Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "firstname",
	'name' => "First Name",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "lastname",
	'name' => "Last Name",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "address",
	'name' => "Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "address2",
	'name' => "Address 2",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "city",
	'name' => "City",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "state",
	'name' => "State",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "postalcode",
	'name' => "Postal Code",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "country",
	'name' => "Country",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "telephone",
	'name' => "Phone",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "hearabout",
	'name' => "Heard About",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "other",
	'name' => "Heard About, Other",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "visit",
	'name' => "Next Visit",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "interest",
	'name' => "Interest",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "hometype",
	'name' => "Home Type",
	'type' => "text"
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this contact item?";
$this->itemid = array("type","email");

?>