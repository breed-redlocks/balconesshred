<?php

$this->name = "Featured Home";

$this->link["List Units"] = "";
$this->link["Add New Unit"] = "?edit=new";

$this->title['edit'] = "Edit Unit";
$this->title['new']  = "New Unit";
$this->title['del']  = "Confirm Delete";

//$this->text['list'] = "Each file may be up to 20 MB.";
//$this->text['edit'] = "Each file may be up to 20 MB.";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `created` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['created'] = "CREATED";
$this->head['type'] = "TYPE";
$this->head['unit'] = "UNIT";
$this->head['active'] = "ACTIVE";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['created'] = "datetime";
$this->cfrm['active'] = "switch";

// formats : $format => $string
$this->form['datetime'] = "M j, Y g:i:s a";
$this->form['switch'] = array("false" => "", "true" => "Yes");

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "type",
	'name' => "Type",
	'type' => "select",
	'vals' => array(
		"Resort Residence" => "Resort Residence",
		"Penthouse Residence" => "Penthouse Residence",
		"Veranda Residence" => "Veranda Residence",
		"Beach Villa" => "Beach Villa",
		"Vacation Rental" => "Vacation Rental",
	),
);
$this->field[] = array(
	'var'  => "unit",
	'name' => "Unit",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "active",
	'name' => "Active",
	'sub'  => "visible or live",
	'col2' => "Making a unit active deactivates all others.",
	'type' => "select",
	'vals' => array(
		"Active" => "true",
		"Inactive" => "false",
	),
);
$this->field[] = array(
	'var'  => "photogrid",
	'name' => "Photo Grid",
	'sub'  => "970x345",
	'fldr' => "/featuredhome/photogrid/",
	'type' => "file",
);
$this->field[] = array(
	'var'  => "photogrid",
	'name' => "Current Photo Grid",
	'fldr' => "/featuredhome/photogrid/",
	'type' => "image",
	'width' => "194",
);
$this->field[] = array(
	'var'  => "steps",
	'name' => "Steps",
	'type' => "textarea",
);
$this->field[] = array(
	'var'  => "description",
	'name' => "Description",
	'type' => "textarea",
);
$this->field[] = array(
	'var'  => "floorplanimg",
	'name' => "Floor Plan Image",
	'sub'  => "xxx x yyy",
	'fldr' => "/featuredhome/floorplanimg/",
	'type' => "file",
);
$this->field[] = array(
	'var'  => "floorplanimg",
	'name' => "Current Floor Plan Image",
	'fldr' => "/featuredhome/floorplanimg/",
	'type' => "image",
	//'width' => "194",
);
$this->field[] = array(
	'var'  => "features",
	'name' => "Features",
	'type' => "textarea",
);
$this->field[] = array(
	'var'  => "price",
	'name' => "Price",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "floorplanpdf",
	'name' => "Floor Plan PDF",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "featurepdf",
	'name' => "Feature PDF",
	'type' => "text",
);

// ========== Presave ============

$this->presaveFile = "presave.php";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this unit?";
$this->itemid = array("created", "type", "unit");

?>