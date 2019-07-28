<?php


namespace ShareMyArt\Controller;


use ShareMyArt\Model\Persistence\UserFinder;
use ShareMyArt\Model\Validation\FormInputValidator\UserValidator;
use ShareMyArt\Model\Validation\FormValidator\LoginFormValidator;

class UserController
{

    public function login()
    {
        $errors = [];
        require_once "src/View/Template/loginForm.php";
    }

    public function loginPost()
    {
        session_start();


        $loginFormValidator = new LoginFormValidator();
        $errors = $loginFormValidator->validateInput($_POST);

        $userFinder = new UserFinder();
        $user = $userFinder->findUserByEmail($_POST['email']);

        $userValidator = new UserValidator();
        $userValidationErrors = $userValidator->validateUser($user);

        $errors = array_merge($userValidationErrors, $errors);

        if (empty($errors)) {
            $_SESSION['userId']=$user->getId();
            header('Location:/user/profile');
        }

        require_once "src/View/Template/loginForm.php";

    }

    public function showProfile()
    {
        session_start();
        var_dump($_SESSION['userId']);
        require_once "src/View/Template/myProfile.php";
    }

}