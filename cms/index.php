<?php

ini_set("display_errors",true);

require_once("class/User.php");
$user = new User("no redirect");

// instantiate the CMS
require_once("class/CMS.php");
$cms = new CMS;

// instantiate the site
require_once("class/Site.php");
$site = new Site($cms);
$site->stndpage->nav->setUser($user);

if ($user->isLoggedIn()) {

// ============== User is logged in ==================

$site->stndpage->divs->setDivClass("nav","home");
$editorsHome = $cms->getHTMLEditorsHome();

$content = <<<EOHTML
<div id="left">
<h1 class="home">Welcome</h1>
<b>Use the options below or on the upper right to navigate:</b>
$editorsHome
</div><!-- /div id="left" -->
<div id="right">
<h2 class="home">System Requirements</h2>
<p class="home"><b>Web Browser</b></p>
<p class="home">To ensure proper operation, please use the most current version of
your preferred internet web browser.</p>
<p class="home"><b>Technology</b></p>
<p class="home">This site makes minimal use of Javascript, but it is not required.
Please note: use of web browser accelerators (especially those using "pre-fetching"
techniques) can cause unexpected results, including data loss.</p>
<p class="home">Portions of this site also require the Flash plugin.</p>
</div><!-- /div id="right" -->
EOHTML;

} else {

// ============== User is NOT logged in ==================

$site->stndpage->setCSSItems(array(
	"/standard.css",
	"/login.css",
	"/tables.css",
	"/styles.css"
));

$site->stndpage->divs->setDivContent("hdr",$site->loginheader);
$site->stndpage->divs->removeDiv("nav");

$content = <<<EOHTML
<form action="login.php" method="POST">
<table class="item" cellspacing="0">
<tr class="login">
<td class="norm">Username</td>
<td class="last"><input type="text" name="username"></td>
</tr>
<tr class="login">
<td class="norm">Password</td>
<td class="last"><input type="password" name="password"></td>
</tr>
<tr class="loginbtn">
<td class="norm"></td>
<td class="last"><input type="submit" value="Login"></td>
</tr>
</table>
</form>
EOHTML;

}

// assemble and write out the page
$site->stndpage->divs->setDivContent("cnt",$content);
echo $site->stndpage->getHTML();

?>