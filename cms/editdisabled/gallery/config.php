<?php

$this->name = "Work";

$this->link["Open Work Editor"] = "";

$this->title['list'] = "Work Editor";
$this->title['edit'] = "Edit Work Item";

$this->text['list']  = "Drag a tile to reorder. Click Save to update. ";
$this->text['list'] .= "To edit a work item, double click a tile.";

// ========== Edit Configuration ==========

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

$this->field[] = array(
	'var'  => "title",
	'name' => "Title",
	'type' => "text"
);
$this->field[] = array(
	'var'  => "text",
	'name' => "Text",
	'type' => "textarea",
	'rows' => "10",
	'cols' => "40",
	'col2' => $formatting
);
$this->field[] = array(
	'var'  => "link1",
	'name' => "Link Text",
	'sub'  => "First",
	'col2' => "Clickable text (\"Visit Web Site\")"
);
$this->field[] = array(
	'var'  => "href1",
	'name' => "Link Address",
	'sub'  => "First",
	'col2' => "Site URL (\"http://www.farmsd.com\")"
);
$this->field[] = array(
	'var'  => "link2",
	'name' => "Link Text",
	'sub'  => "Second",
	'col2' => "Clickable text (\"Visit Web Site\")"
);
$this->field[] = array(
	'var'  => "href2",
	'name' => "Link Address",
	'sub'  => "Second",
	'col2' => "Site URL (\"http://www.farmsd.com\")"
);
$this->field[] = array(
	'var'  => "link3",
	'name' => "Link Text",
	'sub'  => "Third",
	'col2' => "Clickable text (\"Visit Web Site\")"
);
$this->field[] = array(
	'var'  => "href3",
	'name' => "Link Address",
	'sub'  => "Third",
	'col2' => "Site URL (\"http://www.farmsd.com\")"
);
/*
$this->field[] = array(
	'var'  => "attributes",
	'name' => "Attributes",
	'sub'  => "Check all that apply",
	'type' => "attributes"
);
*/
$this->field[] = array(
	'var'  => "thumb",
	'name' => "Upload Thumb",
	'fldr' => "/rsrc/home/thumbs/",
	'sub'  => "146x146",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "thumb",
	'name' => "Current Thumb",
	'fldr' => "/rsrc/home/thumbs/",
	'type' => "image"
);
$this->field[] = array(
	'var'  => "mini",
	'name' => "Upload Sidebar Image",
	'fldr' => "/rsrc/cases/mini/",
	'sub'  => "300 pixel max width",
	'type' => "file",
	'col2' => "This is typically the logo image in the right column"
);
$this->field[] = array(
	'var'  => "mini",
	'name' => "Current Sidebar Image",
	'fldr' => "/rsrc/cases/mini/",
	'type' => "image"
);

$this->field[] = array(
	'var'  => "image1",
	'name' => "Upload Image 1",
	'fldr' => "/rsrc/cases/image/",
	'sub'  => "900 pixel max width",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image1",
	'name' => "Current Image 1",
	'fldr' => "/rsrc/cases/image/",
	'width' => "300",
	'height' => "100",
	'type' => "image",
	'allowdelete' => true
);
$this->field[] = array(
	'var'  => "image2",
	'name' => "Upload Image 2",
	'fldr' => "/rsrc/cases/image/",
	'sub'  => "900 pixel max width",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image2",
	'name' => "Current Image 2",
	'fldr' => "/rsrc/cases/image/",
	'width' => "300",
	'height' => "100",
	'type' => "image",
	'allowdelete' => true
);
$this->field[] = array(
	'var'  => "image3",
	'name' => "Upload Image 3",
	'fldr' => "/rsrc/cases/image/",
	'sub'  => "900 pixel max width",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image3",
	'name' => "Current Image 3",
	'fldr' => "/rsrc/cases/image/",
	'width' => "300",
	'height' => "100",
	'type' => "image",
	'allowdelete' => true
);
$this->field[] = array(
	'var'  => "image4",
	'name' => "Upload Image 4",
	'fldr' => "/rsrc/cases/image/",
	'sub'  => "900 pixel max width",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image4",
	'name' => "Current Image 4",
	'fldr' => "/rsrc/cases/image/",
	'width' => "300",
	'height' => "100",
	'type' => "image",
	'allowdelete' => true
);
$this->field[] = array(
	'var'  => "image5",
	'name' => "Upload Image 5",
	'fldr' => "/rsrc/cases/image/",
	'sub'  => "900 pixel max width",
	'type' => "file"
);
$this->field[] = array(
	'var'  => "image5",
	'name' => "Current Image 5",
	'fldr' => "/rsrc/cases/image/",
	'width' => "300",
	'height' => "100",
	'type' => "image",
	'allowdelete' => true
);

?>