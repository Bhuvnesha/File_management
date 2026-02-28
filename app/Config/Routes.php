<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'FileManager::index');
$routes->get('/filemanager/delete/(:segment)',"FileManager::delete/$1");
$routes->post('/filemanager/upload',"FileManager::upload");
$routes->get('/filemanager/download/(:segment)',"FileManager::download/$1");
$routes->get('/filemanager/zipBackup',"FileManager::zipBackup");
$routes->get('/filemanager/analytics',"FileManager::analytics");
