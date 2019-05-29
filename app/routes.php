<?php
/**
 * All the routes for your website you add in this file
 * First field is the /urlpath, second is the function name aka controller
 * The last field is the function name
 * It is all too simple so you can handle it easily
 */

/* Main */
$Route->new('/', ['\Functions\Home', 'index']);

/* Admin CP */
$Route->new('/admin', ['\Functions\Admin\Home', 'index']);
$Route->new('/admin/login', ['\Functions\Admin\Login', 'index']);
$Route->new('/admin/logout', ['\Functions\Admin\Logout', 'index']);
$Route->new('/admin/pages', ['\Functions\Admin\Pages', 'index']);
$Route->new('/admin/categories', ['\Functions\Admin\Categories', 'index']);
$Route->new('/admin/new_page', ['\Functions\Admin\NewPage', 'index']);
$Route->new('/admin/edit_page', ['\Functions\Admin\EditPage', 'index']);
$Route->new('/admin/new_category', ['\Functions\Admin\NewCategory', 'index']);
$Route->new('/admin/del_page', ['\Functions\Admin\Remove', 'pages']);
$Route->new('/admin/del_category', ['\Functions\Admin\Remove', 'categories']);