<?php

$this->name = "Locations";

$this->link["List Locations"] = "";
$this->link["Add New Location"] = "?edit=new";

$this->title['edit'] = "Edit Location";
$this->title['new']  = "Add Location";
$this->title['del']  = "Confirm Delete";

$textile  = "<a href=\"http://textism.com/tools/textile/\" target=\"_blank\">";
$textile .= "Textile</a>";

$formatting = <<< EOHTML
<div id="instructions">
<!-- p><b>Formatting Text</b></p -->

<p class="sample"><code>*bold*</code> &rarr; <strong>bold</strong><br />
<code>_italic_</code> &rarr; <em>italic</em><br>
<code>"Stratosphere":http://stratospherecreative.com</code> &rarr; <a href="http://stratospherecreative.com">Stratosphere</a></p>

<p>See the $textile site for more examples.</p>
</div><!-- /div id="instructions" -->
EOHTML;

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `sort` ASC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['sort'] = "ORDER";
$this->head['visible'] = "VISIBLE";
$this->head['item'] = "ITEM";
$this->head['name'] = "NAME";
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['date'] = "date";
$this->cfrm['visible'] = "switch";

// formats : $format => $string
$this->form['date'] = "M j, Y";
$this->form['switch'] = array("true" => "Yes","false" => "No");

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "sort",
	'name' => "Sort Order",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "visible",
	'name' => "Visible",
	'type' => "select",
	'vals' => array(
		"Show" => "true",
		"Hide" => "false",
	),
);
$this->field[] = array(
	'var'  => "item",
	'name' => "Item",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "keywords",
	'name' => "Meta Keywords",
	'type' => "textarea",
);
$this->field[] = array(
	'var'  => "description",
	'name' => "Meta Description",
	'type' => "textarea",
);
$this->field[] = array(
	'var'  => "name",
	'name' => "Name",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "address",
	'name' => "Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "address2",
	'name' => "Line 2",
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
	'var'  => "zipcode",
	'name' => "ZIP Code",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "phone",
	'name' => "Phone",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "url",
	'name' => "Web Address",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
/*
$this->field[] = array(
	'var'  => "email",
	'name' => "Email",
	'type' => "text"
);
*/
$this->field[] = array(
	'var'  => "body",
	'name' => "Body",
	'rows' => "20",
	'type' => "textarea",
	'col2' => $formatting
);
$this->field[] = array(
	'var'  => "link_a",
	'name' => "Link Image A",
	'sub'  => "??? x ???",
	'type' => "file",
	'fldr' => "/rsrc/locations/links_a",
);
$this->field[] = array(
	'var'  => "link_a",
	'name' => "Current Link Image A",
	'type' => "image",
	//"width" => "175",
	'fldr' => "/rsrc/locations/links_a",
	'allowdelete' => "true",
);
$this->field[] = array(
	'var'  => "link_b",
	'name' => "Link Image B",
	'sub'  => "??? x ???",
	'type' => "file",
	'fldr' => "/rsrc/locations/links_b",
);
$this->field[] = array(
	'var'  => "link_b",
	'name' => "Current Link Image B",
	'type' => "image",
	//"width" => "175",
	'fldr' => "/rsrc/locations/links_b",
	'allowdelete' => "true",
);
$this->field[] = array(
	'var'  => "photo",
	'name' => "Photo",
	'sub'  => "??? x ???",
	'type' => "file",
	'fldr' => "/rsrc/locations/photos",
);
$this->field[] = array(
	'var'  => "photo",
	'name' => "Current Photo",
	'type' => "image",
	//"width" => "175",
	'fldr' => "/rsrc/locations/photos",
	'allowdelete' => "true",
);
/*
$this->field[] = array(
	'var'  => "summary",
	'name' => "Summary",
	'sub'  => "one sentence",
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
*/

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this location?";
$this->itemid = array("name");

?>