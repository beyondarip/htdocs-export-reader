<?php
// Error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Constants
define('ROOT_PATH', dirname(__DIR__));
define('INPUT_DIR', ROOT_PATH . '/input');
define('ALLOWED_EXTENSIONS', ['md']);

// Composer autoload if needed later
// require_once ROOT_PATH . '/vendor/autoload.php';