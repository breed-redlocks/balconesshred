<?php

$this->name = "Testimonials";

$this->link["List Testimonials"] = "";
$this->link["Add New Testimonial"] = "?edit=new";

$this->title['edit'] = "Edit Testimonial";
$this->title['new']  = "Add Testimonial";
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
$this->sortClause = "ORDER BY `sort` ";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['sort']    = "SORT";
$this->head['date']    = "DATE";
$this->head['name']    = "NAME";
$this->head['company'] = "COMPANY";
$this->head['summary'] = "SUMMARY";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['date'] = "date";
$this->cfrm['summary'] = "limit";

// formats : $format => $string
$this->form['date'] = "M j, Y";

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
	'var'  => "date",
	'name' => "Date",
	'type' => "date"
);
$this->field[] = array(
	'var'  => "name",
	'name' => "Name",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "company",
	'name' => "Company",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "summary",
	'name' => "Summary",
	'sub'  => "one sentence",
	'type' => "textarea"
);
$this->field[] = array(
	'var'  => "body",
	'name' => "Body",
	'rows' => "20",
	'type' => "textarea",
	'col2' => $formatting
);
/*
$this->field[] = array(
	'var'  => "image",
	'name' => "Link Image",
	'sub'  => "??? x ???",
	'type' => "file",
	'fldr' => "/rsrc/locations/links",
);
$this->field[] = array(
	'var'  => "link",
	'name' => "Current Link Image",
	'type' => "image",
	//"width" => "175",
	'fldr' => "/rsrc/locations/links",
	'allowdelete' => "true",
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

$this->prompt['del'] = "Are you sure you want to delete this testimonial?";
$this->itemid = array("name");

?>