<?php
namespace skull;

class utils {
	public static function out($theScript) {
		return htmlspecialchars($theScript, ENT_QUOTES, "UTF-8");
	}
}

?>
