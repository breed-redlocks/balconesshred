<?php

$this->name = "Team Members";

$this->link["List Team Members"] = "";
$this->link["Add New Member"] = "?edit=new";

$this->title['edit'] = "Edit Member";
$this->title['new']  = "Add New Member";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `sort` ASC";

// columns in this editor's table : $dbcolumn => $displaycolumn
//$this->head['id'] = "ID";
//$this->head['section'] = "SECTION";
//$this->head['parent_id'] = "PARENT";
$this->head['sort']    = "ORDER";
$this->head['visible'] = "VISIBLE";
$this->head['onhome']  = "HOME";
$this->head['name']    = "NAME";
$this->head['item']    = "ITEM";
$this->head['title']   = "TITLE";
//$this->head['notes']   = "NOTES";
//$this->head['title'] = "TITLE";
//$this->head['column'] = "COLUMN";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['visible'] = "switch";
$this->cfrm['onhome'] = "switch";
$this->cfrm['parent_id'] = "lookup";
$this->cfrm['title'] = "limit";

// formats : $format => $string
$this->form['switch'] = array("true" => "Yes","false" => "No");
$this->form['lookup'] = "id";
$this->form['limit'] = 40;

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$textile  = "<a href=\"http://textism.com/tools/textile/\" target=\"_blank\">";
$textile .= "Textile</a>";

$formatting = <<< EOHTML
<div id="instructions">
<p class="sample"><code>*bold*</code> &rarr; <strong>bold</strong><br />
<code>_italic_</code> &rarr; <em>italic</em><br>
<code>h1. Title</code> &rarr; <h1>Title</h1></p>

<p>See the $textile site for more examples.</p>
</div>
EOHTML;

$this->field[] = array(
	'var'  => "sort",
	'name' => "Sort Order",
	'type' => "text",
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
	'var'  => "onhome",
	'name' => "Show on Home",
	'type' => "select",
	'vals' => array(
		"Show" => "true",
		"Hide" => "false",
	),
);
$this->field[] = array(
	'var'  => "name",
	'name' => "Name",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "item",
	'name' => "Item",
	'type' => "text",
	'col2' => "<b>Must be unique</b> Used to construct URL",
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "intro",
	'name' => "Intro",
	'type' => "textarea",
	'rows' => "10",
	'cols' => "80",
);
$this->field[] = array(
	'var'  => "body",
	'name' => "Text",
	'type' => "textarea",
	'rows' => "20",
	'cols' => "80",
	'col2' => $formatting
);
$this->field[] = array(
	'var'  => "feature",
	'name' => "Feature Image",
	'sub'  => "580 x 200",
	'type' => "file",
	'fldr' => "/rsrc/yourteam/features",
);
$this->field[] = array(
	'var'  => "feature",
	'name' => "Current Feature Image",
	'type' => "image",
	"width" => "290",
	'fldr' => "/rsrc/yourteam/features",
	'allowdelete' => "true",
);
$this->field[] = array(
	'var'  => "callout",
	'name' => "Callout Image",
	'sub'  => "275 wide",
	'type' => "file",
	'fldr' => "/rsrc/yourteam/callouts",
);
$this->field[] = array(
	'var'  => "callout",
	'name' => "Current Callout Image",
	'type' => "image",
	'fldr' => "/rsrc/yourteam/callouts",
	'allowdelete' => "true",
);
$this->field[] = array(
	'var'  => "home",
	'name' => "Home Slide",
	'sub'  => "875 x 300",
	'type' => "file",
	'fldr' => "/rsrc/home/teamslides",
);
$this->field[] = array(
	'var'  => "home",
	'name' => "Current Home Slide",
	'type' => "image",
	"width" => "175",
	'fldr' => "/rsrc/home/teamslides",
	'allowdelete' => "true",
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Link Image",
	'sub'  => "??? x ???",
	'type' => "file",
	'fldr' => "/rsrc/yourteam/links",
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Current Link Image",
	'type' => "image",
	//"width" => "175",
	'fldr' => "/rsrc/yourteam/links",
	'allowdelete' => "true",
);

// ========== Presave Configuration ==========

//$this->presaveFile = "presave.php";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this content item?";
$this->itemid = array("name","title");

?>