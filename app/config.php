<?php
/**
 * This is all the site settings
 * You can set if development is true or false
 * You can enable/disable the minifier for HTML output
 * You can set REcaptcha public/private key for your own usage
 * Set-up the database and/or driver you will use and the charset
 * By default charset is utf8mb4 that is only added in MySQL 5.5+
 */

/**
 * Site settings
 */
define('DEBUG', false);
define('DEFAULT_LANG', 'en');
define('MINIFY_DATA', true);

/**
 * REcaptcha settings
 */
define('RECAPTCHA_PUBLIC', 'YOUR_PUBLIC_G_RECAPTCHA');
define('RECAPTCHA_PRIVATE', 'YOUR_PRIVATE_G_RECAPTCHA');


/**
 * Database settings
 */
define('DATABASE_USER', 'your_username');
define('DATABASE_PASS', 'your_password');
define('DATABASE_NAME', 'database_name');
define('DATABASE_HOST', '127.0.0.1');

define('DATABASE_DRIVER', 'mysql');
define('DATABASE_CHARSET', 'utf8mb4');


/*
 * Extra settings
 */
ini_set("highlight.comment", "#656565");
ini_set("highlight.default", "#AD398A");
ini_set("highlight.html", "#888888");
ini_set("highlight.keyword", "#056AC1; font-weight: bold");
ini_set("highlight.string", "#056AC1; font-weight: bold");
