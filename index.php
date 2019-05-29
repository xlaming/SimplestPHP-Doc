<?php
/**
 * This is just for isRealUser()
 */
session_start();

/**
 * Set-up the directory variables
 */
define('DIRECTORY', __DIR__);
define('SEPARATOR', DIRECTORY_SEPARATOR);

/**
 * Finally adds the autoloader
 */
require DIRECTORY . SEPARATOR . 'app' . SEPARATOR .  'autoload.php';
?>