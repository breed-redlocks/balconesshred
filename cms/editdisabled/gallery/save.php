<?php



$debug = false;

// instantiate the user
require_once("../../class/User.php");
$user = new User;

// instantiate the database
require_once("../../class/Database.php");
$database = new Database;

foreach ($_POST as $sort => $id) {
	
	// sanitize query variables
	$id   = $database->prepVariable($id);
	$sort = $database->prepVariable($sort);
	
	// construct the query
	$theQuery  = "UPDATE `work` ";
	$theQuery .= "SET `sort` = '$sort' WHERE `id` = '$id'";


	if ($debug) {
		echo "$theQuery<br>\n";
		echo "- If debug weren't on, this query would have been executed.<br>\n";
	} else {
		if ($theQuery != "") {
			$database->getResults($theQuery);
		}
	}
}

if ($debug) {
	echo "<pre>POST ";
	print_r($_POST);
	echo "</pre>";
	echo "- If debug weren't on, I'd have redirected.\n";
} else {
	header("Location: index.php");
}

?>