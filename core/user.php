<?php

namespace skull;

class user {
	const REGULAR = 1;
	const ADMIN = 2;

	public static function getById($theUserId) {
		$aUser = null;
		$aQuery = skull\db::pdo()->prepare("SELECT id, login, name, email, type FROM users WHERE id = ?");

		if ($aQuery->execute(array($theUserId))) {
			$aUser = $aQuery->fetch();
		}

		return $aUser;
	}

	public static function findByIds($theUserIds) {
		$aUsers = array();
		$aIds = '';

		foreach($theUserIds as $aKey => $aValue) {
			$theUserIds[$aKey] = (int)$aValue;
		}
		$aIds = implode(',', $theUserIds);

		$aQuery = skull\db::pdo()->prepare("SELECT id, login, name, email, type FROM users WHERE id IN (".$aIds.")");

		if(count($theUserIds) > 0) {
			if ($aQuery->execute()) {
				while ($aRow = $aQuery->fetch()) {
					$aUsers[$aRow['id']] = $aRow;
				}
			}
		}
		return $aUsers;
	}

	public static function findAll() {
		$aRet = array();
		$aQuery = skull\db::pdo()->prepare("SELECT id, login, name, email, type FROM users WHERE 1 ORDER BY name ASC");

		if ($aQuery->execute()) {
			while ($aRow = $aQuery->fetch()) {
				$aRet[$aRow['id']] = $aRow;
			}
		}

		return $aRet;
	}

	public static function isLevel($theUserInfo, $theLevel) {
		return $theUserInfo['type'] == $theLevel;
	}

	public static function getConferencePrice($theUserInfo) {
		return $theUserInfo['type'] == USER_LEVEL_EXTERNAL ? CONFERENCE_PRICE_EXTERNAL : CONFERENCE_PRICE;
	}

	public static function loginfyName($theName) {
		$aParts = explode(' ', strtolower($theName));
		$aName  = '';

		for ($i = 0; $i < count($aParts) - 1; $i++) {
			$aName .= strlen($aParts[$i]) >= 1 ? $aParts[$i][0] : '';
		}

		$aName .= $aParts[$i];
		return $aName;
	}
}

?>
