<?php

$site->stndpage->nav->setTitle($cms->curEditor->name);
$site->stndpage->nav->setMessage($cms->curEditor->getText("list"));
require_once("../../class/Table.php");
$table = new Table($cms);
$content = $table->getHTMLList();

?>