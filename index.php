<?php
require 'model.php';
require 'session.php';
require 'controller.php';
require 'usersController.php';

$model = new Spaceweb_db;
$model->connect('127.0.0.1', 'space_web', 'Ie6fenge', 'space_web');

$session = new \spaceWeb\Session($model);
session_set_save_handler($session);
session_start();

// session->user_initialzie()

// session->user_cleanup()


$usersController = new \spaceWeb\usersController($model, $session, $_POST);

if (array_key_exists('register', $_POST)) {

    if (empty($_POST['firstname'])) {
        header("Location: /front/?error=First Name is required");
        exit();
    } else if (empty($_POST['lastname'])) {
        header("Location: /front/?error=Last Name is required");
        exit();
    } else if (empty($_POST['nickname'])) {
        header("Location: /front/?error=nickname is required");
        exit();
    } else if (empty($_POST['email'])) {
        header("Location: /front/?error=E-mail is required");
        exit();
    } else if (empty($_POST['password'])) {
        header("Location: /front/?error=Password is required");
        exit();
    } else if (empty($_POST['repeatpassword'])) {
        header("Location: /front/?error=Repeat password is required");
        exit();
    } else {
        header("Location: /front/");
    }
}


$_SESSION['test'] = 'blablabla';

session_gc();


$controller = new \spaceWeb\Controller($model, $session, $_GET);
$path = isset($_SERVER['PATH_INFO'])
    ? "path_" . preg_replace('/\//', '', $_SERVER['PATH_INFO'])
    : "default";
if (method_exists($controller, $path)) {
    $controller->$path();
} else {
    var_dump($_REQUEST);
}
