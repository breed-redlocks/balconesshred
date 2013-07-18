<?php

$this->name = "Quote Inquiries";

$this->link["List Quote Inquiries"] = "";
//$this->link["Add New Quote Inquiry"] = "?edit=new";

$this->title['edit'] = "Edit Quote Inquiry";
$this->title['new']  = "Add Quote Inquiry";
$this->title['del']  = "Confirm Delete";


// ========== List Configuration ==========

// define a custom query
//$this->customQuery = "SELECT * FROM `contact` WHERE `spamflags` = ''";

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `spamflags`, `created` DESC ";

// columns in this editor's table : $dbcolumn => $displaycolumn
$displaySpamFields = false;
if ($displaySpamFields) {
	$this->head['created']  = "DATE";
	$this->head['spamflags']  = "SPAM FLAGS";
	$this->head['georegion']  = "REGION";
	$this->head['zipcode'] = "ZIP";
	$this->head['phone'] = "PHONE";
} else {
	$this->head['created']  = "DATE";
	$this->head['company'] = "COMPANY";
	$this->head['zipcode'] = "ZIP";
	$this->head['contactname'] = "CONTACT NAME";
	$this->head['email'] = "EMAIL";
	$this->head['phone'] = "PHONE";
}
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['created'] = "datetime";
$this->cfrm['spamflags'] = "limit";

// formats : $format => $string
$this->form['datetime'] = "M j, Y g:i:s a";
$this->form['limit'] = "10";

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
	'var'  => "company",
	'name' => "Company",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "zipcode",
	'name' => "ZIP Code",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "contactname",
	'name' => "Contact Name",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "phone",
	'name' => "Phone",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "email",
	'name' => "Email Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "details",
	'name' => "Details",
	'type' => "textarea"
);

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this entry?";
$this->itemid = array("email");

?>