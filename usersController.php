<?php

namespace spaceWeb;

class usersController
{

    var $model;
    var $session;
    var $request;


    function __construct($model, $session, $request)
    {
        $this->model = $model;
        $this->session = $session;
        $this->request = $request;
    }

    public function validateCreateUser()
    {
        $firstName = $this->request["firstname"];
        $lastName = $this->request["lastname"];
        $nickName = $this->request["nickname"];
        $email = $this->request["email"];
        $password = $this->request["password"];
        $repeatPassword = $this->request["repeatpassword"];

        if (!$firstName) {
            $error = "First name is required<br>";
        }
        if (!$lastName) {
            $this->error .= "Last name is required<br>";
        }
        if (!$nickName) {
            $this->error .= "Nickname is required<br>";
        }
        if (!$email) {
            $this->error .= "Email is required<br>";
        }
        if ($password !== $repeatPassword) {
            $this->error .= "Passwords did not similar<br>";
        }
        if ($this->error) {
            $this->error = "Following error in your form<b> <br>" . $this->error;
        } else {
            if ($this->model->checkEmail($email) == false) {
                $this->error .= "Your E-mail already in use";
            } else {
                $this->model->createUser($firstName, $lastName, $nickName, $email, $password);
            }
        }
    }
}
