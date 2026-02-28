<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// $routes->group('', ['filter' => 'admin'], function($routes) {
// 	$routes->get('/', 'FileManager::index');
// 	$routes->get('filemanager/delete/(:segment)',"FileManager::delete/$1");
// 	$routes->post('filemanager/upload',"FileManager::upload");
// 	$routes->get('filemanager/download/(:segment)',"FileManager::download/$1");
// 	$routes->get('filemanager/zipBackup',"FileManager::zipBackup");
// 	$routes->get('filemanager/analytics',"FileManager::analytics");
// });

$routes->group('', ['filter' => 'role:admin,manager,viewer'], function($routes) {
    $routes->get('/', 'FileManager::index');
    $routes->get('filemanager/download/(:segment)', 'FileManager::download/$1', ['filter'=>'permission:download_file']);
});

$routes->group('', ['filter' => 'role:admin,manager'], function($routes) {
    $routes->post('filemanager/upload', 'FileManager::upload', ['filter' => 'permission:upload_file']);
    $routes->get('filemanager/analytics', 'FileManager::analytics',['filter' => 'permission:view_analytics']);
});

$routes->group('', ['filter' => 'role:admin'], function($routes) {
    $routes->get('filemanager/delete/(:segment)', 'FileManager::delete/$1');
    $routes->get('filemanager/zipbackup', 'FileManager::zipBackup',['filter' => 'permission:create_backup']);
});

$routes->get('unauthorized', function() {
    return "Access Denied!";
});