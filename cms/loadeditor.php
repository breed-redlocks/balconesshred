<?php



require_once("class/CMS.php");
$cms = new CMS;

if (isset($_POST['editor']) && $_POST['editor'] != "") {
	$e = $cms->getEditorNumber($_POST['editor']);
	header("location: {$cms->editor[$e]->wpath}");
} else {
	header("location: $cms->wroot");
}

?>