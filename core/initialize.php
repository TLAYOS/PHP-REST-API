<?php

defined('DIRECTORY_SEPARATOR') ? null : define('DIRECTORY_SEPARATOR','DIRECTORY_SEPARATOR');
defined('SITE_ROOT') ? null : define('SITE_ROOT',DIRECTORY_SEPARATOR .'xampp'.DIRECTORY_SEPARATOR. 'htdocs'.DIRECTORY_SEPARATOR. 'REST API');

//Includes

defined('INC_PATH') ? null : define('INC_PATH',SITE_ROOT.DIRECTORY_SEPARATOR.'includes');
defined('CORE_PATH') ? null : define('CORE_PATH',SITE_ROOT.DIRECTORY_SEPARATOR.'core') ;

// Load Configure file first
require_once(INC_PATH.DIRECTORY_SEPARATOR.'config.php');
// Core classes
require_once(CORE_PATH.DIRECTORY_SEPARATOR.'post.php');

?>