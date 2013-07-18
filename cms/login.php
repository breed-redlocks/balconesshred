<?php



require_once("class/User.php");

//$user->login("strat","rare204");

if (isset($_POST['username']) && $_POST['username'] != "") {
	$user = new User("no redirect");
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user->login($username, $password);
} else {
	$user = new User;
}

?>