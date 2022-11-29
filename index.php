<?php
require 'spaceweb_db.php';
require 'session.php';
require 'controller.php';
$model = new Spaceweb_db;
$model->connect('127.0.0.1', 'space_web', 'Ie6fenge','space_web');

$session = new \spaceWeb\Session($model);
// session_set_save_handler($session);
// session_start();


$controller = new \spaceWeb\Controller($model, $session, $_GET);
$path = isset($_SERVER['PATH_INFO']) 
    ? "path_".preg_replace('/\//', '', $_SERVER['PATH_INFO'])
    : "default";
if (method_exists($controller, $path)) {
    $controller->$path();
} else {
    $controller->default();
}

?>