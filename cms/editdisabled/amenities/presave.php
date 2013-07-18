<?php
$result  = "Presave activated. ";
$result .= "Debug: $debug. ";

// check to see if spotlight is set to true
if (isset($_POST['spotlight']) && $_POST['spotlight'] == "true") {
	$result .= "Found Spotlight to handle. ";
	
	$psQuery  = "UPDATE `entries` ";
	$psQuery .= "SET `spotlight` = 'false' ";
	$psQuery .= "WHERE `spotlight` = 'true' ";
	
	$result .= "Query: $psQuery";
	
	if (!$debug) {
		require_once("class/Database.php");
		$database = new Database;
		$database->getResults($psQuery);
	}
} else {
	$result .= "No Spotlight. ";
}
?>