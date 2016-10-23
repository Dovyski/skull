<?php
@define('SKULL_VERSION',  '1.0.0');

@include_once dirname(__FILE__).'/../config.local.php';
require_once dirname(__FILE__).'/config.php';

// TODO: improve this?
session_start();
session_name(SKULL_SESSION_NAME);

require_once dirname(__FILE__).'/core/db.php';
require_once dirname(__FILE__).'/core/auth.php';
require_once dirname(__FILE__).'/core/user.php';
require_once dirname(__FILE__).'/core/view.php';
require_once dirname(__FILE__).'/core/utils.php';

?>
