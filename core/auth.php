<?php
namespace skull;

class auth {
	public static function isValidUser($theUserLogin, $thePassword) {
		$aQuery = db::pdo()->prepare("SELECT id FROM users WHERE login = ? AND password = ?");
		$aRet = false;

		$aQuery->execute(array($theUserLogin, self::hash($thePassword)));

		return $aQuery->rowCount() == 1;
	}

	public static function hash($thePassword) {
		// TODO: improve this!
		return md5($thePassword . PASSWORD_SALT);
	}

	public static function login($theUserLogin) {
		$aQuery = db::pdo()->prepare("SELECT id, name, type FROM users WHERE login = ?");

		if ($aQuery->execute(array($theUserLogin))) {
			$aUser = $aQuery->fetch();

			$_SESSION['authenticaded'] = true;
			$_SESSION['user'] = array('name' => $aUser['name'], 'id' => $aUser['id'], 'type' => $aUser['type']);
		}
	}

	public static function getAuthenticatedUserInfo() {
		return user::getById($_SESSION['user']['id']);
	}

	public static function allowNonAuthenticated() {
		if(self::isAuthenticated()) {
			header('Location: ' . (self::isAdmin() ? 'admin.index.php' : 'index.php'));
			exit();
		}
	}

	public static function allowAdmin() {
		if(!self::isAuthenticated()) {
			header('Location: login.php');
			exit();

		} else if(!self::isAdmin()){
			header('Location: restricted.php');
			exit();
		}
	}

	public static function allowAuthenticated() {
		if(!self::isAuthenticated()) {
			header('Location: login.php');
			exit();
		}
	}

	public static function logout() {
		unset($_SESSION);
		session_destroy();
	}

	public static function isAuthenticated() {
		return isset($_SESSION['authenticaded']) && $_SESSION['authenticaded'];
	}

	public static function isAdmin() {
		return isset($_SESSION['admin']) && $_SESSION['admin'] == true;
	}
}

?>
