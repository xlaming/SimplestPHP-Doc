<?php
/**
 * Autoloading file:
 * ##############################################
 * ########### Do not touch this file ###########
 * ##############################################
 * Firstly load the class Autoloader with name App
 * Adds the configuration file to the start of all
 * Verify if you are in debugging version or not
 * Set the application language automatically
 * Load vendor, classes and functions in the following order
 * Deny access to the folder app and vendor if using php webserver
 * And finally it adds and load all the routes then initialize all
 */

$autoloader = DIRECTORY . SEPARATOR . 'vendor' . SEPARATOR . 'Autoloader.php';
$configfile = DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'config.php';

if (!file_exists($configfile)) { die('Configuration file not found.'); }
require_once $configfile;

if (!file_exists($autoloader)) { die('Autoloader not found.'); }
require_once $autoloader;

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'on');
}

\App::setLanguage();
foreach(\App::loadVendor() as $dir) { require_once($dir); }
foreach(\App::loadClasses() as $dir) { require_once($dir); }
foreach(\App::loadFunctions() as $dir) { require_once($dir); }

\App::isForbidden(
    ['app', 'vendor']
);
use Vendor\Router;
$Route = new Router();
require_once 'routes.php';
$Route->initialize();
