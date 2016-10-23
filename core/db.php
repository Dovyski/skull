<?php
namespace skull;

class db {
    private $mDb;

    static function init() {
        try {
            $this->mDb = new PDO(SKULL_DB_DSN, SKULL_DB_USER, SKULL_DB_PASSWORD, array(PDO::ATTR_PERSISTENT => true));
        	$this->mDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            print "Database error! " . $e->getMessage();
            die();
        }
    }

    static function pdo() {
        return $mDb;
    }
}

?>
