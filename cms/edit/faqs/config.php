<?php

$this->name = "FAQs";

$this->link["List FAQs"] = "";
$this->link["Add New FAQ"] = "?edit=new";

$this->title['edit'] = "Edit FAQ";
$this->title['new']  = "Add New FAQ";
$this->title['del']  = "Confirm Delete";

// ========== List Configuration ==========

// how to sort the items in this editor's table
$this->sortClause = "ORDER BY `sort` ASC";

// columns in this editor's table : $dbcolumn => $displaycolumn
//$this->head['id'] = "ID";
$this->head['sort'] = "ORDER";
$this->head['question'] = "QUESTION";
//$this->head['parent_id'] = "PARENT";
//$this->head['title'] = "TITLE";
//$this->head['column'] = "COLUMN";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['column'] = "switch";
$this->cfrm['parent_id'] = "lookup";
$this->cfrm['title'] = "limit";

// formats : $format => $string
//$this->form['switch'] = array("0" => "","1" => "Column 1","2" => "Column 2","3" => "Column 3");
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
	'name' => "Order",
	'type' => "text",
	'col2' => "For sorting.",
);
$this->field[] = array(
	'var'  => "question",
	'name' => "Question",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "answer",
	'name' => "Answer",
	'type' => "textarea",
	'rows' => "40",
	'cols' => "80",
	'col2' => $formatting
);
/*
$this->field[] = array(
	'var'  => "parent_id",
	'name' => "Parent",
	'type' => "parent",
	'table' => "content",
	//'col2' => "For identifying site section and sorting in this editor.",
);
$this->field[] = array(
	'var'  => "name",
	'name' => "Item Name",
	'type' => "text",
	'sub'  => "identifier",
	'col2' => "Only displays in this editor.",
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Page Title",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "keywords",
	'name' => "Meta Keywords",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "description",
	'name' => "Meta Description",
	'type' => "text",
);
$this->field[] = array(
	'var'  => "notes",
	'name' => "Notes",
	'type' => "text",
	'col2' => "Development notes for this item.",
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text",
	'col2' => "Enter a non-breaking space to force an empty title"
);
$this->field[] = array(
	'var'  => "column",
	'name' => "Column",
	'type' => "select",
	'vals' => array("Hide" => "0","Column 1" => "1","Column 2" => "2","Column 3" => "3")
);
$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'type' => "textarea",
	'rows' => "40",
	'cols' => "80",
	'col2' => $formatting
);
*/

// ========== Presave Configuration ==========

//$this->presaveFile = "presave.php";

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this faq?";
$this->itemid = array("question");

?>