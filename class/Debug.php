<?php

class Debug {
	function Debug() {
		$this->HTMLOutput = true;
		$this->messages = array();
	}
	
	function trace($flag, $text) {
		$this->messages[] = array(
			"flag" => $flag,
			"text" => $text,
		);
	}
	
	function getHTML() {
		$theHTML  = "";
		foreach ($this->messages as $message) {
			$flag = $message['flag'];
			$text = $message['text'];
			if (isset($this->flags[$flag]) and $this->flags[$flag]) {
				$messages[] = $text;
			}
		}
		
		if ($this->HTMLOutput and count($messages) > 0) {
			$theHTML .= "<div id=\"debug\">\n";
			$theHTML .= "<p>Debug Output</p>\n";
			$theHTML .= implode("<br>\n", $messages);
			$theHTML .= "</div>\n";
		}
		
		return $theHTML;
	}
}

?>