<?php



$showInBrowser = false;

require_once("../../class/Database.php");
$database = new Database();

require_once("../../../class/Categories.php");
$categories = new Categories();

$allCategories = $categories->getCategories();

/*
foreach ($allCategories as $page => $items) {
	if ($page != "Directory Only") {
		foreach ($items as $item) {
			$notDirectory[] = $item;
		}
	}
}
*/

//$catlist = "('" . join("','",$notDirectory) . "')";
$catlist = "('" . join("','",$allCategories) . "')";

$theQuery  = "SELECT * FROM `entries` ";
$theQuery .= "WHERE `cat1` IN $catlist ";
$theQuery .= "AND `mapshow` = 'true' ";

$results = $database->getResults($theQuery);

if ($showInBrowser) {
	echo "<html><body><xmp>";
	//echo "$theQuery\n\n";
	
	//print_r($notDirectory);
}

echo "<map>\n";

while ($row = mysql_fetch_assoc($results)) {
	$id   = $row['id'];
	$name = $row['name'];
	$cat1 = $row['cat1'];
	$url  = $row['url'];
	$x    = $row['mapx'];
	$y    = $row['mapy'];
	
	//$cat = $categories->getPageFromCategory($cat1);
	$cat = $cat1;
	$cat = strtolower($cat);
	$cat = str_replace(" ","",$cat);
	
	echo "\t<item id=\"$id\" x=\"$x\" y=\"$y\">\n";
	echo "\t\t<name>$name</name>\n";
	echo "\t\t<cat>$cat</cat>\n";
	echo "\t\t<url>$url</url>\n";
	echo "\t</item>\n";
}

echo "</map>\n";

if ($showInBrowser) {
	echo "</xmp></body></html>";
}

?>