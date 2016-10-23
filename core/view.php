<?php
namespace skull;

class view {
	private static $mBaseUrl;
	private static $mData;

	public static function data() {
		return self::$mData;
	}

	public static function baseUrl() {
		return self::$mBaseUrl;
	}

	public static function render($theFile, $theData = array(), $theBase = '') {
		self::$mBaseUrl = $theBase == '' ? SKULL_VIEW_BASE : $theBase;
		self::$mData 	= $theData;

		$aFolder = SKULL_VIEW_FOLDER;

		$aLastChar = $aFolder[strlen($aFolder) - 1];
		$aFolder = $aLastChar == '\\' || $aLastChar == '/' ? $aFolder : $aFolder . DIRECTORY_SEPARATOR;
		$aPath = $aFolder . $theFile;

		if((@include $aPath) != true) {
			throw new \Exception('Skull: skull\view::render(' . $theFile . ') was unable to render specified file (path='. $aPath .').');
			echo 'SKULL - version ' . SKULL_VERSION . "\n\n";
		}

		if(SKULL_DEBUG) {
			echo '<pre>';
				echo 'SKULL - version ' . SKULL_VERSION . "\n\n";
				echo 'View file: ' . $aPath . "\n";
				echo 'Render time: ?' . "\n";
				echo 'DB queries: ?' . "\n";
			echo '</pre>';
		}
	}
}

?>
