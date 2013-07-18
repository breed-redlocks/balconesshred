<?php

$this->name = "News";

$this->link["List News Items"] = "";
$this->link["Add New Item"] = "?edit=new";

$this->title['edit'] = "Edit News Item";
$this->title['new']  = "Add New Item";
$this->title['del']  = "Confirm Delete";

$textile  = "<a href=\"http://textism.com/tools/textile/\" target=\"_blank\">";
$textile .= "Textile</a>";

/*
$this->content['col2'] = <<< EOHTML
<p><b>Formatting Text</b></p>

<p>The news module supports a text markup system known as "$textile." This allows you to use simple markup to format the text of a given news item.</p>

<p>For example:</p>

<p class="sample"><code>Today, *South Bend* celebrated it's first 100 years.</code></p>

<p class="sample"><span class="becomes">... becomes ...</span></p>

<p class="sample">Today, <strong>South Bend</strong> celebrated it's first 100 years.</p>

<p>Some other simple examples:</p>

<p class="sample"><code>This is *bold*.</code> <span class="becomes">becomes</span> This is <strong>bold</strong>.<br>
<code>This is _italic_.</code> <span class="becomes">becomes</span> This is <em>italic</em>.<br>
<code>An acronym, DTSB(Downtown South Bend)</code> <span class="becomes">becomes</span> An acronym, <acronym title="Downtown South Bend"><span class="caps">DTSB</span></acronym>.<br>
<code>"Click here":http://www.morriscenter.org/</code> <span class="becomes">becomes</span> <a href="http://www.morriscenter.org/">Click here</a><br></p>
EOHTML;

$this->content['col2'] = <<< EOHTML
<p><b>Formatting Text</b></p>

<p>The news module supports a text markup system known as "$textile." This allows you to use simple markup to format the text of a given news item.</p>

<p>For example:</p>

<p class="sample"><code>*bold*</code> &rarr; <strong>bold</strong><br />
<code>_italic_</code> &rarr; <em>italic</em><br>
<code>"Stratosphere":http://stratospherecreative.com</code> &rarr; <a href="http://stratospherecreative.com">Stratosphere</a>
</p>
EOHTML;

$this->content['col2'] = <<< EOHTML
<p><b>Formatting Text With Textile</b></p>

<p class="sample"><code>*bold*</code> &rarr; <strong>bold</strong><br />
<code>_italic_</code> &rarr; <em>italic</em><br>
<code>"Stratosphere":http://stratospherecreative.com</code> &rarr; <a href="http://stratospherecreative.com">Stratosphere</a></p>

<p>See the $textile site for more examples.</p>
EOHTML;
*/

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
$this->sortClause = "ORDER BY `date` DESC";

// columns in this editor's table : $dbcolumn => $displaycolumn
$this->head['date']  = "DATE";
$this->head['title'] = "TITLE";
//$this->head['info']  = "INFO";

// special formatting for columns : $dbcolumn => $format
$this->cfrm['date'] = "date";

// formats : $format => $string
$this->form['date'] = "M j, Y";

// function list : $text => $url
$this->func['Edit']   = "?edit=";
$this->func['Delete'] = "?del=";

// ========== Edit Configuration ==========

$this->field[] = array(
	'var'  => "date",
	'name' => "Date",
	'form' => "F j, Y",
	'type' => "date"
);
$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "summary",
	'name' => "Summary",
	'sub'  => "one sentence",
	'type' => "textarea"
);
$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'rows' => "20",
	'type' => "textarea",
	'col2' => $formatting
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

// ========== Delete Configuration ==========

$this->prompt['del'] = "Are you sure you want to delete this news item?";
$this->itemid = array("date","title");

?>