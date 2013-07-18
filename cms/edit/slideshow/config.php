<?php

$this->name = "Slide Show";

$this->link["List Slides"] = "";
$this->link["Add New Slide"] = "?edit=new";

$this->title['edit'] = "Edit Slide";
$this->title['new']  = "Add New Slide";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `sort` ASC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['sort']    = "ORDER";
$this->head['title']   = "TITLE";
$this->head['visible'] = "VISIBLE";
$this->head['onhome']  = "HOME";
$this->head['link']    = "LINK";



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
	'var'  => "title",
	'name' => "Title",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Link",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "altText",
	'name' => "ALT Text",
	'type' => "text",
	'col2' => "Alternate text to display if image fails to load",
);
$this->field[] = array(
	'var'  => "home",
	'name' => "Home Slide",
	'sub'  => "875 x 300",
	'type' => "file",
	'fldr' => "/rsrc/slideshow",
);
$this->field[] = array(
	'var'  => "home",
	'name' => "Current Home Slide",
	'type' => "image",
	"width" => "175",
	'fldr' => "/rsrc/slideshow",
	'allowdelete' => "true",
);


// ========== Presave Configuration ==========

//$this->presaveFile = "presave.php";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this content item?";
$this->itemid = array("name","title");

?>