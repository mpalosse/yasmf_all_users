<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use yasmf\DataSource;
use yasmf\Router;

$data_source = new DataSource(
    $host = 'localhost',
    $port = 8889, # to change with the port your mySql server listen to
    $db_name = 'all_users', # to change with your db name
    $user = 'username', # to change with your db username
    $pass = '*******', # to change with your db password
    $charset = 'utf8mb4'
);

$router = new Router() ;
$router->route('all_users',$data_source);
