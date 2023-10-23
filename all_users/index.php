<?php
const PREFIX_TO_RELATIVE_PATH = "/all_users";
require $_SERVER[ 'DOCUMENT_ROOT' ] . PREFIX_TO_RELATIVE_PATH . '/lib/vendor/autoload.php';

use application\DefaultComponentFactory;
use yasmf\DataSource;
use yasmf\Router;

$data_source = new DataSource(
    $host = 'all_users_db',
    $port = 3306, 
    $db_name = 'all_users', 
    $user = 'all_users', 
    $pass = 'all_users', 
    $charset = 'utf8mb4'
);



$router = new Router(new DefaultComponentFactory()) ;
$router->route(PREFIX_TO_RELATIVE_PATH,$data_source);
