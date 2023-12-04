<?php
require 'spaceweb_db.php';
require 'session.php';
require 'controller.php';

$model = new Spaceweb_db;
$model->connect('127.0.0.1', 'space_web', 'Ie6fenge','space_web');
$session = new \spaceWeb\Session;
$request = [
    "device_info" => "5a98b3f2-8e8f-11ec-911a-efc249ad347d"
];

$controller = new \spaceWeb\Controller($model, $session, $request);
$path = "path_device_info";

$controller->$path();