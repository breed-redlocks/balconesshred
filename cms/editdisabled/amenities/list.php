<?php

$site->stndpage->nav->setTitle($cms->curEditor->name);
$site->stndpage->nav->setMessage($cms->curEditor->getText("list"));

require_once("../../class/Table.php");
$table = new Table($cms);

require_once("../../class/FormField.php");
$formField = new FormField();

require_once("../../../class/Categories.php");
$categories = new Categories();

$selectAlpha = $formField->getHTML(array(
	'var' => "alpha",
	'prompt' => "Alpha",
	'prefill' => isset($_GET['alpha']) ? $_GET['alpha'] : "",
	'type' => "select",
	'vals' => array(
		"--" => "non",
		"A" => "A",
		"B" => "B",
		"C" => "C",
		"D" => "D",
		"E" => "E",
		"F" => "F",
		"G" => "G",
		"H" => "H",
		"I" => "I",
		"J" => "J",
		"K" => "K",
		"L" => "L",
		"M" => "M",
		"N" => "N",
		"O" => "O",
		"P" => "P",
		"Q" => "Q",
		"R" => "R",
		"S" => "S",
		"T" => "T",
		"U" => "U",
		"V" => "V",
		"W" => "W",
		"X" => "X",
		"Y" => "Y",
		"Z" => "Z"
	)
));

$categoryList = $categories->getCategoriesAssoc();
$selectCategory = $formField->getHTML(array(
	'var' => "category",
	'prompt' => "Category",
	'prefill' => isset($_GET['category']) ? $_GET['category'] : "",
	'type' => "select",
	'vals' => $categoryList
));

$content = "";

// begin filter form
/*
$content .= <<< EOHTML
<form>
Filter By: 
$selectAlpha
$selectCategory
<input type="submit" value="Apply">
</form>
EOHTML;
*/

// start list table
$content .= $table->getHTMLList("filtered");

?>