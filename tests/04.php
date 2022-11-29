<?php 
require 'spaceweb_db.php';
require 'session.php';
require 'controller.php';

$model = new Spaceweb_db;
$model->connect('127.0.0.1', 'space_web', 'Ie6fenge','space_web');
$session = new \spaceWeb\Session;
$request = [
    
];


$controller = new \spaceWeb\Controller($model, $session, $request);
$path = "path_device_list";

$controller->$path();