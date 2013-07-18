<?php

class Nav {
	
	function Nav() {
		$this->leftColumn = "";
		$this->rightColumn = "Logged in as Someone. Log out";
		$this->pageTitle = "";
		$this->message = "";
	}
	
	function setUser($user) {
		$this->user = $user;
	}
	
	function setTitle($newTitle) {
		$this->pageTitle = "\n<h1>$newTitle</h1>";
	}
	
	function setLeftColumn($theContent) {
		$this->leftColumn = $theContent;
	}
	
	function setMessage($newMessage) {
		if ($newMessage != "") {
			$this->message = "<p>$newMessage</p>\n";
		}
	}
	
	function getHTML() {
		$this->constructRightColumn();
		
		$theHTML = <<<EOHTML
<table class="lr" cellspacing="0">
<tr>
<td class="l">$this->leftColumn</td>
<td class="r">$this->rightColumn</td>
</tr>
</table>
$this->pageTitle
$this->message
EOHTML;
		
		return $theHTML;
	}
	
	function constructRightColumn() {
		$this->rightColumn  = "Logged in as ";
		$this->rightColumn .= $this->user->fullname;
		$this->rightColumn .= " <a href=\"/cms/logout.php\">Log out</a>";
	}
}

?>