<?php



$debug = false;

// instantiate the user
require_once("class/User.php");
$user = new User;

// instantiate the database
require_once("class/Database.php");
$database = new Database;

// instantiate the CMS
require_once("class/CMS.php");
$cms = new CMS;

$redir = $_POST['redir'];
$theTable = $_POST['edid'];

// select the current editor
$thisID  = $_POST['edid'];
$thisNum = $cms->getEditorNumber($thisID);
$cms->selectEditor($thisNum);
//$cms->dump();

//echo "save.php: begin switch<br>\n";

switch ($_POST['action']) {
	case "Cancel":
		// redirect back to the list with no changes
		$theQuery = "";
		break; // end Cancel
	case "Save Item":
		//echo "save.php: begin Save Item<br>\n";	
		// Save the item to the database
		
		$id = $database->prepVariable($_POST['id']);
		//editorPresave();
		$presave = $cms->curEditor->doPresave($debug);
		
		//echo "save.php: Save Item, getting Set Phrase<br>\n";	
		$setphrase = $cms->curEditor->getSetPhrase();
		
		//echo "save.php: Save Item, constructing query<br>\n";	
		if ($id == "new") {
			$theQuery  = "INSERT `$theTable` ";
			$theQuery .= $setphrase;
		} else {
			$theQuery  = "UPDATE `$theTable` ";
			$theQuery .= $setphrase;
			$theQuery .= " WHERE id = '$id'";
		}
		
		break; // end Save Item
	case "Delete Item";
		//echo "Needs to be sent back to editor for confirmation.";
		
		$theQuery = "";
		$id = $database->prepVariable($_POST['id']);
		//$redir = $cms['edit'] . $_POST['list'] . "/?del=$id";
		$redir = $cms->curEditor->wpath . "?del=$id";
		break; // end Delete Item
	case "Delete";
		$id = $database->prepVariable($_POST['id']);
		
		$theQuery = "DELETE FROM `$theTable`"
		. " WHERE id = '$id'"
		. " LIMIT 1";
		break; // end Delete
}

//echo "save.php: switch complete<br>\n";

// append alpha & category to $redir, if present
if (isset($_POST['alpha'])) {
	$filterVars[] = "alpha=" . urlencode($database->prepVariable($_POST['alpha']));
}
if (isset($_POST['category'])) {
	$filterVars[] = "category=" . urlencode($database->prepVariable($_POST['category']));
}
if (isset($filterVars)) {
	$redir .= "?";
	$redir .= join("&", $filterVars);
}

if ($debug) {
	echo "Query: $theQuery<br>\n<br>\n";
	echo "Action: " . $_POST['action'] . "<br>\n";
	echo "Presave: $presave<br>\n";
	echo "Redir: $redir<br>\n";
	echo "Table: $theTable<br>\n";
	echo "<pre>POST ";
	print_r($_POST);
	echo "</pre>";
} else {
	if ($theQuery != "") {
		$database->getResults($theQuery);
	}
	header("Location: $redir");
}

?>