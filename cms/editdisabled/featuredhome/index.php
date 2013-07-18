<?php



require_once("../../class/User.php");
$user = new User;

// instantiate the CMS
require_once("../../class/CMS.php");
$cms = new CMS;

// select the current editor
$thisID  = $cms->getEditorID(__FILE__);
$thisNum = $cms->getEditorNumber($thisID);
$cms->selectEditor($thisNum);
//$cms->dump();

// instantiate the site
require_once("../../class/Site.php");
$site = new Site($cms);
$site->stndpage->nav->setLeftColumn($cms->curEditor->getHTMLPageNav());
$site->stndpage->nav->setUser($user);
$site->stndpage->setPageTitle($cms->curEditor->name);

// define the action and target for the editor
$cms->curEditor->action = "list";
$cms->curEditor->target = "none";
if (count($_GET) > 0) {
	if (isset($_GET['edit'])) {
		$cms->curEditor->action = "edit";
		$cms->curEditor->target = $_GET['edit'];
	}
	if (isset($_GET['del'])) {
		$cms->curEditor->action = "del";
		$cms->curEditor->target = $_GET['del'];
	}
}

// perform the actions (defines the $content variable)
switch ($cms->curEditor->action) {
	case "del":
		require_once("../../editactions/delete.php");
		break;
	case "edit":
		require_once("../../editactions/edit.php");
		break;
	case "list":
		require_once("../../editactions/list.php");
		//require_once("list.php");
		break;
}

// assemble and write out the page
$site->stndpage->divs->setDivContent("cnt",$content);
echo $site->stndpage->getHTML();

?>