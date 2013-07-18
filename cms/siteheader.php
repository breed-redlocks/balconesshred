<?php

$this->loginheader = "<img src=\"/cms/images/logo.gif\"><!-- from siteheader.php -->";

$editorMenu = $this->cms->getHTMLEditorMenu();

$this->header = <<<EOHTML
<table class="lr" cellspacing="0">
<tr>
<td class="l">
<a href="/cms/"><img src="/cms/images/logo.gif" border="0"></a>
</td>
<td class="r">
<form action="/cms/loadeditor.php" method="post">
$editorMenu
<noscript><input type="Submit" value="Go"></noscript>
</form>
</td>
</tr>
</table>
EOHTML;

?>