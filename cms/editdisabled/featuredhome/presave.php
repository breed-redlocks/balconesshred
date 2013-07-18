<?php
$result  = "Presave activated. ";
$result .= "Debug: $debug. ";

// check to see if active is set to true
if (isset($_POST['active']) && $_POST['active'] == "true") {
	$result .= "Found active value to handle. ";
	
	$psQuery  = "UPDATE `featuredhome` ";
	$psQuery .= "SET `active` = 'false' ";
	$psQuery .= "WHERE `active` = 'true' ";
	
	$result .= "Query: $psQuery";
	
	if (!$debug) {
		require_once("class/Database.php");
		$database = new Database;
		$database->getResults($psQuery);
	}
} else {
	$result .= "No active value. ";
}
?>