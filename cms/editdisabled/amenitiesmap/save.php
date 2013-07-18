<?php



$debug = false;

// instantiate the user
require_once("../../class/User.php");
$user = new User;

// instantiate the database
require_once("../../class/Database.php");
$database = new Database;

foreach ($_POST as $id => $xypair) {
	// prep x and y
	$xyarray = explode(",", $xypair);
	$x = $xyarray[0];
	$y = $xyarray[1];
	
	// sanitize query variables
	$id = $database->prepVariable($id);
	$x = $database->prepVariable($x);
	$y = $database->prepVariable($y);
	
	// construct the query
	$theQuery  = "UPDATE `amenities` ";
	$theQuery .= "SET `mapx` = '$x', `mapy` = '$y' WHERE `id` = '$id'";


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
	header("Location: viewmap.php");
}

?>